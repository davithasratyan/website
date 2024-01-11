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

        $posts = Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->limit(100)
            ->orderBy('time_date', 'desc')
            ->get();


        $categories = Category::with(['posts' => function ($query) use($currentDateTime) {
                $query->where('status', 0)->where('time_date', '<=', $currentDateTime);
            }, 'children'])
            ->get();

        $photos = Post::whereHas('categories', function ($query) {
            $query->where('category', 'photos');
        })
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->limit(6)
            ->orderBy('time_date', 'desc')
            ->get();

        $favorites = Post::with('articleStatus')
            ->whereHas('articleStatus', function ($query) {
                $query->where('favCheck', 1);
            })
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->orderBy('time_date', 'desc')
            ->limit(3)
            ->get();

        return view('mainPage.homepage.home', [
            'sliderPosts' => $sliderPosts,
            'favorites'=>$favorites,
            'posts' => $posts,
            'categories' => $categories,
            'photos'=>$photos,
        ]);
    }
}
