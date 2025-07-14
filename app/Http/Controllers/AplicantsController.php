<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class AplicantsController extends Controller
{
   public function appliedCandidateShow($id)
    {
        $career = Career::with('applicants')->findOrFail($id);
 
 
        // Access Control
        // if ($user->hasRole('Employer') && $job->created_by_id !== $user->id) {
        //     abort(403, 'You do not own this job.');
        // }
 
        return view('carrer.aplicants', compact('career'));
    }
}
