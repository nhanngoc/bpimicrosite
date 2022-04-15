<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CacheTool;

class CacheToolsController extends Controller
{
    /**
     * Clear view and cache folder
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearAll()
    {
        CacheTool::clearAll();
        return redirect()->back()->with('status', 'Đã xóa tất cả bộ nhớ đệm ứng dụng và giao diện thành công !');
    }

    /**
     * Clear cache folder
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearApp()
    {
        CacheTool::clearApp();
        return redirect()->back()->with('status', 'Đã xóa bộ nhớ đệm ứng dụng thành công !');
    }

    /**
     * Clear view folder
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearView()
    {
        CacheTool::clearView();
        return redirect()->back()->with('status', 'Đã xóa bộ nhớ đệm giao diện thành công !');
    }
}
