<?php

use App\Models\Post;
use Illuminate\Support\Carbon;

function getFeed ()
{
    $currentDateTime = Carbon::now();

    return Post::with('articleStatus')
        ->where('status', '!=', 0)
        ->where('time_date', '<=', $currentDateTime)
        ->limit(100)
        ->orderBy('time_date', 'desc')
        ->get();
}

function getPhotos() {
    $currentDateTime = Carbon::now();

    return Post::whereHas('categories', function ($query) {
        $query->where('category', 'photos');
    })
        ->where('status', '!=', 0)
        ->where('time_date', '<=', $currentDateTime)
        ->limit(6)
        ->orderBy('time_date', 'desc')
        ->get();
}

function getFavorites(){

    $currentDateTime = Carbon::now();

    return Post::with('articleStatus')
        ->whereHas('articleStatus', function ($query) {
            $query->where('favCheck', 1);
        })
        ->where('status', '!=', 0)
        ->where('time_date', '<=', $currentDateTime)
        ->limit(3)
        ->get();
}
