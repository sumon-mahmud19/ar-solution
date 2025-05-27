@extends('layouts.app')

@section('content')
   <section class="relative w-full h-screen overflow-hidden">
  <video autoplay muted loop playsinline class="absolute w-full h-full object-cover">
    <source src="https://cdn.pixabay.com/video/2019/05/06/23355-334950213_tiny.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <!-- Blur overlay -->
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

  <!-- Content -->
  <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
    <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Our Website</h1>
    <p class="text-lg md:text-2xl mb-6">We provide powerful solutions with Laravel, Django, and more.</p>
    <a href="#get-started"
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition">
      Get Started
    </a>
  </div>
</section>

@endsection
