<?php

namespace Alpaca\Commands;

use RecursiveIteratorIterator;
use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class HtmlMinCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'alpaca:html_minifier';

    /**
     * @var string
     */
    protected $description = 'Minify your blade HTML.';

    /**
     * @var string
     */
    protected $htmlminifyerExecuter;

    /**
     * @var string
     */
    protected $bladePath;

    /**
     * @var string
     */
    protected $qurantineDir;

    /**
     * Publish constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->htmlminifyerExecuter = $this->getHtmlMinifyerExecuter();
        $this->bladePath = config('view.compiled');
        $this->qurantineDir = '/tmp/qurantine_'.str_slug(config('app.name'));

        if (! $this->bladePath) {
            throw new RuntimeException('Bladepath for the views not found.');
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('start minify html...');

        $this->createQurantineDir();

        $filesizeBefore = $this->dirSize();

        $this->checkFiles();

        $this->minify();

        $this->removeAllQurantineFilesBack();

        $this->comment($this->getInfoLineAboutDifferentSize($filesizeBefore));

        $this->info('successful minified');
    }

    protected function checkFiles()
    {
        foreach (glob($this->bladePath.'/*.php') as $filepath) {
            if (is_dir($filepath)) {
                continue;
            }

            $content = file_get_contents($filepath);

            // exclude files
            if ($this->isQuarantineFile($content)) {
                $this->moveFileToQuarantine($filepath);
            }

            // incorrect doctype
            if (strpos($content, '<!doctype>') !== false) {
                $content = str_replace('<!doctype>', '<!doctype html>', $content);
                file_put_contents($filepath, $content);
            }
        }
    }

    protected function isQuarantineFile($content)
    {
        if (strpos($content, 'mail::message') !== false) {
            return true;
        }

        return false;
    }

    protected function minify()
    {
        $parameter = [
            "--input-dir $this->bladePath",
            "--output-dir $this->bladePath",
            '--file-ext php',
            '--use-short-doctype',
            '--remove-empty-attributes',
            '--remove-attribute-quotes',
            '--remove-comments',
            '--collapse-whitespace',
            '--minify-css',
            '--minify-js',
        ];

        $command = $this->htmlminifyerExecuter.' '.implode(' ', $parameter);
        $process = new Process($command);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    protected function getHtmlMinifyerExecuter()
    {
        $possibleExecuter = [
            'node_modules/html-minifier/cli.js',
            'html-minifier',
        ];

        foreach ($possibleExecuter as $executer) {
            $process = new Process($executer);
            $process->run();

            if ($process->isSuccessful()) {
                return $executer;
            }
        }
    }

    protected function dirSize()
    {
        $size = 0;
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->bladePath)) as $file) {
            $size += $file->getSize();
        }

        return $size;
    }

    protected function getInfoLineAboutDifferentSize($filesizeBefore)
    {
        $filesizeNow = $this->dirSize();

        $kiloBytesSaved = $filesizeBefore - $filesizeNow;

        return 'Filesize before: '.$filesizeBefore.'KB Now: '.$filesizeNow.'KB Saved: '.$kiloBytesSaved.'KB';
    }

    protected function createQurantineDir(): void
    {
        if (file_exists($this->qurantineDir)) {
            deleteDirectory($this->qurantineDir);
        }

        mkdir($this->qurantineDir);
    }

    protected function moveFileToQuarantine($filepath): void
    {
        $newFilepath = $this->qurantineDir.'/'.basename($filepath);
        rename($filepath, $newFilepath);
    }

    protected function removeAllQurantineFilesBack()
    {
        foreach (scandir($this->qurantineDir) as $filename) {
            if ($filename != '.' && $filename != '..') {
                rename($this->qurantineDir.'/'.$filename, $this->bladePath.'/'.$filename);
            }
        }
    }
}
