@section('title', 'Log In')
<x-app>
    @if(session('passwordForgot'))
    <div class="">
        {{session('passwordForgot')}}
    </div>
    @endif
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    {{-- <a href="#" class="flex items-center justify-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="w-8 h-8 mr-2" src="{{asset('assets/logos/logo.webp')}}" alt="logo">
                    </a> --}}
                    <div class=" flex items-center justify-between border-b-2 border-slate-100 mb-4 font-semibold shadow-sm dark:text-white">
                        <h1 class=" text-lg text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Log In
                        </h1>
                        <p class="font-light text-sm md:text-lg text-gray-500 dark:text-gray-400">
                            OR <a href="{{route('register')}}" class="font-medium text-primary hover:underline dark:text-primary-500">Create An Account</a>
                        </p>
                    </div>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="exapmle@gmail.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror


                            <div class="text-end">
                                <a href="{{route('password.forgot.index')}}" class="text-sm text-gray-500 font-medium hover:underline">{{__('Reset Password')}}</a>
                            </div>
                        </div>


                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Log In</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app>