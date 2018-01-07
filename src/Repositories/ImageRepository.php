<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Image\ImageWasCreated;
use Alpaca\Events\Image\ImageWasDeleted;
use Alpaca\Events\Image\ImageWasUpdated;
use Alpaca\Models\Block;
use Alpaca\Models\Image;
use Alpaca\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImageRepository
{

    /**
     * Create a page
     *
     * @param array $data
     * @return Menu
     */
    public function create(array $data): Image
    {
        Validator::make($data, [
            'filepath' => 'required|string|max:255',

            'title' => 'nullable|string',
            'alt' => 'nullable|string',

            'copyright_simple' => 'nullable|string',

            'copyright_author' => 'nullable|string',
            'copyright_title' => 'nullable|string',
            'copyright_source_url' => 'nullable|string',
            'copyright_license_url' => 'nullable|string',
            'copyright_license_tag' => 'nullable|string',
            'copyright_modification' => 'nullable|string',
        ])->validate();

        $image = Image::create($data);

        event(new ImageWasCreated($image, Auth::user()));

        return $image;
    }

    public function update(Image $image, array $data): Image
    {
        Validator::make($data, [
            'filepath' => 'required|string|max:255',

            'title' => 'nullable|string',
            'alt' => 'nullable|string',

            'copyright_simple' => 'nullable|string',

            'copyright_author' => 'nullable|string',
            'copyright_title' => 'nullable|string',
            'copyright_source_url' => 'nullable|string',
            'copyright_license_url' => 'nullable|string',
            'copyright_license_tag' => 'nullable|string',
            'copyright_modification' => 'nullable|string',
        ])->validate();

        $image->update($data);

        event(new ImageWasUpdated($image, Auth::user()));

        return $image;
    }

    /**
     * @param Block $block
     * @return bool
     * @throws \Exception
     */
    public function delete(Image $image): bool
    {
        $image->delete();

        event(new ImageWasDeleted($image, Auth::user()));

        return true;
    }
}