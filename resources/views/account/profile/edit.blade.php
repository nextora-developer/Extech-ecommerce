<x-app-layout>
    <div class="bg-[#F4F8FD] min-h-screen py-6 md:py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="hidden sm:flex items-center uppercase space-x-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-[#15a5ed] transition-colors">Home</a>

                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-gray-900 font-medium">Profile Setting</span>
            </nav>

            <div class="sm:hidden flex items-center justify-center relative mb-6">
                {{-- Back Button --}}
                <a href="{{ route('home') }}" class="absolute left-0 p-2 text-gray-500 hover:text-[#15A5ED] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                {{-- Title --}}
                <h1 class="text-lg font-bold text-gray-900">
                    Profile Setting
                </h1>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                {{-- 左侧 Sidebar --}}
                <aside class="hidden md:block lg:col-span-1">
                    @include('account.partials.sidebar')
                </aside>

                {{-- 右侧 Profile 内容 --}}
                <main class="lg:col-span-3 space-y-5">

                    {{-- <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                        <h2 class="text-lg font-semibold text-[#0A0A0C]">
                            Profile
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Update your account information and password.
                        </p>
                    </section> --}}

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                        <div class="space-y-6">
                            @include('account.profile.partials.update-profile-information-form')
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                        <div class="space-y-6">

                            @include('account.profile.partials.update-password-form')
                        </div>
                    </section>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
