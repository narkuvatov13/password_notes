@extends('layouts.sidebar')
<x-app>
    @section('title', 'Bank Accounts')
    @section('main-content')


    <!-- Notification Message -->
    @if (session('success'))
    <div>
        <div id="toast-success" class="position absolute top-[-65px] left-1/2 translate-x-[-50%] transition-all duration-1000 ease-in-out  flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
            </div>
            <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">{{ __('messages.close') }}</span>
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
            <h1 class="text-xl text-gray-700 font-bold">{{ __('messages.bank_account_items') }}</h1>
        </div>
    </div>

    {{-- Main Content Items --}}
    <div class="p-4 sm:ml-64">
        <div class="flex flex-wrap gap-4 md:gap-6 md:justify-start justify-center p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

            {{-- Bank Account Item Cards --}}
            @foreach ($bankAccounts as $bankAccount)
            <div class="block w-64 h-32 px-4 py-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                {{-- Bank Account Item Card Buttons --}}
                <div class="flex justify-end">
                    <button id="bankAccountEditDropdownButton{{ $loop->iteration }}" data-dropdown-toggle="bankAccountEditDropdown{{ $loop->iteration }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                        <span class="sr-only">{{ __('messages.open_dropdown') }}</span>
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
                                    <button @click="bankAccountEditModalOpen=true" class="w-full px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white disabled:opacity-50 disabled:pointer-events-none">{{ __('messages.edit') }}</button>
                                    {{-- Bank Account Edit Modal Body --}}
                                    <template x-teleport="body">
                                        <div x-show="bankAccountEditModalOpen" class="fixed top-0 left-0 z-[50] flex items-center justify-center w-screen h-screen" x-cloak>
                                            <div x-show="bankAccountEditModalOpen" @click="bankAccountEditModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                            <div x-show="bankAccountEditModalOpen" x-trap.inert.noscroll="bankAccountEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                                                <div class="flex items-center justify-between pb-2">
                                                    <h3 class="text-lg font-semibold">{{ __('messages.payment_card_update') }}</h3>
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
                                                            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.title') }}</label>
                                                        </div>

                                                        <div class="grid md:grid-cols-2 md:gap-6">
                                                            <div class="relative z-0 w-full mb-5 group">
                                                                <input type="text" name="bank_name" x-model="bank_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                <label for="bank_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.bank_name') }}</label>
                                                            </div>

                                                            <div class="relative z-0 w-full mb-5 group">
                                                                <input type="text" name="account_type" x-model="account_type" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                <label for="account_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.account_type') }}</label>
                                                            </div>
                                                        </div>



                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="routing_number" x-model="routing_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                            <label for="routing_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.routing_number') }}</label>
                                                        </div>

                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="account_number" x-model="account_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                            <label for="account_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.swift_code') }}</label>
                                                        </div>

                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="swift_code" x-model="swift_code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                            <label for="swift_code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.iban_number') }}</label>
                                                        </div>

                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="iban_number" x-model="iban_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                            <label for="iban_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.pin') }}</label>
                                                        </div>

                                                        <div class="grid md:grid-cols-2 md:gap-6">
                                                            <div class="relative z-0 w-full mb-5 group">
                                                                <input type="text" name="branch_address" x-model="branch_address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                <label for="branch_address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.branch_address') }}</label>
                                                            </div>

                                                            <div class="relative z-0 w-full mb-5 group">
                                                                <input type="text" name="branch_phone" x-model="branch_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                                                <label for="branch_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('messages.branch_phone') }}</label>
                                                            </div>
                                                        </div>

                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <label for="notes" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('messages.your_message') }}</label>
                                                            <textarea name="notes" rows="4" x-model="notes" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('messages.leave_a_comment') }}"></textarea>
                                                        </div>

                                                        <div class="w-full text-end">
                                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">{{ __('messages.update') }}</button>
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
                                    <button @click="bankAccountDeleteModalOpen=true" class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100  disabled:opacity-50 disabled:pointer-events-none">{{ __('messages.delete') }}</button>
                                    {{--Payment Cards Delete Modal Body --}}
                                    <template x-teleport="body">
                                        <div x-show="bankAccountDeleteModalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen rounded-md" x-cloak>
                                            <div x-show="bankAccountDeleteModalOpen" @click="bankAccountDeleteModalOpen=false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                                            <div x-show="bankAccountDeleteModalOpen" x-trap.inert.noscroll="paymentCardDeleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white sm:max-w-lg sm:rounded-lg">
                                                <div class="flex items-center justify-between bg-red-700 px-6  py-3 rounded-t-lg">
                                                    <h3 class="text-lg font-semibold text-white">{{ __('messages.delete') }}</h3>
                                                    <button @click="bankAccountDeleteModalOpen=false" class=" flex items-center justify-center w-8 h-8 text-white rounded-full hover:bg-red-600">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                {{--Payment Cards Delete Modal Content --}}
                                                <div class="relative w-auto mt-2 px-6 py-3">

                                                    <p class="text-lg text-gray-800">{{ __('messages.delete_this_site') }} - {{$bankAccount->title}}</p>
                                                    <div class="mt-4 flex justify-center gap-8 ">
                                                        <button @click="bankAccountDeleteModalOpen=false" class="border shadow-md px-8 py-2 text-md text-black rounded-lg hover:bg-gray-100 ">
                                                            {{ __('no') }}
                                                        </button>
                                                        <form action="{{route('form.bank_account.destroy',$bankAccount->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="shadow-md px-8 py-2 text-white text-md rounded-xl bg-red-700 hover:bg-red-800">{{ __('messages.yes') }}</button>
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