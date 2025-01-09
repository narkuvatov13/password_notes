<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->input('birthday'));
        // dd($request->all());
        $request->validate([
            "title" => "required",
            "first_name",
            "middle_name",
            "last_name",
            "username",
            "gender",
            "birthday",
            "company",
            "address",
            "city",
            "country",
            "state",
            "postal_code",
            "email",
            "phone_number",
            "mobile_phone_number",
            "fax",
            "notes",
        ]);

        // if()
        auth()->user()->addresses()->create($request->all());
        return redirect()->back()->with('success', "Create Address Successfylly");
    }
}
