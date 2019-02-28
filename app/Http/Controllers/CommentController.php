<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HTML;
use App\Profile;
use App\News;
use App\Comment;

class CommentController extends Controller
{
  public function delete(Request $request)
  {
    $comment = Comment::find($request->id);
    $comment->delete();
    return redirect('/');
  }
  public function create(Request $request)
  {
    $this->validate($request, Comment::$rules);
    $comment = new Comment;
    $form = $request->all();

    unset($form['_token']);

    $comment->fill($form);
    $comment->save();
    return redirect('/');
  }


}
