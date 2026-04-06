<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class PageController extends Controller {
    public function about()   { return view('pages.about'); }
    public function contact() { return view('pages.contact'); }

    public function sendMessage(Request $request) {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        Message::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim ke admin!');
    }
}