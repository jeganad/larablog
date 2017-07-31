<?php

namespace Naoray\Larablog\Http\Controllers;

use Illuminate\Http\Request;
use Naoray\Larablog\Models\Post;
use Naoray\Larablog\Http\Requests\StorePostRequest;
use Naoray\Larablog\Http\Requests\UpdatePostRequest;
use Illuminate\Routing\Controller as BaseController;

class PostsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $publishedPosts = Post::ownedByUser($user)->published()->orderBy('published_at', 'DESC')->paginate(config('larablog.posts_per_page'));
        $unPublishedPosts = Post::ownedByUser($user)->notPublished()->orderBy('created_at', 'DESC')->paginate(config('larablog.posts_per_page'));

        return view('larablog::backend.index', compact('publishedPosts', 'unPublishedPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post([
            'title' => 'Example Title',
            'slug' => 'example-slug',
            'body' => "<h1>Heading</h1>\n\n<p>Example paragraph.</p>\n\n<p>Use <bold>HTML</bold> to write your post!</p>",
        ]);

        return view('larablog::backend.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post([
            'slug' => str_slug($request->slug),
            'title' => $request->title,
            'body' => $request->body,
            'is_published' => $request->is_published ? true : false,
        ]);
        $post->setAuthor(\Auth::user());
        $post->save();

        return redirect()->route('larablog.backend.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Naoray\Larablog\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('larablog::backend.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Naoray\Larablog\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('larablog::backend.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Naoray\Larablog\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->fill([
            'slug' => str_slug($request->slug),
            'title' => $request->title,
            'body' => $request->body,
            'is_published' => $request->is_published ? true : false,
        ]);
        $post->save();

        return redirect()->route('larablog.backend.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Naoray\Larablog\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('larablog.backend.posts.index');
    }
}
