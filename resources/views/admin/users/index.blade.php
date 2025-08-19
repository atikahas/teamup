@extends('layouts.admin')

@section('header', __('Manage Users'))

@section('content')
    <div class="space-y-6">
        <!-- Search and Actions -->
        <div class="flex flex-col justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
            <div class="relative max-w-xs">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-magnifying-glass class="h-5 w-5 text-zinc-400" />
                </div>
                <input
                    type="text"
                    name="search"
                    id="search"
                    class="block w-full rounded-lg border-0 bg-white py-1.5 pl-10 pr-3 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:placeholder:text-zinc-400 sm:text-sm sm:leading-6"
                    placeholder="{{ __('Search users...') }}"
                    x-data="{ search: '' }"
                    x-model="search"
                    x-on:keyup.enter="$dispatch('search', { search: search })"
                >
            </div>
            <div class="flex items-center space-x-3">
                <button
                    type="button"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
                >
                    <x-heroicon-o-plus class="-ml-0.5 h-5 w-5" />
                    {{ __('Add User') }}
                </button>
                <button
                    type="button"
                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600"
                >
                    <x-heroicon-o-funnel class="-ml-0.5 mr-1.5 h-5 w-5 text-zinc-400" />
                    {{ __('Filter') }}
                </button>
            </div>
        </div>

        <!-- Users Table -->
        <div class="overflow-hidden bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-zinc-900 dark:text-white sm:pl-6">
                                {{ __('User') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                {{ __('Email') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                {{ __('Role') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">
                                {{ __('Last Login') }}
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 bg-white dark:divide-zinc-700 dark:bg-zinc-800">
                        @forelse(\App\Models\User::with('roles')->latest()->take(10)->get() as $user)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-700">
                                                <span class="font-medium text-zinc-700 dark:text-zinc-200">{{ $user->initials() }}</span>
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-zinc-900 dark:text-white">{{ $user->name }}</div>
                                            <div class="text-zinc-500 dark:text-zinc-400">ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $user->email }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                    @foreach($user->roles as $role)
                                        <span class="inline-flex items-center rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900/30 dark:text-primary-400">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            {{ __('Verified') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                            {{ __('Pending') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button type="button" class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                            <x-heroicon-o-pencil-square class="h-5 w-5" />
                                            <span class="sr-only">{{ __('Edit') }}</span>
                                        </button>
                                        <button type="button" class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300">
                                            <x-heroicon-o-eye class="h-5 w-5" />
                                            <span class="sr-only">{{ __('View') }}</span>
                                        </button>
                                        <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            <x-heroicon-o-trash class="h-5 w-5" />
                                            <span class="sr-only">{{ __('Delete') }}</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ __('No users found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="flex items-center justify-between border-t border-zinc-200 bg-white px-4 py-3 dark:border-zinc-700 dark:bg-zinc-800 sm:px-6">
                <div class="flex flex-1 justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center rounded-md border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        {{ __('Previous') }}
                    </a>
                    <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        {{ __('Next') }}
                    </a>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-zinc-700 dark:text-zinc-300">
                            {{ __('Showing') }}
                            <span class="font-medium">1</span>
                            {{ __('to') }}
                            <span class="font-medium">10</span>
                            {{ __('of') }}
                            <span class="font-medium">24</span>
                            {{ __('results') }}
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-zinc-400 ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 dark:ring-zinc-600 dark:hover:bg-zinc-700">
                                <span class="sr-only">{{ __('Previous') }}</span>
                                <x-heroicon-o-chevron-left class="h-5 w-5" />
                            </a>
                            <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-primary-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                                1
                            </a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-zinc-900 ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-700">
                                2
                            </a>
                            <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-zinc-900 ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-700 md:inline-flex">
                                3
                            </a>
                            <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-zinc-400 ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 dark:ring-zinc-600 dark:hover:bg-zinc-700">
                                <span class="sr-only">{{ __('Next') }}</span>
                                <x-heroicon-o-chevron-right class="h-5 w-5" />
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('userManagement', () => ({
                    search: '',
                    users: [],
                    loading: false,
                    
                    init() {
                        this.fetchUsers();
                        
                        this.$watch('search', (value) => {
                            this.debouncedSearch();
                        });
                    },
                    
                    debouncedSearch: _.debounce(function() {
                        this.fetchUsers();
                    }, 300),
                    
                    fetchUsers() {
                        this.loading = true;
                        
                        fetch(`/admin/users/search?search=${this.search}`)
                            .then(response => response.json())
                            .then(data => {
                                this.users = data;
                                this.loading = false;
                            });
                    },
                    
                    deleteUser(userId) {
                        if (confirm('Are you sure you want to delete this user?')) {
                            fetch(`/admin/users/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.fetchUsers();
                                }
                            });
                        }
                    }
                }));
            });
        </script>
    @endpush
@endsection
