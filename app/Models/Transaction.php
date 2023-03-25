<?php

namespace App\Models;

use App\Enums\Transactions\Status;
use App\Enums\Transactions\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'type' => Type::class,
        'status' => Status::class,
    ];
}
