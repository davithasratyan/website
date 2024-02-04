<?php

use App\Models\Category;

function getCategories () {

    return Category::with('posts', 'children')->get();
}
