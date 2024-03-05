<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class HomePageController extends Controller
{

//    public function index() {
//        $currentDateTime = Carbon::now();
//        $sliderPosts = Post::with('articleStatus')
//            ->whereHas('articleStatus', function ($query) {
//                $query->where('mainCheck', 1);
//            })
//            ->where('status', '!=', 0)
//            ->where('time_date', '<=', $currentDateTime)
//            ->limit(5)
//            ->orderBy('time_date', 'desc')
//            ->get();
//
//        $mainPageCategories = Category::with(['posts' => function ($query) use($currentDateTime) {
//                $query->where('status', 0)->where('time_date', '<=', $currentDateTime);
//            }, 'children'])
//            ->get();
//
//        return view('mainPage.homepage.home', [
//            'sliderPosts' => $sliderPosts,
//            'mainPageCategories' => $mainPageCategories
//        ]);
//    }

    public function index() {
        // Check if the cached data exists
        if (Cache::has('mainPageData')) {
            // Retrieve the data from the cache
            $data = Cache::get('mainPageData');
        } else {
            // Retrieve the current datetime
            $currentDateTime = Carbon::now();

            // Retrieve slider posts
            $sliderPosts = Post::with('articleStatus')
                ->whereHas('articleStatus', function ($query) {
                    $query->where('mainCheck', 1);
                })
                ->where('status', '!=', 0)
                ->where('time_date', '<=', $currentDateTime)
                ->limit(5)
                ->orderBy('time_date', 'desc')
                ->get();

            // Retrieve main page categories
            $mainPageCategories = Category::with(['posts' => function ($query) use($currentDateTime) {
                $query->where('status', 0)->where('time_date', '<=', $currentDateTime);
            }, 'children'])
                ->get();

            // Store the data in the cache
            Cache::put('mainPageData', [$sliderPosts, $mainPageCategories], now()->addMinutes(1));

            // Assign the data to a variable
            $data = [$sliderPosts, $mainPageCategories];
        }

        // Return the view with the data
        return view('mainPage.homepage.home', [
            'sliderPosts' => $data[0],
            'mainPageCategories' => $data[1]
        ]);
    }
}
