<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Introduce;
use App\Models\Setting;

class GeneralController extends Controller
{
    protected $categories;

    public function __construct()
    {
        // Danh mục
        $menu = Category::where([
            'is_active' => 1,
        ])->orderBy('id', 'DESC')->get();

        // TT Câu hình
        $setting = Setting::first();

        $introduce = Introduce::first();

        // Chia sẻ dữ qua tất các layout
        view()->share([
            'setting' => $setting,
            'menu' => $menu,
            'introduce' => $introduce
        ]);
    }
}
