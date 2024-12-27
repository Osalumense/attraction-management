<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * user service
     * @var userService
     * 
     */
    protected UserService $userService;
    
    /**
     * 
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create a new user
     * @param Request $request
     */
    public function store(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $user = $this->userService->createUser($validatedData);

    }

    /**
     * Login user
     * @param Request $request
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            return redirect()->route('attractions.index')->with('success', 'Welcome back ' . $user->name);
        }
        return redirect()->back()->with('error', 'Invalid login credentials.');

    }

    /**
     * Display login view
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
