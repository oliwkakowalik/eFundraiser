<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing a donation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="post" action="{{ route('fundraisers.donations.update', [$fundraiser, $donation]) }}">
                    Unfortunately the amount you donated can not be changed. Feel free to change the other details of donation.
                        @csrf
                        @method("PUT")

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                                     :value="$donation->description" />
                        </div>

                        <div class="mt-4">
                            <x-label for="category" :value="__('Do you want to stay anonymoys?')" />
                            <select id="is_anonymous" class="block mt-1 w-full" name="is_anonymous">
                                <option    @if(1 == $donation->is_anonymous)
                                           selected
                                           @endif
                                           value="1">Anonymous donation</option>
                                <option    @if(0 == $donation->is_anonymous)
                                           selected
                                           @endif
                                           value="0">Show my username</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
