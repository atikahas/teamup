@extends('layouts.admin')

@section('header', __('Admin Dashboard'))

@section('content')
    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users -->
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow dark:bg-zinc-800 sm:p-6">
                <dt class="truncate text-sm font-medium text-zinc-500 dark:text-zinc-400">
                    {{ __('Total Users') }}
                </dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                    {{ \App\Models\User::count() }}
                </dd>
                <div class="mt-2">
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                        {{ __('View all') }}
                    </a>
                </div>
            </div>

            <!-- Total Teams -->
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow dark:bg-zinc-800 sm:p-6">
                <dt class="truncate text-sm font-medium text-zinc-500 dark:text-zinc-400">
                    {{ __('Total Teams') }}
                </dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                    {{ \App\Models\Team::count() }}
                </dd>
                <div class="mt-2">
                    <a href="{{ route('admin.teams.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                        {{ __('View all') }}
                    </a>
                </div>
            </div>

            <!-- Active Users -->
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow dark:bg-zinc-800 sm:p-6">
                <dt class="truncate text-sm font-medium text-zinc-500 dark:text-zinc-400">
                    {{ __('Active Users (30d)') }}
                </dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                    {{ \App\Models\User::where('last_login_at', '>=', now()->subDays(30))->count() }}
                </dd>
                <div class="mt-2">
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ __('Last 30 days') }}
                    </span>
                </div>
            </div>

            <!-- System Status -->
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow dark:bg-zinc-800 sm:p-6">
                <dt class="truncate text-sm font-medium text-zinc-500 dark:text-zinc-400">
                    {{ __('System Status') }}
                </dt>
                <dd class="mt-1 flex items-baseline">
                    <span class="text-3xl font-semibold tracking-tight text-emerald-600 dark:text-emerald-400">
                        {{ __('Operational') }}
                    </span>
                    <span class="ml-2 flex items-center text-sm font-medium text-emerald-600 dark:text-emerald-400">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </dd>
                <div class="mt-2">
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ __('All systems normal') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="overflow-hidden bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                    {{ __('Recent Activity') }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('A summary of recent activities in the system.') }}
                </p>
            </div>
            <div class="border-t border-zinc-200 px-4 py-5 dark:border-zinc-700 sm:p-0">
                <div class="py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('No recent activity to display.') }}
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="overflow-hidden bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                    {{ __('Quick Actions') }}
                </h3>
            </div>
            <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 lg:grid-cols-4">
                <a href="#" class="flex flex-col items-center justify-center rounded-lg border border-zinc-200 p-6 text-center hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-700/50">
                    <div class="rounded-full bg-primary-100 p-3 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400">
                        <x-heroicon-o-user-plus class="h-6 w-6" />
                    </div>
                    <span class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">
                        {{ __('Add User') }}
                    </span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center rounded-lg border border-zinc-200 p-6 text-center hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-700/50">
                    <div class="rounded-full bg-emerald-100 p-3 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <x-heroicon-o-user-group class="h-6 w-6" />
                    </div>
                    <span class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">
                        {{ __('Create Team') }}
                    </span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center rounded-lg border border-zinc-200 p-6 text-center hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-700/50">
                    <div class="rounded-full bg-amber-100 p-3 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                        <x-heroicon-o-cog-6-tooth class="h-6 w-6" />
                    </div>
                    <span class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">
                        {{ __('System Settings') }}
                    </span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center rounded-lg border border-zinc-200 p-6 text-center hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-700/50">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                        <x-heroicon-o-chart-bar class="h-6 w-6" />
                    </div>
                    <span class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">
                        {{ __('View Reports') }}
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection
