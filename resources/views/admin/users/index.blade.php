@extends('layouts.main')

@section('content')
<div class="container-lg">
    @can('create_user')
        <div class="flex text-sm justify-end">
            <a href="{{ route('users.create') }}" class=" primary-btn">
                <i class="fa-solid fa-user-plus mr-2"></i>Add User
            </a>
        </div>
    @endcan
    <div class="w-full mb-8 overflow-hidden mt-4">
        <div>
            <div class="table-header">
                <div class="w-full px-3 py-4 text-sm"><i class="fa-solid fa-user mr-2"></i>Name</div>
                <div class="w-full px-3 py-4 text-sm"><i class="fa-solid fa-envelope mr-2"></i>Email</div>
                <div class="w-full px-3 py-4 text-sm"><i class="fa-solid fa-bars-progress mr-2"></i>Status</div>
                <div class="w-full px-3 py-4 text-sm"><i class="fa-solid fa-calendar-plus mr-2"></i>Created At</div>
            </div>
        </div>
        @forelse($users  as $user)
            <ul
                class=" flex justify-between items-center w-full border rounded-md my-2 space-x-5 hover:bg-gray-200 hover:border-gray-200">
                <li class="flex w-full py-3 px-4 text-xs">
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                        <img class="object-cover w-full h-full rounded-full" src="{{ $user->avatar }}" alt=""
                            loading="lazy" />
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                        <a href="{{ route('users.show', [$user]) }}"
                            class="font-semibold text-black">{{ $user->full_name }}</a>
                        <p class="text-xs text-gray-600">{{ $user->role }}</p>
                    </div>
                </li>
                <li class="w-full py-3 px-4 text-xs">{{ $user->email }}</li>
                <li class="w-full py-3 px-4 text-xs">
                    <span
                        class=" text-xs font-semibold mr-2 px-2.5 py-0.5 rounded {{ ($user->status) ? "bg-green-100 text-green-800" :"bg-red-100 text-red-800" }}">{{ $user->active }}</span>
                </li>
                <li class=" w-full py-3 px-4 text-xs">
                    {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</li>
            </ul>
        @empty
            <div class="flex items-center justify-center">
                <h1 class="text-xl font-bold text-gray-400 pt-32">No Data Available</h1>
            </div>
        @endforelse
    </div>
    {{ $users->links() }}

</div>

@endsection
