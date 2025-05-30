<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\School;

class ContactController extends Controller
{
    public function index()
    {
        $school = School::first();

        return view('contact', compact('school'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
