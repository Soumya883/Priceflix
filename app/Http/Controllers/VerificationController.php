<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(Request $request): View
    {
        $documents = $request->user()->documents()->latest()->get();
        return view('verification.index', compact('documents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|string|in:id_card,passport,driver_license',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = $request->user();

        // Prevent multiple pending documents of the same type if needed, 
        // but typically we just allow new submissions.
        
        $path = $request->file('document')->store('documents', 'private');

        Document::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'status' => 'pending',
            'file_path' => $path,
        ]);

        $user->update(['verification_status' => 'pending']);

        return back()->with('success', 'Document uploaded successfully. Our team will review it shortly.');
    }
}
