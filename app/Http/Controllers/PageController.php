<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTags;
use App\Models\Tags;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
    public function index($id) {

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

        $currentDateTime = Carbon::now();
        $singlePost = Post::with(['categories' => function ($query) use ($id) {
            $query->where('post_id', $id);
        }])
            ->with('articleImages')
            ->where('id', $id)
            ->first();

        $categories = Category::with('posts', 'children')->get();
        $posts = Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->where('time_date', '<=', $currentDateTime)
            ->limit(100)
            ->orderBy('time_date', 'desc')
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
            ->limit(3)
            ->get();

        return view('mainPage.pages.articlePage', [
            'singlePost'=>$singlePost,
            'posts'=>$posts,
            'categories'=>$categories,
            'photos'=>$photos,
            'favorites'=>$favorites,
            'relatedPosts'=>$relatedPosts,
            'ogTitle' => $singlePost->title,
            'ogImage' => $singlePost->main_image,
            'ogDescription' => $singlePost->article,
        ]);
    }

    public function postsByCategory ($id) {

        $posts = Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->limit(100)
            ->orderBy('time_date', 'desc')
            ->get();
        $photos = Post::whereHas('categories', function ($query) {
            $query->where('category', 'photos');
        })
            ->where('status', '!=', 0)
            ->limit(6)
            ->orderBy('time_date', 'desc')
            ->get();
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        $favorites = Post::with('articleStatus')
            ->whereHas('articleStatus', function ($query) {
                $query->where('favCheck', 1);
            })
            ->where('status', '!=', 0)
            ->limit(3)
            ->get();
        $categoryPosts = $category->posts()->paginate(10);
        $categories = Category::with('posts', 'children')
            ->get();
        return view('mainPage.pages.categoryPage', [
            'posts'=>$posts,
            'photos'=>$photos,
            'categoryPosts'=>$categoryPosts,
            'category'=>$category,
            'categories'=>$categories,
            'favorites'=>$favorites
        ]);
    }



    public function search (SearchRequest $request)
    {
        $searchTerm = $request->q;

        $searchResults = Post::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('article', 'like', '%' . $searchTerm . '%');
        })
            ->where('status', '!=', 0)
            ->get();

        $page = request()->input('paged', 1);
        $perPage = 10;

        $searchResultsPaginated = new LengthAwarePaginator(
            $searchResults->forPage($page, $perPage),
            $searchResults->count(),
            $perPage,
            $page,
            [
                'path' => url()->current(),
                'pageName' => 'paged',
            ]
        );


        $categories = Category::with('posts', 'children')
            ->get();
        $favorites = Post::with('articleStatus')
            ->whereHas('articleStatus', function ($query) {
                $query->where('favCheck', 1);
            })
            ->where('status', '!=', 0)
            ->limit(3)
            ->get();
        $posts = Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->limit(100)
            ->orderBy('time_date', 'desc')
            ->get();
        $photos = Post::whereHas('categories', function ($query) {
            $query->where('category', 'photos');
        })
            ->where('status', '!=', 0)
            ->limit(6)
            ->orderBy('time_date', 'desc')
            ->get();

        return view('mainPage.pages.searchResults', [
            'searchResults'=>$searchResultsPaginated,
            'posts'=>$posts,
            'photos'=>$photos,
            'categories'=>$categories,
            'favorites'=>$favorites,
            'searchTerm'=>$searchTerm
        ]);

    }

    public function feed () {
        $posts = Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->orderBy('time_date', 'desc')
            ->paginate(20);
        $categories = Category::with('posts', 'children')
            ->get();
        return view('mainPage.pages.feed', ['posts'=>$posts, 'categories'=>$categories]);
    }

}
