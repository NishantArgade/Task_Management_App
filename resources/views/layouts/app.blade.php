<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!--Flowbite Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />


    <!-- Configure style and script using Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Success Alert  -->
        @if (session('status'))
        <div id="alert-border-3" class="flex fixed z-50  rounded-md right-2 top-2  items-center p-4 mb-4 min-w-80 text-green-800 border-b-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-700  dark:border-green-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-medium px-2">
                {{session('status')}}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-700 dark:text-green-400 dark:hover:bg-gray-600" data-dismiss-target="#alert-border-3" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif

        <!-- Error Alert -->
        @if ($errors->any())
        <div id="alert-border-4" class="flex rounded-md z-50 fixed right-2 top-2 min-w-80  items-center p-4 mb-4 text-red-600 border-b-4 border-red-300 bg-red-50 dark:text-red-500 dark:bg-gray-700 dark:border-red-600" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-600 bg-red-100 rounded-lg dark:bg-red-700 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-medium px-2">
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-600 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-700 dark:text-red-500 dark:hover:bg-gray-600" data-dismiss-target="#alert-border-4" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6
                    M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif


        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-none shadow">
            <div class="container mx-auto py-4 ">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>



    <!-- Dropdonw Menu Script -->
    <script src="{{ asset('/assets/dropdownMenu.js') }}"></script>

    <!-- MultiSelect Item Script -->
    <script src="{{asset('/assets/multiSelectItem.js')}}"></script>

    <!-- Flowbite Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script>
        function handleViewTaskModal(task) {

            const {
                id: task_id,
                title,
                description,
                due_date,
                users
            } = JSON.parse(task);

            console.log(users)

            const dueDateObj = new Date(due_date);

            document.getElementById('task_id').innerText = task_id;
            document.getElementById('title').innerText = title;
            document.getElementById('description').innerText = description;
            document.getElementById('due_date').innerText =
                dueDateObj.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            document.getElementById('assigned_to').innerText = users.map(user => user.name).join(', ');
        }

        function handleViewMyTaskModal(task) {


            const {
                id: task_id,
                title,
                description,
                due_date,
                pivot: {
                    status,
                    created_at
                },
            } = JSON.parse(task);


            const dueDateObj = new Date(due_date);
            const assignedDateObj = new Date(created_at);

            document.getElementById('task_id').innerText = task_id;
            document.getElementById('title').innerText = title;
            document.getElementById('description').innerText = description;
            document.getElementById('due_date').innerText =
                dueDateObj.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            document.getElementById('status').innerText = status;
            document.getElementById('assigned_date').innerText = assignedDateObj.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function handleChangeTaskStatus(task){
            const {
                id: task_id,
                title,
                description,
                pivot: {
                    status,
                    created_at
                }
            } = JSON.parse(task);
            


            document.getElementById('taskId_changeTaskModal').value = task_id;
            document.getElementById('title_changeTaskModal').innerText = title;
            document.getElementById('desc_changeTaskModal').innerText = description;
            document.getElementById('multiSelect_changeTaskModal').value = status;

        }
        function handleDeleteTask(task_id) {
            document.getElementById('del_task_id').value = task_id;
        }

        function handleViewUserTaskModal(user, task) {
            const {
                id: user_id,
                name,
                pivot
            } = JSON.parse(user);
            const {
                id: task_id,
                title,
                description,
                due_date,
                status
            } = JSON.parse(task);

            const dueDateObj = new Date(due_date);
            const assignedDateObj = new Date(pivot?.created_at);


            document.getElementById('user_id').innerText = user_id;
            document.getElementById('user_name').innerText = name;
            document.getElementById('task_id').innerText = task_id;
            document.getElementById('title').innerText = title;
            document.getElementById('description').innerText = description;
            document.getElementById('assigned_date').innerText = assignedDateObj.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });

            document.getElementById('due_date').innerText =
                dueDateObj.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });

            document.getElementById('status').innerText = pivot.status;
        }

        function handleDeleteUserTask(task_id, user_id) {
            document.getElementById('del_task_id').value = task_id;
            document.getElementById('del_user_id').value = user_id;
        }
    </script>
</body>

</html>