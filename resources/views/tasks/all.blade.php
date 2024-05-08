<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-400 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    @php
    $noRecordFound = true;
    @endphp

    <div class="container mx-auto flex items-center justify-between w-full my-4 ">
        <!-- Searchbar for table -->
        <form method="get" action="{{ route('task.all') }}" class=" w-1/2">

            <div class="relative w-full  border-s-gray-50 border-s-[1px] border border-none rounded-sm">
                <input type="search" name="search_query" value="{{ old('search_query') }}" id="search-dropdown" class="block p-2.5 w-full rounded-lg z-20 text-sm text-gray-900 bg-gray-50  focus:ring-blue-600 focus:border-blue-600 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-600" placeholder="Search by Title, Due Date" />
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-gray-200 dark:text-gray-400 bg-blue-500 rounded-lg border border-blue-600 dark:border-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-600 dark:bg-blue-900 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>

        <a href="{{ route('task.create') }}" type="button" class="py-2.5 px-5 me-2  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Add Task</a>
    </div>


    <!--Confrim Delete Task Modal -->
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this task?</h3>
                    <div class="flex items-center gap-x-2 justify-center">
                        <form action="{{ route('task.destroy',0) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="task_id" id="del_task_id" value="">

                            <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Show Task Detail Modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">
                        Task Details
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="grid grid-cols-2 p-6 gap-4">

                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Task ID:</label>
                        <p class="text-gray-400 dark:text-gray-300 " id="task_id"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Due Date:</label>
                        <p class="text-gray-400 dark:text-gray-300 " id="due_date"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Title:</label>
                        <p class="text-gray-400 dark:text-gray-300 " id="title"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Description:</label>
                        <p class="text-gray-400 dark:text-gray-300 " id="description"></p>
                    </div>
                    <div class="col-span-2 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Assigned To:</label>
                        <p class="text-gray-400 dark:text-gray-300 " id="assigned_to"></p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Table -->
    <div class="container mx-auto mt-3">
        <div class="relative  shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Sr.No
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Due_Date
                        </th>
                        <th scope="col" class="px-6 py-3 w-96">
                            Assigned_To
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>


                    @foreach($tasks->all() as $key => $task)
                    @if(
                    stripos($task->title, $searchTerm) !== false
                    || stripos($task->due_date, $searchTerm) !== false
                    )
                    @php
                    $noRecordFound = false;
                    @endphp

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $key+1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{$task->title}}
                        </td>

                        <td class="px-6 py-4">
                            {{date('Y-m-d', strtotime($task->due_date))}}
                        </td>
                        <td class="px-6 py-4">
                            <!-- [adfa,asdf,asdf] -->
                            @foreach($task->users as $user)
                            @if($loop->last)
                            {{$user->name}}
                            @else
                            {{$user->name}},
                            @endif
                            @endforeach
                        </td>


                        <td class="px-6 py-4">
                            <div class="options-dropdown relative inline-block">
                                <button class="border-gray-400 border-2 text-gray-400 font-semibold py-2 px-2 mb-1 rounded-full inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                        <path d="M8 2a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM8 6.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM9.5 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                    </svg>
                                </button>

                                <ul class="dark:border-gray-400 border-gray-200 border-2 shadow options-dropdown-menu absolute z-50 hidden text-gray-700 rounded-md">
                                    <li>
                                        <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="w-full flex items-center justify-start gap-2 bg-gray-100 dark:bg-gray-500 hover:bg-gray-200 dark:hover:bg-gray-400 text-gray-500 dark:text-gray-300 dark:hover:text-gray-700 py-2 px-4  whitespace-no-wrap" type="button" onclick="handleViewTaskModal('{{json_encode($task)}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                            <span>View</span>

                                        </button>
                                    </li>
                                    <li>
                                        <a href="{{ route('task.edit', $task) }}" class=" flex items-center justify-start gap-2  dark:bg-gray-500 hover:bg-gray-200 dark:hover:bg-gray-400 text-gray-500 dark:text-gray-300 dark:hover:text-gray-700 py-2 px-4  whitespace-no-wrap" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                    </li>
                                    <li>
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class=" flex items-center justify-start gap-2  dark:bg-gray-500 hover:bg-gray-200 dark:hover:bg-gray-400 text-gray-500 dark:text-gray-300 dark:hover:text-gray-700 py-2 px-4  whitespace-no-wrap" type="button" onclick="handleDeleteTask('{{$task->id}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>

                                            <span>Delete</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                    @if($noRecordFound)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 text-center" colspan="7">
                            No Task Found
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>