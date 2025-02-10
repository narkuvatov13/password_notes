<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'imageUrl'   => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);


        if ($request->file('imageUrl')) {
            $img = $request->file('imageUrl')->store('user/images', 'public');
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'img' => $img != null ? $img : $request->file('imageUrl'),
        ]);

        return redirect()->back()->with('success', "Update Profile Settings Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
