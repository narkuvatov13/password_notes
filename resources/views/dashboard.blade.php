@extends('layouts.sidebar')
@push('scripts')

@endpush
<x-app>
    @section('title', 'Dashboard')
    @section('content')

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