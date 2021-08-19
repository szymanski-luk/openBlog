@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="display-1">{{ $posts[0]->user->name }}</h1>

        <div class="card mb-3">
            <div class="card-header bg-dark text-info">
                <img src="{{ asset('/images/' . $author->img) }}" class="rounded" alt="...">
                <h1 class="display-6">{{ $posts[0]->user->name }}</h1>
            </div>

            <div class="card-body">
                <p class="card-text">dgfhdfghfgd</p>

            </div>

        </div>

        <div class="container">
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-header bg-dark text-info"><h1 class="display-6">{{ $post->title }}</h1></div>
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
                                <p class="card-text"><small class="text-muted">Category: <a href="#">{{ $post->category->title }}</a></small></p>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <p class="card-text"><small class="text-muted">Author: <a href="#">{{ $post->user->name }}</a></small></p>
                            </div>
                        </div>
                    </div>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
@endsection
