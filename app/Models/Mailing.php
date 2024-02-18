<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $message
 * @property int $sent_count
 * @property int $delivered_count
 *
 * @mixin Builder
 */
class Mailing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
    ];

    /**
     * @param Builder $query
     * @param array $data
     * @return void
     */
    public function scopeFilter(Builder $query, array $data): void
    {
        if (isset($data['date'])) {
            $query->whereDate('created_at', '=', $data['date']);
        }

        if (isset($data['period'])) {
            if ($data['period'] === 'week') {
                $query->where('mailings.created_at', '>=', now()->subWeek())->get();
            }

            if ($data['period'] === '30days') {
                $query->where('mailings.created_at', '>=', now()->subDays(30))->get();
            }

            if ($data['period'] === 'month') {
                $query->where('mailings.created_at', '>=', now()->subMonth())->get();
            }

            if ($data['period'] === 'quarter') {
                $query->where('mailings.created_at', '>=', now()->subQuarter())->get();
            }

            if ($data['period'] === 'year') {
                $query->where('mailings.created_at', '>=', now()->subYear())->get();
            }
        }
    }
}
