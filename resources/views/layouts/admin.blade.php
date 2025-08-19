<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    @stack('styles')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex w-64 flex-col border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
                <!-- Logo -->
                <div class="flex h-16 flex-shrink-0 items-center px-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2" wire:navigate>
                        <x-application-logo class="h-8 w-auto" />
                        <span class="text-lg font-bold">Admin Panel</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
                    <flux:navlist variant="outline">
                        <flux:navlist.item 
                            icon="squares-2x2" 
                            :href="route('admin.dashboard')" 
                            :current="request()->routeIs('admin.dashboard')"
                            wire:navigate>
                            {{ __('Dashboard') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item 
                            icon="users" 
                            :href="route('admin.users.index')" 
                            :current="request()->routeIs('admin.users.*')"
                            wire:navigate>
                            {{ __('Users') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item 
                            icon="user-group" 
                            :href="route('admin.teams.index')" 
                            :current="request()->routeIs('admin.teams.*')"
                            wire:navigate>
                            {{ __('Teams') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item 
                            icon="cog-6-tooth" 
                            :href="route('admin.settings')" 
                            :current="request()->routeIs('admin.settings')"
                            wire:navigate>
                            {{ __('Settings') }}
                        </flux:navlist.item>
                    </flux:navlist>
                </nav>
                
                <!-- User Menu -->
                <div class="flex-shrink-0 border-t border-zinc-200 p-4 dark:border-zinc-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-zinc-200 dark:bg-zinc-700">
                                <span class="font-medium text-zinc-700 dark:text-zinc-200">{{ auth()->user()->initials() }}</span>
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ auth()->user()->name }}</p>
                            <a href="{{ route('dashboard') }}" class="text-xs font-medium text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200" wire:navigate>
                                {{ __('Back to App') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col overflow-hidden">
            <!-- Mobile header -->
            <header class="flex h-16 flex-shrink-0 items-center border-b border-zinc-200 bg-white px-4 dark:border-zinc-700 dark:bg-zinc-800 lg:hidden">
                <button type="button" class="-ml-2.5 p-2.5 text-zinc-700 dark:text-zinc-200 lg:hidden" @click="mobileMenuOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>
                <h1 class="ml-3 text-lg font-medium text-zinc-900 dark:text-white">
                    @yield('header')
                </h1>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html>
