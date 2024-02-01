<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\FeedBack;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index () {
        $posts = Post::orderBy('time_date', 'desc')->paginate(10);
        return view('admin.admin', ['posts'=>$posts]);
    }

    public function searchArticle(Request $request)
    {
        $searchTerm = $request->q;
        $searchResults = Post::where('id', 'like', '%' . $searchTerm . '%')->get();
        return view('admin.pages.search', ['searchResults'=> $searchResults]);
    }

    public function addMediaIcons (){
        $icons = Contacts::all();
        return view('admin.pages.updateContacts', ['icons'=>$icons]);
    }

    public function addIcon (Request $request){
        $validated = $request->validate([
            'icon'=>'required',
            'color'=>'required',
            'link'=>'required'
        ]);

        if ($validated) {
            $contacts = new Contacts();
            $contacts->icon = $request->icon;
            $contacts->color = $request->color;
            $contacts->link = $request->link;
            $contacts->save();
            return redirect()->back()->with('successMessage', 'Սոցցանցն ավելացված է');
        }
    }

    public function deleteMediaIcon(Request $request)
    {
        if ( isset($request->id) && intval($request->id)>0) {
            Contacts::where('id', $request->id)->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function addContacts(Request $request)
    {
        $feedback = new FeedBack();
        $feedback->phone = $request->phone;
        $feedback->email = $request->email;

        FeedBack::query()->delete();

        $feedback->save();

        return redirect()->back();
    }

}
