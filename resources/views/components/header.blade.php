<!-- Load the main JavaScript (and imported CSS) using Vite -->
@vite(['resources/js/app.js'])
<header class="p-1">
    <div class="header">
        <!-- redirect to home page -->
        <a href="{{ url('/') }}">
            <!-- render logo image -->
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="pt-3">
        </a>
    </div>
</header>