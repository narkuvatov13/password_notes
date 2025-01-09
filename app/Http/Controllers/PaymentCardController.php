<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentCardController extends Controller
{
    //Payment Card Create
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "card_name",
            "card_type",
            "card_number",
            "card_security_code",
            "card_start_date",
            "card_expiration_date",
            "notes",
        ]);

        auth()->user()->paymentCards()->create($request->all());

        return redirect()->back()->with('success', 'Create Payment Card Successfully');
        // dd('store');
    }

    //Payment Card Update
    public function update(Request $request, $id)
    {
        dd('update');
    }

    //Payment Card Delete
    public function destroy(Request $request, $id)
    {
        dd('delete');
    }
}
