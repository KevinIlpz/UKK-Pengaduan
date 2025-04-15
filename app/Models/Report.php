<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Report.php
class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'image',
        'voting',
        'status',
        'views',
    ];

    protected $casts = [
        'voting' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function likes()
    {
        return $this->hasMany(ReportLike::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function progress()
    {
        return $this->hasMany(ResponseProgress::class);
    }

    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by'); 
    }

    public function responseProgress()
    {
        return $this->hasOne(ResponseProgress::class);
    }
}

