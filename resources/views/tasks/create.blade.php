<x-layout>
    <x-slot:title>
        Create New Task
    </x-slot:title>
    <div class="flex flex-col items-center justify-center mt-2">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('task.store') }}" method="post" class="w-1/2 bg-gray-200 p-6 rounded-lg">
            @csrf
            <x-form-error name="title" />
            <div class="my-4">
                <x-form-label for="title">Title</x-form-label>
                <x-form-input name="title" type="text" required/>
            </div>
            <x-form-error name="title" />
            <div class="my-4">
                <x-form-label for="description">Description</x-form-label>
                <textarea name="description" rows="4" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <x-form-error name="description" />
            <div class="my-4">
                <x-form-label for="due_date">Due Date</x-form-label>
                <x-form-input name="due_date" type="date"/>
            </div>
            <x-form-error name="due_date" />
            <div class="my-4">
                <x-form-label for="category_id">Category</x-form-label>
                <select name="category_id" class="w-full p-2 border border-gray-300 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-form-error name="due_date" />
            
            <div class="my-4">
                <x-form-label for="status">Status</x-form-label>
                <select name="status" class="w-full p-2 border border-gray-300 rounded">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <x-form-error name="status" />
            <div class="my-4">
                <x-form-label for="priority">Priority</x-form-label>
                <select name="priority" class="w-full p-2 border border-gray-300 rounded">
                    <option value="0">Low</option>
                    <option value="1">Medium</option>
                    <option value="2">High</option>
                </select>
            </div>
            <x-form-error name="priority" />
            
            <div class="flex justify-end mt-6">
                <x-form-button>Create Task</x-form-button>
            </div>

        </form>
</x-layout>