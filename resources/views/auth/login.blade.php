<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
    <div class="flex flex-col items-center justify-center mt-2"> 
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
    <form action="/login" method="post" class="w-1/2 bg-gray-200 p-6 rounded-lg">
        @csrf
        <x-form-error name="title" />
        <div class="my-4">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" type="email" required/>
        </div>
        <x-form-error name="email" />
        <div class="my-4">
            <x-form-label for="password">Password</x-form-label>
            <x-form-input name="password" type="password" required/>
        </div>
        <x-form-error name="password" />
        <div class="flex justify-end mt-6">
            <x-form-button>Login</x-form-button>
        </div>

    </form>
</div>

</x-layout>