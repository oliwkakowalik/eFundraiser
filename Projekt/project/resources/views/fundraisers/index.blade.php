<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All fundraisers') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3  class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Filtration Catalog') }}
                    </h3>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form id="create_form"  method="get" action="{{ route('fundraisers.index') }}">
                        @csrf
                        <div class="mt-4">
                            <x-label for="category" :value="__('Category')" />
                            <select id="category" class="block mt-1 w-full" name="category">
                                <option value="" selected disabled hidden>-- Choose category --</option>
                                @foreach($categories as $category)
                                    <option
                                        @if($category->name == old('category'))
                                        selected
                                        @endif
                                        value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        <div class="mt-4">
                            <x-label for="amount_to_be_raised" :value="__('Minimal Amount To Collect')" />
                            <x-input id="amount_to_be_raised" class="block mt-1 w-full" type="number" name="amount_to_be_raised" :value="old('amount_to_be_raised')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="stop_date" :value="__('Ends before')" />
                            <x-input id="stop_date" class="block mt-1 w-full" type="date" name="stop_date" :value="old('stop_date')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="start_date" :value="__('Starts before')" />
                            <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4" type="Submit" value="FilterSubmit" name="filter">
                                {{ __('Filter') }}
                            </x-button>

                            <x-button class="ml-4" type="Submit" value="all" name="filter">
                                {{ __('Show All') }}
                            </x-button>
                        </div>
                            <div class="flex items-center justify-end mt-4 px-4 pb-5">
                                <form method="get" action="{{ route('fundraisers.create') }}">
                                    <x-button class="ml-4">
                                        {{ __('Create new...') }}
                                    </x-button>
                                </form>
                            </div>
                     </div>
                    </form>
                @if( count($fundraisers) < 1 )
                    <p class="p-6">No fundraisers available.</p>
                @else
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Sort:') }}
                    </h3>
                <div class="pt-8">
                    <form method="get" action="{{ route('fundraisers.index') }}">
                        <x-button class="ml-4" type="Submit" value="amount" name="submit">
                            {{ __('Amount ↓') }}
                        </x-button>
                        <x-button class="ml-4" type="Submit" value="amount2" name="submit">
                            {{ __('Amount ↑') }}
                        </x-button>
                        <x-button class="ml-4" type="Submit" value="date1" name="submit">
                            {{ __('End Date ↑') }}
                        </x-button>
                        <x-button class="ml-4" type="Submit" value="date2" name="submit">
                            {{ __('End Date ↓') }}
                        </x-button>
                    </form>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ends at
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($fundraisers as $fundraiser)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('fundraisers.show', $fundraiser) }}" class="text-indigo-600
                                    hover:text-indigo-900">{{ $fundraiser->title }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $fundraiser->amount_raised }} /
                                        {{ $fundraiser->amount_to_be_raised }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($fundraiser->stop_date < \Carbon\Carbon::now()->toDateTimeString())
                                        <div class="text-sm text-red-600">Closed</div>
                                    @else
                                        <div class="text-sm text-gray-900">{{ $fundraiser->stop_date }}</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                </div>
                <div>
                    {{ $paged->links() }}
                </div>
           </div>
        </div>
    </div>
    </div>
</x-app-layout>
