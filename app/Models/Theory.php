<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    use HasFactory;
    protected $fillable = ['subject_name'];

    public function question()
    {
        //One to One and One of many (latestofmany)
        return $this->morphOne(Question::class,'questionable');
    }

    public function questions()
    {
        //One to Many
        return $this->morphMany(Question::class,'questionable');
    }
}
