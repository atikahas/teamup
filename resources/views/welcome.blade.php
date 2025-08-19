<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/4500/4500024.png" sizes="any">
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/4500/4500024.png" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>

    <section class="relative overflow-hidden">

        <div aria-hidden class="absolute inset-0 bg-gradient-to-b from-neutral-600 via-neutral-700 to-neutral-900"></div>
        <div aria-hidden class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 10%, white 0%, transparent 35%), radial-gradient(circle at 80% 30%, white 0%, transparent 35%), radial-gradient(circle at 50% 80%, white 0%, transparent 35%);"></div>

        <svg aria-hidden viewBox="0 0 1200 800" class="pointer-events-none absolute inset-0 h-full w-full opacity-10">
            <defs>
            <pattern id="pitch" width="80" height="80" patternUnits="userSpaceOnUse">
                <path d="M0 40h80M40 0v80" stroke="white" stroke-width="1" />
                <circle cx="40" cy="40" r="9" fill="none" stroke="white" stroke-width="1"/>
            </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#pitch)" />
        </svg>

        <div class="relative z-10 mx-auto max-w-7xl px-4 py-20 sm:px-6 md:py-28 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2">
            <!-- Copy -->
            <div class="text-white">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium backdrop-blur-sm">
                    <span class="i-flux-sparkle h-3.5 w-3.5 [mask:radial-gradient(circle,white_55%,transparent_56%)] bg-white/80"></span>
                    New: Auto-matching for 5v5 & 11v11
                </div>
                <h1 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl">
                    TeamUp. Train smart. <span class="text-emerald-200">Win together.</span>
                </h1>
                <p class="mt-4 max-w-xl text-base/relaxed sm:text-lg text-emerald-50/90">
                    Organize squads, fixtures, and player availability in minutes. 
                    AI-powered matching pairs managers with the right players and pitches—so your only focus is the beautiful game.
                </p>

                <!-- CTAs -->
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="flux-btn flux-btn--primary inline-flex items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold text-emerald-950 bg-emerald-300 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300 focus:ring-offset-emerald-800">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="flux-btn flux-btn--ghost inline-flex items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold text-white/90 ring-1 ring-inset ring-white/30 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-emerald-200">
                                Login
                            </a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="flux-btn flux-btn--primary inline-flex items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold text-emerald-950 bg-emerald-300 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300 focus:ring-offset-emerald-800">
                                Join Now !
                            </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Social Proof -->
                <div class="mt-8 grid gap-6 sm:grid-cols-2">
                <!-- Avatars & count -->
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <img class="h-10 w-10 rounded-full ring-2 ring-emerald-700" src="https://i.pravatar.cc/40?img=11" alt="Player 1">
                        <img class="h-10 w-10 rounded-full ring-2 ring-emerald-700" src="https://i.pravatar.cc/40?img=22" alt="Player 2">
                        <img class="h-10 w-10 rounded-full ring-2 ring-emerald-700" src="https://i.pravatar.cc/40?img=31" alt="Player 3">
                    </div>
                    <p class="ml-4 text-sm text-emerald-50/90"><span class="font-semibold">24,000+</span> players joined this month</p>
                </div>

                <!-- Logos -->
                <div class="flex items-center gap-4 text-white/60">
                    <span class="text-xs">Trusted by leagues:</span>
                    <div class="flex items-center gap-3 opacity-80">
                    <span class="rounded bg-white/10 px-2 py-1 text-xs">MY Super5</span>
                    <span class="rounded bg-white/10 px-2 py-1 text-xs">KK 7s</span>
                    <span class="rounded bg-white/10 px-2 py-1 text-xs">JB Amateur</span>
                    </div>
                </div>
                </div>

                <!-- Key points -->
                <dl class="mt-10 grid max-w-xl grid-cols-2 gap-6 text-emerald-50/90">
                <div>
                    <dt class="text-xs uppercase tracking-wide text-emerald-200/80">Smart scheduling</dt>
                    <dd class="mt-1 text-sm">Auto-resolve fixture clashes & pitch slots</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-emerald-200/80">Team ops</dt>
                    <dd class="mt-1 text-sm">Roster, roles, and availability in one view</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-emerald-200/80">Player marketplace</dt>
                    <dd class="mt-1 text-sm">Find subs & trials by skill and position</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-emerald-200/80">Insights</dt>
                    <dd class="mt-1 text-sm">Performance trends and attendance heatmaps</dd>
                </div>
                </dl>
            </div>

            <!-- Mockup Panel -->
            <div class="relative">
                <div class="absolute -right-10 -top-10 hidden h-48 w-48 rounded-full bg-emerald-400/30 blur-3xl lg:block"></div>
                <div class="absolute -bottom-10 -left-10 hidden h-48 w-48 rounded-full bg-emerald-300/20 blur-3xl lg:block"></div>

                <div class="flux-card rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-md shadow-2xl">
                <!-- Card header -->
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-emerald-300 to-emerald-500 text-emerald-950 grid place-items-center font-black">FT</div>
                    <div>
                        <p class="text-sm font-semibold text-white">Your Team</p>
                        <p class="text-xs text-white/60">Sunday League • 11v11</p>
                    </div>
                    </div>
                    <button class="rounded-lg bg-white/10 px-3 py-2 text-xs text-white hover:bg-white/15">Invite</button>
                </div>

                <!-- Roster list -->
                <ul class="divide-y divide-white/10">
                    <li class="flex items-center justify-between gap-3 py-3">
                    <div class="flex items-center gap-3">
                        <img class="h-9 w-9 rounded-full ring-2 ring-emerald-700" src="https://i.pravatar.cc/36?img=5" alt="GK">
                        <div>
                        <p class="text-sm font-medium text-white">Nizam Rahman</p>
                        <p class="text-xs text-white/60">GK • Available</p>
                        </div>
                    </div>
                    <span class="rounded bg-emerald-400/20 px-2 py-1 text-xs text-emerald-200">Starter</span>
                    </li>
                    <li class="flex items-center justify-between gap-3 py-3">
                    <div class="flex items-center gap-3">
                        <img class="h-9 w-9 rounded-full ring-2 ring-emerald-700" src="https://i.pravatar.cc/36?img=15" alt="DF">
                        <div>
                        <p class="text-sm font-medium text-white">Haziq Musa</p>
                        <p class="text-xs text-white/60">DF • 70% fit</p>
                        </div>
                    </div>
                    <span class="rounded bg-white/10 px-2 py-1 text-xs text-white/80">Bench</span>
                    </li>
                    <li class="flex items-center justify-between gap-3 py-3">
                    <div class="flex items-center gap-3">
                        <img class="h-9 w-9 rounded-full ring-2 ring-emerald-700" src="https://i.pravatar.cc/36?img=25" alt="MF">
                        <div>
                        <p class="text-sm font-medium text-white">Atikah Subari</p>
                        <p class="text-xs text-white/60">MF • New signing</p>
                        </div>
                    </div>
                    <span class="rounded bg-emerald-400/20 px-2 py-1 text-xs text-emerald-200">Trial</span>
                    </li>
                </ul>

                <!-- Quick actions -->
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <button class="rounded-lg bg-emerald-300 px-3.5 py-2 text-xs font-semibold text-emerald-950 hover:bg-emerald-200">Create Fixture</button>
                    <button class="rounded-lg bg-white/10 px-3.5 py-2 text-xs text-white hover:bg-white/15">Find Sub</button>
                    <button class="rounded-lg bg-white/10 px-3.5 py-2 text-xs text-white hover:bg-white/15">Share Lineup</button>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Bottom social strip -->
        <div class="relative z-10 border-t border-white/10 bg-neutral-950/40 backdrop-blur">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div class="flex items-center gap-4 text-white/80">
                <span class="text-sm">Follow TeamUp</span>
                <a href="#" aria-label="X" class="rounded-full bg-white/10 p-2 hover:bg-white/15"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M2 3h4l6 7 6-7h4l-8 9 8 9h-4l-6-7-6 7H2l8-9z"/></svg></a>
                <a href="#" aria-label="Instagram" class="rounded-full bg-white/10 p-2 hover:bg-white/15"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 5a5 5 0 1 0 .001 10.001A5 5 0 0 0 12 7zm6.5-.75a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5zM12 9a3 3 0 1 1-.001 6.001A3 3 0 0 1 12 9z"/></svg></a>
                <a href="#" aria-label="Facebook" class="rounded-full bg-white/10 p-2 hover:bg-white/15"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M13 22V12h3l1-4h-4V6.5A1.5 1.5 0 0 1 14.5 5H17V1h-3.5A4.5 4.5 0 0 0 9 5.5V8H6v4h3v10z"/></svg></a>
                </div>
                <div class="flex items-center gap-6">
                <div class="text-left text-white/80">
                    <p class="text-sm font-semibold">100+</p>
                    <p class="text-xs text-white/60">Matches scheduled</p>
                </div>
                <div class="text-left text-white/80">
                    <p class="text-sm font-semibold">200+</p>
                    <p class="text-xs text-white/60">Players registered</p>
                </div>
                <div class="text-left text-white/80">
                    <p class="text-sm font-semibold">14 states</p>
                    <p class="text-xs text-white/60">Growing community</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</html>
