<?php

//
//namespace Alpaca\Block\Builder;
//
//use Alpaca\Block\Models\Block;
//
///**
// * This class gets all blocks.
// * It sorted, filtered and than returned the html for each area.
// */
//class BlockBuilder
//{
//    /**
//     * @var \Illuminate\Support\Collection
//     */
//    protected $blocks;
//
//    /**
//     * Returns a html with all blocks for the area.
//     *
//     * @param $area
//     * @return mixed
//     */
//    public function getDesktopBlocks($area)
//    {
//        $areaBlocks = $this->getBlockByArea($area);
//
//        if (is_null($areaBlocks)) {
//            return;
//        }
//
//        return $areaBlocks->map(function (Block $block, $key) {
//            // each block
//            return $this->getHtmlBlock($block, false);
//        })->implode('');
//    }
//
//    /**
//     * Check if any block exists for the area.
//     *
//     * @param $area
//     * @return bool
//     */
//    public function existsDesktopBlocks($area)
//    {
//        $blocks = $this->getDesktopBlockByArea($area);
//
//        return ! is_null($blocks);
//    }
//
//    /**
//     * Return a html block list.
//     *
//     * @return string
//     */
//    public function getMobileBlocks()
//    {
//        $allBlocks = $this->getAllBlocks();
//
//        return $allBlocks->map(function ($area, $key) {
//            // each area
//
//            return $area->map(function ($block, $key) {
//                if (is_null($block) || ! $block->mobile_view) {
//                    return '';
//                }
//
//                // each block
//                return $this->getHtmlBlock($block, true);
//            })->implode('');
//        })->implode('');
//    }
//
//    /**
//     * Return all blocks for this area.
//     *
//     * @param $area
//     * @return mixed
//     */
//    protected function getDesktopBlockByArea($area)
//    {
//        $allBlocks = $this->getAllBlocks();
//
//        if (isset($allBlocks[$area])) {
//            $allBlocks[$area]->filter(function (Block $block) {
//
//
//
//                if($block->desktop_view === 0 || mobile_view_on_desktop === 0){
//                    return false;
//                }
//
//                return true;
//                return $item > 2;
//            });
//
//
//            dd($allBlocks[$area]);
//            return $allBlocks[$area];
//        }
//    }
//
//    /**
//     * Load all blocks from database and events.
//     * Blocks collection will stored in this class.
//     *
//     * return void
//     */
//    public function initBlocks()
//    {
//        // get block
////        $databaseBlocks = Block::with(['menu', 'menu.items'])->whereActive(true)->orderBy('range', 'asc')->get();
//        $databaseBlocks = Block::with(['menu', 'menu.items'])->orderBy('range', 'asc')->get();
//        $eventBlocks = event('loadEventBlocks');
//
//        // merge
//        foreach ($eventBlocks as $eventBlock) {
//            $databaseBlocks->push($eventBlock);
//        }
//
//        // group by area
//        $this->blocks = $databaseBlocks
//            ->filter(function ($block) {
//                if (is_null($block)) {
//                    return false;
//                }
//
////                if ($block->active == false) {
////                    // event blocks are maybe not active
////                    return false;
////                }
//
//                // check exception rule
//                $ex = new Exception($block);
//
//                return $ex->isViewable();
//            })
//            ->sortBy('range')
//            ->groupBy('area');
//    }
//
//    /**
//     * Returns all blocks.
//     *
//     * @return \Illuminate\Support\Collection
//     */
//    protected function getAllBlocks()
//    {
//        if (is_null($this->blocks)) {
//            $this->initBlocks();
//        }
//
//        return $this->blocks;
//    }
//
//    private function getHtmlBlock(Block $block, $isMobileView)
//    {
//        // menu
//        if (is_null($block->menu_id) === false) {
//            $template = $isMobileView ? 'menu::menuMobile' : 'menu::menu';
//
//            return view($template, [
//                'menu' => $block->menu,
//                'isMobileView' => $isMobileView,
//            ])->render();
//        }
//
//        // block
//        $template = $isMobileView ? 'block::blockMobile' : 'block::block';
//
//        return view($template, [
//            'block' => $block,
//            'isMobileView' => $isMobileView,
//        ])->render();
//    }
//}
