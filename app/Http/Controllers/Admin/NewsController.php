<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\History;
use Carbon\Carbon;

class NewsController extends Controller
{
//
  public function add()
  {
    return view('admin.news.create');
  }

  public function create(Request $request)
  {
// ↓Newsはモデル
    $this->validate($request, News::$rules);
    $news = new News;
    $form = $request->all();

    if (isset($form['image'])) {
      $path = $request->file('image')->store('public/image');
      $news->image_path = basename($path);
    } else {
      $news->image_path = null;
    }

    unset($form['_token']);
    unset($form['_image']);
    $news->fill($form);
    $news->save();

    return redirect('admin/news/create');
  }

// indexは一覧画面
  public function index(Request $request)
  {
    // cond_titleはユーザーが入力したタイトルの文字
    $cond_title = $request->cond_title;
    if ($cond_title != '') {
      $posts = News::where('title', $cond_title)->get();
    } else {
      // $postsにはnewsテーブルのレコードが全部入ってる
      $posts = News::all();
    }
    return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

  public function edit(Request $request)
  {
    $news = News::find($request->id);
    if (empty($news)) {
      abort(404);
    }
    return view('admin.news.edit', ['news_form' => $news]);
  }

  public function update(Request $request)
  {
    $this->validate($request, News::$rules);
    $news = News::find($request->id);
    $news_form = $request->all();

    if (isset($news_form['image'])) {
       $path = $request->file('image')->store('public/image');
       $news->image_path = basename($path);
    } else {
       $news->image_path = null;
    }

    unset($news_form['_token']);
    unset($news_form['image']);
    $news->fill($news_form)->save();

    $history = new History;
    \Debugbar::info($history);
    $history->news_id = $news->id;

    $history->edited_at = Carbon::now();
    $history->save();

    return redirect('admin/news');
  }

  public function delete(Request $request)
  {
    $news = News::find($request->id);
    $news->delete();
    return redirect('admin/news/');
  }
}
