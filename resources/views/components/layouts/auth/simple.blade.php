<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-100 dark:bg-zinc-950 antialiased">
        <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <div class="flex flex-col gap-6 bg-white dark:bg-zinc-900 p-10 border border-zinc-200 dark:border-zinc-800 shadow-lg" style="border-radius: 1.5rem;">
                    <!-- Logo en Bedrijfsnaam -->
                    <div class="flex items-center justify-center gap-4 pb-2">
                        <img src="{{ asset('img/Logo6_groot.png') }}" alt="{{ config('app.name') }}" class="h-14 w-auto">
                        <span style="font-size: 1.875rem;" class="font-bold text-zinc-900 dark:text-white">Barocc Intens</span>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
