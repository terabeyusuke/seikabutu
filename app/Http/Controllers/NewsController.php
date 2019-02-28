<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HTML;
use App\News;
use App\Comment;
use App\Profile;
use App\Http\Requests;
use App\Post;
use Auth;


class NewsController extends Controller
{
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title !='') {
          $posts = News::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
           $posts = News::all()->sortByDesc('updated_at');
      }

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }


    public function indexhuman(Request $request)
    {
      $posts = News::where("category","芸能")->orderBy('updated_at', 'desc')->get();

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('news.indexhuman', ['headline' => $headline, 'posts' => $posts]);
    }


    public function indexfood(Request $request)
    {

          $posts = News::where("category","食べ物")->orderBy('updated_at', 'desc')->get();

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('news.indexfood', ['headline' => $headline, 'posts' => $posts]);
    }

    public function profile(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = Profile::find($request->id);
      $profile_form = $request->all();

      return view('news.profile', ['profile_form' => $profile]);
    }


    public function __construct()
    {
      $this->middleware('auth', array('except' => 'index'));
    }

    public function show($id) {
      $news = News::findOrFail($id);
      $like = $news->likes()->where('user_id', Auth::user()->id)->first();

      return view('news.show')->with(array('news' => $news, 'like' => $like));
    }


}
