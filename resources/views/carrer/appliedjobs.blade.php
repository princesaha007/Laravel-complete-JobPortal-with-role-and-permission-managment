<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applied Jobs') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-200 px-4 py-2 text-left">Job Title</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Category</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Applied By</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Email</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Applied At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appliedJobs as $application)
                                <tr>
                                    <td>{{ $application->career->job_title ?? 'N/A' }}</td>
                                    <td>{{ $application->career->job_category ?? 'N/A' }}</td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
