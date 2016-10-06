<?php

namespace Alpaca\Gallery\Models;

use Alcodo\PowerImage\Jobs\CreateImage;
use Alcodo\PowerImage\Jobs\DeleteImage;
use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Response;

class Image extends Model
{
    protected $fillable = [
        'title',
        'filepath',
        'alt',

        'copyright_simple',

        'copyright_author',
        'copyright_title',
        'copyright_source_url',
        'copyright_license_url',
        'copyright_license_tag',
        'copyright_modification',
    ];

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (! empty($attributes)) {
            $this->onCreateOrUpdate($attributes);
        }

        return $this;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHtmlOutput()
    {
        // blade render
        $html = Response::view('gallery::wrapperBind', ['image' => $this])->getContent();
        $html = trim($html);

        // html prettify
        return $this->getPrettyHtml($html);
    }

    private function onCreateOrUpdate($attributes)
    {
        if (array_key_exists('file', $attributes) &&
            get_class($attributes['file']) === 'Symfony\Component\HttpFoundation\File\UploadedFile' ||
            get_class($attributes['file']) === 'Illuminate\Http\UploadedFile'
        ) {

            // delete old image (update image)
            if (! empty($this->filepath)) {
                // delete old image (update image)
                $this->dispatch(new DeleteImage($this->filepath));
            }

            // create image
            $createImage = new CreateImage($attributes['file'], $attributes['filename'], 'gallery/');
            $this->filepath = $createImage->handle();
        }
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        $filepath = $this->filepath;

        // db
        $result = parent::delete();

        // image files
        if ($result) {
            $deleteImage = new DeleteImage($filepath);
            $deleteImage->handle();
        }

        return $result;
    }

    /**
     * Return pretty html.
     *
     * @param $html
     * @return mixed
     */
    public function getPrettyHtml($html)
    {
        $params = [
            'show-body-only' => true,
            'indent' => true,
            'output-html' => true,
            'wrap' => 200, ];
        $tidy = tidy_parse_string($html, $params, 'UTF8');
        $tidy->cleanRepair();

        $this->htmlOutput = $tidy;

        return $tidy;
    }
}
