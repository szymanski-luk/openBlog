@extends('layouts.app')
<title>{{ $post->user->blog_title }}</title>
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
            <div class="card mb-3">
                <div class="card-header bg-dark text-info">
                    <h1 class="display-6">{{ $post->title }}</h1>
                    @auth
                        @if(Auth::user()->id == $post->user_id)
                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editingModal">Edit</button>
                        @endif
                    @endauth
                </div>
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('/images/' . $post->img) }}" style="max-width: 500px; margin-left: 10px; margin-top: 10px" class="card-img-top" alt="...">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <p class="card-text">{!! nl2br(e($post->content)) !!}</p>
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
            </div>
        </div>
    </div>



    @auth
        @if(Auth::user()->id == $post->user_id)
            <div class="modal" tabindex="-1" id="editingModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="row m-3" method="POST" action="{{ route('edit_post') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <div class="col-11">
                                <label for="title">Title</label>
                                <input type="text" style="width: 100%" class="form-control @error('title') is-invalid @enderror" placeholder="Title" aria-label="Username" id="title" name="title" value="{{$post->title}}" aria-describedby="basic-addon1">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-1">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="col-lg-6 col-sm-12 my-2">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control  @error('image') is-invalid @enderror" type="file" name="image" id="formFile">

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-5 col-sm-12 my-2">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    @foreach($categories as $category)
                                        @if(($loop->index + 1) == $post->category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-11 my-2">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('contents') is-invalid @enderror" name="contents" placeholder="Content" maxlength="2900" rows="15" aria-label="Content">{{ $post->content }}</textarea>
                                @error('contents')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-11 my-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
