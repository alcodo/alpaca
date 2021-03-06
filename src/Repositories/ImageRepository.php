<?php

namespace Alpaca\Repositories;

use Alpaca\Models\Menu;
use Alpaca\Models\Block;
use Alpaca\Models\Image;
use Illuminate\Support\Facades\Storage;
use Alpaca\Events\Image\ImageWasCreated;
use Alpaca\Events\Image\ImageWasDeleted;
use Alpaca\Events\Image\ImageWasUpdated;
use Illuminate\Support\Facades\Validator;

class ImageRepository
{
    /**
     * Create a page.
     *
     * @param array $data
     * @return Menu
     */
    public function create(array $data): Image
    {
        Validator::make($data, [
            'file' => 'required|image',

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

        $data['filepath'] = Storage::disk('public')->putFile('images', $data['file']);

        $image = Image::create($data);

        event(new ImageWasCreated($image));

        return $image;
    }

    public function update(Image $image, array $data): Image
    {
        Validator::make($data, [
            'file' => 'nullable|image',

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

        if (isset($data['file']) && ! empty($data['file'])) {
            Storage::disk('public')->delete($image->filepath);

            $data['filepath'] = Storage::disk('public')->putFile('images', $data['file']);
        } else {
            unset($data['filepath']);
        }

        $image->update($data);

        event(new ImageWasUpdated($image));

        return $image;
    }

    /**
     * @param Block $block
     * @return bool
     * @throws \Exception
     */
    public function delete(Image $image): bool
    {
        Storage::disk('public')->delete($image->filepath);
        $image->delete();

        event(new ImageWasDeleted($image));

        return true;
    }
}
