@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="pl-1 w-96 h-20 bg-green-600 rounded-lg shadow-md mx-4">
        <div class="flex w-full h-full py-2 px-4 bg-white border rounded-lg justify-between">
            <div class="my-auto">
                <a href="/users" class="font-bold uppercase">Users</a>

                <p class="text-lg">2000</p>
            </div>
            <div class="my-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection
