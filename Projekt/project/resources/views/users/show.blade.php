<?php
use App\Models\User;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}{{ __('\'s account')}}

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <divfundraisers class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 style="color:{{$user->isSpecial()}}"class="text-lg leading-6 font-medium text-900">
                            {{ $user->name }}
                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    e-mail:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{$user->email}}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    created fundraisers:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @foreach($user_fundraisers as $fundraiser)
                                            <a href="{{ route('fundraisers.show', $fundraiser) }}">{{$fundraiser->title}}</a>
                                            <br>
                                    @endforeach

                                    @if($user_fundraisers->isEmpty())
                                        none
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Donations:
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @foreach($user_donations as $donation)
                                            <a href="{{ route('fundraisers.donations.show', [$donation->fundraiser, $donation]) }}">{{$donation->amount}}</a>
                                            <br>
                                    @endforeach
                                    @if($user_donations->isEmpty())
                                         none
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Sum of donations:
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $user->scopeSumOfDonations($donations) }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </divfundraisers>
            </div>
        </div>
    </div>
</x-app-layout>
</dt>
