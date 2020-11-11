<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('id', 'desc')->get();
        return view('posts.index', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'description' => 'required|max:255',
            'category_id' => 'required',
        ]);

        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
        ]);
        return redirect()->route('posts.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|unique:posts|max:255',
                'description' => 'required|max:255',
                'category_id' => 'required',
            ]);

            $post = Post::find($id);
            if (!$post) {
                return redirect()->route('posts.index');
            }
            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
            ]);
            return redirect()->route('posts.index');
        } catch (\Exception $exception) {
            return redirect()->route('posts.index');
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('posts.index');
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
