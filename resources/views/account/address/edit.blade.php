<x-app-layout>
    <div class="bg-[#F4F8FD] min-h-screen py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs font-medium uppercase tracking-widest text-gray-400 mb-8">
                <a href="{{ route('home') }}" class="hover:text-[#15A5ED] transition-colors">Home</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <a href="{{ route('account.address.index') }}"
                    class="hover:text-[#15A5ED] transition-colors">Shipping Addresses</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-gray-900">Edit</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                {{-- Sidebar --}}
                <aside class="hidden md:block lg:col-span-1">
                    @include('account.partials.sidebar')
                </aside>

                {{-- Right content --}}
                <main class="lg:col-span-3 space-y-5">

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-[#0A0A0C]">
                                Edit Address
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Update your shipping / delivery address details.
                            </p>
                        </div>

                        {{-- Validation errors --}}
                        @if ($errors->any())
                            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                <p class="font-semibold mb-1">There were some problems with your input:</p>
                                <ul class="list-disc list-inside space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('account.address.update', $address) }}" class="space-y-5">
                            @csrf
                            @method('PUT')

                            {{-- Row 1 --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                @foreach ([
                                    ['Recipient Name','recipient_name',$address->recipient_name ?? $user->name],
                                    ['Phone Number','phone',$address->phone],
                                    ['Email Address','email',$address->email],
                                ] as [$label,$name,$value])
                                    <div>
                                        <label class="block text-sm text-gray-500 mb-1">{{ $label }}</label>
                                        <input type="text" name="{{ $name }}" value="{{ old($name,$value) }}"
                                            class="w-full text-black rounded-xl border-gray-200 px-3 py-3
                                                   focus:border-[#15A5ED] focus:ring-[#15A5ED]/30">
                                    </div>
                                @endforeach
                            </div>

                            {{-- Address --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line1"
                                        value="{{ old('address_line1',$address->address_line1) }}"
                                        class="w-full text-black rounded-xl border-gray-200 px-3 py-3
                                               focus:border-[#15A5ED] focus:ring-[#15A5ED]/30">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">
                                        Address Line 2 <span class="text-gray-400">(optional)</span>
                                    </label>
                                    <input type="text" name="address_line2"
                                        value="{{ old('address_line2',$address->address_line2) }}"
                                        class="w-full text-black rounded-xl border-gray-200 px-3 py-3
                                               focus:border-[#15A5ED] focus:ring-[#15A5ED]/30">
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                                @foreach (['postcode','city','country'] as $field)
                                    <div>
                                        <label class="block text-sm text-gray-500 mb-1">{{ ucfirst($field) }}</label>
                                        <input type="text" name="{{ $field }}"
                                            value="{{ old($field,$address->$field ?? ($field==='country'?'Malaysia':'')) }}"
                                            class="w-full text-black rounded-xl border-gray-200 px-3 py-3
                                                   focus:border-[#15A5ED] focus:ring-[#15A5ED]/30">
                                    </div>
                                @endforeach

                                <div>
                                    <label class="block text-sm text-gray-500 mb-1">State</label>
                                    <select name="state"
                                        class="w-full text-black rounded-xl border-gray-200 px-3 py-3
                                               focus:border-[#15A5ED] focus:ring-[#15A5ED]/30">
                                        <option value="">Select State</option>
                                        @foreach ($states as $s)
                                            <option value="{{ $s['name'] }}" @selected(old('state',$address->state)===$s['name'])>
                                                {{ $s['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Default --}}
                            <div class="pt-4">
                                <label class="inline-flex items-center gap-2 text-base text-gray-600">
                                    <input type="checkbox" name="is_default" value="1"
                                        class="rounded border-gray-300 text-[#15A5ED] focus:ring-[#15A5ED]/40"
                                        {{ old('is_default',$address->is_default) ? 'checked' : '' }}>
                                    Set as my default address
                                </label>
                            </div>

                            {{-- Actions --}}
                            <div class="pt-5 flex items-center gap-4">
                                <button type="submit"
                                    class="px-7 py-3 rounded-full bg-[#15A5ED] text-white font-semibold
                                           hover:bg-[#0F8DD1] transition">
                                    Save Changes
                                </button>

                                <a href="{{ route('account.address.index') }}"
                                    class="px-7 py-3 rounded-full bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition">
                                    Cancel
                                </a>
                            </div>

                        </form>
                    </section>
                </main>

            </div>
        </div>
    </div>
</x-app-layout>
