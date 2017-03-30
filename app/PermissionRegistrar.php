<?php

namespace Naoray\Larablog;

use Illuminate\Contracts\Auth\Access\Gate;

class PermissionRegistrar
{
    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @param Gate $gate
     * @param Repository $cache
     */
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    /**
     *  Register the permissions.
     *
     * @return bool
     */
    public function registerPermissions()
    {
        $this->gate->define('view post', function ($user, $post) {
            return $post->is_published || $this->userIsPostsAuthor($user, $post);
        });

        $this->gate->define('edit post', function ($user, $post) {
            return $this->userIsPostsAuthor($user, $post);
        });

        $this->gate->define('delete post', function ($user, $post) {
            return $this->userIsPostsAuthor($user, $post);
        });
    }

    /**
     * Checks if the user is the posts owner.
     *
     * @return [type] [description]
     */
    public function userIsPostsAuthor($user, $post)
    {
        return $user->id == $post->author_id;
    }
}
