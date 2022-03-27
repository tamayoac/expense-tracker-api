@extends('layouts.main')

@section('content')
<div class="container-lg">
    @can('create_role')
        <div class="flex text-sm justify-end">
            <a href="{{ route('roles.create') }}" class=" primary-btn">
                <i class="fa-solid fa-circle-plus mr-2"></i>Add Role
            </a>
        </div>
    @endcan
    <div class="w-full mb-8 overflow-hidden mt-4">
        <div>
            <div class="table-header">
                <div class="w-full px-3 py-4 text-sm">Display Name</div>
                <div class="w-full px-3 py-4 text-sm">Description</div>
                <div class="w-full px-3 py-4 text-sm">Permissions</div>
                <div class="w-full px-3 py-4 text-sm">Created At</div>
            </div>
        </div>
        @forelse($roles  as $role)
            <ul
                class=" flex justify-between w-full border rounded-md my-2 space-x-5 hover:bg-gray-200 hover:border-gray-200">
                <li class="w-full py-3 px-4 text-xs">
                    <a
                        href="{{ route('roles.show', [$role]) }}">{{ $role->display_name }}</a>
                </li>
                <li class="w-full py-3 px-4 text-xs">{{ $role->description }}</li>
                <li class="w-full py-3 px-4 text-xs text-blue-300"><a
                        href="{{ route('roles.show', [$role]) }}" class="underline ">View
                        Permissions
                        ({{ $role->permissions->count() }})</a>
                </li>
                <li class="w-full py-3 px-4 text-xs">
                    {{ \Carbon\Carbon::parse($role->created_at)->format('Y-m-d') }}</li>
            </ul>
        @empty
            <div class="flex items-center justify-center">
                <h1 class="text-xl font-bold text-gray-400 pt-32">No Data Available</h1>
            </div>
        @endforelse
    </div>
    {{ $roles->links() }}

</div>

@endsection
