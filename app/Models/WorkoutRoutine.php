<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutRoutine extends Model
{
    protected $fillable = ['user_id', 'workout_id', 'workout_name', 'sets', 'reps'];
}
