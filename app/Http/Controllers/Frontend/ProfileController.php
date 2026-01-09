<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        return view('frontend.dashboard.account.index');
    }

    function update(Request $request): RedirectResponse
    {
        // dd($request->all());
        // Validate and update the user's profile information here.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . auth('web')->id()],
            'avatar' => ['nullable', 'image', 'max:2048'], // max 2MB
        ]);

        $user = auth('web')->user();
        if ($request->hasFile('avatar')) {
            $filepath = $this->uploadFile($request->file('avatar'), $user->avatar);
            $filepath ? $user->avatar = $filepath : null;
        }

        // dd($request->all());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = auth('web')->user();
        if ($request->hasFile('avatar')) {
            $filepath = $this->uploadFile($request->file('avatar'), $user->avatar);
            $filepath ? $user->avatar = $filepath : null;
        }
        $user->password = bcrypt($request->password);
        $user->save();

        AlertService::updated();

        // notyf()->success('Your account has been reactivated.');

        // auth('web')->user()->update([
        //     'password' => bcrypt($request->password),
        // ]);

        return redirect()->back();
    }
}
