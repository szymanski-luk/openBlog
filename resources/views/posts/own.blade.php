@extends('layouts.app')
<title>{{ $author->blog_title }}</title>
@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header bg-dark text-info">
                <div class="row">
                    <div class="col-1">
                        <img src="{{ asset('/images/' . $author->img) }}" style="max-width: 100px; border-radius: 50%;" class="rounded" alt="...">
                    </div>
                    <div class="col-11">
                        <h1 class="display-2" style="margin-left: 10px">{{ $author->name }}</h1>
                    </div>
                    <div class="col-12" style="text-align: right">
                        <h1 class="display-6"> <i>{{ $author->blog_title }}</i></h1>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <h1 class="display-5" style="text-align: center">About</h1>
                    <div class="col-6 border-end">
                        <h1 class="display-6" style="text-align: right">me</h1>
                        <p class="card-text" style="text-align: right">{{ $author->description }}</p>
                    </div>
                    <div class="col-6">
                        <h1 class="display-6">blog</h1>
                        <p class="card-text">{{ $author->blog_description }}</p>
                    </div>

                </div>


            </div>

        </div>

        <div class="container">
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-header bg-dark text-info"><h1 class="display-6">{{ $post->title }}</h1></div>
                    <a href="{{ route('post_detailed', ['id' => $post->id]) }}" id="post-card" style="text-decoration-line: none">
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
                                <p class="card-text"><small class="text-muted">Author: <a href="#">{{ $post->user->name }}</a></small></p>
                            </div>
                        </div>
                    </div>
                    </a>

                </div>
            @endforeach
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
        </div>
    </div>
@endsection
