<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Applied Jobs') }}
        </h2>
    </x-slot>
   
    
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="text-xs uppercase bg-gray-100 text-gray-700 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Job Title</th>
                                    <th class="px-6 py-4">Category</th>
                                    <th class="px-6 py-4">Applied By</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Applied At</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($appliedJobs as $application)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $application->career->job_title ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $application->career->job_category ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $application->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="mailto:{{ $application->email }}" class="text-blue-600 hover:underline">
                                                {{ $application->email }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $application->created_at->format('d M, Y h:i A') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center px-6 py-8 text-gray-500">No applications found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
