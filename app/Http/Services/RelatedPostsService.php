<?php

namespace App\Http\Services;

use App\Models\PostTags;

class RelatedPostsService
{
    function fetchRelatedPosts($id)
    {
        $firstPostTags = PostTags::where('post_id', $id)->with('post', 'tag')->get();
        $relatedPosts = [];
        if (!$firstPostTags->isEmpty()) {
            $tagName = $firstPostTags->first()->tag->name;
            $relatedPosts = PostTags::whereHas('tag', function ($query) use ($tagName) {
                $query->where('name', $tagName);
            })
                ->with('post')
                ->where('post_id', '!=', $id)
                ->whereHas('post', function ($query) {
                    $query->where('status', '!=', 0);
                })
                ->limit(6)
                ->get();
        }
        return $relatedPosts;

    }
}
