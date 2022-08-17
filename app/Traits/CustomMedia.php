<?php

namespace App\Traits;

use App\Helpers\ArrHelper;
use App\Helpers\SysHelper;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

trait CustomMedia
{
    protected $allowed_modules = ['chat'];
    protected $default_allowed_max_file_count = 10;
    protected $default_allowed_max_file_size = 1024 * 1024 * 10;
    protected $default_allowed_file_extensions = ["jpg","png","jpeg","pdf","doc","docx","xls","xlsx","txt"];
    protected $temp_path = 'temp/';

    private function getAllowedExtension($media)
    {
        return Arr::get($media, 'allowed_file_extensions', $this->default_allowed_file_extensions);
    }

    private function getAllowedMaxFileCount($media)
    {
        return Arr::get($media, 'allowed_max_file_count', $this->default_allowed_max_file_count);
    }

    /**
     * Get pre requisite
     */
    public function mediaPreRequisite() : array
    {
        $medias = ArrHelper::getVar('media');
        $post_max_size = SysHelper::getPostMaxSize();
        $media = request()->query('module') ? Arr::get($medias, request()->query('module'), []) : [];

        $allowed_file_extensions = $this->getAllowedExtension($media);
        $allowed_max_file_count = $this->getAllowedMaxFileCount($media);

        return compact('allowed_file_extensions', 'allowed_max_file_count', 'post_max_size');
    }

    public function validateModule()
    {
        if (! request()->query('module')) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }

        if (! in_array(request()->query('module'), $this->allowed_modules)) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_input')]);
        }
    }

    public function validateFile()
    {
        // $this->validateModule();

        $this->validateExtension();

        $this->validateFileSize();
    }

    private function validateExtension()
    {
        // $medias = ArrHelper::getVar('media');
        // $media = request()->query('module') ? Arr::get($medias, request()->query('module'), []) : [];
        // $allowed_extensions = $this->getAllowedExtension($media);
        $allowed_extensions = explode(',', config('config.system.allowed_file_extensions'));

        $extension = request()->file('file')->getClientOriginalExtension();

        if (! in_array($extension, $allowed_extensions)) {
            throw ValidationException::withMessages(['message' => trans('upload.invalid_extension', ['attribute' => $extension])]);
        }
    }

    private function validateFileSize()
    {
        $post_max_size = SysHelper::getPostMaxSize();

        $size = request()->file('file')->getSize();

        if ($size > $post_max_size * 1024 * 1024) {
            throw ValidationException::withMessages(['message' => trans('upload.file_size_exceeds')]);
        }
    }
}
