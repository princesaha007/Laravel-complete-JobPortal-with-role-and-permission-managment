<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            @role('superadmin')
            <!-- Chart Container -->
            <div class="bg-white mt-8 p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">Job Category Chart</h3>
                <div id="container" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>

    <!-- Highcharts CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Chart Script -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            const categories = @json($categories);
            const counts = @json($counts);

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Job Graph by Category'
                },
                subtitle: {
                    text: 'Source: Careers Table'
                },
                xAxis: {
                    categories: categories,
                    crosshair: true,
                    accessibility: {
                        description: 'Job Categories'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Jobs'
                    }
                },
                tooltip: {
                    valueSuffix: ' jobs'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Jobs',
                    colorByPoint: true,
                    data: counts.map((count, index) => ({
                        y: count,
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors.length]
                    }))
                }]
            });
        });
    </script>

    <!-- Job Statistics Table -->
    <div class="bg-white rounded-xl shadow p-6 overflow-x-auto mx-16 mt-10">
        <div class="mb-6">
            <h4 class="text-xl font-semibold text-gray-800">Job Statistics</h4>
            <p class="text-gray-600">Total Jobs: {{ $careers->count() }}</p>
        </div>

        <table class="min-w-full table-auto divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">ID</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Job Type</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Job Title</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Created By</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Total Applied</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($careers as $career)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $career->id }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $career->job_category }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $career->job_title }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $career->created_by_name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $career->appliedJobs->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  <div class="mt-6 flex justify-center items-center mx-7">
    {{ $careers->links() }}
</div>
    @endrole

    @role('Employer')
    <div class="bg-white mt-8 p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">Job Category Chart</h3>
                <div id="container" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>

    <!-- Highcharts CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Chart Script -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
       
            const categories = @json($categoriesByEmployer);
            const counts = @json($appliedJobsCounts);

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Job Graph by Category'
                },
                subtitle: {
                    text: 'Source: Careers Table'
                },
                xAxis: {
                    categories: categories,
                    crosshair: true,
                    accessibility: {
                        description: 'Job Categories'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Applications'
                    }
                },
                tooltip: {
                    valueSuffix: ' applications'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Applications',
                    colorByPoint: true,
                    data: counts.map((count, index) => ({
                        y: count,
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors.length]
                    }))
                }]
            });
        });
    </script>
    @endrole
     @role('candidate')
      <a href="{{ route('applied.jobs.index') }}" 
   class="bg-blue-500 text-white px-6 py-3 rounded-md  mt-10 mb-6 inline-block">
   My Applied Jobs
</a>
       @endrole

</x-app-layout>
