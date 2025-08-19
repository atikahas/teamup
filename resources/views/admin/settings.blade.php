@extends('layouts.admin')

@section('header', __('System Settings'))

@section('content')
    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-zinc-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('System Settings') }}
                </h2>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('Manage your application settings and configurations.') }}
                </p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-zinc-200 dark:border-zinc-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button
                    @click="activeTab = 'general'"
                    :class="{
                        'border-primary-500 text-primary-600 dark:border-primary-400 dark:text-primary-300': activeTab === 'general',
                        'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:text-zinc-200': activeTab !== 'general'
                    }"
                    class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('General') }}
                </button>
                <button
                    @click="activeTab = 'authentication'"
                    :class="{
                        'border-primary-500 text-primary-600 dark:border-primary-400 dark:text-primary-300': activeTab === 'authentication',
                        'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:text-zinc-200': activeTab !== 'authentication'
                    }"
                    class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Authentication') }}
                </button>
                <button
                    @click="activeTab = 'email'"
                    :class="{
                        'border-primary-500 text-primary-600 dark:border-primary-400 dark:text-primary-300': activeTab === 'email',
                        'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:text-zinc-200': activeTab !== 'email'
                    }"
                    class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Email') }}
                </button>
                <button
                    @click="activeTab = 'maintenance'"
                    :class="{
                        'border-primary-500 text-primary-600 dark:border-primary-400 dark:text-primary-300': activeTab === 'maintenance',
                        'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:text-zinc-200': activeTab !== 'maintenance'
                    }"
                    class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Maintenance') }}
                </button>
            </nav>
        </div>

        <!-- Tab Panels -->
        <div class="mt-6">
            <!-- General Settings -->
            <div x-show="activeTab === 'general'" class="space-y-6">
                <form class="space-y-6">
                    <div class="bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                                {{ __('Application Settings') }}
                            </h3>
                            <div class="mt-5 space-y-6">
                                <div>
                                    <label for="app_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Application Name') }}
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            name="app_name"
                                            id="app_name"
                                            class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                            value="{{ config('app.name') }}"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="app_url" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Application URL') }}
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="url"
                                            name="app_url"
                                            id="app_url"
                                            class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                            value="{{ config('app.url') }}"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="timezone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Timezone') }}
                                    </label>
                                    <div class="mt-1">
                                        <select
                                            id="timezone"
                                            name="timezone"
                                            class="mt-1 block w-full rounded-md border-zinc-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                        >
                                            @foreach(timezone_identifiers_list() as $timezone)
                                                <option value="{{ $timezone }}" {{ config('app.timezone') === $timezone ? 'selected' : '' }}>
                                                    {{ $timezone }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="date_format" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Date Format') }}
                                    </label>
                                    <div class="mt-1">
                                        <select
                                            id="date_format"
                                            name="date_format"
                                            class="mt-1 block w-full rounded-md border-zinc-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                        >
                                            <option value="Y-m-d">YYYY-MM-DD</option>
                                            <option value="d/m/Y">DD/MM/YYYY</option>
                                            <option value="m/d/Y">MM/DD/YYYY</option>
                                            <option value="d M, Y">DD MMM, YYYY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-zinc-50 px-4 py-3 text-right dark:bg-zinc-700/50 sm:px-6">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:ring-offset-zinc-800"
                            >
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Authentication Settings -->
            <div x-show="activeTab === 'authentication'" class="space-y-6">
                <form class="space-y-6">
                    <div class="bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                                {{ __('Authentication Settings') }}
                            </h3>
                            <div class="mt-5 space-y-6">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input
                                            id="registration_enabled"
                                            name="registration_enabled"
                                            type="checkbox"
                                            class="h-4 w-4 rounded border-zinc-300 text-primary-600 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700"
                                            checked
                                        >
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="registration_enabled" class="font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('Enable User Registration') }}
                                        </label>
                                        <p class="text-zinc-500 dark:text-zinc-400">
                                            {{ __('Allow new users to create accounts.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input
                                            id="email_verification_required"
                                            name="email_verification_required"
                                            type="checkbox"
                                            class="h-4 w-4 rounded border-zinc-300 text-primary-600 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700"
                                            checked
                                        >
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="email_verification_required" class="font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('Require Email Verification') }}
                                        </label>
                                        <p class="text-zinc-500 dark:text-zinc-400">
                                            {{ __('Users must verify their email address before accessing the application.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input
                                            id="remember_me_enabled"
                                            name="remember_me_enabled"
                                            type="checkbox"
                                            class="h-4 w-4 rounded border-zinc-300 text-primary-600 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700"
                                            checked
                                        >
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember_me_enabled" class="font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('Enable "Remember Me"') }}
                                        </label>
                                        <p class="text-zinc-500 dark:text-zinc-400">
                                            {{ __('Allow users to stay logged in.') }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label for="password_min_length" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Minimum Password Length') }}
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="number"
                                            name="password_min_length"
                                            id="password_min_length"
                                            min="6"
                                            max="32"
                                            class="block w-24 rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                            value="8"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-zinc-50 px-4 py-3 text-right dark:bg-zinc-700/50 sm:px-6">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:ring-offset-zinc-800"
                            >
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Email Settings -->
            <div x-show="activeTab === 'email'" class="space-y-6">
                <form class="space-y-6">
                    <div class="bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                                {{ __('Email Settings') }}
                            </h3>
                            <div class="mt-5 space-y-6">
                                <div>
                                    <label for="mail_mailer" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Mailer') }}
                                    </label>
                                    <select
                                        id="mail_mailer"
                                        name="mail_mailer"
                                        class="mt-1 block w-full rounded-md border-zinc-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                    >
                                        <option value="smtp">SMTP</option>
                                        <option value="mailgun">Mailgun</option>
                                        <option value="ses">Amazon SES</option>
                                        <option value="postmark">Postmark</option>
                                        <option value="sendmail">Sendmail</option>
                                        <option value="log">Log</option>
                                        <option value="array">Array</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="mail_host" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('SMTP Host') }}
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            name="mail_host"
                                            id="mail_host"
                                            class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                            placeholder="smtp.mailtrap.io"
                                        >
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="mail_port" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('SMTP Port') }}
                                        </label>
                                        <div class="mt-1">
                                            <input
                                                type="number"
                                                name="mail_port"
                                                id="mail_port"
                                                class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                                placeholder="2525"
                                            >
                                        </div>
                                    </div>

                                    <div>
                                        <label for="mail_encryption" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('Encryption') }}
                                        </label>
                                        <select
                                            id="mail_encryption"
                                            name="mail_encryption"
                                            class="mt-1 block w-full rounded-md border-zinc-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                        >
                                            <option value="tls">TLS</option>
                                            <option value="ssl">SSL</option>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="mail_username" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('SMTP Username') }}
                                        </label>
                                        <div class="mt-1">
                                            <input
                                                type="text"
                                                name="mail_username"
                                                id="mail_username"
                                                class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                                autocomplete="username"
                                            >
                                        </div>
                                    </div>

                                    <div>
                                        <label for="mail_password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ __('SMTP Password') }}
                                        </label>
                                        <div class="mt-1">
                                            <input
                                                type="password"
                                                name="mail_password"
                                                id="mail_password"
                                                class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                                autocomplete="new-password"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="mail_from_address" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('From Address') }}
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="email"
                                            name="mail_from_address"
                                            id="mail_from_address"
                                            class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                            placeholder="noreply@example.com"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="mail_from_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('From Name') }}
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            name="mail_from_name"
                                            id="mail_from_name"
                                            class="block w-full rounded-md border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white sm:text-sm"
                                            placeholder="{{ config('app.name') }}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-zinc-50 px-4 py-3 text-right dark:bg-zinc-700/50 sm:px-6">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:ring-offset-zinc-800"
                            >
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Maintenance Settings -->
            <div x-show="activeTab === 'maintenance'" class="space-y-6">
                <div class="bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                            {{ __('Maintenance Mode') }}
                        </h3>
                        <div class="mt-2 max-w-xl text-sm text-zinc-500 dark:text-zinc-400">
                            <p>
                                {{ __('When maintenance mode is enabled, all requests to your application will return a maintenance mode response.') }}
                            </p>
                        </div>
                        <div class="mt-5">
                            <div class="rounded-md bg-yellow-50 p-4 dark:bg-yellow-800/30">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-o-exclamation-triangle class="h-5 w-5 text-yellow-400 dark:text-yellow-200" />
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                            {{ __('Maintenance mode is currently disabled.') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                            <p>
                                                {{ __('Enable maintenance mode when you are performing updates or maintenance tasks.') }}
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <div class="-mx-2 -my-1.5 flex">
                                                <button
                                                    type="button"
                                                    class="rounded-md bg-yellow-50 px-2 py-1.5 text-sm font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 focus:ring-offset-yellow-50 dark:bg-yellow-200/20 dark:text-yellow-100 dark:hover:bg-yellow-200/30 dark:focus:ring-offset-yellow-800/30"
                                                >
                                                    {{ __('Enable Maintenance Mode') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                            {{ __('Backup') }}
                        </h3>
                        <div class="mt-2 max-w-xl text-sm text-zinc-500 dark:text-zinc-400">
                            <p>
                                {{ __('Create a backup of your application database and files.') }}
                            </p>
                        </div>
                        <div class="mt-5">
                            <button
                                type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:ring-offset-zinc-800"
                            >
                                <x-heroicon-o-arrow-down-tray class="-ml-1 mr-2 h-5 w-5" />
                                {{ __('Create Backup') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium leading-6 text-zinc-900 dark:text-white">
                            {{ __('Clear Cache') }}
                        </h3>
                        <div class="mt-2 max-w-xl text-sm text-zinc-500 dark:text-zinc-400">
                            <p>
                                {{ __('Clear the application cache. This will clear all cached data including views, routes, and configuration.') }}
                            </p>
                        </div>
                        <div class="mt-5">
                            <button
                                type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-amber-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:ring-offset-zinc-800"
                            >
                                <x-heroicon-o-arrow-path class="-ml-1 mr-2 h-5 w-5" />
                                {{ __('Clear Cache') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('settings', () => ({
                    activeTab: 'general',
                    
                    init() {
                        // Check for tab in URL hash
                        if (window.location.hash) {
                            const tab = window.location.hash.substring(1);
                            if (['general', 'authentication', 'email', 'maintenance'].includes(tab)) {
                                this.activeTab = tab;
                            }
                        }
                        
                        // Update URL when tab changes
                        this.$watch('activeTab', (value) => {
                            window.history.pushState(null, null, `#${value}`);
                        });
                    }
                }));
            });
        </script>
    @endpush
@endsection
