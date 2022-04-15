<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GetImageTrait
{
    /**
     * Get upload image folder name in public/upload
     *
     * @return string
     */
    public function getImageFolder()
    {
        $class_name = substr(get_class($this), strrpos(get_class($this), '\\') + 1);
        return Str::singular(Str::snake($class_name, ''));
    }

    /**
     * Get uploaded image name in public/upload/upload-image-folder
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->getImageFolder() .'/'.$this->getKey().'/' . $this->image;
    }
}
