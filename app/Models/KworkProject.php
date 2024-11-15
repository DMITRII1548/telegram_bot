<?php

namespace App\Models;

use App\Observers\KworkProjectObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(KworkProjectObserver::class)]
class KworkProject extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'username',
    ];
}
