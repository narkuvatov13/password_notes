<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;


class DashboardController extends Controller
{
    public function index()
    {

        // $countries = new Countries();
        // $allCountries = $countries->all()->toArray(); // Tüm ülkeleri alır

        // dd($allCountries);
        $passwordItems = auth()->user()->passwords;
        $noteItems = auth()->user()->notes;
        $addresses = auth()->user()->addresses;
        $paymentCards = auth()->user()->paymentCards;
        // dd($allItems);
        return view('dashboard', compact('passwordItems', 'noteItems', 'addresses', 'paymentCards'));
    }
}
