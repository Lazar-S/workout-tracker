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
use Illuminate\Support\Facades\Hash;
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
    public function issueToken(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'token_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->token_name)->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function getRoutines(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $routines = WorkoutRoutine::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->get();

        return response()->json([
            'routines' => $routines,
        ], 200);
    }

    public function createRoutine(Request $request): JsonResponse
    {
        $user = $request->user();
//        $user = Auth::user();
//        return response()->json($request->all(), 200);

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $workout = Workout::find($request->workout_id);

        $routine = WorkoutRoutine::create([
            'user_id' => $user->id,
            'workout_id' => $workout->id,
            'workout_name' => $workout->name,
        ]);

        return response()->json([
            'routine' => $routine,
        ], 201);
    }

    public function updateRoutine(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $data = [
            'sets' => $request->sets,
            'reps' => $request->reps,
        ];

        if($data['sets'] < 0 || $data['reps'] < 0){
            return response()->json([
                'message' => 'Unprocessable, "sets" and "reps" must be 0 or higher',
            ], 422);
        }

        $routine = WorkoutRoutine::find($id);
        $routine->sets = $data['sets'];
        $routine->reps = $data['reps'];
        $routine->save();

        return response()->json([
            'routine' => $routine,
        ], 200);
    }

    public function deleteRoutine(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $routine = WorkoutRoutine::find($id);

        if($routine->user_id !== $user->id){
            return response()->json([
                "id" => $routine->id
            ], 403);
        }

        $routine->delete();

        return response()->json([], 204);
    }

    public function makePublic(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $data = User::find($user->id);
        $data->public = $request->public;
        $data->save();

        return response()->json([
            'public' => $data->public
        ], 200);
    }
}
