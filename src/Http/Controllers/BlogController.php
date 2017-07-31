<?php

namespace Naoray\Larablog\Http\Controllers;

use Naoray\Larablog\Models\Post;
use Illuminate\Routing\Controller as BaseController;

class BlogController extends BaseController
{
    /**
     * Show all blog posts.
     *
     * @return [type] [description]
     */
    public function index()
    {
        $posts = Post::published()->orderBy('published_at', 'DESC')->paginate(config('larablog.posts_per_page'));

        return view('larablog::frontend.index', compact('posts'));
    }

    /**
     * Show single post page.
     *
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function show(Post $post)
    {
        return view('larablog::frontend.show', compact('post'));
    }
}
