<?php
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing a donation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                          <div style="text-align: center;">{{ $donation->amount }}</div>
                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    <br>Donated fundraiser
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <a style="color: black" href="{{ route('fundraisers.show', $donation->fundraiser) }}" class="text-indigo-600
                                    hover:text-indigo-800"><x-markdown>{{ $donation->fundraiser->title }}</x-markdown></a>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    <br>Description
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <x-markdown>
                                        {{ $donation->description }}
                                    </x-markdown>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Donated by
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if( !isset($donation->user) )
                                        User has deleted their's account.
                                    @elseif($donation->is_anonymous == 1)
                                            Anonymous donation
                                    @elseif(Auth::id() == $donation->user_id)
                                        <a style="color: {{User::findOrFail($donation->user_id)->isSpecial()}}" href="{{ route('dashboard') }}" class="text-indigo-600
                                    hover:text-indigo-900"><x-markdown>{{ $donation->user->name }}</x-markdown></a>
                                    @else
                                        <a style="color: {{User::findOrFail($donation->user_id)->isSpecial()}}" href="{{ route('users.show', $donation->user) }}" class="text-indigo-600
                                    hover:text-indigo-900"><x-markdown>{{ $donation->user->name }}</x-markdown></a>
                                    @endif
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Donated at
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $donation->created_at }}
                                </dd>
                            </div>
                            @if( isset($donation->user) && Auth::id() == $donation->user->id)
                            <div class="bg-white px-4 pb-5 flex items-center justify-end mt-4">

                                <form method="get" action="{{ route('fundraisers.donations.edit', [$fundraiser, $donation]) }}">
                                    <x-button class="ml-4">
                                        {{ __('Edit') }}
                                    </x-button>
                                </form>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
