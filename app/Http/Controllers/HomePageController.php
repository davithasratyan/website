<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;

class HomePageController extends Controller
{

    public function index() {
        $currentDateTime = Carbon::now();
        $sliderPosts = Post::with('articleStatus')
            ->whereHas('articleStatus', function ($query) {
                $query->where('mainCheck', 1);
            })
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->limit(5)
            ->orderBy('time_date', 'desc')
            ->get();

        $categories = Category::with(['posts' => function ($query) use($currentDateTime) {
                $query->where('status', 0)->where('time_date', '<=', $currentDateTime);
            }, 'children'])
            ->get();

        return view('mainPage.homepage.home', [
            'sliderPosts' => $sliderPosts,
            'categories' => $categories
        ]);
    }
}
