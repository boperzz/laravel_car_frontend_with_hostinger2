<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Login')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles / Scripts -->
        @if (app()->environment('local') && file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Tailwind CSS CDN (Production) -->
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                    theme: {
                        extend: {
                            fontFamily: {
                                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                            },
                        },
                    },
                }
            </script>
        @endif

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }
            .gradient-text {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
        </style>

        @stack('styles')
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <!-- Logo/Brand -->
            <div class="mb-8 animate-fade-in-up">
                <div class="flex items-center justify-center">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl p-5 shadow-xl transform hover:scale-105 transition-transform">
                        <i class="fas fa-car text-white text-4xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-extrabold gradient-text mt-6 text-center">Car Maintenance</h1>
                <p class="text-slate-600 dark:text-slate-400 text-center mt-2 text-lg">Service Appointment System</p>
            </div>

            <!-- Auth Card -->
            <div class="w-full sm:max-w-md px-6 py-10 bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-700 animate-fade-in-up">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-slate-600 dark:text-slate-400 text-sm">
                <p>&copy; {{ date('Y') }} Car Maintenance System. All rights reserved.</p>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
