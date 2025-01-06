<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{






    public function store(Request $request)
    {
        // dd($request->name);

        $request->validate([
            'name' => 'required',
            'note_message',
        ]);

        auth()->user()->notes()->create($request->all());

        return redirect()->back()->with('success', 'Created Note Successfully');
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

        return redirect()->back()->with('success', ' Update Note Successfully');
    }





    public function destroy($id)
    {
        $note = auth()->user()->notes()->findorFail($id);
        $note->delete();
        return redirect()->back()->with('success', 'Note Delete Successfully');
    }
}
