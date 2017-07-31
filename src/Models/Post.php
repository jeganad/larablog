<?php

namespace Naoray\Larablog\Models;

use Carbon\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Naoray\Larablog\Contracts\Post as PostContract;

class Post extends Model implements PostContract
{
    use HasSlug;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['published_at', 'title'])
            ->saveSlugsTo('slug');
    }

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('larablog.table_name'));
    }

    /**
     * When is_published is set to True, published_at is also set.
     *
     * @param [type] $published [description]
     */
    public function setIsPublishedAttribute($published)
    {
        if ($published) {
            $this->published_at = Carbon::now();
        }

        $this->attributes['is_published'] = $published;
    }

    /**
     * A Post has to be applied to a user.
     *
     * @return [type] [description]
     */
    public function author()
    {
        return $this->belongsTo(
            config('auth.model') ?: config('auth.providers.users.model'), 'author_id'
        );
    }

    /**
     * Sets the author of this post.
     *
     * @param User $user [description]
     */
    public function setAuthor($user)
    {
        return $this->author()->associate($user);
    }

    /**
     * Get all published blog posts.
     *
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopePublished($query)
    {
        return $query->whereIsPublished(true);
    }

    /**
     * Get all unPublished blog posts.
     *
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeNotPublished($query)
    {
        return $query->whereIsPublished(false);
    }

    /**
     * Get all posts of current user.
     *
     * @param  [type] $query [description]
     * @param  [type] $user  [description]
     * @return [type]        [description]
     */
    public function scopeOwnedByUser($query, $user)
    {
        return $query->whereAuthorId($user->id);
    }
}
