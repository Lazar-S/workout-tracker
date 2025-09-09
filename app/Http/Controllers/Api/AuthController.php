<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutRoutine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle an API login request.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        // Validate request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ])->status(401); // Return 401 Unauthorized
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login successful',
            'user' => Auth::user(),
        ], 200);
    }

    public function getRoutines(Request $request): JsonResponse
    {
        $user = $request->user(); // Sanctum resolves this from the session

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $routines = WorkoutRoutine::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->get();

        return response()->json([
            'message' => 'Routines retrieved successfully',
            'routines' => $routines,
        ], 200);
    }

    public function createRoutine(Request $request): JsonResponse
    {
        $user = $request->user(); // Sanctum resolves this from the session

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $workout = Workout::find($request->workout_id);

        $routine = WorkoutRoutine::create([
            'user_id' => $user->id,
            'workout_id' => $request->workout_id,
            'workout_name' => $workout->name,
        ]);

        return response()->json([
            'routine' => $routine,
        ], 201);
    }

    public function updateRoutine(Request $request): JsonResponse
    {
        $user = $request->user(); // Sanctum resolves this from the session

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $data = [
            'sets' => $request->sets,
            'reps' => $request->reps,
        ];

        return response()->json([
            'id' => $request->id
        ], 200);
//
//        if($data['sets'] < 0 || $data['reps'] < 0){
//            return response()->json([
//                'message' => 'Unprocessable, "sets" and "reps" must be 0 or higher',
//            ], 422);
//        }
//
//        $routine = WorkoutRoutine::where('id', $request->id)->update($data);
//
//        return response()->json([
//            'message' => 'Updated routine successfully',
//            'routine' => [
//                'id' => $routine->id,
//                'sets' => $routine->workout_id,
//                'reps' => $routine->workout_name,
//            ],
//        ], 200);
    }

    public function deleteRoutine(Request $request): JsonResponse
    {
        $user = $request->user(); // Sanctum resolves this from the session

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $routine = WorkoutRoutine::find($request->id);

        if($routine->id !== $user->id){
            return response()->json([
                "id" => $routine->id
            ], 403);
        }

        $routine->delete();

        return response()->json([
            'deleted_id' => $routine->id
        ], 200);
    }

    public function makePublic(Request $request): JsonResponse
    {
        $user = $request->user(); // Sanctum resolves this from the session

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $data = User::find($user->id);
        $data->public = $request->public;
        $data->save();

        return response()->json([
            'message' => 'Updated user successfully',
            'public' => $data->public
        ], 200);
    }
}
