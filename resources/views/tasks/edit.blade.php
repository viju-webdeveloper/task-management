<x-layout>
    <x-slot:title>
        Edit Task
    </x-slot:title>
    <div class="flex flex-col items-center justify-center mt-2">
        <form action="{{route('task.update',$task)}}" method="post" class="w-1/2 bg-gray-200 p-6 rounded-lg">
            @csrf
            <x-form-error name="title" />
            <div class="my-4">
                <x-form-label for="title">Title</x-form-label>
                <x-form-input name="title" type="text" value="{{ $task->title }}" required/>
            </div>
            <x-form-error name="title" />
            <div class="my-4">
                <x-form-label for="description">Description</x-form-label>
                <textarea name="description" rows="4" class="w-full p-2 border border-gray-300 rounded">{{$task->description}}</textarea>
            </div>
            <x-form-error name="description" />
            <div class="my-4">
                <x-form-label for="due_date">Due Date</x-form-label>
                <x-form-input name="due_date" type="date" value="{{\Carbon\Carbon::parse($task->due_date)->format('Y-m-d')}}" required/>
            </div>
            <x-form-error name="due_date" />
            <div class="my-4">
                <x-form-label for="category_id">Category</x-form-label>
                <select name="category_id" class="w-full p-2 border border-gray-300 rounded">
                    @foreach($categories as $category)
                    
                        <option value="{{ $category->id }}"
                        @if($task->category_id == $category->id) selected @endif>
                        {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-form-error name="due_date" />
            
            <div class="my-4">
                <x-form-label for="status">Status</x-form-label>
                <select name="status" class="w-full p-2 border border-gray-300 rounded">
                    <option value="pending" @if($task->status == 'pending') selected @endif>Pending</option>
                    <option value="in_progress" @if($task->status == 'in_progress') selected @endif>In Progress</option>
                    <option value="completed" @if($task->status == 'completed') selected @endif>Completed</option>
                </select>
            </div>
            <x-form-error name="status" />
            <div class="my-4">
                <x-form-label for="priority">Priority</x-form-label>
                <select name="priority" class="w-full p-2 border border-gray-300 rounded">
                    <option value="0" @if($task->priority == 0) selected @endif>Low</option>
                    <option value="1" @if($task->priority == 1) selected @endif>Medium</option>
                    <option value="2" @if($task->priority == 2) selected @endif>High</option>
                </select>
            </div>
            <x-form-error name="priority" />
            
            <div class="flex justify-end mt-6">
                <x-form-button>Update Task</x-form-button>
            </div>

        </form>
</x-layout>