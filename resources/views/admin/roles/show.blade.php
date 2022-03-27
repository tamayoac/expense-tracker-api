@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="flex justify-between items-center">
        <a href="{{ route('roles.index') }}" class="default-btn"><i
                class="fa-solid fa-circle-arrow-left mr-2"></i>Back</a>
        <div class="text-md">Update Role</div>
    </div>
    <form method="POST" action="{{ route('roles.update', [$role]) }}"
        class="flex flex-wrap">
        @csrf
        @method('PUT')
        <div class="w-1/2 mt-3 pr-3">
            <div class="flex flex-wrap items-center border rounded">
                <label for="display_name" class="w-1/3 text-sm text-right pr-4 py-2 border-r">Display
                    Name
                </label>
                <input id="display_name" class="w-2/3 px-3 focus:outline-none text-sm" value={{ $role->display_name }}
                    type="text" placeholder="ex. Admin" name="display_name">
            </div>
            <div class="flex flex-wrap mt-2">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('display_name')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
        </div>
        <div class="w-1/2 mt-3">
            <div class="flex flex-wrap items-center border rounded">
                <label for="description" class="w-1/3 text-sm text-right pr-4 py-2 border-r">
                    Description
                </label>
                <input id="description" class="w-2/3 px-3 focus:outline-none text-sm" value={{ $role->description }}
                    type="text" placeholder="ex. Juan" name="description">
            </div>
            <div class="flex flex-wrap mt-2">
                <div class="w-1/3"></div>
                <div class="w-2/3">
                    @error('description')
                        <div class="text-xs text-red-500 mb-3">{{ $message }}</div>
                    @enderror()
                </div>
            </div>
        </div>
        <div class="w-full mt-3">
            <div class="grid grid-cols-3 gap-3">
                @foreach($permissions as $permission)
                    <div class="flex justify-between items-center text-xs px-2 py-3 rounded border shadow ">
                        <div class="uppercase text-xs">{{ $permission->title }}</div>
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" name="permissions[]" id="toggle{{ $permission->id }}"
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                value="{{ $permission->id }}"
                                {{ $role->permissions()->pluck('id')->contains($permission->id) ? 'checked'  : '' }} />
                            <label for="toggle{{ $permission->id }}"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="flex justify-between items-center w-full mt-3">
            <button class="primary-btn" type="submit"><i class="fa-solid fa-pen-to-square mr-2"></i>Update</button>
            <button class="danger-btn" type="submit"><i class="fa-solid fa-trash mr-2"></i>Delete</button>
        </div>
    </form>


</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

    })

</script>
@endsection
