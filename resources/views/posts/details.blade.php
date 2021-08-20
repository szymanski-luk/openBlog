@extends('layouts.app')
<title>{{ $post->title }}</title>
@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header bg-dark text-info">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-3">
                        <img src="{{ asset('/images/' . $author->img) }}" style="height: 100px; width: 100px; border-radius: 50%;" alt="Profile picture">
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-1">
                        <h1 class="display-2" style="margin-left: 10px">{{ $author->name }}</h1>
                    </div>
                    <div class="col-12" style="text-align: right">
                        <h1 class="display-6" style="color: white"> <i>{{ $author->blog_title }}</i></h1>
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
                                <p class="card-text"><small class="text-muted">Author: <a href="{{ route('blog', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></small></p>
                            </div>
                        </div>
                    </div>
            </div>


            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6" style="text-align: right">
                    @auth
                    <button class="btn btn-info" style="margin-left: auto" data-bs-toggle="modal" data-bs-target="#addCommentModal">Comment</button>
                    @endauth
                    @guest
                            <button class="btn btn-info" disabled style="margin-left: auto" title="Log in to comment">Log in to comment</button>
                    @endguest

                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-dark text-info">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="display-6" style="margin-left: 10px">Comments</h1>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @if(count($comments) > 0)
                        @foreach($comments as $comment)
                        <div class="row">
                            <div class="col-4 border-end">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                        <img src="{{ asset('/images/' . $comment->user->img) }}" style="height: 55px; width: 55px; border-radius: 50%;" alt="Profile picture">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 ">
                                        <a href="{{ route('blog', ['id' => $comment->user->id]) }}" style="text-decoration-line: none"><h5>{{ $comment->user->name }}</a></h5>
                                        <h6>{{ \App\Models\Post::query()->where('user_id', $comment->user_id)->count() }} posts</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                {!! nl2br(e($comment->content)) !!}
                                <p class="card-text mt-3"><small class="text-muted">{{ $comment->created_at }}</small></p>
                                @auth
                                    <button class="btn btn-outline-info" style="margin-left: auto" data-bs-toggle="modal" data-bs-target="#addReplyModal">Reply</button>
                                @endauth
                                @guest
                                    <button class="btn btn-outline-info" disabled style="margin-left: auto" title="Log in to comment">Log in to reply this comment</button>
                                @endguest
                            </div>
                        </div>
                            @foreach($replies as $reply)
                                @if($reply->comment_id == $comment->id)
                                    <div class="row">
                                        <div class="col-1">
                                        </div>
                                        <div class="col-11">
                                                <div class="row mt-5">
                                                    <div class="col-4 border-end">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                                <img src="{{ asset('/images/' . $reply->user->img) }}" style="height: 55px; width: 55px; border-radius: 50%;" alt="Profile picture">
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-sm-8 ">
                                                                <a href="{{ route('blog', ['id' => $reply->user->id]) }}" style="text-decoration-line: none"><h5>{{ $reply->user->name }}</a></h5>
                                                                <h6>{{ \App\Models\Post::query()->where('user_id', $reply->user_id)->count() }} posts</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <b>In response to</b> <a href="{{ route('blog', ['id' => $reply->user->id]) }}" style="text-decoration-line: none">{{ $reply->comment->user->name }}</a><br>
                                                        {!! nl2br(e($reply->content)) !!}
                                                        <p class="card-text mt-3"><small class="text-muted">{{ $reply->created_at }}</small></p>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        <hr>

                            <div class="modal" tabindex="-1" id="addReplyModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1>Add comment</h1>
                                        </div>
                                        <form class="row m-3" method="POST" action="{{ route('create_reply') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $post->id }}" name="post_id">
                                            <input type="hidden" value="{{ $comment->id }}" name="comment_id">
                                            <div class="col-12 ">
                                                <textarea class="form-control @error('contents') is-invalid @enderror" name="contents" placeholder="Content" maxlength="950" rows="10" aria-label="Content"></textarea>
                                                @error('contents')
                                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-11 my-2">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-info">Save comment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                    @else
                        <h4>Nobody has commented on this post yet :(</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>



    @auth
        <div class="modal" tabindex="-1" id="addCommentModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Add comment</h1>
                    </div>
                    <form class="row m-3" method="POST" action="{{ route('create_comment') }}">
                        @csrf
                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                        <div class="col-12 ">
                            <textarea class="form-control @error('contents') is-invalid @enderror" name="contents" placeholder="Content" maxlength="950" rows="10" aria-label="Content"></textarea>
                            @error('contents')
                            <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-11 my-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



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
