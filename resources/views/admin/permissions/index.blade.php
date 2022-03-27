@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="w-full mb-8 overflow-hidden mt-4">
        <div>
            <div class="table-header">
                <div class="w-full px-3 py-4 text-sm">Display Name</div>
                <div class="w-full px-3 py-4 text-sm">Status</div>
                <div class="w-full px-3 py-4 text-sm">Created At</div>
            </div>
        </div>
        @forelse($permissions as $permission)
            <ul
                class=" flex justify-between w-full border rounded-md my-2 space-x-5 hover:bg-gray-200 hover:border-gray-200">
                <li class="w-full py-3 px-4 text-xs">
                    <a>{{ $permission->title }}</a>
                </li>
                <li class="w-full py-3 px-4 text-xs">
                    <span
                        class=" text-xs font-semibold mr-2 px-2.5 py-0.5 rounded {{ ($permission->status) ? "bg-green-100 text-green-800" :"bg-red-100 text-red-800" }}">{{ $permission->active }}</span>
                </li>
                <li class="w-full py-3 px-4 text-xs">
                    {{ \Carbon\Carbon::parse($permission->created_at)->format('Y-m-d') }}
                </li>
            </ul>
        @empty
            <div class="flex items-center justify-center">
                <h1 class="text-xl font-bold text-gray-400 pt-32">No Data Available</h1>
            </div>
        @endforelse
    </div>
    {{ $permissions->links() }}
</div>
@endsection
