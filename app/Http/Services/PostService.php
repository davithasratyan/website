<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Models\PostTags;

class PostService
{

    public function getSinglePost($id){

        return Post::with(['categories' => function ($query) use ($id) {
            $query->where('post_id', $id);
        }])
            ->with('articleImages')
            ->where('id', $id)
            ->first();
    }

}
