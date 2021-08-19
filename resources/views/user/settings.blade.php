@extends('layouts.app')
<title>Settings</title>
@section('content')
    <div class="container">
        <div class="container">
            <div class="card">
                <h1 class="card-header bg-dark text-info display-6">Settings</h1>
                <div class="card-body">
                    <form method="POST" action="{{ route('save_settings') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Describe yourself') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" maxlength="2800" name="description" placeholder="Something about you" required autofocus>{{ $user->description }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="blog_title" class="col-md-4 col-form-label text-md-right">{{ __('Blog title') }}</label>

                            <div class="col-md-6">
                                <input id="blog_title" type="text" class="form-control @error('blog_title') is-invalid @enderror" name="blog_title" value="{{ $user->blog_title }}" required autofocus>

                                @error('blog_title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="blog_description" class="col-md-4 col-form-label text-md-right">{{ __('Describe your blog') }}</label>

                            <div class="col-md-6">
                                <textarea id="blog_description" type="text" class="form-control @error('blog_description') is-invalid @enderror" maxlength="2800" name="blog_description" placeholder="Something about your blog" required autofocus>{{ $user->blog_description }}</textarea>

                                @error('blog_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="blog_description" class="col-md-4 col-form-label text-md-right">{{ __('Upload profile image') }}</label>

                            <div class="col-md-6">
                                <input class="form-control  @error('image') is-invalid @enderror" type="file" name="image" id="formFile">

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
