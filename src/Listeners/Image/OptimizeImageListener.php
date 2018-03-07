<?php

namespace Alpaca\Listeners\Image;

use Illuminate\Support\Facades\Storage;
use Alcodo\PowerImage\Events\ImageWasCreated;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OptimizeImageListener
{
    /**
     * Handle the event.
     *
     * @param ImageWasCreated $event
     */
    public function handle($event)
    {
        /** @var \Alpaca\Models\Image $image */
        $image = $event->image;

        $optimizerChain = OptimizerChainFactory::create();

        $optimizerChain->optimize(
            Storage::path($image->filepath)
        );
    }
}
