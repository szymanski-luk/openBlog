@extends('layouts.app')
<title>Users</title>
@section('content')
    <div class="container">
        <form method="GET" action="{{ route('search') }}">
            <div class="row" style="margin-left: 20px; margin-right: 20px">
                <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="What would you like to find?" name="search" value="@if(isset($_GET['search'])){{ $_GET['search'] }}@endif" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button type="submit" class="btn btn-outline-danger">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        @if(count($users) > 0)
            @foreach($users as $user)
                <a href="{{ route('blog', ['id' => $user->id]) }}"  id="user-card" style="text-decoration-line: none">
                    <div class="card mb-3 mt-3" style="margin-left: 30px; margin-right: 30px" >
                        <div class="card-header bg-dark text-info" >
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-3">
                                    <img src="{{ asset('/images/' . $user->img) }}" style="height: 100px; width: 100px; border-radius: 50%; object-fit:cover" alt="Profile picture">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-1">
                                    <h1 class="display-4" style="margin-left: 10px">{{ $user->name }}</h1>
                                </div>
                                <div class="col-12" style="text-align: right">
                                    <h1 class="display-6" style="color: white"> <i>{{ $user->blog_title }}</i></h1>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="row">
                <img src="{{ asset('images/' . 'oops.png') }}" style="max-width: 300px; margin-left: auto; margin-right: auto" alt="Oops">
                <h2 style="text-align: center; margin-top: 15px">No one associated with the phrase "<b>{{ $_GET['search']}}</b>" was found</h2>
            </div>
        @endif


            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
    </div>

@endsection
