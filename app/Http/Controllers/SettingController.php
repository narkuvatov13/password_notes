<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);
        $img = null;


        // dd('asdad');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'imageUrl'   => 'nullable|file|image|mimes:png,jpg,jpeg',
            'password' => [
                'nullable',
                // 'required_with:new_password',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail(__('Fail Current Password'));
                    }
                }
            ],
            'new_password' => [
                'nullable',
                'different:password',
                'required_with:password',
                Password::min(8)->mixedCase()->letters()->numbers(),
            ],
        ]);

        // dd($validator->fails());
        // Password Fail
        if ($validator->fails()) {

            session()->flash('error', __('messages.error_password_not_update'));
            // dd($validator->fails());

            return redirect()->back();
        }

        // image upload
        if ($request->file('imageUrl')) {

            $img = Storage::disk('public')->put('images', $request->file('imageUrl'));
            // $me_image = "public/" . $user->img;
            // dd(Storage::disk('public')->files($img), $user->img);
            Storage::disk('public')->delete($user->img);
        }

        // password 
        if ($request->input('password') == null || $request->input('password') == null) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'img' => $img != null ? $img : $user->img,
            ]);

            return redirect()->back()->with(['success' => "Update Profile Settings Successfully"]);
        } else {

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'img' => $img != null ? $img : $user->img,
                'password' =>  Hash::make($request->input('new_password')),
            ]);
            return redirect()->back()->with(['success' => "Update Profile Settings Successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
