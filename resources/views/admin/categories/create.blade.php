@extends('layouts.main')

@section('content')
<div class="container-sm">
    @can('create_category')
        <div class="flex justify-between items-center">
            <a href="{{ route('users.index') }}" class="default-btn"><i
                    class="fa-solid fa-circle-arrow-left mr-2"></i>Back</a>
            <div class="text-md">Create Category</div>
        </div>
        <form method="POST" action="{{ route('categories.store') }}" class="flex flex-col pt-10">
            @csrf
            <div class="flex flex-wrap items-center border rounded px-1 py-2">
                <div class="w-1/3 border-r text-sm text-right pr-4">Display Name</div>
                <div class="w-2/3">
                    <input class="w-full focus:outline-none px-2 text-sm" type="text" placeholder="ex.. Beverage"
                        name="display_name" value="{{ old('display_name') }}">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('display_name')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
            <div class="flex flex-wrap items-center border rounded px-1 py-2 my-3">
                <div class="w-1/3 border-r text-sm text-right pr-4">Description</div>
                <div class="w-2/3">
                    <input class="w-full focus:outline-none px-2 text-sm" type="text" placeholder="ex. Luna"
                        name="description" value="{{ old('description') }}">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('description')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
            <div>
                <button class="default-btn" type="submit"><i class="fa-solid fa-circle-plus mr-2"></i>Create</button>
            </div>
        </form>

    @endcan
</div>
@endsection
