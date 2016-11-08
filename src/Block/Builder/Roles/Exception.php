<?php

namespace Alpaca\Block\Builder\Roles;

use Alpaca\Block\Models\Block;
use Illuminate\Support\Facades\Request;

/**
 * Class Exception.
 *
 * Check if block is a exception
 */
class Exception
{
    /**
     * @var Block
     */
    private $block;

    /**
     * WhiteList constructor.
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function isViewable()
    {
        if (empty($this->block->exception)) {
            return true;
        }

        if ($this->block->exception_rule) {
            return $this->hasAccess();
        } else {
            return ! $this->hasAccess();
        }
    }

    private function hasAccess()
    {
        $patterns_quoted = preg_quote($this->block->exception, '/');
        $to_replace = [
            '/(\r\n?|\n)/', // newlines
            '/\\\\\*/',     // wildcard
        ];
        $replacements = [
            '|',
            '.*',
        ];

        $regexpPatter = '/^('.preg_replace($to_replace, $replacements, $patterns_quoted).')$/';

        return (bool) preg_match($regexpPatter, Request::path());

        return true;
    }
}
