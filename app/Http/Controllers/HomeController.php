<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function settings()
    {
        $user = User::query()->where('id', Auth::user()->id)->first();
        return view('user.settings', ['user' => $user]);
    }

    public function saveSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:30', 'max:3000'],
            'blog_title' => ['required', 'string', 'min:8', 'max:70'],
            'image' => ['mimes:png,jpg,jpeg'],
            'blog_description' => ['required', 'string', 'min:30', 'max:3000']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::query()->where('id', '=', $request->id)->first();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . 'id' . Auth::user()->id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('/images/' . $filename));

            $user->img = $filename;
        }

        $user->name= $request->name;
        $user->description = $request->description;
        $user->blog_title = $request->blog_title;
        $user->blog_description = $request->blog_description;
        $user->save();

        return redirect()->route('settings');
    }

    public function usersList()
    {
        $users = User::query()
                ->paginate(10);

        return view('user.list', ['users' => $users]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->search;

        $users = User::query()
                ->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('blog_title', 'LIKE', "%{$searchTerm}%")
                ->orWhere('blog_description', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                ->paginate(10);

        return view('user.list', ['users' => $users]);
    }

}
