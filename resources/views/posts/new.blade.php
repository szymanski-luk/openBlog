@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1 class="card-header bg-dark text-info display-6">New post</h1>
            <form method="POST" action="{{ route('create_post') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <div class="col">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" required placeholder="Title" name="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col">
                            <textarea id="description" type="text" class="form-control @error('contents') is-invalid @enderror" rows="15" maxlength="2800" name="contents" placeholder="Content" required autofocus></textarea>

                            @error('contents')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control  @error('img') is-invalid @enderror" type="file" name="image" id="formFile">

                                @error('img')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select mb-3 @error('category') is-invalid @enderror" id="category" name="category" aria-label="Category">
                                @foreach($categories as $category)
                                    @if($loop->index == 0)
                                        <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="card-footer bg-dark">
                    <button type="submit" class="btn btn-outline-info">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
