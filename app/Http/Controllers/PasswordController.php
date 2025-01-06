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
            'name' => 'required',
            'username',
            'password',
            'message',
        ]);

        auth()->user()->passwords()->create($request->all());

        return redirect()->back()->with('success', 'Password created successfully.');
    }

    // public function edit($id)
    // {
    //     $password = auth()->user()->passwords()->findOrFail($id);

    //     return view('passwords.edit', compact('password'));
    // }


    public function update(Request $request, $id)
    {
        // dd('sdasaaaa');
        $password = auth()->user()->passwords()->findOrFail($id);

        $request->validate([
            'url',
            'name' => 'required',
            'username',
            'password',
            'message',
        ]);


        if (
            $password->name != $request->input('name')
            || $password->username != $request->input('username')
            || $password->password != $request->input('password')
            || $password->message != $request->input('message')
            || $password->url != $request->input('url')
        ) {

            $password->update($request->all());
            return redirect()->back()->with('success', 'Password updated successfully.');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        // dd($id);
        $password = auth()->user()->passwords()->findOrFail($id);

        $password->delete();

        return redirect()->back()->with('success', 'Password deleted successfully.');
    }
}
