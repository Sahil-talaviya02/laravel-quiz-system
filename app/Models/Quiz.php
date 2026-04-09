<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quizzes";

    public function category() {
        return $this->belongsTo(Category::class);
    }

    function mcq() {
        return $this->hasMany(Mcq::class);
    }
}