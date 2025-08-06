<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Chef;
use App\Models\Menu;
use App\Models\Event;
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
                ->limit(3)->get(),

            'events' => Event::latest()
                ->select(['name', 'price', 'description', 'image', 'status'])
                ->where('status', 'active')
                ->get(),
        ]);
    }
}
