<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd('sad');
        $passwordItems = auth()->user()->passwords;
        // dd($allItems);
        return view('dashboard', compact('passwordItems'));
    }


    public function destroy($id)
    {
        // dd($id);
        $password = auth()->user()->passwords()->findOrFail($id);

        $password->delete();

        return redirect()->back()->with('success', 'Password deleted successfully.');
    }
}
