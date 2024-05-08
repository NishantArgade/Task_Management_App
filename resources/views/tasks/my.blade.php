<x-app-layout>
    <!-- Page Heading -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-400 leading-tight">
            Task List
        </h2>
    </x-slot>

    @php
    $noRecordFound = true;
    @endphp


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
                        <p class="text-gray-400 dark:text-gray-30" id="task_id"></p>
                    </div>

                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Status:</label>
                        <p class="text-gray-400 dark:text-gray-30" id="status"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Assigned Date:</label>
                        <p class="text-gray-400 dark:text-gray-30" id="assigned_date"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Due Date:</label>
                        <p class="text-gray-400 dark:text-gray-30" id="due_date"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Title:</label>
                        <p class="text-gray-400 dark:text-gray-30" id="title"></p>
                    </div>
                    <div class="col-span-1 ">
                        <label class="font-bold text-gray-500 dark:text-gray-400">Description:</label>
                        <p class="text-gray-400 dark:text-gray-30" id="description"></p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Show Change Task  Modal -->
    <div id="authentication-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form action="{{ route('task.update-status') }}" method="post">
                @csrf
                @method('PUT')

                <input type="hidden" id="taskId_changeTaskModal" name="task_id">

                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">
                            Change Task Status
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="grid grid-cols-2 p-6 gap-4">

                        <div class="col-span-1 ">
                            <label class="font-bold text-gray-500 dark:text-gray-400">Title:</label>
                            <p class="text-gray-400 dark:text-gray-300  line-clamp-3" id="title_changeTaskModal"></p>
                        </div>
                        <div class="col-span-1 ">
                            <label class="font-bold text-gray-500 dark:text-gray-400">Description:</label>
                            <p class="text-gray-400 dark:text-gray-300  line-clamp-6" id="desc_changeTaskModal"></p>
                        </div>
                        <div class="col-span-1 ">
                            <label class="font-bold text-gray-500 dark:text-gray-400">Task Status:</label>
                            <select id="multiSelect_changeTaskModal" name="status" class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a status</option>
                                <option value="pending">Pending</option>
                                <option value="in progress">In Progress</option>
                                <option value="completed">Complated</option>
                            </select>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="reset" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" data-modal-hide="authentication-modal">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container mx-auto my-4 flex justify-center">
        <!-- Searchbar for table -->
        <form method="get" action="{{ route('task.my') }}" class="w-1/2">
            <div class="relative w-full  border-s-gray-50 border-s-[1px] border border-none rounded-sm">
                <input type="search" name="search_query" value="{{ old('search_query') }}" id="search-dropdown" class="block p-2.5 w-full rounded-lg z-20 text-sm text-gray-900 bg-gray-50  focus:ring-blue-600 focus:border-blue-600 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-600" placeholder="Search by Title, Status, Due Date" />
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-gray-200 dark:text-gray-400 bg-blue-500 rounded-lg border border-blue-600 dark:border-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-600 dark:bg-blue-900 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>
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
                            Task_Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>

                        <th scope="col" class="px-6 py-3 ">
                            Status
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Assigned_Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Due_Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                  
                    @foreach($tasks as $key=> $task)

                    @if(
                    stripos($task['title'], $searchTerm) !== false
                    || stripos($task['due_date'], $searchTerm) !== false
                    || stripos($task['pivot']['status'], $searchTerm) !== false
                    )

                    @php
                    $noRecordFound = false;
                    @endphp

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{$key+1}}
                        </td>
                        <td class="px-6 py-4">
                            {{$task['id']}}
                        </td>
                        <td class="px-6 py-4">

                            {{$task['title']}}
                        </td>

                        <td class="px-6 py-4">

                            @if($task['pivot']['status'] == 'pending')
                            <span class="bg-yellow-200 text-yellow-700 dark:bg-yellow-600 dark:text-yellow-100 font-semibold py-1 px-3 rounded-full text-xs">
                                Pending
                            </span>
                            @elseif($task['pivot']['status'] == 'in progress')
                            <span class="bg-blue-200 text-blue-700 dark:bg-blue-600 dark:text-blue-100 font-semibold py-1 px-3 rounded-full text-xs">
                                In Progress
                            </span>
                            @else
                            <span class="bg-green-200 text-green-700 dark:bg-green-600 dark:text-green-100 font-semibold py-1 px-3 rounded-full text-xs">
                                Completed
                            </span>
                            @endif

                        </td>
                        <td class="px-6 py-4">

                            {{date('Y-m-d', strtotime( $task['pivot']['created_at'] ))}}

                        </td>
                        <td class="px-6 py-4">
                            {{date('Y-m-d', strtotime( $task['due_date'] ))}}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="options-dropdown relative inline-block">
                                <button class="border-gray-400 border-2 text-gray-400 font-semibold py-2 px-2 mb-1 rounded-full inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                        <path d="M8 2a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM8 6.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM9.5 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                    </svg>
                                </button>

                                <ul class="dark:border-gray-400 border-gray-200 border-2 shadow options-dropdown-menu absolute z-50 hidden text-gray-700 rounded-md">
                                    <li>
                                        <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="w-full flex items-center justify-start gap-2 bg-gray-100 dark:bg-gray-500 hover:bg-gray-200 dark:hover:bg-gray-400 text-gray-500 dark:text-gray-300 dark:hover:text-gray-700   hover:text-gray-700 py-2 px-4  whitespace-no-wrap" type="button" onclick="handleViewMyTaskModal('{{json_encode($task)}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <span>View</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="w-full flex items-center justify-start gap-2 bg-gray-100 dark:bg-gray-500 hover:bg-gray-200 dark:hover:bg-gray-400 text-gray-500 dark:text-gray-300 dark:hover:text-gray-700 py-2 px-4  whitespace-no-wrap" type="button" onclick="handleChangeTaskStatus('{{json_encode($task)}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            <span>Edit</span>
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