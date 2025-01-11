<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentCardController extends Controller
{
    public function index()
    {

        $paymentCards = auth()->user()->paymentCards;
        return view("pages.payment-cards", compact('paymentCards'));
    }


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
        // dd('update');
        $request->validate([
            "title" => "required",
            "card_name",
            "card_type",
            "card_number",
            "card_security_code",
            "card_start_date",
            "card_expiration_date",
            "notes"
        ]);

        $data = [
            "title" => $request->title,
            "card_name" => $request->card_name,
            "card_type" => $request->card_type,
            "card_number" => $request->card_number,
            "card_security_code" => $request->card_security_code,
            "card_start_date" => $request->card_start_date,
            "card_expiration_date" => $request->card_expiration_date,
            "notes" => $request->notes
        ];

        $paymentCard = auth()->user()->paymentCards()->findorFail($id);
        $paymentCard->update($data);

        return redirect()->back()->with('success', 'Update Payment Card Succesfully');
    }

    //Payment Card Delete
    public function destroy(Request $request, $id)
    {
        $paymentCard = auth()->user()->paymentCards()->findOrFail($id);
        $paymentCard->delete();

        return redirect()->back()->with('success', 'Delete Payment Card Successfully');
    }
}
