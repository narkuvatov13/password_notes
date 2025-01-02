@extends('layouts.sidebar')
<x-app>
    @section('title', 'Dashboard')
    @section('main-content')

    {{-- Main Content Header --}}
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <h1 class="text-xl text-gray-700 font-bold">All Items</h1>
        </div>
    </div>
    {{-- Main Content Items --}}
    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg flex flex-wrap m-auto gap-4">

            {{-- Item Cards --}}
            @foreach ($passwordItems as $item)
            <div class="block w-64 h-32 m-auto px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                {{-- Item Card Buttons --}}
                <div class="flex justify-end">
                    <button id="dropdownButton{{ $loop->iteration }}" data-dropdown-toggle="dropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown{{ $loop->iteration }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2" aria-labelledby="dropdownButton">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Item Card Content --}}
                <div class="flex flex-col items-center  ">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{Str::limit($item->name,25,'...')}} </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">{{Str::limit($item->username,25,'...')}}</p>
                </div>
            </div>

            @endforeach



        </div>

    </div>
    </div>












    <script>
        const notification = document.getElementById('toast-success');
        setTimeout(() => {
            notification.classList.add('top-[65px]');
        },1);

        setTimeout(() => {
            notification.classList.remove('top-[65px]');
        },2500);

        console.log(notification);
    </script>
    @endsection

</x-app>