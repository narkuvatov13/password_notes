<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    // public function index()
    // {
    //     $passwords = auth()->user()->passwords;

    //     return view('passwords.index', compact('passwords'));
    // }

    // public function create()
    // {
    //     return view('passwords.create');
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'url',
            'username',
            'password',
            'messages',
        ]);

        auth()->user()->passwords()->create($request->all());

        return redirect()->back()->with('success', 'Password saved successfully.');
    }

    // public function edit($id)
    // {
    //     $password = auth()->user()->passwords()->findOrFail($id);

    //     return view('passwords.edit', compact('password'));
    // }

    // // public function update(Request $request, $id)
    // // {
    // //     $password = auth()->user()->passwords()->findOrFail($id);

    // //     $request->validate([
    // //         'url' => 'required',
    // //         'username' => 'required',
    // //         'password' => 'required',
    // //         'messages' => 'required',
    // //     ]);

    // //     $password->update($request->all());

    // //     return redirect()->route('passwords.index');
    // // }

    // public function destroy($id)
    // {
    //     $password = auth()->user()->passwords()->findOrFail($id);

    //     $password->delete();

    //     return redirect()->route('passwords.index');
    // }
}
