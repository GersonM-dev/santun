@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow mt-8">
    <h2 class="text-2xl font-bold mb-4">My Profile</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border rounded p-2">
            @error('name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded p-2">
            @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">New Password (leave blank if not changing)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            @error('password')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>
        <button type="submit" class="bg-sky-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
