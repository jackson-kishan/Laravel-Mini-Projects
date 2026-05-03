<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'is_approved',
        'user_id',
    ];

    public function user()
    {
       return $this->belongsTo(User::class)->withTrashed();
    }
}
