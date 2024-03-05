<?php


use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

//function getFeed ()
//{
//    $currentDateTime = Carbon::now();
//
//    return Post::with('articleStatus')
//        ->where('status', '!=', 0)
//        ->where('time_date', '<=', $currentDateTime)
//        ->limit(100)
//        ->orderBy('time_date', 'desc')
//        ->get();
//}


function getFeed()
{
    return Cache::remember('feed', Carbon::now()->addMinutes(1), function () {
        return Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->where('time_date', '<=', Carbon::now())
            ->limit(100)
            ->orderBy('time_date', 'desc')
            ->get();
    });
}



function getPhotos()
{
    return Cache::remember('photos_feed', Carbon::now()->addMinutes(1), function () {
        $currentDateTime = Carbon::now();

        return Post::whereHas('categories', function ($query) {
            $query->where('category', 'photos');
        })
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->limit(4)
            ->orderBy('time_date', 'desc')
            ->get();
    });
}

function getFavorites()
{
    return Cache::remember('favorite_posts', Carbon::now()->addMinutes(1), function () use ($currentDateTime) {
        return Post::with('articleStatus')
            ->whereHas('articleStatus', function ($query) {
                $query->where('favCheck', 1);
            })
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->orderBy('time_date', 'desc') // Order by date descending
            ->limit(3)
            ->get();
    });


}

