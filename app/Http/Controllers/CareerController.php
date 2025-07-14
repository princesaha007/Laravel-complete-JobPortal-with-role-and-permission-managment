<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareerController extends Controller
{

        public function __construct()
    {
        $this->middleware('permission:view jobs')->only('index');
        $this->middleware('permission:edit jobs')->only('edit', 'update');
        $this->middleware('permission:create jobs')->only('create', 'store');
        $this->middleware('permission:delete jobs')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $user = Auth::user();

    // If user is super-admin, show all job posts
    if ($user->hasRole('superadmin')) {
        $careers = Career::latest()->paginate(10);
    } 
    // Otherwise, show only jobs created by this user
    elseif ($user->hasRole('Employer')) {

        // $careers = Career::where('created_by', $user->id)->latest()->paginate(10);
         $careers = $user->careers()->latest()->get();
    }
    // If user is a candidate, show all jobs
    elseif ($user->hasRole('candidate')) {
        $careers = Career::latest()->paginate(10);
    }   

    return view('carrer.list', compact('careers'));
}


 

    public function create()
    {
        return view('carrer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'job_category' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'key_responsibilities' => 'nullable|string',
            'skill_requirement' => 'nullable|string',
            'educational_requirements' => 'nullable|string',
            'experience_requirements' => 'nullable|string',
            'salary' => 'nullable|numeric',
        ]);

        // Create the job listing
        if($validated) {
            $career = new Career();
            $career->job_category = $request->job_category;
            $career->job_title = $request->job_title;
            $career->job_description = $request->job_description;
            $career->key_responsibilities = $request->key_responsibilities;
            $career->skill_requirement = $request->skill_requirement;
            $career->educational_requirements = $request->educational_requirements;
            $career->experience_requirements = $request->experience_requirements;
           
            $career->salary = $request->salary;

            $career->created_by = Auth::user()->id;
            $career->created_by_name = Auth::user()->name;
            $career->save();
            

            return redirect()->route('careers.index')->with('success', 'Job posted successfully.');
        }

        return redirect()->back()->withInput()->withErrors($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $career = Career::findOrFail($id);
        $user = Auth::user();
        // Check if the user has permission to view the job
        if ($user->can('view jobs')) {
            return view('carrer.view', ['career' => $career]);
        } else {
            return redirect()->route('careers.index')->with('error', 'You do not have permission to view this job.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $career= Career::findOrFail($id);
        return view('carrer.edit', ['ourCareer' => $career]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $career = Career::findOrFail($id);

        $validated = $request->validate([
            'job_category' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'key_responsibilities' => 'nullable|string',
            'skill_requirement' => 'nullable|string',
            'educational_requirements' => 'nullable|string',
            'experience_requirements' => 'nullable|string',
            'salary' => 'nullable|numeric',
        ]);

        // Update the job listing
        if($validated) {
            $career->job_category = $request->job_category;
            $career->job_title = $request->job_title;
            $career->job_description = $request->job_description;
            $career->key_responsibilities = $request->key_responsibilities;
            $career->skill_requirement = $request->skill_requirement;
            $career->educational_requirements = $request->educational_requirements;
            $career->experience_requirements = $request->experience_requirements;
            $career->salary = $request->salary;
            $career->created_by = Auth::user()->id;
            $career->created_by_name = Auth::user()->name;
            $career->save();

            return redirect()->route('careers.index')->with('success', 'Job updated successfully.');
        }

        return redirect()->back()->withInput()->withErrors($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('careers.index')->with('success', 'Job deleted successfully.');
    }


public function search(Request $request)
{
    $job_title = $request->job_title;
    $job_category = $request->job_category;

    // Build query
    $query = Career::query();

    if ($job_title) {
        $query->where('job_title', 'LIKE', '%' . $job_title . '%');
    }

    if ($job_category) {
        $query->where('job_category', 'LIKE', '%' . $job_category . '%');
    }

    $careers = $query->paginate(5)->withQueryString();

    if ($careers->isEmpty()) {
        return redirect()->route('careers.index')->with('error', 'No careers found');
    }

    return view('carrer.list', compact('careers')); 
}



}