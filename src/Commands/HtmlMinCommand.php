<?php

/*
 * This file is part of the overtrue/laravel-lang.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alpaca\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

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
     * Publish constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

        if (!$bladePath) {
            throw new RuntimeException('Bladepath for the views not found.');
        }

        $this->checkHtmlFiles($bladePath);


        // compress now
//        $process = new Process("html-minifier --inpllut-dir {$bladePath} --output-dir {$bladePath} --remove-comments --collapse-whitespace --minify-css --minify-js");
        $process = new Process("node_modules/html-minifier/cli.js --input-dir {$bladePath} --output-dir {$bladePath} --remove-comments --collapse-whitespace --minify-css --minify-js");
        $process->run();
ll
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // in case the .gitignore was changed
        $process = new Process("git checkout HEAD {$bladePath}/.gitignore");
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('successful minified');
    }

    protected function checkHtmlFiles($bladePath)
    {
        $files = app('Filesystem');
        dd($files);

        foreach ($files->glob("{$bladePath}/*") as $view) {
            $content = $files->get($view);

            // incorrect doctype
            if (strpos($content, '<!doctype>') !== false) {
                $files->put($view, str_replace('<!doctype>', '<!doctype html>', $content));
            }
        }
    }
}
