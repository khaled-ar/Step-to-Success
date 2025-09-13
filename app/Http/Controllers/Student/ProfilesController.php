<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Profile\UpdateProfileRequest;
use App\Http\Requests\Student\UpdatePasswordRequest;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function get(Request $request) {
        $user = $request->user();
        unset($user->email, $user->email_verified_at, $user->role);
        return $this->generalResponse($user, null, 200);
    }

    public function update(UpdateProfileRequest $request) {
        return $request->update();
    }

    public function update_password(UpdatePasswordRequest $request) {
        return $request->update();
    }
}
