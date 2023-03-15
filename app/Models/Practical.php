<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Practical extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name'];

    public function question()
    {
        return $this->morphOne(Question::class,'questionable');
    }

    public function questions()
    {
        return $this->morphMany(Question::class,'questionable');
    }
}
