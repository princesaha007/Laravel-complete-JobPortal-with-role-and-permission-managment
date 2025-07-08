<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <x-message></x-message>
             <!-- <-- Display success or error messages -->


        <!-- @can('create users') -->
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Create user</a>
        <!-- @endcan  -->

        

  <form class="mt-5" action="{{ route('users.search') }}" method="GET">
    {{-- Name or keyword search --}}
    <input
        type="search"
        name="search"
        id="search"
        placeholder="Search by name..."
        value="{{ old('search', request('search')) }}"
        class="border border-gray-300 rounded-md px-4 py-2 mb-4 w-full max-w-md"
    >

    {{-- Email filter --}}
    <input
        type="email"
        name="email"
        id="email"
        placeholder="Email (optional)"
        value="{{ old('email', request('email')) }}"
        class="border border-gray-300 rounded-md px-4 py-2 mb-4 w-full max-w-md"
    >

    {{-- Role dropdown --}}
    <select
        name="role"
        id="role"
        class="border border-gray-300 rounded-md px-4 py-2 mb-4 w-full max-w-md"
    >
        <option value="">All Roles</option>
        @foreach($roles as $role)
            <option
                value="{{ $role->name }}"
                {{ request('role') == $role->name ? 'selected' : '' }}
            >
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>

    <input
        type="submit"
        value="Search"
        class="bg-blue-500 text-white px-4 py-2 rounded-md"
    >
</form>












        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="">

    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Users
            </h1>

            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">ID</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Name</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Email</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Roles</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Created</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>

                
                @foreach($users as $user)
                                        <tbody class="bg-white divide-y divide-gray-100">
                    <tr>
                        <td class="px-4 py-3 text-gray-900 font-semibold">{{$user->id}}</td>
                        <td class="px-4 py-3 text-gray-700">{{$user->name}}</td>
                        <td  class="px-4 py-3 text-gray-700">{{$user->email}}</td>
                        <td  class="px-4 py-3 text-gray-700">{{$user->roles->pluck('name')->implode(', ')}}</td>
                        <td class="px-4 py-3 text-gray-600">{{\Carbon\Carbon::parse($user->created_at)->format('d M Y')}}</td>
  
                        <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-2">
                                
                                @can('edit users')
                                <a href= "{{route('users.edit', $user->id)}}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs inline-block">
                                    Update
                                </a>
                                 @endcan

                                @can('delete users')
                                <a href="{{route('users.destroy', $user->id)}}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs inline-block">
                                    Delete
                                </a>
                                @endcan
                                
                            </div>
                    
                        </td>
                        
                    </tr>
                </tbody>
                @endforeach

            </table>
            {{$users ->onEachSide(1)-> links()}}
        </div>
    </div>

</div>



            </div>
        </div>
    </div>
</x-app-layout>
