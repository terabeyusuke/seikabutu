@extends('layouts.front')

@section('content')
  <div class="container">
      <hr color="#c0c0c0">
      <h1>最新記事＊食品ページ</h1>
      @if (!is_null($headline))
        <div class="row">
            <div class="headline col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-6">
                        <div class="caption mx-auto">
                            <div class="image">
                                @if ($headline->image_path)
                                  <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                                @endif
                            </div>
                            <div class="title p-2">
                                <h1>{{ str_limit($headline->title, 70) }}</h1>
                            </div>
                        </div>
                        <!-- ツイッター -->
                        <div class="twitter">
                          <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                        <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=large&mobile_iframe=true&width=75&height=28&appId" width="75" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                    </div>

                    <div class="col-md-6">
                        <p class="body mx-auto">{{ str_limit($headline->body, 650) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ユーザーコメント -->
        <div class="maine-comment">
            <div class="row mt-5">
                <div class="col-md-4 mx-auto">
                    <h3>コメント一覧</h3>
                    <ul class="list-group">
                      @if ($headline->comments != NULL)
                        @foreach ($headline->comments as $comment)
                          <li class="list-group-item">{{ $comment->comment }}</li>
                          <a href="{{ action('CommentController@delete', ['id' => $comment->id]) }}">削除</a>
                        @endforeach
                      @endif
                    </ul>
                </div>
            </div>
        </div>

        <label class="col-md-2" for="comment">コメント記入欄</label>
        <div class="col-md-10">
            <form action="{{ action('CommentController@create') }}" method="post" enctype="multipart/form-date">
              <input type="text" class="form-comment" name="comment" value="">
              <input type="hidden" name="news_id" value="{{$headline->id}}">
              <input type="submit" class="btn btn-comment" value="コメントを投稿">
              {{ csrf_field() }}
            </form>
        </div>
  </div>
  @endif
  <hr color="#c0c0c0">
  <div class="category">
    <label class="col-md-2" for="category">カテゴリ別に表示</label>

    <form action="{{ action('NewsController@index') }}" method="post" enctype="multipart/form-date">
       <input type="submit" class="button" value="新着順">
       {{ csrf_field() }}
    </form>
    <form action="{{ action('NewsController@indexhuman') }}" method="post" enctype="multipart/form-date">
       <input type="submit" class="button" value="芸能">
       {{ csrf_field() }}
   </form>
   <form action="{{ action('NewsController@indexfood') }}" method="post" enctype="multipart/form-date">
       <input type="submit" class="button" value="食べ物">
       {{ csrf_field() }}
   </form>
  </div>

    <div class="row">
      <h1>食べ物記事を表示</h1>
      <div class="posts col-md-8 mx-auto mt-3">
        @foreach($posts as $post)
         <div class="post">
             <div class="row">

                 <div class="text col-md-6">
                    <div class="date">
                      {{ $post->updated_at->format('Y年m月d日') }}
                    </div>
                    <div class="title">
                       {{ str_limit($post->title, 150) }}
                    </div>
                    <div class="body mt-3">
                       {{ str_limit($post->body, 1500) }}
                    </div>
                 </div>
                 <div class="image col-md-6 text-ridht mt-4">
                    @if ($post->image_path)
                        <img src="{{ asset('storage/image/' . $post->image_path) }}">
                    @endif
                 </div>
             </div>

         </div>
         <hr color="#c0c0c0">
        @endforeach

      </div>
    </div>
 </div>
 @endsection
