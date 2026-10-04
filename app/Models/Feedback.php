<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * Table name is singular in migration: 'feedback'
     */
    protected $table = 'feedback';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'subject',
        'type'
    ];
}
