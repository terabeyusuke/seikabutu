@extends('layouts.admin')
  <!-- //layouts/admin.blade.phpを読み込む -->
@section('title', 'ニュースの新規作成')
  <!-- //admin.blade.phpの@yield('content')にニュースの新規作成を埋め込む -->
@section('content')
  <!-- //admin.blade.phpの@yield('content')に以下を埋め込む -->
 <div class="container">
   <div class="row">
     <div class="col-md-8 mx-auto">
       <h2>ニュース新規作成</h2>
       <form action="{{ action('Admin\NewsController@create') }}" method="post" enctype="multipart/form-data">
         @if (count($errors) > 0)
          <ul>
            <!-- $errorsはタイトル本文画像 -->
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
         @endif

         <div class="form-group row">
           <label class="col-md-2" for="title">タイトル</label>
            <div class="col-md-10">
             <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
         </div>
         <!-- カテゴリーを追加　検索の際にカテゴリーの値が必要 -->
         <div class="form-group row">
               <div class="col-md-10">
                   <input type="radio" class="" name="category" value="芸能"><label>　芸能</label>
                   <input type="radio" class="" name="category" value="食べ物"><label>　食べ物</label>
                   <input type="radio" class="" name="category" value="その他"><label>　その他</label>
               </div>
         </div>
</label>
         <div class="form-group row">
           <label class="col-md-2" for="body">本文</label>
            <div class="col-md-10">
               <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
            </div>
         </div>

         <div class="form-group row">
           <label class="col-md-2" for="title">画像</label>
             <div class="col-md-10">
               <input type="file" class="form-control-file" name="image_path">
             </div>
         </div>
         {{ csrf_field() }}
         <!-- submitは<form actionを実行する -->
         <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
         <input type="submit" class="btn btn-primary" value="更新">

       </form>

     </div>
　 </div>
 </div>
@endsection
