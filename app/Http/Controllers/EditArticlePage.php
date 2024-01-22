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
use Illuminate\Support\Facades\Validator;

class EditArticlePage extends Controller
{
    function edit_page($id)
    {
        $posts = Post::with('categories', 'articleImages', 'articleStatus')->where('id', $id)->get();
        $tags = PostTags::with('tag')->where('post_id', $id)->get();
        foreach ($tags as $postTag) {
            $tagName = $postTag->tag->name;
        }

        $tagNames = $tags->pluck('tag.name');
        $categories = Category::all();
        return view('admin.pages.editArticlePage', [
            'posts' => $posts,
            'categories'=>$categories,
            'tagNames'=>$tagNames
        ]);
    }
    function store_updatedPost (Request $request, $id) {

        $post = Post::find($id);
        $path = public_path('storage/images/mainImage');
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
        try {
            $validator = Validator::make($request->all(), [
                'date' => 'nullable|date_format:Y-m-d H:i:s',
            ]);

            if ($validator->fails()) {
                throw new \Exception('Invalid date format');
            }

            $post->time_date = $request->date ? Carbon::parse($request->date) : Carbon::now();

//        $post->time_date = $request->date;

        $post->save();
        PostTags::where('post_id', $post->id)->delete();

// Insert the new tags
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
        $articleStatus = Status::firstOrNew(['post_id' => $post->id]);
        $articleStatus->mainCheck = $request->has('mainCheck') ? 1 : 0;
        $articleStatus->boldCheck = $request->has('boldCheck') ? 1 : 0;
        $articleStatus->hideCheck = $request->has('hideCheck') ? 1 : 0;
        $articleStatus->favCheck = $request->has('favCheck') ? 1 : 0;
        $articleStatus->save();

        if ($request->category_checks) {
            $post->categories()->sync($request->category_checks);
        } else {
            $post->categories()->detach();
        }


        $photoSeriesPath = public_path('storage/images/photoSeries');

        if ($request->multi_images) {
            Images::where('post_id', $post->id)->delete();

            foreach ($request->multi_images as $key => $image) {
                $imageName = time() . '.' . $key . $image->extension();
                if (!File::isDirectory($photoSeriesPath)) {
                    File::makeDirectory($photoSeriesPath, 0777, true, true);
                }

                $multi_image = new Images([
                    'post_id' => $post->id,
                    'images' => $imageName,
                ]);

                $image->move($photoSeriesPath, $imageName);

                $multi_image->save();
            }
        }
        return redirect()->route('adminPanel');
    }
    function delete_image($id)
    {
        $image = Images::find($id);

        if ($image) {
            $imagePath = public_path('storage/images/photoSeries/' . $image->images);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Image not found'], 404);
    }
    private function parseVideoId(mixed $url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $params);
        return isset($params['v']) ? $params['v'] : null;
    }

}
