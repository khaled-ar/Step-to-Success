<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\{
    ForgotPasswordRequest,
    AdminLoginRequest,
    RegisterRequest,
    ResetPasswordRequest,
    StudentLoginRequest,
    VerifyCodeRequest
};

class AuthController extends Controller
{

    public function login_admin(AdminLoginRequest $request) {
        return $request->check();
    }

    public function login_student(StudentLoginRequest $request) {
        return $request->check();
    }

    public function register(RegisterRequest $request) {
        return $request->register();
    }

    public function forgot_password(ForgotPasswordRequest $request) {
        return $request->send_code();
    }

    public function verify(VerifyCodeRequest $request) {
        return $request->verify_code();
    }

    public function reset_password(ResetPasswordRequest $request) {
        return $request->reset_password();
    }

    public function resend_code(ForgotPasswordRequest $request) {
        return $request->send_code();
    }

    public function logout() {
        $user = request()->user();
        $user->tokens()->delete();
        return $this->generalResponse(null, 'logout_success', 200);
    }
}
