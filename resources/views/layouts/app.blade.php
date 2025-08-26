<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true, darkMode: false }" 
      x-bind:class="{ 'dark': darkMode }"
      xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="flex h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Mobile overlay -->
    <div 
        x-show="sidebarOpen && window.innerWidth < 1024" 
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
        @click="sidebarOpen = false">
    </div>

    <!-- Sidebar -->
    <aside 
        x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full lg:translate-x-0"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full lg:translate-x-0"
        class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg z-50
               transform lg:static lg:translate-x-0 lg:flex lg:flex-col">
        
        <!-- Logo + Drawer -->
        <div class="flex items-center justify-between px-4 py-3 border-b dark:border-gray-700">
            <span class="text-xl font-bold">MyCodex</span>
            <!-- Close btn for mobile -->
            <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 lg:hidden"
                    @click="sidebarOpen = false">
                ✖
            </button>
            <!-- Close btn for desktop -->
            <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 hidden lg:inline-block"
                    @click="sidebarOpen = false"
                    x-show="sidebarOpen">
                ✖
            </button>
        </div>

        <!-- Sidebar Nav -->
        <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" 
               class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700
               {{ request()->is('dashboard') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
               Dashboard
            </a>
            <a href="{{ route('project.index') }}" 
               class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700
               {{ request()->is('project*') ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
               My Projects
            </a>
            <a href="#" 
               class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
               Settings
            </a>
        </nav>

        <!-- Logout bottom -->
        <div class="p-4 border-t dark:border-gray-700">
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button class="text-red-700 w-full text-left hover:underline">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">

        <!-- AppBar -->
        <header class="flex items-center justify-between bg-white dark:bg-gray-800 px-4 py-3 shadow">
            
            <div class="flex items-center space-x-2">
                <!-- Drawer toggle for Mobile -->
                <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 lg:hidden"
                        @click="sidebarOpen = true">
                    ☰
                </button>

                <!-- Drawer toggle for Desktop -->
                <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 hidden lg:inline-block"
                        x-show="!sidebarOpen"
                        @click="sidebarOpen = true">
                    ☰
                </button>
            </div>

            <span>👋 Welcome, {{ Auth::user()->name ?? 'User' }}</span>

            <div class="flex items-center space-x-1">
                <!-- Dark mode toggle -->
                <button @click="darkMode = !darkMode"
                        class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span x-show="!darkMode">🌙</span>
                    <span x-show="darkMode">☀️</span>
                </button>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
