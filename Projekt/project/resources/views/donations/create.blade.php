<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Making a donation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="post" action="{{ route('fundraisers.donations.store', $fundraiser) }}">

                        @csrf

                        <div class="mt-4">
                            <x-label for="title" :value="__('Amount')" />
                            <x-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="title" :value="__('Description')" />
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="category" :value="__('Do you want to stay anonymoys?')" />
                            <select id="is_anonymous" class="block mt-1 w-full" name="is_anonymous">
                                <option value="" selected disabled hidden>-- Choose an option --</option>
                                <option value="1">Anonymous donation</option>
                                <option value="0">Show my username</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Make a donation') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
