@extends('example.layouts.default.main')

@section('title', 'Register Pengguna')

@section('content')
<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    <a href="{{ url('/') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <img src="{{ asset('static/images/logoku.png') }}" class="mr-4 h-11" alt="Flowbite Logo">
        <span>Stocktify</span>
    </a>
    
    <!-- Card -->
    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Buat Akun Gratis
        </h2>
        <form class="mt-8 space-y-6" action="{{ route('submit') }}" method="post">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Anda</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Nama" required>
            </div>
            
            <!-- Username and Email Fields Side by Side -->
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="w-full mb-4">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username Anda</label>
                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Username" required>
                </div>
                <div class="w-full mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Anda</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required>
                </div>
            </div>

            <!-- Password and Confirm Password Fields Side by Side -->
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="w-full mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Anda</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
                <div class="w-full mb-4">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password Anda</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
            </div>

            <div>
                <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <select name="role_id" id="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <option value="" disabled selected>Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="font-medium text-gray-900 dark:text-white">Saya menerima <a href="#" class="text-primary-700 hover:underline dark:text-primary-500">Syarat dan Ketentuan</a></label>
                </div>
            </div>
            <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Buat Akun</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Sudah memiliki akun? <a href="{{ route('login.tampil') }}" class="text-primary-700 hover:underline dark:text-primary-500">Login di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
