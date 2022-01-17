<?php
use App\Models\User;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Here you can see ranking of all our users!') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if($users->isEmpty())
                    <p class="p-6">No users in database.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Name</span>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Sum of donations</span>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Details</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(User::scopeRanking() as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user[0] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user[1] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="get" action=" @if( isset($_SESSION['logged_user_id']) && $user[2] == $_SESSION['logged_user_id'] ) {{ route('dashboard', $user[2]) }} @else {{ route('users.show', $user[2]) }} @endif">
                                        <x-button class="ml-4">
                                            {{ __('View ') }} {{$user[0]}} {{__('profile')}}
                                        </x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

