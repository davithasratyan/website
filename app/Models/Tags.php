<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tags extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];

    public function tags() {
        return  $this->belongsToMany(Tags::class, 'post_tags', 'post_id', 'tag_id');
    }
}
