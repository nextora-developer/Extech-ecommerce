@extends('admin.layouts.app')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">Edit Account</h1>
            <p class="text-sm text-gray-500 mt-1">Modify credentials and manage saved delivery locations.</p>
        </div>

        <a href="{{ route('admin.users.show', $user) }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-gray-200
                   text-sm font-semibold text-gray-600 hover:bg-gray-50 transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Back</span>
        </a>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm flex items-center gap-3">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">

        <form id="user-form" method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-2 mb-4">
                <span class="w-1.5 h-6 bg-[#D4AF37] rounded-full"></span>
                <h2 class="font-bold text-gray-900">Basic Credentials</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Name --}}
                <div>
                    <label class="text-xs uppercase font-black tracking-widest text-gray-400">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#D4AF37] focus:ring-[#D4AF37]/30 font-medium">
                </div>

                {{-- IC --}}
                <div>
                    <label class="text-xs uppercase font-black tracking-widest text-gray-400">IC Number</label>
                    <input type="text" name="ic_number" value="{{ old('ic_number', $user->ic_number) }}"
                        class="mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#D4AF37] focus:ring-[#D4AF37]/30 font-medium">
                </div>

                {{-- Birth --}}
                <div>
                    <label class="text-xs uppercase font-black tracking-widest text-gray-400">Birth Date</label>
                    <input type="date" name="birth_date"
                        value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}"
                        class="mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#D4AF37] focus:ring-[#D4AF37]/30 font-medium">
                </div>

                {{-- Email --}}
                <div>
                    <label class="text-xs uppercase font-black tracking-widest text-gray-400">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#D4AF37] focus:ring-[#D4AF37]/30 font-medium">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="text-xs uppercase font-black tracking-widest text-gray-400">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#D4AF37] focus:ring-[#D4AF37]/30 font-medium">
                </div>

                {{-- Password --}}
                <div>
                    <label class="text-xs uppercase font-black tracking-widest text-[#8f6a10]">Change Password</label>
                    <input type="password" name="password"
                        class="mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#D4AF37] focus:ring-[#D4AF37]/30"
                        placeholder="Leave blank to keep current">
                </div>

                {{-- IC IMAGE --}}
                <div class="md:col-span-3" x-data="{
                    open: false,
                    img: '',
                    pick(e) {
                        const f = e.target.files[0];
                        if (!f) return;
                        this.img = URL.createObjectURL(f);
                    },
                    view(src) {
                        this.img = src;
                        this.open = true;
                    },
                    close() { this.open = false; }
                }">

                    <label class="text-xs uppercase font-black tracking-widest text-gray-400">IC Image</label>

                    <div class="mt-1.5 flex flex-col md:flex-row gap-4 items-start">

                        <div
                            class="w-48 h-32 rounded-2xl border border-dashed border-gray-200 bg-gray-50 overflow-hidden flex items-center justify-center">
                            @if ($user->ic_image)
                                <img x-show="!img" src="{{ asset('storage/' . $user->ic_image) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div x-show="!img" class="text-xs text-gray-400 font-bold uppercase tracking-widest">No
                                    Image</div>
                            @endif

                            <img x-show="img" :src="img" class="w-full h-full object-cover"
                                style="display:none;">
                        </div>

                        <div class="flex-1 w-full">
                            <input type="file" name="ic_image" accept="image/*" @change="pick"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-[#D4AF37]/10 file:text-[#8f6a10]
                                hover:file:bg-[#D4AF37]/20 cursor-pointer">

                            <div class="mt-2 flex items-center gap-2">
                                <span class="text-xs text-gray-400">Accepted: JPG, PNG, WEBP (Max 4MB)</span>

                                @if ($user->ic_image)
                                    <button type="button" @click="view('{{ asset('storage/' . $user->ic_image) }}')"
                                        class="text-xs font-black uppercase tracking-widest text-gray-500 hover:text-[#8f6a10]">
                                        View
                                    </button>

                                    <a href="{{ asset('storage/' . $user->ic_image) }}" download
                                        class="text-xs font-black uppercase tracking-widest text-gray-500 hover:text-[#8f6a10]">
                                        Download
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Modal --}}
                    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        style="display:none;">
                        <div class="absolute inset-0 bg-black/60" @click="close()"></div>

                        <div class="relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl">
                            <div class="flex justify-between px-5 py-4 border-b">
                                <div class="font-bold">IC Image Preview</div>
                                <button @click="close()">✕</button>
                            </div>

                            <div class="p-4 bg-gray-50">
                                <img :src="img" class="w-full max-h-[75vh] object-contain">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        {{-- Address --}}
        <div class="mt-10 border-t border-gray-100 pt-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#D4AF37] rounded-full"></span>
                    <h2 class="font-bold text-gray-900 text-lg">Saved Locations</h2>
                </div>

                <a href="{{ route('admin.addresses.create', $user) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#D4AF37]/10 text-[#8f6a10] border border-[#D4AF37]/30 text-sm font-bold hover:bg-[#D4AF37]/20 transition">
                    New Address
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($user->addresses as $address)
                    <div
                        class="group flex justify-between border border-gray-100 rounded-2xl p-5 bg-gray-50/50 hover:bg-white hover:border-[#D4AF37]/40 transition shadow-sm">
                        <div>
                            <p class="font-bold text-gray-900">{{ $address->recipient_name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $address->address_line1 }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between">

            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">
                Last activity: {{ $user->updated_at?->diffForHumans() ?? 'Never' }}
            </p>

            <div class="flex items-center gap-6">

                {{-- Active --}}
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0" form="user-form">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" form="user-form"
                        @checked(old('is_active', $user->is_active ?? true))>

                    <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-[#D4AF37]
                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                        after:bg-white after:h-5 after:w-5 after:rounded-full
                        after:transition-all peer-checked:after:translate-x-full">
                    </div>

                    <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">
                        Account Active
                    </span>
                </label>

                {{-- Verified --}}
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_verified" value="0" form="user-form">
                    <input type="checkbox" name="is_verified" value="1" class="sr-only peer" form="user-form"
                        @checked(old('is_verified', $user->is_verified))>

                    <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full
                        peer-checked:bg-emerald-500
                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                        after:bg-white after:h-5 after:w-5 after:rounded-full
                        after:transition-all peer-checked:after:translate-x-full">
                    </div>

                    <span
                        class="text-xs font-bold uppercase tracking-widest
                        {{ $user->is_verified ? 'text-emerald-600' : 'text-gray-500' }}">
                        Identity Verified
                    </span>
                </label>

                <button type="submit" form="user-form"
                    class="px-8 py-2.5 rounded-xl bg-[#D4AF37] text-white text-sm font-bold hover:bg-[#c29c2f] transition shadow-lg shadow-[#D4AF37]/20">
                    Save Profile Changes
                </button>

            </div>
        </div>

    </div>
@endsection
