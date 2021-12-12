<?php

namespace App\Http\Helper;

trait FileHandling {
    protected function getUploadedFilePath($file)
    {
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('uploads/media', $filename, 'public');

        return $path;
    }
}