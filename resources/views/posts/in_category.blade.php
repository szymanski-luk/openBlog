@extends('layouts.app')
<title>{{ $categories->where('id', '=', $catId)->first()->title }} - posts</title>
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-12">
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="card mb-3">
                                <div class="card-header bg-dark text-info"><h1 class="display-6">{{ substr($post->title, 0, 42) }}...</h1></div>
                                <a href="#" id="post-card" style="text-decoration-line: none">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('/images/' . $post->img) }}" style="max-width: 500px; margin-left: 10px; margin-top: 10px" class="card-img-top" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <p class="card-text">{!! nl2br(e(substr($post->content, 0, 700))) !!}...</p>
                                                <p class="card-text"><small class="text-muted">Last updated {{ $post->updated_at }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="card-text"><small class="text-muted">Category: <a href="{{ route('posts_in_category', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a></small></p>
                                            </div>
                                            <div class="col-6" style="text-align: right">
                                                <p class="card-text"><small class="text-muted">Author: <a href="{{ route('blog', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endforeach
                            <div class="d-flex justify-content-center">
                                {!! $posts->links() !!}
                            </div>
                    @else
                        <div class="row">
                            <img src="{{ asset('images/' . 'oops.png') }}" style="max-width: 300px; margin-left: auto; margin-right: auto" alt="Oops">

                            <h2 style="text-align: center; margin-top: 15px">There is no post in this category.</h2>
                        </div>
                    @endif
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header bg-dark text-info"><h2 class="display-6">Categories</h2></div>
                        <div class="row">
                            <div class="card-body">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="{{ route('posts_in_category', ['id' => $category->id]) }}">{{ $category->title }} ({{ $allPosts->where('category_id', '=', $category->id)->count() }})</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
