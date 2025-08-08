<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Chef;
use App\Models\Menu;
use App\Models\Event;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('frontend.layouts.main', [
            'chefs' => Chef::latest()
                ->select(['name', 'position', 'description', 'image', 'insta_link', 'linked_link'])
                ->limit(3)
                ->get(),

            'events' => Event::latest()
                ->where('status', 'active')
                ->select(['name', 'price', 'description', 'image'])
                ->get(),

            'categories' => Category::whereIn('name', ['Starters', 'Breakfast', 'Lunch', 'Dinner'])
                ->with(['menus' => function ($query) {
                    $query->where('status', 'active')
                        ->select(['category_id', 'name', 'description', 'price', 'image'])
                        ->orderBy('name', 'asc');
                }])
                ->select(['id', 'name', 'slug'])
                ->get(),

            'images' => Image::latest()
                ->select(['name', 'slug', 'description', 'file'])
                ->get()
        ]);
    }
}
