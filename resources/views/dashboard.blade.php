@extends('layouts.sidebar')
<x-app>
    @section('title', 'Dashboard')
    @section('main-content')


    <!-- Notification Message -->
    @if (session('success'))
    <div>
        <div id="toast-success" class="position absolute top-[-65px] left-1/2 translate-x-[-50%] transition-all duration-1000 ease-in-out  flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Created Password Success</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
    @endif


    {{-- Main Content Header --}}
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <h1 class="text-xl text-gray-700 font-bold">All Items</h1>
        </div>
    </div>

    {{-- Main Content Items --}}
    <div class="p-4 sm:ml-64">

        <!-- Accordians -->
        <div id="accordion-collapse" data-accordion="collapse">




            <!-- Password Accordian -->
            <h2 id="accordion-collapse-heading-password">

                <!-- Password Accordian Header -->
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-password" aria-expanded="true" aria-controls="accordion-collapse-body-password">
                    <span>
                        Password Items
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{\App\Models\Password::count()}}</span>
                    </span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <!-- Passwords Accordian Content -->
            <div id="accordion-collapse-body-password" class="hidden" aria-labelledby="accordion-collapse-heading-password">
                <div class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                    {{-- Password Item Cards --}}
                    @foreach ($passwordItems as $item)
                    <div class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        {{-- Item Card Buttons --}}
                        <div class="flex justify-end">
                            <button id="passwordDropdownButton{{ $loop->iteration }}" data-dropdown-toggle="passwordDropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->

                            <div id="passwordDropdown{{ $loop->iteration }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="passwordDropdownButton">

                                    {{-- Edit Modal --}}
                                    <li>
                                        <div x-data="{ passwordEditModalOpen: false }" @keydown.escape.window="passwordEditModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{-- Edit Modal Button --}}
                                            <button @click="passwordEditModalOpen=true" class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                            {{-- Edit Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="passwordEditModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                                                    <div x-show="passwordEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="passwordEditModalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="passwordEditModalOpen" x-trap.inert.noscroll="passwordEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">Password Update</h3>
                                                            <button @click="passwordEditModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{-- Content --}}
                                                        <div class="relative w-auto mt-2">
                                                            <form @submit.prevent="passwordEditSubmitForm($event)" x-data="{
                                                                            url: '{{old('url',$item->url)}}',
                                                                            name: '{{old('name',$item->name)}}', 
                                                                            username: '{{old('username', $item->username)}}', 
                                                                            password: '{{old('password',$item->password)}}', 
                                                                            message: '{{old('message',$item->message)}}',
                                                                            passwordEditSubmitForm(event) {
                                                                                        if(this.url == '{{$item->url}}' && this.name == '{{$item->name}}' && this.username == '{{$item->username}}' && this.password == '{{$item->password}}' && this.message == '{{$item->message}}'){
                                                                                            event.preventDefault();
                                                                                            editModalOpen = false;
                                                                                        } else{
                                                                                                event.target.submit();
                                                                                        }
                                                                                    } 
                                                                            }"
                                                                class="max-w-md mx-auto" action="{{ route('form.password.update',$item->id)}}" method="POST">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <!-- <h1 x-text="name"></h1> -->
                                                                    <!-- <h1 x-text="username"></h1> -->
                                                                    <!-- <h1 x-text="password"></h1> -->
                                                                    <!-- <h1 x-text="url"></h1>  -->
                                                                    <input x-model="url" type="text" name="url" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                    <label for="url" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Url</label>
                                                                </div>
                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="name" x-model="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                                                                </div>

                                                                <div class="grid md:grid-cols-2 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" name="username" x-model="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" name="password" x-model="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                                                    </div>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Your message</label>
                                                                    <textarea name="message" rows="4" x-model="message" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                                                </div>

                                                                <div class="w-full text-end">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Update</button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                    {{-- Delete Form --}}
                                    <li>
                                        <!-- Delete Modal Button -->
                                        <div x-data="{ passwordDeleteModalOpen: false }" @keydown.escape.window="passwordDeleteModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{-- Delete Modal Button --}}
                                            <button @click="passwordDeleteModalOpen=true" class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                            {{-- Delete Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="passwordDeleteModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md" x-cloak>
                                                    <div x-show="passwordDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="passwordDeleteModalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="passwordDeleteModalOpen" x-trap.inert.noscroll="passwordDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                            <h3 class="text-lg font-semibold text-white">Delete</h3>
                                                            <button @click="passwordDeleteModalOpen=false" class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Delete Modal Content --}}
                                                        <div class="relative w-auto mt-2 px-6 py-3">

                                                            <p class="text-lg text-gray-800">Delete this site - {{$item->name}}</p>
                                                            <div class="mt-4 flex justify-center gap-8 ">
                                                                <button @click="passwordDeleteModalOpen=false" class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                                    No
                                                                </button>
                                                                <form action="{{route('form.password.destroy',$item->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
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

            <!-- Notes Accordian -->
            <h2 id="accordion-collapse-heading-note">

                <!-- Notes Accordian Header -->
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-note" aria-expanded="true" aria-controls="accordion-collapse-body-note">
                    <span>Notes Items
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{\App\Models\Note::count()}}</span>

                    </span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <!-- Notes Accordian Content -->
            <div id="accordion-collapse-body-note" class="hidden" aria-labelledby="accordion-collapse-heading-note">
                <div class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                    {{-- Note Item Cards --}}
                    @foreach ($noteItems as $noteItem)
                    <div class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        {{-- Note Item Card Buttons --}}
                        <div class="flex justify-end">
                            <button id="noteEditDropdownButton{{ $loop->iteration }}" data-dropdown-toggle="notEditDropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!--Note Dropdown menu -->

                            <div id="notEditDropdown{{ $loop->iteration }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="noteEditDropdownButton">

                                    {{--Note Edit Modal --}}
                                    <li>
                                        <div x-data="{ noteEditModalOpen: false }" @keydown.escape.window="noteEditModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{-- Note Edit Modal Button --}}
                                            <button @click="noteEditModalOpen=true" class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                            {{--Note Edit Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="noteEditModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                                                    <div x-show="noteEditModalOpen" @click="noteEditModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="noteEditModalOpen" x-trap.inert.noscroll="noteEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">Password Update</h3>
                                                            <button @click="noteEditModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Note Content --}}
                                                        <div class="relative w-auto mt-2">
                                                            <form @submit.prevent="noteEditSubmitForm($event)" x-data="{
                                                        name: '{{old('name',$noteItem->name)}}', 
                                                        note_message: '{{old('note_message',$noteItem->note_message)}}',
                                                        noteEditSubmitForm(event) {
                                                                    if(this.name == '{{$noteItem->name}}' && this.note_message == '{{$noteItem->note_message}}'){
                                                                        event.preventDefault();
                                                                        noteEditModalOpen = false;
                                                                    } else{
                                                                            event.target.submit();
                                                                    }
                                                                } 
                                                        }"
                                                                class="max-w-md mx-auto" action="{{ route('form.note.update',$noteItem->id)}}" method="POST">
                                                                @method('PATCH')
                                                                @csrf

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="name" x-model="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                                                                </div>



                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <label for="note_message" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Your Note message</label>
                                                                    <textarea name="note_message" rows="4" x-model="note_message" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                                                </div>

                                                                <div class="w-full text-end">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Update</button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                    {{--Note Delete Form --}}
                                    <li>
                                        <!--Note Delete Modal Button -->
                                        <div x-data="{ noteDeleteModalOpen: false }" @keydown.escape.window="noteDeleteModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{--Note Delete Modal Button --}}
                                            <button @click="noteDeleteModalOpen=true" class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                            {{--Note Delete Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="noteDeleteModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md" x-cloak>
                                                    <div x-show="noteDeleteModalOpen" @click="noteDeleteModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="noteDeleteModalOpen" x-trap.inert.noscroll="noteDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                            <h3 class="text-lg font-semibold text-white">Delete</h3>
                                                            <button @click="noteDeleteModalOpen=false" class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Note Delete Modal Content --}}
                                                        <div class="relative w-auto mt-2 px-6 py-3">

                                                            <p class="text-lg text-gray-800">Delete this site - {{$noteItem->name}}</p>
                                                            <div class="mt-4 flex justify-center gap-8 ">
                                                                <button @click="noteDeleteModalOpen=false" class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                                    No
                                                                </button>
                                                                <form action="{{route('form.note.destroy',$noteItem->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        {{--Note Item Card Content --}}
                        <div class="flex flex-col items-center  ">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{Str::limit($noteItem->name,25,'...')}} </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{Str::limit($noteItem->username,25,'...')}}</p>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>


            <!-- Adress Accordian -->
            <h2 id="accordion-collapse-heading-address">

                <!-- Adress Accordian Header -->
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-address" aria-expanded="true" aria-controls="accordion-collapse-body-address">
                    <span>Address Items
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{\App\Models\Address::count()}}</span>
                    </span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>

            <!-- Adress Accordian Content -->
            <div id="accordion-collapse-body-address" class="hidden" aria-labelledby="accordion-collapse-body-address">
                <div class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                    {{-- Address Item Cards --}}
                    @foreach ($addresses as $address)
                    <div class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        {{-- Address Item Card Buttons --}}
                        <div class="flex justify-end">
                            <button id="addressEditDropdownButton{{ $loop->iteration }}" data-dropdown-toggle="addressEditDropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!--Address Dropdown menu -->

                            <div id="addressEditDropdown{{ $loop->iteration }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="addressEditDropdownButton">

                                    {{--Address Edit Modal --}}
                                    <li>
                                        <div x-data="{ addressEditModalOpen: false }" @keydown.escape.window="addressEditModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{-- Address Edit Modal Button --}}
                                            <button @click="addressEditModalOpen=true" class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                            {{--Address Edit Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="addressEditModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                                                    <div x-show="addressEditModalOpen" @click="addressEditModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="addressEditModalOpen" x-trap.inert.noscroll="addressEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">Address Update</h3>
                                                            <button @click="addressEditModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Address Content --}}
                                                        <div class="relative w-auto mt-2">
                                                            <form @submit.prevent="addressEditSubmitForm($event)" x-data="{
                                                        title: '{{old('title',$address->title)}}', 
                                                        first_name: '{{old('first_name',$address->first_name)}}', 
                                                        middle_name: '{{old('middle_name',$address->middle_name)}}', 
                                                        last_name: '{{old('last_name',$address->last_name)}}', 
                                                        username: '{{old('username',$address->username)}}', 
                                                        gender: '{{old('gender',$address->gender)}}', 
                                                        birthday: '{{old('birthday',$address->birthday)}}', 
                                                        company: '{{old('company',$address->company)}}', 
                                                        address: '{{old('address',$address->address)}}', 
                                                        city: '{{old('city',$address->city)}}', 
                                                        country: '{{old('country',$address->country)}}', 
                                                        state: '{{old('state',$address->state)}}', 
                                                        postal_code: '{{old('postal_code',$address->postal_code)}}', 
                                                        email: '{{old('email',$address->email)}}', 
                                                        phone_number: '{{old('phone_number',$address->phone_number)}}', 
                                                        mobile_phone_number: '{{old('mobile_phone_number',$address->mobile_phone_number)}}', 
                                                        fax: '{{old('fax',$address->fax)}}', 
                                                        notes: '{{old('notes',$address->notes)}}', 
                                                        addressEditSubmitForm(event) {
                                                                    if(this.title == '{{$address->title}}' && this.first_name == '{{$address->first_name}}' && this.middle_name == '{{$address->middle_name}}' && this.last_name == '{{$address->last_name}}' && this.username == '{{$address->username}}' && this.gender == '{{$address->gender}}' && this.birthday == '{{$address->birthday}}' && this.company == '{{$address->company}}' && this.address == '{{$address->address}}' && this.city == '{{$address->city}}' && this.country == '{{$address->country}}' && this.state == '{{$address->state}}' && this.postal_code == '{{$address->postal_code}}' && this.email == '{{$address->email}}' && this.phone_number == '{{$address->phone_number}}' && this.mobile_phone_number == '{{$address->mobile_phone_number}}' && this.fax == '{{$address->fax}}' && this.notes == '{{$address->notes}}'){
                                                                        event.preventDefault();
                                                                        noteEditModalOpen = false;
                                                                    } else{
                                                                            event.target.submit();
                                                                    }
                                                                } 
                                                        }"
                                                                class="max-w-md mx-auto" action="{{ route('form.address.update',$address->id)}}" method="POST">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="title" name="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                        <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="first_name" name="first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First Name</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="middle_name" name="middle_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="middle_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Middle Name</label>
                                                                    </div>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="last_name" name="last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last Name</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="username" name="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">


                                                                        <select id="gender" x-model="gender" name="gender" class="border-0 border-b-2 border-gray-300 focus:ring-0 text-gray-500 text-sm">
                                                                            @foreach (\App\Enums\Gender::getValues() as $key=>$gender )
                                                                            <option value="{{$gender}}">{{$gender}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">

                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="date" x-model="birthday" name="birthday" id="dateInput" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="GG/AA/YYYY" maxlength="10">
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="company" name="company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company</label>
                                                                    </div>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" x-model="address" name="address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                    <label for="address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address</label>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="city" name="city" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="city" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">City</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="country" name="country" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="country" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Country</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="state" name="state" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="state" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">State</label>
                                                                    </div>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="postal_code" name="postal_code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="postal_code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Zip/Postal Code</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="email" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email Address</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="phone_number" name="phone_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for=" phone_number " class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                                                                    </div>
                                                                </div>
                                                                <div class="grid md:grid-cols-2 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="mobile_phone_number" name="mobile_phone_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="mobile_phone_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mobil Phone</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="fax" name="fax" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                                        <label for="fax" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fax</label>
                                                                    </div>

                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Your Address Message</label>
                                                                    <textarea x-model="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                                                </div>

                                                                <div class="w-full text-end">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Update</button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                    {{--Address Delete Form --}}
                                    <li>
                                        <!--Address Delete Modal Button -->
                                        <div x-data="{ addressDeleteModalOpen: false }" @keydown.escape.window="addressDeleteModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{--Address Delete Modal Button --}}
                                            <button @click="addressDeleteModalOpen=true" class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                            {{--Address Delete Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="addressDeleteModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md" x-cloak>
                                                    <div x-show="addressDeleteModalOpen" @click="addressDeleteModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="addressDeleteModalOpen" x-trap.inert.noscroll="addressDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                            <h3 class="text-lg font-semibold text-white">Delete</h3>
                                                            <button @click="addressDeleteModalOpen=false" class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Address Delete Modal Content --}}
                                                        <div class="relative w-auto mt-2 px-6 py-3">

                                                            <p class="text-lg text-gray-800">Delete this site - {{$address->title}}</p>
                                                            <div class="mt-4 flex justify-center gap-8 ">
                                                                <button @click="addressDeleteModalOpen=false" class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                                    No
                                                                </button>
                                                                <form action="{{route('form.address.destroy',$address->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        {{--Address Item Card Content --}}
                        <div class="flex flex-col items-center  ">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{Str::limit($address->title,25,'...')}} </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{Str::limit($address->address,25,'...')}}</p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>


            <!-- Payment Cards Accordian -->
            <h2 id="accordion-collapse-heading-note">

                <!-- Payment Cards Accordian Header -->
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-payment-card" aria-expanded="true" aria-controls="accordion-collapse-body-payment-card">
                    <span>Payment Cards Items
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{\App\Models\PaymentCard::count()}}</span>
                    </span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <!-- Payment Cards Accordian Content -->
            <div id="accordion-collapse-body-payment-card" class="hidden" aria-labelledby="accordion-collapse-body-payment-card">
                <div class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                    {{-- Payment Cards Item Cards --}}
                    @foreach ($paymentCards as $paymentCard)
                    <div class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        {{-- Payment Cards Item Card Buttons --}}
                        <div class="flex justify-end">
                            <button id="paymentCardEditDropdownButton{{ $loop->iteration }}" data-dropdown-toggle="paymentCardEditDropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!--Payment Cards Dropdown menu -->

                            <div id="paymentCardEditDropdown{{ $loop->iteration }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="paymentCardEditDropdownButton">

                                    {{-- Payment Cards Edit Modal --}}
                                    <li>
                                        <div x-data="{ paymentCardEditModalOpen: false }" @keydown.escape.window="paymentCardEditModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{-- Payment Cards Edit Modal Button --}}
                                            <button @click="paymentCardEditModalOpen=true" class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                            {{--Payment Cards Edit Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="paymentCardEditModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                                                    <div x-show="paymentCardEditModalOpen" @click="paymentCardEditModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="paymentCardEditModalOpen" x-trap.inert.noscroll="paymentCardEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">Payment Card Update</h3>
                                                            <button @click="paymentCardEditModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Payment Cards Content --}}
                                                        <div class="relative w-auto mt-2">
                                                            <form @submit.prevent="paymentCardsEditSubmitForm($event)" x-data="{
                                        title: '{{old('title',$paymentCard->title)}}',
                                        card_name: '{{old('card_name',$paymentCard->card_name)}}',
                                        card_type: '{{old('card_type',$paymentCard->card_type)}}',
                                        card_number: '{{old('card_number',$paymentCard->card_number)}}',
                                        card_security_code: '{{old('card_security_code',$paymentCard->card_security_code)}}',
                                        card_start_date: '{{old('card_start_date',$paymentCard->card_start_date)}}',
                                        card_expiration_date: '{{old('card_expiration_date',$paymentCard->card_expiration_date)}}',
                                        notes: '{{old('notes',$paymentCard->notes)}}',
                                        paymentCardsEditSubmitForm(event) {
                                                    if(this.title == '{{$paymentCard->title}}' && this.card_name == '{{$paymentCard->card_name}}' && this.card_type == '{{$paymentCard->card_type}}' && this.card_number == '{{$paymentCard->card_number}}' && this.card_security_code == '{{$paymentCard->card_security_code}}' && this.card_start_date == '{{$paymentCard->titcard_start_datele}}' && this.card_expiration_date == '{{$paymentCard->card_expiration_date}}' && this.notes == '{{$paymentCard->notes}}'){
                                                        event.preventDefault();
                                                        paymentCardEditModalOpen = false;
                                                    } else{
                                                            event.target.submit();
                                                    }
                                                } 
                                        }"
                                                                class="max-w-md mx-auto" action="{{ route('form.payment_card.update',$paymentCard->id)}}" method="POST">
                                                                @method('PATCH')
                                                                @csrf

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="title" x-model="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="card_name" x-model="card_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="card_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name on Card</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="card_type" x-model="card_type" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="card_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Type</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="card_number" x-model="card_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="card_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Number</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="card_security_code" x-model="card_security_code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="card_security_code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Security Code</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="card_start_date" x-model="card_start_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="card_start_date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Start Date</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="card_expiration_date" x-model="card_expiration_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="card_expiration_date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Expiration Date</label>
                                                                </div>


                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Your Notes</label>
                                                                    <textarea name="notes" rows="4" x-model="note_message" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                                                </div>

                                                                <div class="w-full text-end">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                    {{--Payment Cards Delete Form --}}
                                    <li>
                                        <!--Payment Cards Delete Modal Button -->
                                        <div x-data="{ paymentCardDeleteModalOpen: false }" @keydown.escape.window="paymentCardDeleteModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{--Payment Cards Delete Modal Button --}}
                                            <button @click="paymentCardDeleteModalOpen=true" class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                            {{--Payment Cards Delete Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="paymentCardDeleteModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md" x-cloak>
                                                    <div x-show="paymentCardDeleteModalOpen" @click="paymentCardDeleteModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="paymentCardDeleteModalOpen" x-trap.inert.noscroll="paymentCardDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                            <h3 class="text-lg font-semibold text-white">Delete</h3>
                                                            <button @click="paymentCardDeleteModalOpen=false" class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Payment Cards Delete Modal Content --}}
                                                        <div class="relative w-auto mt-2 px-6 py-3">

                                                            <p class="text-lg text-gray-800">Delete this site - {{$paymentCard->title}}</p>
                                                            <div class="mt-4 flex justify-center gap-8 ">
                                                                <button @click="paymentCardDeleteModalOpen=false" class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                                    No
                                                                </button>
                                                                <form action="{{route('form.payment_card.destroy',$paymentCard->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        {{--Payment Cards Item Card Content --}}
                        <div class="flex flex-col items-center  ">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{Str::limit($paymentCard->title,15,'...')}} </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{Str::limit($paymentCard->card_name,25,'...')}}</p>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>

            <!-- Bank Account Cards Accordian -->
            <h2 id="accordion-collapse-heading-bank-account">

                <!-- Bank Account Cards Accordian Header -->
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-bank-account" aria-expanded="true" aria-controls="accordion-collapse-body-bank-account">
                    <span>Bank Account Items
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{\App\Models\BankAccount::count()}}</span>
                    </span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <!-- Bank Account Accordian Content -->
            <div id="accordion-collapse-body-bank-account" class="hidden" aria-labelledby="accordion-collapse-body-bank-account">
                <div class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                    {{-- Bank Account Item Cards --}}
                    @foreach ($bankAccounts as $bankAccount)
                    <div class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        {{-- Bank Account Item Card Buttons --}}
                        <div class="flex justify-end">
                            <button id="bankAccountEditDropdownButton{{ $loop->iteration }}" data-dropdown-toggle="bankAccountEditDropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!--Bank Account Dropdown menu -->

                            <div id="bankAccountEditDropdown{{ $loop->iteration }}" class="z-50 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="bankAccountEditDropdownButton">

                                    {{-- Bank Account Edit Modal --}}
                                    <li>
                                        <div x-data="{ bankAccountEditModalOpen: false }" @keydown.escape.window="bankAccountEditModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{-- Bank Account Edit Modal Button --}}
                                            <button @click="bankAccountEditModalOpen=true" class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">Edit</button>
                                            {{-- Bank Account Edit Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="bankAccountEditModalOpen" class="fixed top-0 left-0 z-[50] flex items-center justify-center w-screen h-screen" x-cloak>
                                                    <div x-show="bankAccountEditModalOpen" @click="bankAccountEditModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="bankAccountEditModalOpen" x-trap.inert.noscroll="bankAccountEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">Payment Card Update</h3>
                                                            <button @click="bankAccountEditModalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Bank Account Content --}}
                                                        <div class="relative w-auto mt-2">
                                                            <form @submit.prevent="bankAccountEditSubmitForm($event)" x-data="{
                        title: '{{old('title',$bankAccount->title)}}',
                        bank_name: '{{old('bank_name',$bankAccount->bank_name)}}',
                        account_type: '{{old('account_type',$bankAccount->account_type)}}',
                        routing_number: '{{old('routing_number',$bankAccount->routing_number)}}',
                        account_number: '{{old('account_number',$bankAccount->account_number)}}',
                        swift_code: '{{old('swift_code',$bankAccount->swift_code)}}',
                        iban_number: '{{old('iban_number',$bankAccount->iban_number)}}',
                        pin: '{{old('pin',default: $bankAccount->pin)}}',
                        branch_address: '{{old('branch_address',$bankAccount->branch_address)}}',
                        branch_phone: '{{old('branch_phone',$bankAccount->branch_phone)}}',
                        notes: '{{old('notes',$bankAccount->notes)}}',
                        bankAccountEditSubmitForm(event) {
                                    if(this.title == '{{$bankAccount->title}}' && this.bank_name == '{{$bankAccount->bank_name}}' && this.account_type == '{{$bankAccount->account_type}}' && this.routing_number == '{{$bankAccount->routing_number}}' && this.account_number == '{{$bankAccount->account_number}}' && this.swift_code == '{{$bankAccount->swift_code}}' && this.iban_number == '{{$bankAccount->iban_number}}' && this.pin == '{{$bankAccount->pin}}' && this.branch_address == '{{$bankAccount->branch_address}}' && this.branch_phone == '{{$bankAccount->branch_phone}}' && this.notes == '{{$bankAccount->notes}}'){
                                        event.preventDefault();
                                        bankAccountEditModalOpen = false;
                                    } else{
                                            event.target.submit();
                                    }
                                } 
                        }"
                                                                class="max-w-md mx-auto" action="{{ route('form.bank_account.update',$bankAccount->id)}}" method="POST">
                                                                @method('PATCH')
                                                                @csrf

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="title" x-model="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
                                                                </div>

                                                                <div class="grid md:grid-cols-2 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" name="bank_name" x-model="bank_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                        <label for="bank_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Bank Name</label>
                                                                    </div>

                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" name="account_type" x-model="account_type" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                        <label for="account_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Account Type</label>
                                                                    </div>
                                                                </div>



                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="routing_number" x-model="routing_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="routing_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Routing Number</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="account_number" x-model="account_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="account_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SWIFT Code</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="swift_code" x-model="swift_code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="swift_code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">IBAN Number</label>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" name="iban_number" x-model="iban_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                    <label for="iban_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">PIN</label>
                                                                </div>

                                                                <div class="grid md:grid-cols-2 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" name="branch_address" x-model="branch_address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                        <label for="branch_address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Branch Address</label>
                                                                    </div>

                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" name="branch_phone" x-model="branch_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                        <label for="branch_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Branch Phone</label>
                                                                    </div>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Your Notes</label>
                                                                    <textarea name="notes" rows="4" x-model="notes" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                                                </div>

                                                                <div class="w-full text-end">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                    {{--Bank Account Delete Form --}}
                                    <li>
                                        <!--Bank Account Delete Modal Button -->
                                        <div x-data="{ bankAccountDeleteModalOpen: false }" @keydown.escape.window="bankAccountDeleteModalOpen = false" class="relative z-50 w-auto h-auto">
                                            {{--Payment Cards Delete Modal Button --}}
                                            <button @click="bankAccountDeleteModalOpen=true" class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                            {{--Payment Cards Delete Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="bankAccountDeleteModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md" x-cloak>
                                                    <div x-show="bankAccountDeleteModalOpen" @click="bankAccountDeleteModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="bankAccountDeleteModalOpen" x-trap.inert.noscroll="paymentCardDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                            <h3 class="text-lg font-semibold text-white">Delete</h3>
                                                            <button @click="bankAccountDeleteModalOpen=false" class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Payment Cards Delete Modal Content --}}
                                                        <div class="relative w-auto mt-2 px-6 py-3">

                                                            <p class="text-lg text-gray-800">Delete this site - {{$bankAccount->title}}</p>
                                                            <div class="mt-4 flex justify-center gap-8 ">
                                                                <button @click="bankAccountDeleteModalOpen=false" class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                                    No
                                                                </button>
                                                                <form action="{{route('form.bank_account.destroy',$bankAccount->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        {{--Bank Account Item Card Content --}}
                        <div class="flex flex-col items-center  ">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{Str::limit($bankAccount->title,15,'...')}} </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{Str::limit($bankAccount->bank_name,25,'...')}}</p>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>


        </div>
    </div>













    <script>
        // Notification Message
        const notification = document.getElementById('toast-success');
        if (notification != null) {
            setTimeout(() => {
                notification.classList.add('top-[65px]');
            }, 1);

            setTimeout(() => {
                notification.classList.remove('top-[65px]');
            }, 2500);

        }

        // console.log(notification);

        // Edit  Modal Form Script

        function addressDate(event) {
            if (event) {
                const input = event.target;

                input.addEventListener("input", function() {
                    let value = input.value;

                    // Sadece rakamları al (tarih için geçerli karakterler)
                    value = value.replace(/\D/g, "");

                    // GG/AA/YYYY formatını uygula
                    if (value.length >= 3 && value.length <= 4) {
                        value = value.slice(0, 2) + "/" + value.slice(2);
                    } else if (value.length >= 5) {
                        value = value.slice(0, 2) + "/" + value.slice(2, 4) + "/" + value.slice(4, 8);
                    }

                    // Değeri input alanına geri yaz
                    input.value = value;
                });
            }
        }
    </script>
    @endsection

</x-app>