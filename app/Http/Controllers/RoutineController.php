<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\WorkoutRoutine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RoutineController extends Controller
{
    public function getRoutines(Request $request){
        $workout_routines = WorkoutRoutine::where('user_id', $request->user()->id)->whereDate('created_at', Carbon::today())->get();
        return view("tracker", ["workouts" => Workout::all(), "workout_routines" => $workout_routines ]);
    }

    public function getHistory(Request $request){
        $workout_routines = WorkoutRoutine::where('user_id', $request->user()->id)->whereDate('created_at', '<', Carbon::today())->get();
        return view("history", [ "workout_routines" => $workout_routines ]);
    }

    public function handleRoutine(Request $request): RedirectResponse{
        $routine = WorkoutRoutine::find($request->routine_id);
        if($request->delete === "true"){
            $routine->delete();
        }
        else {
            $routine->sets = $request->sets > -1 ? $request->sets : 0;
            $routine->reps = $request->reps > -1 ? $request->reps : 0;
            $routine->save();
        }

        return redirect('/tracker');
    }

    public function createRoutine(Request $request): RedirectResponse {
        $workout = Workout::find($request->workout_id);

        WorkoutRoutine::create([
            'user_id' => $request->user()->id,
            'workout_id' => $workout->id,
            'workout_name' => $workout->name,
        ]);

        return redirect('/tracker');
    }
}
