<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raycodex</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-black text-white">

    <!-- Navbar -->
    <header id="navbar" class="fixed top-0 w-full z-30 transition">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <h1 class="text-2xl font-extrabold text-white-500">Raycodex</h1>
            <ul class="flex space-x-8 text-gray-200 font-medium">
                <li><a href="#home" class="hover:text-indigo-400">Home</a></li>
                <li><a href="#features" class="hover:text-indigo-400">Features</a></li>
                <li><a href="{{ route('login') }}" class="bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen flex items-center justify-center text-center overflow-hidden">
        <video class="absolute inset-0 w-full h-full object-cover"
            src="{{ asset('videos/bg.mp4') }}"
            autoplay muted loop playsinline>
        </video>
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="relative z-10 max-w-3xl px-6">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6">Manage Projects Smarter</h1>
            <p class="text-lg md:text-xl mb-8 text-gray-300">
                Raycodex helps you stay productive with simplicity, speed, and security.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-indigo-600 px-8 hover:bg-indigo-700 px-6 py-3 rounded-lg font-semibold transition">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 bg-gray-900">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-indigo-400 mb-12">Powerful Features</h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-gray-800 p-8 rounded-2xl shadow-lg hover:scale-105 transition">
                    <div class="text-indigo-400 text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold mb-3">Secure</h3>
                    <p class="text-gray-400">Advanced encryption keeps your data private and safe.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-2xl shadow-lg hover:scale-105 transition">
                    <div class="text-indigo-400 text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-3">Fast</h3>
                    <p class="text-gray-400">Blazing-fast tools to manage and track your projects.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-2xl shadow-lg hover:scale-105 transition">
                    <div class="text-indigo-400 text-4xl mb-4">🎯</div>
                    <h3 class="text-xl font-semibold mb-3">Smart</h3>
                    <p class="text-gray-400">AI-driven recommendations to boost your productivity.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-8 text-center text-gray-500 text-sm">
        © 2025 Raycodex. All Rights Reserved.
    </footer>

    <!-- Navbar Scroll Effect -->
    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-black', 'shadow');
            } else {
                navbar.classList.remove('bg-black', 'shadow');
            }
        });
    </script>

</body>
</html>
