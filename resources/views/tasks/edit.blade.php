<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-400  leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    <div class="container mx-auto flex justify-center  mt-4 ">

        <form class="w-1/2" method="post" action="{{ route('task.update',$task->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-500 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input class="shadow dark:border placeholder-gray-400 dark:placeholder-gray-300  dark:bg-gray-500 bg-gray-50 border-0  appearance-none rounded w-full py-2 px-3 dark:text-gray-200  text-gray-500 leading-tight focus:outline-none focus:shadow-outline" name="title" type="text" placeholder="Title" value="{{ $task->title }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-500 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow h-28 placeholder-gray-400 dark:placeholder-gray-300  resize-none dark:border  dark:bg-gray-500 bg-gray-50 border-0   appearance-none  rounded w-full py-2 px-3  dark:text-gray-200  text-gray-500 leading-tight focus:outline-none focus:shadow-outline" name="description" placeholder="Description"> {{$task->description}}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-500 text-sm font-bold mb-2" for="due_date">
                    Due Date
                </label>
                <input class="shadow dark:border placeholder-gray-400 dark:placeholder-gray-300   dark:bg-gray-500 bg-gray-50 border-0  appearance-none  rounded w-full py-2 px-3  dark:text-gray-200  text-gray-500 leading-tight focus:outline-none focus:shadow-outline" name="due_date" type="date" value="{{ date('Y-m-d', strtotime($task->due_date)) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-500 text-sm font-bold mb-2" for="assigned_to">
                    Assigned to
                </label>

                <div class="relative inline-block text-left w-full rounded-md">
                    <input type="text" class="rounded-md  border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2 dark:bg-gray-500 bg-gray-50 shadow text-sm  dark:text-gray-200  text-gray-500 border-none leading-5 font-medium  w-full cursor-pointer placeholder-gray-300 " placeholder="Select Option" value="Select Option" id="selectedCountInput" autocomplete="false" onclick="toggleDropdown()" readonly>
                    <input type="hidden" autocomplete="false" id="selectedInputsData" name="selectedInputs" value="0">

                    <div id="multiSelectDropdown" class="origin-top-right hidden  left-0 mt-2 w-full rounded-md shadow ">
                        <!-- search -->
                        <input type="text" class="shadow-sm bg-gray-50   dark:text-gray-700  text-gray-500 dark:bg-gray-200 border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2 text-sm leading-5 font-medium  w-full placeholder-gray-300 dark:placeholder-gray-600 " placeholder="Search" autocomplete="false" id="searchInput" onkeyup="filterOptions()">

                        <div>
                            <!-- noResultFound -->
                            <div id="noResultFound" class="hidden">
                                <div class="px-4 py-2 flex items-center justify-start gap-x-2 cursor-pointer dark:bg-gray-400 bg-gray-50">
                                    <span class="block text-sm leading-5 font-medium text-gray-700">No result found</span>
                                </div>
                            </div>

                            <div class=" bg-gray-300 rounded-md shadow-xs ">
                                <div class="flex flex-col max-h-60 overflow-y-auto">
                                    <div class="px-4 flex items-center justify-between cursor-pointer dark:bg-gray-400 bg-gray-50 hover:bg-gray-200 dark:hover:bg-gray-300 ">
                                        <label class="flex items-center py-2 w-full cursor-pointer">
                                            <input id="selectAll" type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out" onchange="selectAllCheckbox()">
                                            <span class="block text-sm leading-5 font-medium text-gray-700 ml-2">Select All</span>
                                        </label>
                                    </div>
                                    <!-- 'allUsers', 'selectedUsers' -->
                                    @foreach( $allUsers as $user)
                                    <label class="px-4 py-2 flex items-center justify-start gap-x-2 cursor-pointer dark:bg-gray-400 bg-gray-50 dark:hover:bg-gray-300 hover:bg-gray-200">
                                        <input id="option1" type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out" onchange="updateSelectedCount()" @if(in_array($user['id'], array_keys($selectedUsers))) checked @endif>
                                        <span class="block text-sm leading-5 font-medium text-gray-700" value="{{$user['id']}}">{{$user['name']}}</span>
                                    </label>
                                    @endforeach
                                    <script>
                                        window.onload = function() {
                                            updateSelectedCount();
                                        };
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex items-center gap-x-2 mt-6">

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">Update</button>
                    <button type="reset" class="text-red-500 hover:text-white border border-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Cancel</button>

                </div>
        </form>
    </div>



</x-app-layout>