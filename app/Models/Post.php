<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'article',
        'yt_link',
        'main_image',
        'time_date',
        'status'
    ];
    protected $casts = [
        'time_date' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }


    public function articleImages() {
        return $this->hasMany(Images::class, 'post_id', 'id');
    }

    public function articleStatus() {
        return  $this->hasOne(Status::class, 'post_id', 'id');
    }

}
