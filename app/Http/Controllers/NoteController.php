<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index()
    {

        $noteItems = auth()->user()->notes;
        return view("pages.notes", compact('noteItems'));
    }




    public function store(Request $request)
    {
        // dd($request->name);

        $request->validate([
            'name' => 'required',
            'note_message',
        ]);

        auth()->user()->notes()->create($request->all());

        return redirect()->back()->with('success', __('messages.created_note_successfuly'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'note_message'
        ]);

        $note = auth()->user()->notes()->findorFail($id);
        $note->update([
            'name' => $request->input('name'),
            'note_message' => $request->input('note_message')
        ]);

        return redirect()->back()->with('success', __('messages.update_note_successfully'));
    }





    public function destroy($id)
    {
        $note = auth()->user()->notes()->findorFail($id);
        $note->delete();
        return redirect()->back()->with('success', __('messages.note_delete_successfully'));
    }
}
