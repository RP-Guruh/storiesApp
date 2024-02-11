<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Story;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function stories() {
        return $this->hasMany(Story::class);
    }
}
