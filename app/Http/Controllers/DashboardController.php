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

            $careers = Career::latest()->get();
     

            return view('dashboard', compact('categories', 'counts', 'careers'));
    }
}
