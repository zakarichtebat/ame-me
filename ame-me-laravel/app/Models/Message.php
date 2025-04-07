<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'content',
        'ip_address',
        'is_read',
        'read_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Mark the message as read.
     *
     * @return bool
     */
    public function markAsRead()
    {
        if ($this->is_read) {
            return true;
        }

        $this->is_read = true;
        $this->read_at = now();

        return $this->save();
    }

    /**
     * Mark the message as unread.
     *
     * @return bool
     */
    public function markAsUnread()
    {
        if (!$this->is_read) {
            return true;
        }

        $this->is_read = false;
        $this->read_at = null;

        return $this->save();
    }

    /**
     * Scope a query to only include unread messages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only include read messages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}