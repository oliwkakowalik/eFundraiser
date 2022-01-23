<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->name }}{{ __('\'s account')}}

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">

                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    name:
                                </dt>
                                <dd style="color:{{auth()->user()->isSpecial()}}" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{auth()->user()->name}}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    e-mail:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{auth()->user()->email}}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">

                                    Fundraisers you created:
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
                                    Your donations:
                                </dt>

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
                                    Your anonymous donations:
                                </dt>

                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @foreach($user_anonymous_donations as $donation)
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
                                    Sum of your non-anonymous donations:
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ auth()->user()->scopeSumOfDonations($donations) }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Sum of all your donations:
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $sum_donations }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Verified:
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if( isset(auth()->user()->email_verified_at))
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        yes
                                    </dd>
                                    @else
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        no
                                    </dd>
                                    @endif
                                </dd>
                            </div>
                            @if(auth()->user()->email_verified_at == null)
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="get" action="{{ route('verification.notice') }}">
                                    <x-button class="ml-4">
                                        {{ __('Verify account') }}
                                    </x-button>
                                </form>
                            </td>
                            @endif
                        </dl>
                    </div>
                    @auth
                        <div class="bg-white px-4 pb-5 flex items-center justify-end mt-4">

                            <form method="get" action="{{route('users.edit', auth()->user())}}">
                                <x-button class="ml-4">
                                    {{ __('Edit your profile') }}
                                </x-button>
                            </form>
                        </div>

                        <div class="bg-white px-4 pb-5 flex items-center justify-end mt-4">

                            <form method="post" action="{{route('users.destroy', auth()->user())}}">

                                @csrf
                                @method("DELETE")

                                <x-button class="ml-4">
                                    {{ __('Delete your profile') }}
                                </x-button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


