<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <x-message></x-message>
             <!-- <-- Display success or error messages -->



       <div>

        @can('create jobs')
       <a href="{{ route('careers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 ">Create Job</a>
       @endcan

       @role('candidate')
       <a href="{{ route('applied.jobs.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 ">My Applied Jobs</a>
       @endrole

       </div>

<!-- search form -->
        <!-- search form -->
  <form class="mt-5" action="{{ route('careers.search') }}" method="GET">
    {{-- Name or keyword search --}}
    <input
        type="search"
        name="job_title"
        id="search"
        placeholder="Search by job title..."
        value="{{ old('job_title', request('job_title')) }}"
        class="border border-gray-300 rounded-md px-4 py-2 mb-4 w-full max-w-md"
    >

    {{-- Job category filter --}}
    <select
        name="job_category"
        id="job_category"
        class="border border-gray-300 rounded-md px-4 py-2 mb-4 w-full max-w-md"
    >
        <option value="">All Categories</option>
        @foreach($careers as $career)
            <option
                value="{{ $career->job_category }}"
                {{ request('job_category') == $career->job_category ? 'selected' : '' }}
            >
                {{ ucfirst($career->job_category) }}
            </option>
        @endforeach
    </select>



    <input
        type="submit"
        value="Search"
        class="bg-blue-500 text-white px-4 py-2 rounded-md"
    >
</form>













            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-7">
<div class="">

    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Created jobs
            </h1>

            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">ID</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Job type</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Job title</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Created by</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Created on</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Updated</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>

                
                @foreach($careers as $career)
                                        <tbody class="bg-white divide-y divide-gray-100">
                    <tr>
                        <td class="px-4 py-3 text-gray-900 font-semibold">{{$career->id}}</td>
                        <td class="px-4 py-3 text-gray-700">{{$career->job_category}}</td>
                        <td class="px-4 py-3 text-gray-700">{{$career->job_title}}</td>
                        <td class="px-4 py-3 text-gray-700">{{$career->created_by_name}}</td>
                       
                        <td class="px-4 py-3 text-gray-600">{{\Carbon\Carbon::parse($career->created_at)->format('d M Y')}}</td>
                        <td class="px-4 py-3 text-gray-600">{{\Carbon\Carbon::parse($career->updated_at)->format('d M Y')}}</td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                <!-- <a href="" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs inline-block"> -->
                                    <!-- Read -->
                                <!-- </a> -->

                                @can('edit jobs')
                                <a href= "{{route('careers.edit', $career->id)}}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs inline-block">
                                    Update
                                </a>
                                @endcan

                                @can('delete jobs')
                                <a href="{{route('careers.destroy', $career->id)}}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs inline-block">
                                    Delete
                                </a>
                                @endcan
                                
                                @can('view jobs')
                                <a href="{{ route('careers.show', $career->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs inline-block">
                                    View
                                </a>
                                @endcan

                                @role('Employer|superadmin')
                                    <a href="{{ route('applied.candidates.show', $career->id) }}" class="bg-green-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs inline-block">
                                    Applicants
                                </a>
                                @endrole

                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach

            </table>
          
        </div>
    </div>

</div>
            </div>
        </div>
    </div>
</x-app-layout>
