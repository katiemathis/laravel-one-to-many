<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:1',
                'content' => 'required|min:5',

            ]
        );

        $data = $request->all();

        $slug = Str::slug($data['title']);

        $counter = 1;

        while(Post::where('slug', $slug)->first()){
            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;
            
        }

        $data['slug'] = $slug;

        $post = new Post();

        $post->fill($data);

        $post->save();

        return redirect()->route('admin.posts.index', ['post' => $post->id])->with('status', 'post added successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if ($post) {
            return view('admin.posts.edit', compact('post'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|min:1',
                'content' => 'required|min:5',

            ]
        );

        $data = $request->all();

        $slug = Str::slug($data['title']);

        if ($post->slug != $slug) {
            $counter = 1;

            while(Post::where('slug', $slug)->first()){
                $slug = Str::slug($data['title']) . '-' . $counter;
                $counter++;
            }
            
        }

        $data['slug'] = $slug;

        $post->fill($data);

        $post->save();

        return redirect()->route('admin.posts.index', ['post' => $post->id])->with('status', 'post added successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');

    }
}
