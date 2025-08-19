@extends('layouts.admin')

@section('header', __('Manage Teams'))

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
                    placeholder="{{ __('Search teams...') }}"
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
                    {{ __('Create Team') }}
                </button>
            </div>
        </div>

        <!-- Teams Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse(\App\Models\Team::with('owner')->latest()->take(9)->get() as $team)
                <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-zinc-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-primary-100 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400">
                                        <x-heroicon-o-user-group class="h-6 w-6" />
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-zinc-900 dark:text-white">{{ $team->name }}</h3>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $team->members_count }} {{ Str::plural('member', $team->members_count) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                    <x-heroicon-o-pencil-square class="h-5 w-5" />
                                    <span class="sr-only">{{ __('Edit') }}</span>
                                </button>
                                <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                    <x-heroicon-o-trash class="h-5 w-5" />
                                    <span class="sr-only">{{ __('Delete') }}</span>
                                </button>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-zinc-200 pt-4 dark:border-zinc-700">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center">
                                    <span class="text-zinc-500 dark:text-zinc-400">{{ __('Owner') }}:</span>
                                    <div class="ml-2 flex items-center">
                                        <span class="mr-2 inline-block h-6 w-6 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                                            <span class="flex h-full items-center justify-center text-xs font-medium text-zinc-600 dark:text-zinc-300">
                                                {{ Str::upper(Str::substr($team->owner->name, 0, 1)) }}
                                            </span>
                                        </span>
                                        <span class="text-zinc-900 dark:text-white">{{ $team->owner->name }}</span>
                                    </div>
                                </div>
                                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    {{ $team->personal_team ? 'Personal' : 'Team' }} Team
                                </span>
                            </div>
                            <div class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                                <p>{{ __('Created') }}: {{ $team->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                                {{ __('View Details') }}
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-lg border-2 border-dashed border-zinc-300 p-12 text-center dark:border-zinc-600">
                    <x-heroicon-o-user-group class="mx-auto h-12 w-12 text-zinc-400" />
                    <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">{{ __('No teams') }}</h3>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        {{ __('Get started by creating a new team.') }}
                    </p>
                    <div class="mt-6">
                        <button
                            type="button"
                            class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
                        >
                            <x-heroicon-o-plus class="-ml-0.5 mr-1.5 h-5 w-5" />
                            {{ __('New Team') }}
                        </button>
                    </div>
                </div>
            @endforelse
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
                        <span class="font-medium">9</span>
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
                        <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-zinc-400 ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 dark:ring-zinc-600 dark:hover:bg-zinc-700">
                            <span class="sr-only">{{ __('Next') }}</span>
                            <x-heroicon-o-chevron-right class="h-5 w-5" />
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('teamManagement', () => ({
                    search: '',
                    loading: false,
                    
                    init() {
                        this.$watch('search', (value) => {
                            this.debouncedSearch();
                        });
                    },
                    
                    debouncedSearch: _.debounce(function() {
                        this.searchTeams();
                    }, 300),
                    
                    searchTeams() {
                        this.loading = true;
                        // Implement search functionality
                        this.loading = false;
                    },
                    
                    confirmDelete(teamId) {
                        if (confirm('Are you sure you want to delete this team? This action cannot be undone.')) {
                            this.deleteTeam(teamId);
                        }
                    },
                    
                    deleteTeam(teamId) {
                        // Implement delete functionality
                        fetch(`/admin/teams/${teamId}`, {
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
                                window.location.reload();
                            }
                        });
                    }
                }));
            });
        </script>
    @endpush
@endsection
