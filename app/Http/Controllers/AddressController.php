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

    public function update(Request $request, $id)
    {
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

        $address = auth()->user()->addresses()->findorFail($id);
        $address->update([
            'title' => $request->title,
            'first_name' => $request->input("first_name"),
            'middle_name' => $request->input("middle_name"),
            'last_name' => $request->input("last_name"),
            'username' => $request->input("username"),
            'gender' => $request->input("gender"),
            'birthday' => $request->input("birthday"),
            'company' => $request->input("company"),
            'address' => $request->input("address"),
            'city' => $request->input("city"),
            'country' => $request->input("country"),
            'state' => $request->input("state"),
            'postal_code' => $request->input("postal_code"),
            'email' => $request->input("email"),
            'phone_number' => $request->input("phone_number"),
            'mobile_phone_number' => $request->input("mobile_phone_number"),
            'fax' => $request->input("fax"),
            'notes' => $request->input("notes"),
        ]);

        return redirect()->back()->with('success', 'Update Address Successfully');
    }

    public function destroy($id)
    {
        $address = auth()->user()->addresses()->findorFail($id);
        $address->delete();

        return redirect()->back()->with('success', 'Delete Address Successfully');
        // dd($id);
    }
}
