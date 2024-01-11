<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Images;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTags;
use App\Models\Status;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index () {
        $categories = Category::all();
        return view('admin.pages.addArticle', ['categories'=>$categories]);
    }

    public function store (Request $request) {
        $path = public_path('storage/images/mainImage');
        $post = new Post();
        $post->title = $request->title;
        $post->article =  $request->article;
        $request->yt_link? $post->yt_link = $this->parseVideoId($request->yt_link) : $post->yt_link = null;
        if ($request->main_image) {
            $fileName = time() . '.' . $request->main_image->extension();
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $request->main_image->move($path, $fileName);
            $post->main_image = $fileName;
        }

        $post->status = $request->status;
        $request->date ? $post->time_date = $request->date : $post->time_date = Carbon::now();
        $post->save();

        $articleStatus = new Status();
        $articleStatus->post_id = $post->id;
        $request->mainCheck ? $articleStatus->mainCheck = 1 : $articleStatus->mainCheck = 0;
        $request->boldCheck ? $articleStatus->boldCheck = 1 : $articleStatus->boldCheck = 0;
        $request->hideCheck ? $articleStatus->hideCheck = 1 : $articleStatus->hideCheck = 0;
        $request->favCheck ? $articleStatus->favCheck = 1 : $articleStatus->favCheck = 0;
        $articleStatus->save();

        if ($request->category_checks) {
            foreach ($request->category_checks as $categoryId) {
                $articalCategory = new PostCategory();
                $articalCategory->post_id = $post->id;
                $articalCategory->category_id = $categoryId;
                $articalCategory->save();
            }
        }
        if($request->multi_images) {
            $photoSeriesPath = public_path('storage/images/photoSeries');
            foreach ($request->multi_images as $key => $image) {
                $multi_image = new Images();
                $imageName = time() . '.' . $key . $image->extension();
                if (!File::isDirectory($photoSeriesPath)) {
                    File::makeDirectory($photoSeriesPath, 0777, true, true);
                }
                $image->move($photoSeriesPath, $imageName);
                $multi_image->post_id = $post->id;
                $multi_image->images = $imageName;
                $multi_image->save();
            }

        }
        if ($request->tags) {
            $tagNames = explode(',', $request->tags);

            foreach ($tagNames as $tagName) {
                $tag = Tags::firstOrCreate(['name' => $tagName]);

                PostTags::create([
                    'post_id' => $post->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }


        return redirect()->route('adminPanel');
    }

    public function delete ($id) {
        $post = Post::find($id);
        $post->delete();

        $category = PostCategory::where('post_id', $id)->first();
        if ($category) {
            $category->delete();
        }

        $image = Images::where('post_id', $id)->first();
        if ($image) {
            $image->delete();
        }

        $status = Status::where('post_id', $id)->first();
        if ($status) {
            $status->delete();
        }

//        $tags = PostTags::where('post_id', $id)->first();
//
//        if ($tags) {
//            $tags->delete();
//        }
      return redirect()->back();
    }

    private function parseVideoId(mixed $url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $params);
        return isset($params['v']) ? $params['v'] : null;
    }
}
