<?php

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

function getCategories()
{
    return Cache::remember('all_categories', now()->addMinutes(60), function () {
        return Category::with('posts', 'children')->get();
    });
}
