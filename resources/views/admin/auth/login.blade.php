@extends('layouts.main')

@section('content')
<div class="flex flex-wrap w-screen">
    <div class="w-1/4">
        <div class="flex flex-col justify-center px-16  h-screen">
            <div class="text-3xl font-bold mb-8">Admin Login</div>

            @error('message')
                <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
            @enderror()
            <form action="{{ route('login') }}" method="POST"">
@csrf
                <div class=" flex flex-col bg-white">
                <label for="" class="uppercase font-bold text-sm py-1">Email</label>
                <input type="email" class="focus:outline-none border-b px-2 py-3 mb-2" name="email">
                @error('email')
                    <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                @enderror()
        </div>

        <div class="flex flex-col bg-white">
            <label for="" class="uppercase font-bold text-sm py-2">Password</label>
            <input type="password" class="focus:outline-none border-b px-2 py-2 mb-2" name="password">
            @error('password')
                <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
            @enderror()
        </div>
        <Button class="bg-emerald-500 px-6 py-2 text-white font-bold rounded w-full uppercase mt-6">Login</Button>
        </form>
    </div>
</div>
<div class="w-3/4 bg-emerald-500">
</div>
</div>
@endsection
