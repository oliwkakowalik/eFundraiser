<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing a fundraiser') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div>
                        {{$date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $fundraiser->stop_date)->format('Y-m-d')}}
                    </div>
                    <form method="post" action="{{ route('fundraisers.update', $fundraiser) }}">

                        @csrf
                        @method("PUT")

                        <div class="mt-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                     :value="$fundraiser->title" />
                        </div>

                        <div class="mt-4">
                            <x-label for="category" :value="__('Category')" />
                            <select id="category" class="block mt-1 w-full" name="category">
                                <option value="" disabled hidden>-- Choose category --</option>
                                @foreach($categories as $category)
                                    <option
                                        @if($fundraiser->category->name == $category->name)
                                            selected
                                        @endif
                                        >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                                     :value="$fundraiser->description" />
                        </div>

                        <div class="mt-4">
                            <x-label for="stop_date" :value="__('Stop date')" />
                            <x-input id="stop_date" class="block mt-1 w-full" type="date" name="stop_date" :
                                     value="{{$date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $fundraiser->stop_date)->format('Y-m-d')}}" />
                        </div>

                        <div class="mt-4">
                            <x-label for="amount_to_be_raised" :value="__('Amount to be raised')" />
                            <x-input id="amount_to_be_raised" class="block mt-1 w-full" type="number" name="amount_to_be_raised"
                                     :value="$fundraiser->amount_to_be_raised" />
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
