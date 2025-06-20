<x-layout>
    <x-slot:title>
        Task Details
    </x-slot:title>
    <div class="flex flex-col items-center justify-center mt-2">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="w-1/2 bg-gray-200 p-6 rounded-lg">
            <h2 class="text-xl font-bold mb-4">{{ $task->title }}</h2>
            <p class="mb-4">{{ $task->description }}</p>
            <p class="mb-4"><strong>Due Date:</strong> {{ optional($task->due_date)->format('Y-m-d') }}</p>
            <p class="mb-4"><strong>Category:</strong> {{ $task->category->name }}</p>
            <p class="mb-4"><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p class="mb-4"><strong>Priority:</strong> 
                @if($task->priority == 0) Low 
                @elseif($task->priority == 1) Medium 
                @else High 
                @endif
            </p>
            <div class="flex justify-between mt-6">
                <a href="{{ route('task.edit', $task->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                <form action="{{ route('task.delete', $task->id) }}" method="post" class="inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>