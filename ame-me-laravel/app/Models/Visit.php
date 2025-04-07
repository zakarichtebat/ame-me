<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page',
        'ip_address',
        'user_agent',
        'count',
        'date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Increment visit count for a page.
     *
     * @param string $page
     * @param string $ipAddress
     * @param string $userAgent
     * @return void
     */
    public static function record($page, $ipAddress, $userAgent)
    {
        $date = now()->toDateString();

        $visit = self::firstOrNew([
            'page' => $page,
            'ip_address' => $ipAddress,
            'date' => $date,
        ]);

        $visit->user_agent = $userAgent;
        $visit->count = ($visit->count ?? 0) + 1;
        $visit->save();
    }

    /**
     * Get visits summary for a period.
     *
     * @param int $days
     * @return \Illuminate\Support\Collection
     */
    public static function summary($days = 30)
    {
        $startDate = now()->subDays($days)->toDateString();

        return self::where('date', '>=', $startDate)
            ->selectRaw('date, SUM(count) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    /**
     * Get popular pages.
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public static function popularPages($limit = 10)
    {
        return self::selectRaw('page, SUM(count) as total')
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }
}