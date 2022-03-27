@extends('layouts.app')

@section('title', 'Administrator')

@section('body')

<div class="flex relative">
    @auth
        <div class="w-64 h-screen fixed pb-6 px-0 bg-storm">
            <a href="/account">
                <div class="flex flex-wrap my-4">
                    <div class="flex flex-wrap justify-center w-1/3">
                        <div class="w-12 h-12">
                            <img class="h-auto w-full align-middle border-none rounded-full"
                                src="{{ auth()->user()->avatar }}" alt="">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-2/3 text-sm text-white">
                        <div class="w-full">
                            {{ auth()->user()->full_name }}
                        </div>
                        <div class="w-full text-xs">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </a>

            <ul class="flex justify-center flex-col">
                @can('view_dashboard')
                    <li>
                        <a href="{{ route('dashboard.index') }}"
                            class="flex items-center px-6 py-3 text-base font-normal text-gray-900 dark:text-white hover:bg-blue-200 hover:bg-opacity-25
                            {{ request()->is('dashboard') ? 'bg-blue-200 bg-opacity-25' : '' }}">
                            <i class="fa-solid fa-gauge mr-2"></i>Dashboard
                        </a>
                    </li>
                @endcan
                @can('view_user_management')
                    <li>
                        <a href="#" onclick="toogleMenu('user-management')"
                            class="flex items-center px-6 py-3 text-base font-normal text-gray-900 dark:text-white hover:bg-blue-200 hover:bg-opacity-25">
                            <i class="fa-solid fa-users-gear mr-2"></i>User Management
                        </a>
                    </li>
                @endcan
                <li id="menu-user-management" class="block">
                    @can('view_user')
                        <a href="{{ route('users.index') }}"
                            class="pl-16 w-full flex items-center p-3 text-base dark:text-white hover:bg-blue-200 hover:bg-opacity-25 text-white font-normal
                            {{ request()->is('users') ? 'bg-blue-200 bg-opacity-25' : '' }}">
                            <i class="fa fa-users mr-2"></i>Users
                        </a>
                    @endcan
                    @can('view_role')
                        <a href="{{ route('roles.index') }}"
                            class="pl-16 w-full flex items-center p-3 text-base dark:text-white hover:bg-blue-200 hover:bg-opacity-25 text-white font-normal
                            {{ request()->is('roles') ? 'bg-blue-200 bg-opacity-25' : '' }}">
                            <i class="fa-solid fa-user-gear mr-2"></i>Roles
                        </a>
                    @endcan
                    @can('view_permission')
                        <a href="{{ route('permissions.index') }}"
                            class="pl-16 w-full flex items-center p-3 text-base dark:text-white hover:bg-blue-200 hover:bg-opacity-25 text-white font-normal
                            {{ request()->is('permissions') ? 'bg-blue-200 bg-opacity-25' : '' }}">
                            <i class="fa-solid fa-lock mr-2"></i>Permissions
                        </a>
                    @endcan
                </li>
                @can('view_expense_management')
                    <li>
                        <a href="#" onclick="toogleMenu('expense-management')"
                            class="flex items-center px-6 py-3 text-base font-normal text-gray-900 dark:text-white hover:bg-blue-200 hover:bg-opacity-25">
                            <i class="fa-solid fa-list-check mr-2"></i>Expense Management
                        </a>
                    </li>
                @endcan

                <li id="menu-expense-management" class="block">
                    @can('view_category')
                        <a href="{{ route('categories.index') }}"
                            class="pl-16 w-full flex items-center p-3 text-base dark:text-white hover:bg-blue-200 hover:bg-opacity-25 text-white font-normal">
                            Categories
                        </a>
                    @endcan
                </li>
                </li>
            </ul>
        </div>
        <div class="w-screen ml-64">
            <nav class="
              flex
              justify-between
              items-center
              py-4
              px-6
              border-b
              bg-white
              text-sm
            sticky
            top-0">
                <div class="text-gray-400 uppercase"></div>
                <div class="flex items-center">
                    <div class="pr-8 text-gray-400">Welcome to Expense Manager</div>
                    <a href="{{ route('logout') }}" class="danger-btn"><i
                            class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </nav>
            @yield('content')
        </div>
    @else
        @yield('content')
    @endauth()
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function toogleMenu(type) {
        var menu = document.getElementById(`menu-${type}`);
        if (menu.classList.contains('hidden')) {
            menu.classList.remove("hidden");
            menu.classList.add("block");
        } else {
            menu.classList.add("hidden");
            menu.classList.remove("block");
        }
    }

</script>
@endsection
