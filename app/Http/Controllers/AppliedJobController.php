<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use App\Models\Career;
use Illuminate\Http\Request;

class AppliedJobController extends Controller
{



    // Show applied jobs for the candidate
    public function index()
    {
        $user = auth()->user();

    if (!$user->hasRole('candidate')) {
        abort(403);
    }
 
    $appliedJobs = $user->appliedJobs()->latest()->get();

        return view('carrer.appliedjobs', compact('appliedJobs'));
    }




    // Show apply form
    public function apply(string $id)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'You must be logged in to apply for a job.');
        }

        if (!$user->hasRole('candidate')) {
            abort(403, 'Only candidates can apply.');
        }

        $career = Career::findOrFail($id);
        return view('carrer.apply', ['career' => $career]);
    }




    // Handle job application submission
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'You must be logged in to apply for a job.');
        }

        if (!$user->hasRole('candidate')) {
            abort(403, 'Only candidates can apply.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('applications', 'public');

        $career = Career::findOrFail($id);
        

        $career->appliedJobs()->create([
            'name' => $request->name,
            'email' => $request->email,
            'cv_path' => $cvPath,
             'user_id' => $user->id , // ✅ Store user ID
        ]);

        return redirect()->route('applied.jobs.index')->with('success', 'Application submitted successfully.');
    }



    
}