<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Applicants for: {{ $career->job_title}}
        </h2>
    </x-slot>
 
    <div class="py-10 max-w-6xl mx-auto px-6">
        @if($career->applicants->isEmpty())
        <div class="text-center text-gray-600 text-lg bg-white p-6 rounded shadow">
            No applications yet.
        </div>
        @else
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Resume
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Applied At
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-800">
                    @foreach($career->applicants as $applicant)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $applicant->pivot-> name }}</td>
                        <td class="px-6 py-4">{{ $applicant->pivot-> email }}</td>
                        <td class="px-6 py-4">
                             <a href="{{ asset('storage/' . $applicant->pivot->cv_path) }}"
                                           target="_blank"
                                           class="text-blue-600 underline">View Resume</a>
                        </td>
                        <td class="px-6 py-4">{{ $applicant->pivot->created_at->format('d M, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-app-layout>