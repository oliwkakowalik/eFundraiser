<?php
use \App\Models\User;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing a fundraiser') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-black shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            <div style="text-align: center;">{{ $fundraiser->title }}</div>
                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            @if($is_closed)
                            <div class="px-4 py-5 sm:px-6 sm:gap-4" style="background-color: indianred">
                                This fundraiser has ended and further donations are not allowed.
                            </div>
                            @endif
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Created by
                                </dt>
                                @if( !isset($fundraiser->user) )
                                    User has deleted their's account.
                                @elseif(Auth::id() == $fundraiser->user->id)
                                    <a style="color: {{User::findOrFail($fundraiser->user_id)->isSpecial()}}" href="{{ route('dashboard')}}" class="text-indigo-600
                                    hover:text-indigo-900"><x-markdown>{{ $fundraiser->user->name }}</x-markdown></a>
                                @else
                                <a style="color: {{User::findOrFail($fundraiser->user_id)->isSpecial()}}" href="{{ route('users.show', $fundraiser->user) }}" class="text-indigo-600
                                    hover:text-indigo-900"><x-markdown>{{ $fundraiser->user->name }}</x-markdown></a>
                                @endif
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Category
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $fundraiser->category->name }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Amount
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $fundraiser->amount_raised }} / {{ $fundraiser->amount_to_be_raised }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Date
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    Start: {{ $fundraiser->created_at }}
                                    <br>
                                    End: {{ $fundraiser->stop_date }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Description
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <x-markdown>
                                        {{ $fundraiser->description }}
                                    </x-markdown>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Latest donations
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <x-markdown>
                                        @foreach($latest_5_donations as $donation)
                                            <a href="{{ route('fundraisers.donations.show', [$fundraiser, $donation]) }}"
                                               class="text-indigo-600 hover:text-indigo-900">{{$donation->amount}}- {{$donation->description}}</a>
                                            <br>
                                        @endforeach
                                    </x-markdown>
                                </dd>
                            </div>
                            @if( isset($fundraiser->user) && Auth::id() == $fundraiser->user->id && !$is_closed)
                            <div class="bg-white px-4 pb-5 flex items-center justify-end mt-4">

                                <form method="get" action="{{ route('fundraisers.edit', $fundraiser) }}">
                                    <x-button class="ml-4">
                                        {{ __('Edit') }}
                                    </x-button>
                                </form>

                                <form method="post" action="{{ route('fundraisers.destroy', $fundraiser) }}">

                                    @csrf
                                    @method("DELETE")

                                    <x-button class="ml-4">
                                        {{ __('Delete') }}
                                    </x-button>
                                </form>
                            </div>
                            @endif
                            <div class="flex items-center justify-end mt-4 px-4 pb-5">
                                @if(!$is_closed)
                                <form method="get" action="{{ route('fundraisers.donations.create', $fundraiser) }}">
                                    <x-button class="ml-4">
                                        {{ __('Make a donation') }}
                                    </x-button>
                                </form>
                                @endif
                                <form method="get" action="{{ route('fundraisers.donations.index', $fundraiser) }}">
                                    <x-button class="ml-4">
                                        {{ __('See all donations for this fundraiser') }}
                                    </x-button>
                                </form>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
