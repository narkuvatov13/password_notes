@extends('layouts.sidebar')
<x-app>
    @section('title', 'Addresses')
    @section('main-content')


        <!-- Notification Message -->
        @if (session('success'))
            <div>
                <div id="toast-success"
                    class="position absolute top-[-65px] left-1/2 translate-x-[-50%] transition-all duration-1000 ease-in-out  flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">{{ __('messages.close') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif


        {{-- Main Content Header --}}
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <h1 class="text-xl text-gray-700 font-bold">{{ __('messages.address_items') }}</h1>
            </div>
        </div>

        {{-- Main Content Items --}}
        <div class="p-4 sm:ml-64">

            <div
                class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                {{-- Address Item Cards --}}
                @foreach ($addresses as $address)
                    <div
                        class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        {{-- Address Item Card Buttons --}}
                        <div class="flex justify-end">
                            <button id="addressEditDropdownButton{{ $loop->iteration }}"
                                data-dropdown-toggle="addressEditDropdown{{ $loop->iteration }}"
                                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                type="button">
                                <span class="sr-only">{{ __('messages.open_dropdown') }}</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>

                            <!--Address Dropdown menu sss -->

                            <div id="addressEditDropdown{{ $loop->iteration }}"
                                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="addressEditDropdownButton">

                                    {{--Address Edit Modal --}}
                                    <li>
                                        <div x-data="{ addressEditModalOpen: false }"
                                            @keydown.escape.window="addressEditModalOpen = false"
                                            class="relative z-50 w-auto h-auto">
                                            {{-- Address Edit Modal Button --}}
                                            <button @click="addressEditModalOpen=true"
                                                class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">{{ __('messages.edit') }}</button>
                                            {{--Address Edit Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="addressEditModalOpen"
                                                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                                    x-cloak>
                                                    <div x-show="addressEditModalOpen" @click="addressEditModalOpen=false"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0"
                                                        x-transition:enter-end="opacity-100"
                                                        x-transition:leave="ease-in duration-300"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="addressEditModalOpen"
                                                        x-trap.inert.noscroll="addressEditModalOpen"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">
                                                                {{ __('messages.address_update') }}</h3>
                                                            <button @click="addressEditModalOpen=false"
                                                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Address Content --}}
                                                        <div class="relative w-auto mt-2">
                                                            <form @submit.prevent="addressEditSubmitForm($event)" x-data="{
                                                                title: '{{old('title', $address->title)}}',
                                                                first_name: '{{old('first_name', $address->first_name)}}',
                                                                middle_name: '{{old('middle_name', $address->middle_name)}}',
                                                                last_name: '{{old('last_name', $address->last_name)}}',
                                                                username: '{{old('username', $address->username)}}',
                                                                gender: '{{old('gender', $address->gender)}}',
                                                                birthday: '{{old('birthday', $address->birthday)}}',
                                                                company: '{{old('company', $address->company)}}',
                                                                address: '{{old('address', $address->address)}}',
                                                                city: '{{old('city', $address->city)}}',
                                                                country: '{{old('country', $address->country)}}',
                                                                state: '{{old('state', $address->state)}}',
                                                                postal_code: '{{old('postal_code', $address->postal_code)}}',
                                                                email: '{{old('email', $address->email)}}',
                                                                phone_number: '{{old('phone_number', $address->phone_number)}}',
                                                                mobile_phone_number: '{{old('mobile_phone_number', $address->mobile_phone_number)}}',
                                                                fax: '{{old('fax', $address->fax)}}',
                                                                notes: '{{old('notes', $address->notes)}}',
                                                                addressEditSubmitForm(event) {
                                                                            if(this.title == '{{$address->title}}' && this.first_name == '{{$address->first_name}}' && this.middle_name == '{{$address->middle_name}}' && this.last_name == '{{$address->last_name}}' && this.username == '{{$address->username}}' && this.gender == '{{$address->gender}}' && this.birthday == '{{$address->birthday}}' && this.company == '{{$address->company}}' && this.address == '{{$address->address}}' && this.city == '{{$address->city}}' && this.country == '{{$address->country}}' && this.state == '{{$address->state}}' && this.postal_code == '{{$address->postal_code}}' && this.email == '{{$address->email}}' && this.phone_number == '{{$address->phone_number}}' && this.mobile_phone_number == '{{$address->mobile_phone_number}}' && this.fax == '{{$address->fax}}' && this.notes == '{{$address->notes}}'){
                                                                                event.preventDefault();
                                                                                noteEditModalOpen = false;
                                                                            } else{
                                                                                    event.target.submit();
                                                                            }
                                                                        }
                                                                }" class="max-w-md mx-auto"
                                                                action="{{ route('form.address.update', $address->id)}}"
                                                                method="POST">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="title" name="title"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " required />
                                                                        <label for="title"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.title') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="first_name"
                                                                            name="first_name"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="first_name"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.first_name') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="middle_name"
                                                                            name="middle_name"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="middle_name"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.middle_name') }}</label>
                                                                    </div>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="last_name" name="last_name"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="last_name"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.last_name') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="username" name="username"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="username"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.username') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">


                                                                        <select id="gender" x-model="gender" name="gender"
                                                                            class="border-0 border-b-2 border-gray-300 focus:ring-0 text-gray-500 text-sm">
                                                                            @foreach (\App\Enums\Gender::getValues() as $key => $gender)
                                                                                <option value="{{$gender}}">{{$gender}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">

                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="date" x-model="birthday" name="birthday"
                                                                            id="dateInput"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder="GG/AA/YYYY" maxlength="10">
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="company" name="company"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="company"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.company') }}</label>
                                                                    </div>
                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <input type="text" x-model="address" name="address"
                                                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                        placeholder=" " />
                                                                    <label for="address"
                                                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.address') }}</label>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="city" name="city"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="city"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.city') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="country" name="country"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="country"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.country') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="state" name="state"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="state"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.state') }}</label>
                                                                    </div>
                                                                </div>

                                                                <div class="grid md:grid-cols-3 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="postal_code"
                                                                            name="postal_code"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="postal_code"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.zip_postal') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="email" name="email"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="email"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.email_address') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="phone_number"
                                                                            name="phone_number"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for=" phone_number "
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.phone') }}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="grid md:grid-cols-2 md:gap-6">
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="mobile_phone_number"
                                                                            name="mobile_phone_number"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="mobile_phone_number"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.mobile_phone') }}</label>
                                                                    </div>
                                                                    <div class="relative z-0 w-full mb-5 group">
                                                                        <input type="text" x-model="fax" name="fax"
                                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                            placeholder=" " />
                                                                        <label for="fax"
                                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.fax') }}</label>
                                                                    </div>

                                                                </div>

                                                                <div class="relative z-0 w-full mb-5 group">
                                                                    <label for="notes"
                                                                        class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('messages.your_message') }}</label>
                                                                    <textarea x-model="notes" name="notes" rows="4"
                                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder={{ __('messages.leave_a_comment') }}"></textarea>
                                                                </div>

                                                                <div class="w-full text-end">
                                                                    <button type="submit"
                                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">{{ __('messages.update') }}</button>
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
                                        <div x-data="{ addressDeleteModalOpen: false }"
                                            @keydown.escape.window="addressDeleteModalOpen = false"
                                            class="relative z-50 w-auto h-auto">
                                            {{--Address Delete Modal Button --}}
                                            <button @click="addressDeleteModalOpen=true"
                                                class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">{{ __('messages.delete') }}</button>
                                            {{--Address Delete Modal Body --}}
                                            <template x-teleport="body">
                                                <div x-show="addressDeleteModalOpen"
                                                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md"
                                                    x-cloak>
                                                    <div x-show="addressDeleteModalOpen" @click="addressDeleteModalOpen=false"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0"
                                                        x-transition:enter-end="opacity-100"
                                                        x-transition:leave="ease-in duration-300"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                                    <div x-show="addressDeleteModalOpen"
                                                        x-trap.inert.noscroll="addressDeleteModalOpen"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                        <div
                                                            class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                            <h3 class="text-lg font-semibold text-white">
                                                                {{ __('messages.delete') }}</h3>
                                                            <button @click="addressDeleteModalOpen=false"
                                                                class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        {{--Address Delete Modal Content --}}
                                                        <div class="relative w-auto mt-2 px-6 py-3">

                                                            <p class="text-lg text-gray-800">
                                                                {{ __('messages.delete_this_site') }}- {{$address->title}}</p>
                                                            <div class="mt-4 flex justify-center gap-8 ">
                                                                <button @click="addressDeleteModalOpen=false"
                                                                    class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                                    {{ __('messages.no') }}
                                                                </button>
                                                                <form action="{{route('form.address.destroy', $address->id)}}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">{{ __('yes') }}</button>
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
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{Str::limit($address->title, 25, '...')}} </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{Str::limit($address->address, 25, '...')}}
                            </p>
                        </div>
                    </div>
                @endforeach

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

                    input.addEventListener("input", function () {
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