<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $message
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
}
