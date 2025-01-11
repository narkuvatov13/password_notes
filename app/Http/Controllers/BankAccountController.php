<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountRequest;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    public function index()
    {

        $bankAccounts = auth()->user()->bankAccounts;
        return view("pages.bank-accounts", compact('bankAccounts'));
    }



    public function store(BankAccountRequest $request)
    {
        // dd($request);

        $validateData = $request->validated();

        auth()->user()->bankAccounts()->create($validateData);

        return redirect()->back()->with("success", "Create Bank Account Note Successfully");
    }


    public function update(BankAccountRequest $request, $id)
    {
        dd('update');

        $request->validated();

        $dataForm = [
            "title" => $request->input('title'),
            "bank_name" => $request->input('bank_name'),
            "account_type" => $request->input('account_type'),
            "routing_number" => $request->input('routing_number'),
            "account_number" => $request->input('account_number'),
            "swift_code" => $request->input('swift_code'),
            "iban_number" => $request->input('iban_number'),
            "pin" => $request->input('pin'),
            "branch_address" => $request->input('branch_address'),
            "branch_phone" => $request->input('branch_phone'),
            "notes" => $request->input('notes'),
        ];

        $bankAccount  = auth()->user()->bankAccounts()->findOrFail($id);
        $bankAccount->update($dataForm);

        return redirect()->back()->with('success', 'Update Bank Account Successfully');
    }

    public function destroy($id)
    {
        // dd('delete');

        auth()->user()->bankAccounts()->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Delete Bank Account Note Successfully');
    }
}
