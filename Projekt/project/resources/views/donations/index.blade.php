<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of donations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <br class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if($fundraiser->donations->isEmpty())
                    <p class="p-6">No donation has been made for this fundraiser.</p>
                @else
                    @foreach($fundraiser->donations as $donation)
                        <a href="{{ route('fundraisers.donations.show', [$fundraiser, $donation]) }}"
                           class="text-indigo-600 hover:text-indigo-900">{{$donation->amount}}- {{$donation->description}}</a>
                        <br>
                    @endforeach
                @endif
        </div>
        </div>
    </div>
</x-app-layout>
