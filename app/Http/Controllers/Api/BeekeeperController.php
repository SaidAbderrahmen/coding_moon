<?php

namespace App\Http\Controllers\Api;

use App\Models\Beekeeper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\BeekeeperResource;
use App\Http\Resources\BeekeeperCollection;
use App\Http\Requests\BeekeeperStoreRequest;
use App\Http\Requests\BeekeeperUpdateRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class BeekeeperController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }



    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $beekeeper = Auth::guard('api')->user();
        $beekeeper = $beekeeper::with(['hives.histories','hives.notifications'])->get();
        
    $beekeeper = $beekeeper->map(function ($beekeeper) {
        $beekeeper['hives'] = $beekeeper['hives']->map(function ($hive) {
            $hive['histories'] = $hive['histories']->map(function ($history) {
                $history['details'] = preg_replace("/<p>(.*)<\/p>/", "$1", $history['details']);
                return $history;
            });

            $hive['notifications'] = $hive['notifications']->map(function ($notification) {
                $notification['details'] = preg_replace("/<p>(.*)<\/p>/", "$1", $notification['details']);
                return $notification;
            });

            return $hive;
        });

        return $beekeeper;
    });
        return new BeekeeperResource($beekeeper);
    }

    /**
     * @param \App\Http\Requests\BeekeeperUpdateRequest $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function update(
        BeekeeperUpdateRequest $request,
        Beekeeper $beekeeper
    ) {
        //$this->authorize('update', $beekeeper);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $beekeeper->update($validated);

        return new BeekeeperResource($beekeeper);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Beekeeper $beekeeper)
    {
        //$this->authorize('delete', $beekeeper);

        $beekeeper->delete();

        return response()->noContent();
    }
}
