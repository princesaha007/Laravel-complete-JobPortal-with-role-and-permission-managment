<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jobData = DB::table('careers')
            ->select('job_category', DB::raw('count(*) as total'))
            ->groupBy('job_category')
            ->get();

        // Separate labels and values for the chart
        $categories = $jobData->pluck('job_category')->toArray();
        $counts = $jobData->pluck('total')->toArray();
        $careers = Career::latest()->paginate(6);

        //job category by the employer x-axis & applied jobs count by the candidates y-axis
        $categoriesByEmployer = [];
        $appliedJobsCounts = [];
        if (Auth::user()->hasRole('Employer')) {
            $careersByEmployer = Auth::user()->careers()->latest()->get();

            foreach ($careersByEmployer as $career) {
                $categoriesByEmployer[] = $career->job_category;

                $count = DB::table('applied_jobs')
                    ->where('career_id', $career->id)
                    ->count();

                $appliedJobsCounts[] = $count;
            }
        }


        return view('dashboard', compact('categories', 'counts', 'careers', 'categoriesByEmployer', 'appliedJobsCounts'));
    }
}
