<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show()
    {
        return view('vitrine.contact');
    }
    public function delete($id)
    {
        $msg = Message::findOrFail($id);
        $msg->delete();
        return redirect()->route('messages')->with('success', 'Message supprimé.');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès.');
    }

    

    public function messages()
    {
        $messages = Message::latest()->paginate(20);
        return view('messages', compact('messages'));
    }
}
