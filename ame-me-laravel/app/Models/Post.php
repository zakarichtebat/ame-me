<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'category_id',
        'user_id',
        'meta_title',
        'meta_description',
        'views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }

            if (empty($post->user_id) && auth()->check()) {
                $post->user_id = auth()->id();
            }
        });
    }

    /**
     * Get the user who authored the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the post belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the comments for the post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    /**
     * Get all comments for the post, including replies.
     */
    public function allComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get approved comments.
     */
    public function approvedComments()
    {
        return $this->comments()->where('is_approved', true);
    }

    /**
     * Get the tags associated with the post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft posts.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to only include scheduled posts.
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '>', now());
    }

    /**
     * Check if the post is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    /**
     * Check if the post is a draft.
     *
     * @return bool
     */
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    /**
     * Check if the post is scheduled.
     *
     * @return bool
     */
    public function isScheduled()
    {
        return $this->status === 'published' && $this->published_at > now();
    }

    /**
     * Get the formatted date for the published date.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d F Y') : null;
    }

    /**
     * Get the reading time for the post.
     *
     * @return int
     */
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutesToRead = round($wordCount / 200);

        return max(1, $minutesToRead);
    }

    /**
     * Increment view count.
     *
     * @return void
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Get related posts.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedPosts($limit = 3)
    {
        return static::published()
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where('category_id', $this->category_id)
                    ->orWhereHas('tags', function ($q) {
                        $tagIds = $this->tags->pluck('id');
                        $q->whereIn('tags.id', $tagIds);
                    });
            })
            ->latest('published_at')
            ->take($limit)
            ->get();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}