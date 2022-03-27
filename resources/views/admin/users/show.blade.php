@extends('layouts.main')

@section('content')
<div class="container-sm">
    @can('create_user')
        <div class="flex justify-between items-center">
            <a href="{{ route('users.index') }}" class="default-btn"><i
                    class="fa-solid fa-circle-arrow-left mr-2"></i>Back</a>
            <div class="text-md">Update User</div>
        </div>
        <form method="POST" action="{{ route('users.update', [$user]) }}"
            class="flex flex-col pt-10">
            @csrf
            @method('PUT')
            <div class="flex flex-wrap items-center border rounded px-1 py-2">
                <div class="w-1/3 border-r text-sm text-right pr-4">First Name</div>
                <div class="w-2/3">
                    <input class="w-full focus:outline-none px-2 text-sm" type="text" placeholder="ex. Juan"
                        name="first_name" value="{{ $user->profile->first_name }}">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('first_name')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
            <div class="flex flex-wrap items-center border rounded px-1 py-2 my-3">
                <div class="w-1/3 border-r text-sm text-right pr-4">Last Name</div>
                <div class="w-2/3">
                    <input class="w-full focus:outline-none px-2 text-sm" type="text" placeholder="ex. Luna"
                        name="last_name" value="{{ $user->profile->last_name }}">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('last_name')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>

            <div class="flex flex-wrap items-center border rounded px-1 py-2">
                <div class="w-1/3 border-r text-sm text-right pr-4">Email</div>
                <div class="w-2/3">
                    <input class="w-full focus:outline-none px-2 text-sm" type="email" placeholder="@site.com"
                        name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('email')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>

            <div class="flex flex-wrap items-center border rounded px-1 py-2 my-3">
                <div class="w-1/3 border-r text-sm text-right pr-4">Mobile</div>
                <div class="w-2/3">
                    <input class="w-full focus:outline-none px-2 text-sm" type="text" placeholder="+63-(000000000)"
                        name="mobile" value="{{ $user->profile->mobile }}">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('mobile')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
            <div class="flex flex-wrap items-center border rounded px-1 py-2">
                <div class="w-1/3 border-r text-sm text-right pr-4">Role</div>
                <div class="w-2/3">
                    <select name="role" class="w-full focus:outline-none px-2 text-sm">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $role->id === $user->roles()->first()->id ? "selected" : "" }}>
                                {{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('role')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('status')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
            <div class="flex items-center justify-between mt-3">
                <button class="default-btn" type="submit"><i class="fa-solid fa-pen-to-square mr-2"></i>Update</button>
                <button class="danger-btn" type="submit"><i class="fa-solid fa-trash mr-2"></i>Delete</button>
            </div>
        </form>

    @endcan

</div>

@endsection
