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
     * Publish constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->htmlminifyerExecuter = $this->getHtmlMinifyerExecuter();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('start minify html...');

        $bladePath = config('view.compiled');

        if (! $bladePath) {
            throw new RuntimeException('Bladepath for the views not found.');
        }

        $filesizeBefore = $this->dirSize($bladePath);

        $this->checkFiles($bladePath);

        $this->minify($bladePath);

        $filesizeNow = $this->dirSize($bladePath);
        $kiloBytesSaved = $filesizeBefore - $filesizeNow;
        $this->comment('Filesize before: '.$filesizeBefore.'KB Now: '.$filesizeNow.'KB Saved: '.$kiloBytesSaved.'KB');

        $this->info('successful minified');
    }

    protected function checkFiles($bladePath)
    {
        foreach (glob($bladePath.'/*.php') as $filepath) {
            $this->checkFile($filepath);
        }
    }

    protected function checkFile($filepath)
    {
        $content = file_get_contents($filepath);

        // incorrect doctype
        if (strpos($content, '<!doctype>') !== false) {
            $content = str_replace('<!doctype>', '<!doctype html>', $content);
            file_put_contents($filepath, $content);
        }
    }

    protected function minify($bladePath)
    {
        $parameter = [
            "--input-dir $bladePath",
            "--output-dir $bladePath",
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

    protected function dirSize($directory)
    {
        $size = 0;
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
            $size += $file->getSize();
        }

        return $size;
    }
}
