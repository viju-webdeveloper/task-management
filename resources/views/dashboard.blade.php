<x-layout>
    <x-slot:title>Dashboard </x-slot:title>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-200">
            <caption class="text-lg font-semibold text-gray-900 mb-4">Tasks List</caption>
            <div class="mb-4">
                <form action="{{ route('dashboard') }}" method="get">
                    <div class="flex items-center">
                        <div class="flex flex-col md:flex-row gap-4 items-center">
                             <!-- title or description Search  -->
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search title or description..."
                                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200" />

                            <!-- Status Filter  -->
                            <select
                                name="status"
                                class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                                <option value="">-- All Status --</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>

                             <!-- Category Filter  -->
                            <select
                                name="category"
                                class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                                <option value="">-- All Categories --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            <x-form-button class="ml-2">Search</x-form-button>
                            <a href="/" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Reset</a>
                        </div>
                </form>
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Due Date</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Priority</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                    $i = 1
                    @endphp
                    @foreach($tasks as $task)
                    <tr>
                        <td class="border px-4 py-2">{{ $i++ }}</td>
                        <td class="border px-4 py-2">{{ $task->title }}</td>
                        <td class="border px-4 py-2">{{ $task->category->name }}</td>
                        <td class="border px-4 py-2">{{ optional($task->due_date)->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">
                            @if($task->status == 'pending')
                            <span class="text-red-500">Pending</span>
                            @elseif($task->status == 'in_progress')
                            <span class="text-green-500">in-process</span>
                            @elseif($task->status == 'completed')
                            <span class="text-blue-500">Completed</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            @if($task->priority == '0')
                            <span class="text-yellow-500">Low</span>
                            @elseif($task->priority == '1')
                            <span class="text-orange-500">Medium</span>
                            @elseif($task->priority == '2')
                            <span class="text-red-500">High</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('task.show', $task->id) }}" class="text-blue-500 hover:underline">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        {{ $tasks->links() }}

    </div>
</x-layout>