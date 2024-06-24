<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\MailService;

use App\Jobs\SendVerificationEmail;

class UserController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create($validated);

        SendVerificationEmail::dispatch($user->email);

        return response()->json($user, 201);
    }

    /**
     * Retrieve users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by verification status if 'is_verified' parameter is present
        if ($request->has('is_verified')) {
            $query->where('is_verified', filter_var($request->input('is_verified'), FILTER_VALIDATE_BOOLEAN));
        }

        // Order by name
        $users = $query->orderBy('name')->get();

        return response()->json($users);
    }
}