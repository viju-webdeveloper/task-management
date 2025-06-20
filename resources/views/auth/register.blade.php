<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>
    <form action="/register" method="post">
        @csrf
        <div class="my-4">
            <x-form-label for="name">Name</x-form-label>
            <x-form-input name="name" type="text" required/>
        </div>
        <x-form-error name="name" />
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
        <div class="my-4">
            <x-form-label for="password_confirmation">Repeat Password</x-form-label>
            <x-form-input name="password_confirmation" type="password" required/>
        </div>
        <x-form-error name="password_confirmation" />
        <div class="flex justify-end mt-6">
            <x-form-button>Register</x-form-button>
        </div>

    </form>


</x-layout>