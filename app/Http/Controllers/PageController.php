<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Services\PostService;
use App\Http\Services\RelatedPostsService;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index(PostService $postService, RelatedPostsService $related, $id) {
        $singlePost = $postService->getSinglePost($id);
        $this->incrementPostViews($id);
        $relatedPosts= $related->fetchRelatedPosts($id);

        return view('mainPage.pages.articlePage', [
            'singlePost' => $singlePost,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    protected function incrementPostViews($id) {
        $viewedKey = 'post_viewed_' . $id;
        if (!Session::has($viewedKey)) {
            Post::find($id)->increment('views');
            Session::put($viewedKey, true);
        }
    }


    public function postsByCategory ($id) {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        $categoryPosts = $category->posts()->paginate(10);

        return view('mainPage.pages.categoryPage', [
            'categoryPosts'=>$categoryPosts,
            'category'=>$category,
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

        return view('mainPage.pages.searchResults', [
            'searchResults'=>$searchResultsPaginated,
            'searchTerm'=>$searchTerm
        ]);

    }

    public function feed () {
        $posts = Post::with('articleStatus')
            ->where('status', '!=', 0)
            ->orderBy('time_date', 'desc')
            ->paginate(20);

        return view('mainPage.pages.feed', ['posts'=>$posts]);
    }

}
