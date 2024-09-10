<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $attempt = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($attempt) {
            return redirect()
                ->route('dashboard');
        }
        return redirect()
            ->back()
            ->with('danger', 'Invalid Credentials');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
