<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Cache;

class CacheTool extends Model
{
    //
    /**
     * Clear view and cache folder
     *
     * @return void
     */
    public static function clearAll()
    {
        Cache::flush();
        $viewFiles = new Filesystem;
        foreach ($viewFiles->files(storage_path() . '/framework/views') as $file) {
            $viewFiles->delete($file);
        }
    }

    /**
     * Clear cache folder
     *
     * @return void
     */
    public static function clearApp()
    {
        Cache::flush();
    }

    /**
     * Clear view folder
     *
     * @return void
     */
    public static function clearView()
    {
        $viewFiles = new Filesystem;
        foreach ($viewFiles->files(storage_path() . '/framework/views') as $file) {
            $viewFiles->delete($file);
        }
    }
}
