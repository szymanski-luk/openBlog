<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['list', 'usersPosts', 'postsInCategory']);
    }

    public function newPost()
    {
        $categories = Category::all();
        return view('posts.new', ['categories' => $categories]);
    }

    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:70'],
            'contents' => ['required', 'string', 'max:3000'],
            'image' => ['mimes:png,jpg,jpeg'],
            'category' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $post = new Post();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . 'id' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('/images/' . $filename));

            $post->img = $filename;
        }
        $post->title = $request->title;
        $post->content = $request->contents;
        $post->title = $request->title;
        $post->content = $request->contents;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category;
        $post->save();


        return redirect()->route('home');

    }

    public function list()
    {
        $posts = Post::query()
            ->orderByDesc('id')
            ->paginate(5);

        $allPosts = Post::all();

        $categories = Category::all();
        return view('posts.list', ['posts' => $posts, 'categories' => $categories, 'allPosts' => $allPosts]);
    }

    public function usersPosts($id)
    {
        $posts = Post::query()
            ->where('user_id', '=', $id)
            ->orderByDesc('id')
            ->paginate(5);

        $author = User::query()
            ->where('id', '=', $id)
            ->first();

        return view('posts.own', ['posts' => $posts, 'author' => $author]);
    }

    public function postsInCategory($id)
    {
        $posts = Post::query()
            ->where('category_id', '=', $id)
            ->orderByDesc('id')
            ->paginate(5);

        $categories = Category::all();

        $allPosts = Post::all();

        return view('posts.in_category', ['posts' => $posts, 'categories' => $categories, 'allPosts' => $allPosts, 'catId' => $id]);
    }

    public function details($id)
    {
        $post = Post::query()
            ->where('id', '=', $id)
            ->first();

        $author = User::query()
            ->where('id', '=', $post->user_id)
            ->first();

        $categories = Category::all();

        return view('posts.details', ['post' => $post, 'author' => $author, 'categories' => $categories]);
    }

    public function editPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:70'],
            'contents' => ['required', 'string', 'max:3000'],
            'image' => ['mimes:png,jpg,jpeg'],
            'category' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::query()->where('id', '=', $request->id)->first();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . 'id' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('/images/' . $filename));

            $post->img = $filename;
        }

        $post->title = $request->title;
        $post->content = $request->contents;
        $post->title = $request->title;
        $post->content = $request->contents;
        $post->category_id = $request->category;
        $post->save();

        return redirect()->route('post_detailed', ['id' => $request->id]);
    }
}
