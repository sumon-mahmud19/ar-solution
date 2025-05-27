<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billionaire Life Simulator - Spend $1 Billion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f2f5;
        }
        
        .money-counter {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        .category-btn.active {
            background-color: #4C1D95;
            color: white;
        }
        
        .item-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .purchase-animation {
            position: fixed;
            z-index: 9999;
            animation: fly 1.5s forwards;
            pointer-events: none;
        }
        
        @keyframes fly {
            0% {
                transform: scale(0.5) translateY(0);
                opacity: 1;
            }
            100% {
                transform: scale(1.5) translateY(-100vh);
                opacity: 0;
            }
        }
        
        .purchase-history-item {
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .game-over-popup {
            animation: scaleIn 0.5s;
        }
        
        @keyframes scaleIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        .shine {
            position: relative;
            overflow: hidden;
        }
        
        .shine::after {
            content: '';
            position: absolute;
            top: -110%;
            left: -210%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0) 100%);
            transform: rotate(30deg);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            to {
                top: 100%;
                left: 100%;
            }
        }
        
        /* Hide scrollbar but allow scrolling */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Custom progress bar */
        .custom-progress {
            height: 10px;
            background-color: #E5E7EB;
            border-radius: 5px;
            margin-top: 5px;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 5px;
            background: linear-gradient(90deg, #10B981, #059669);
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen pb-20">
    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-900 to-indigo-800 text-white py-4 px-6 shadow-lg">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-3xl font-bold mb-2 md:mb-0">
                <i class="fas fa-crown text-yellow-300 mr-2"></i>Billionaire Life Simulator
            </h1>
            <div class="money-counter text-2xl md:text-3xl font-bold bg-black bg-opacity-20 px-5 py-2 rounded-lg shine">
                <i class="fas fa-dollar-sign text-yellow-300 mr-1"></i><span id="money-display">1,000,000,000</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <!-- Categories Navigation -->
        <div class="overflow-x-auto hide-scrollbar mb-6">
            <div class="flex space-x-2 pb-2">
                <button class="category-btn active whitespace-nowrap px-5 py-3 bg-purple-700 text-white rounded-lg font-semibold transition-all hover:bg-purple-800" data-category="real-estate">
                    <i class="fas fa-home mr-2"></i>Real Estate
                </button>
                <button class="category-btn whitespace-nowrap px-5 py-3 bg-gray-200 rounded-lg font-semibold transition-all hover:bg-gray-300" data-category="vehicles">
                    <i class="fas fa-car mr-2"></i>Vehicles
                </button>
                <button class="category-btn whitespace-nowrap px-5 py-3 bg-gray-200 rounded-lg font-semibold transition-all hover:bg-gray-300" data-category="aircraft">
                    <i class="fas fa-plane mr-2"></i>Aircraft
                </button>
                <button class="category-btn whitespace-nowrap px-5 py-3 bg-gray-200 rounded-lg font-semibold transition-all hover:bg-gray-300" data-category="yachts">
                    <i class="fas fa-ship mr-2"></i>Yachts
                </button>
                <button class="category-btn whitespace-nowrap px-5 py-3 bg-gray-200 rounded-lg font-semibold transition-all hover:bg-gray-300" data-category="experiences">
                    <i class="fas fa-star mr-2"></i>Experiences
                </button>
                <button class="category-btn whitespace-nowrap px-5 py-3 bg-gray-200 rounded-lg font-semibold transition-all hover:bg-gray-300" data-category="investments">
                    <i class="fas fa-chart-line mr-2"></i>Investments
                </button>
                <button class="category-btn whitespace-nowrap px-5 py-3 bg-gray-200 rounded-lg font-semibold transition-all hover:bg-gray-300" data-category="luxury">
                    <i class="fas fa-gem mr-2"></i>Luxury Items
                </button>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Items Display -->
            <div class="w-full md:w-3/4">
                <!-- Real Estate Category -->
                <div class="category-content" id="real-estate">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-home mr-2 text-purple-700"></i>Real Estate
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Mansion -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1505843513577-22bb7d21e455?auto=format&fit=crop&w=800&q=80" alt="Luxury Mansion" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Luxury Mansion</h3>
                                <p class="text-sm text-gray-600 mb-2">Beverly Hills, California</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$45,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-combined mr-1"></i>15,000 sq ft
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bed mr-1"></i>10 beds
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bath mr-1"></i>12 baths
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Luxury Mansion" data-price="45000000" data-image="https://images.unsplash.com/photo-1505843513577-22bb7d21e455?auto=format&fit=crop&w=800&q=80" data-category="Real Estate">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Penthouse -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80" alt="Luxury Penthouse" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Luxury Penthouse</h3>
                                <p class="text-sm text-gray-600 mb-2">Manhattan, New York</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$28,500,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-combined mr-1"></i>7,500 sq ft
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bed mr-1"></i>5 beds
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bath mr-1"></i>6 baths
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Luxury Penthouse" data-price="28500000" data-image="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80" data-category="Real Estate">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Private Island -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?auto=format&fit=crop&w=800&q=80" alt="Private Island" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Private Island</h3>
                                <p class="text-sm text-gray-600 mb-2">Bahamas</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$95,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-combined mr-1"></i>25 acres
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-home mr-1"></i>2 villas
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-water mr-1"></i>Private beach
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Private Island" data-price="95000000" data-image="https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?auto=format&fit=crop&w=800&q=80" data-category="Real Estate">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Ski Chalet -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1482192505345-5655af888cc4?auto=format&fit=crop&w=800&q=80" alt="Luxury Ski Chalet" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Luxury Ski Chalet</h3>
                                <p class="text-sm text-gray-600 mb-2">Aspen, Colorado</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$18,750,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-combined mr-1"></i>6,500 sq ft
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bed mr-1"></i>7 beds
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-mountain mr-1"></i>Ski-in/out
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Luxury Ski Chalet" data-price="18750000" data-image="https://images.unsplash.com/photo-1482192505345-5655af888cc4?auto=format&fit=crop&w=800&q=80" data-category="Real Estate">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Vineyard Estate -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1543459176-4426b37223ba?auto=format&fit=crop&w=800&q=80" alt="Vineyard Estate" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Vineyard Estate</h3>
                                <p class="text-sm text-gray-600 mb-2">Napa Valley, California</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$32,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-wine-glass mr-1"></i>75 acres
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-home mr-1"></i>Estate home
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-warehouse mr-1"></i>Winery
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Vineyard Estate" data-price="32000000" data-image="https://images.unsplash.com/photo-1543459176-4426b37223ba?auto=format&fit=crop&w=800&q=80" data-category="Real Estate">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vehicles Category (Hidden by Default) -->
                <div class="category-content hidden" id="vehicles">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-car mr-2 text-purple-700"></i>Luxury Vehicles
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Bugatti -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1566638686220-935228458d59?auto=format&fit=crop&w=800&q=80" alt="Bugatti Chiron" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Bugatti Chiron</h3>
                                <p class="text-sm text-gray-600 mb-2">Super Sport 300+</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$3,900,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>1,600 HP
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-road mr-1"></i>300+ mph
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>2.5s 0-60
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Bugatti Chiron" data-price="3900000" data-image="https://images.unsplash.com/photo-1566638686220-935228458d59?auto=format&fit=crop&w=800&q=80" data-category="Vehicles">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Rolls Royce -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80" alt="Rolls-Royce Phantom" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Rolls-Royce Phantom</h3>
                                <p class="text-sm text-gray-600 mb-2">Extended Wheelbase</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$1,100,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>563 HP
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-couch mr-1"></i>Starlight roof
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-wine-glass-alt mr-1"></i>Bar console
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Rolls-Royce Phantom" data-price="1100000" data-image="https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80" data-category="Vehicles">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Lamborghini -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80" alt="Lamborghini Aventador SVJ" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Lamborghini Aventador</h3>
                                <p class="text-sm text-gray-600 mb-2">SVJ Roadster</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$573,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>770 HP
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-road mr-1"></i>217 mph
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>2.9s 0-60
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Lamborghini Aventador" data-price="573000" data-image="https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80" data-category="Vehicles">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Ferrari -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&w=800&q=80" alt="Ferrari SF90 Stradale" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Ferrari SF90 Stradale</h3>
                                <p class="text-sm text-gray-600 mb-2">Hybrid Supercar</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$625,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>986 HP
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bolt mr-1"></i>Hybrid
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>2.5s 0-60
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Ferrari SF90 Stradale" data-price="625000" data-image="https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&w=800&q=80" data-category="Vehicles">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Motorcycle -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1558981852-426c6c22a060?auto=format&fit=crop&w=800&q=80" alt="Ducati Superleggera V4" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Ducati Superleggera V4</h3>
                                <p class="text-sm text-gray-600 mb-2">Limited Edition</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$100,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>234 HP
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-weight-hanging mr-1"></i>350 lbs
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-trophy mr-1"></i>Limited
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Ducati Superleggera V4" data-price="100000" data-image="https://images.unsplash.com/photo-1558981852-426c6c22a060?auto=format&fit=crop&w=800&q=80" data-category="Vehicles">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aircraft Category (Hidden by Default) -->
                <div class="category-content hidden" id="aircraft">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-plane mr-2 text-purple-700"></i>Private Aircraft
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Private Jet -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=800&q=80" alt="Gulfstream G650" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Gulfstream G650</h3>
                                <p class="text-sm text-gray-600 mb-2">Ultra Long-Range Jet</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$65,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>Up to 19 pax
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-globe-americas mr-1"></i>7,000 nm range
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>Mach 0.925
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Gulfstream G650" data-price="65000000" data-image="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=800&q=80" data-category="Aircraft">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Helicopter -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1507812984078-917a274065be?auto=format&fit=crop&w=800&q=80" alt="Airbus ACH160" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Airbus ACH160</h3>
                                <p class="text-sm text-gray-600 mb-2">Luxury Helicopter</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$14,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>8 passengers
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-horizontal mr-1"></i>460 nm range
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-tachometer-alt mr-1"></i>155 knots
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Airbus ACH160" data-price="14000000" data-image="https://images.unsplash.com/photo-1507812984078-917a274065be?auto=format&fit=crop&w=800&q=80" data-category="Aircraft">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- BBJ -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1558366361-2b5e4589b701?auto=format&fit=crop&w=800&q=80" alt="Boeing Business Jet" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Boeing Business Jet</h3>
                                <p class="text-sm text-gray-600 mb-2">BBJ 787 Dreamliner</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$200,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>40 passengers
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-bed mr-1"></i>Master suite
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-globe-americas mr-1"></i>Global range
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Boeing Business Jet" data-price="200000000" data-image="https://images.unsplash.com/photo-1558366361-2b5e4589b701?auto=format&fit=crop&w=800&q=80" data-category="Aircraft">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Yachts Category (Hidden by Default) -->
                <div class="category-content hidden" id="yachts">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-ship mr-2 text-purple-700"></i>Luxury Yachts
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Superyacht -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?auto=format&fit=crop&w=800&q=80" alt="Superyacht Eclipse" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Superyacht "Azure"</h3>
                                <p class="text-sm text-gray-600 mb-2">Custom Built, 120m</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$275,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-horizontal mr-1"></i>120 meters
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>36 guests
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-helicopter mr-1"></i>Helipad
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Superyacht Azure" data-price="275000000" data-image="https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?auto=format&fit=crop&w=800&q=80" data-category="Yachts">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Sailing Yacht -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1605281317010-fe5ffe798166?auto=format&fit=crop&w=800&q=80" alt="Luxury Sailing Yacht" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Sailing Yacht "Windseeker"</h3>
                                <p class="text-sm text-gray-600 mb-2">Custom Sloop, 75m</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$85,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-horizontal mr-1"></i>75 meters
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>12 guests
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-water mr-1"></i>Beach club
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Sailing Yacht Windseeker" data-price="85000000" data-image="https://images.unsplash.com/photo-1605281317010-fe5ffe798166?auto=format&fit=crop&w=800&q=80" data-category="Yachts">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Explorer Yacht -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1599678510013-ca0911d8e97e?auto=format&fit=crop&w=800&q=80" alt="Explorer Yacht" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Explorer Yacht "Discovery"</h3>
                                <p class="text-sm text-gray-600 mb-2">Ice-class, 95m</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$145,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-ruler-horizontal mr-1"></i>95 meters
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-globe-americas mr-1"></i>Global range
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-submarine mr-1"></i>Submarine
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Explorer Yacht Discovery" data-price="145000000" data-image="https://images.unsplash.com/photo-1599678510013-ca0911d8e97e?auto=format&fit=crop&w=800&q=80" data-category="Yachts">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Experiences Category (Hidden by Default) -->
                <div class="category-content hidden" id="experiences">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-star mr-2 text-purple-700"></i>Luxury Experiences
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Space Flight -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?auto=format&fit=crop&w=800&q=80" alt="Private Space Flight" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Private Space Flight</h3>
                                <p class="text-sm text-gray-600 mb-2">Orbital Experience</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$55,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-rocket mr-1"></i>10 days
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-space-shuttle mr-1"></i>Space station
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-astronaut mr-1"></i>Full training
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Private Space Flight" data-price="55000000" data-image="https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?auto=format&fit=crop&w=800&q=80" data-category="Experiences">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- World Tour -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80" alt="Private Jet World Tour" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Ultimate World Tour</h3>
                                <p class="text-sm text-gray-600 mb-2">1-Year, Private Jet</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$6,500,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-globe-americas mr-1"></i>50+ countries
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-plane mr-1"></i>Private transport
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-concierge-bell mr-1"></i>Personal staff
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Ultimate World Tour" data-price="6500000" data-image="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80" data-category="Experiences">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Private Concert -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&w=800&q=80" alt="Private Concert" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Private Superstar Concert</h3>
                                <p class="text-sm text-gray-600 mb-2">Your Choice of Artist</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$5,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-music mr-1"></i>A-list artist
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>100 guests
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-champagne-glasses mr-1"></i>Catering
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Private Superstar Concert" data-price="5000000" data-image="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&w=800&q=80" data-category="Experiences">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Investments Category (Hidden by Default) -->
                <div class="category-content hidden" id="investments">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-purple-700"></i>Investments
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Sports Team -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80" alt="Professional Sports Team" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Professional Sports Team</h3>
                                <p class="text-sm text-gray-600 mb-2">Premier League Club</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$750,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-futbol mr-1"></i>Full ownership
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-trophy mr-1"></i>League status
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-building mr-1"></i>Stadium
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Professional Sports Team" data-price="750000000" data-image="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80" data-category="Investments">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Tech Startup -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80" alt="Tech Startup Investment" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Tech Unicorn Investment</h3>
                                <p class="text-sm text-gray-600 mb-2">AI Technology</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$50,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-chart-line mr-1"></i>High growth
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-microchip mr-1"></i>AI technology
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-percentage mr-1"></i>10% equity
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Tech Unicorn Investment" data-price="50000000" data-image="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80" data-category="Investments">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Art Collection -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1531913764164-f85c52d7e6a9?auto=format&fit=crop&w=800&q=80" alt="Fine Art Collection" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Fine Art Collection</h3>
                                <p class="text-sm text-gray-600 mb-2">Modern Masters</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$120,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-paint-brush mr-1"></i>15 masterpieces
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-palette mr-1"></i>Rare works
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-chart-line mr-1"></i>Appreciating
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Fine Art Collection" data-price="120000000" data-image="https://images.unsplash.com/photo-1531913764164-f85c52d7e6a9?auto=format&fit=crop&w=800&q=80" data-category="Investments">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Luxury Items Category (Hidden by Default) -->
                <div class="category-content hidden" id="luxury">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-gem mr-2 text-purple-700"></i>Luxury Items
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Diamond -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80" alt="Rare Pink Diamond" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Rare Pink Diamond</h3>
                                <p class="text-sm text-gray-600 mb-2">Flawless, 15 carats</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$48,000,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-gem mr-1"></i>15 carats
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-certificate mr-1"></i>Flawless
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-star mr-1"></i>Extremely rare
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Rare Pink Diamond" data-price="48000000" data-image="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80" data-category="Luxury Items">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Watch -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1526045612212-70caf35c14df?auto=format&fit=crop&w=800&q=80" alt="Limited Edition Watch" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Patek Philippe Grand Complication</h3>
                                <p class="text-sm text-gray-600 mb-2">Limited Edition, Platinum</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$2,900,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>Handcrafted
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-trophy mr-1"></i>Limited
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-cog mr-1"></i>24 complications
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Patek Philippe Grand Complication" data-price="2900000" data-image="https://images.unsplash.com/photo-1526045612212-70caf35c14df?auto=format&fit=crop&w=800&q=80" data-category="Luxury Items">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                        
                        <!-- Wine Collection -->
                        <div class="item-card bg-white rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?auto=format&fit=crop&w=800&q=80" alt="Rare Wine Collection" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-xl mb-1">Rare Wine Collection</h3>
                                <p class="text-sm text-gray-600 mb-2">Vintage Cellar</p>
                                <p class="font-bold text-green-600 text-lg mb-2">$4,500,000</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-wine-bottle mr-1"></i>500+ bottles
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-calendar-alt mr-1"></i>Rare vintages
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-warehouse mr-1"></i>Custom cellar
                                    </div>
                                </div>
                                <button class="buy-btn mt-4 w-full bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg transition-colors font-semibold" data-name="Rare Wine Collection" data-price="4500000" data-image="https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?auto=format&fit=crop&w=800&q=80" data-category="Luxury Items">
                                    <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Purchase History Sidebar -->
            <div class="w-full md:w-1/4 bg-white rounded-xl shadow-lg p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Shopping History</h3>
                    <div class="text-sm font-semibold text-purple-700">
                        <span id="item-count">0</span> Items
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium">Money Spent:</span>
                        <span id="money-spent" class="font-semibold">$0</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="font-medium">Money Left:</span>
                        <span id="money-left" class="font-semibold">$1,000,000,000</span>
                    </div>
                    <div class="custom-progress mt-2">
                        <div id="progress-bar" class="progress-fill" style="width: 0%;"></div>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-4">
                    <div id="purchase-history" class="max-h-[600px] overflow-y-auto hide-scrollbar">
                        <div class="text-gray-500 text-center text-sm py-8">
                            Your purchases will appear here
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Game Over Modal (Hidden by default) -->
    <div id="game-over-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="game-over-popup bg-white rounded-xl shadow-2xl p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-purple-800">Game Over!</h2>
                <p class="text-xl text-gray-600 mt-2">You spent your entire billion!</p>
            </div>
            
            <div class="mb-6">
                <h3 class="text-xl font-bold mb-3 text-gray-800">Your Billionaire Shopping Summary:</h3>
                <div class="flex justify-between text-lg mb-2">
                    <span class="font-medium">Items Purchased:</span>
                    <span id="final-item-count" class="font-semibold">0</span>
                </div>
                <div class="flex justify-between text-lg mb-2">
                    <span class="font-medium">Money Spent:</span>
                    <span id="final-money-spent" class="font-semibold">$1,000,000,000</span>
                </div>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-bold mb-3 text-gray-800">Categories Breakdown:</h3>
                <div id="categories-breakdown" class="space-y-3"></div>
            </div>
            
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-3 text-gray-800">All Purchases:</h3>
                <div id="final-purchases" class="grid grid-cols-1 gap-3"></div>
            </div>
            
            <div class="flex justify-center">
                <button id="play-again-btn" class="bg-purple-700 hover:bg-purple-800 text-white py-3 px-6 rounded-lg transition-colors font-bold text-lg">
                    <i class="fas fa-redo-alt mr-2"></i>Play Again
                </button>
            </div>
        </div>
    </div>

    <script>
        // Game state
        let money = 1000000000; // $1 billion
        let purchases = [];
        let categoryTotals = {};
        
        // DOM elements
        const moneyDisplay = document.getElementById('money-display');
        const purchaseHistory = document.getElementById('purchase-history');
        const progressBar = document.getElementById('progress-bar');
        const itemCountElem = document.getElementById('item-count');
        const moneySpentElem = document.getElementById('money-spent');
        const moneyLeftElem = document.getElementById('money-left');
        const gameOverModal = document.getElementById('game-over-modal');
        const finalItemCount = document.getElementById('final-item-count');
        const finalMoneySpent = document.getElementById('final-money-spent');
        const finalPurchases = document.getElementById('final-purchases');
        const categoriesBreakdown = document.getElementById('categories-breakdown');
        const playAgainBtn = document.getElementById('play-again-btn');
        
        // Format money as currency
        function formatMoney(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        }
        
        // Update money display
        function updateMoneyDisplay() {
            moneyDisplay.textContent = formatMoney(money).replace('$', '');
            
            // Calculate money spent
            const spent = 1000000000 - money;
            moneySpentElem.textContent = formatMoney(spent);
            moneyLeftElem.textContent = formatMoney(money);
            
            // Update progress bar
            const percentage = (spent / 1000000000) * 100;
            progressBar.style.width = `${percentage}%`;
            
            // Update item count
            itemCountElem.textContent = purchases.length;
        }
        
        // Add purchase
        function addPurchase(name, price, image, category) {
            if (money >= price) {
                // Create purchase object
                const purchase = {
                    name,
                    price,
                    image,
                    category,
                    date: new Date()
                };
                
                // Add to purchases array
                purchases.push(purchase);
                
                // Update category totals
                if (categoryTotals[category]) {
                    categoryTotals[category].amount += price;
                    categoryTotals[category].count += 1;
                } else {
                    categoryTotals[category] = {
                        amount: price,
                        count: 1
                    };
                }
                
                // Deduct money
                money -= price;
                updateMoneyDisplay();
                
                // Add to purchase history
                addPurchaseToHistory(purchase);
                
                // Show purchase animation
                showPurchaseAnimation(image);
                
                // Check for game over
                if (money <= 0) {
                    setTimeout(showGameOver, 1500);
                }
                
                return true;
            }
            
            return false;
        }
        
        // Add purchase to history
        function addPurchaseToHistory(purchase) {
            // Remove the "no purchases" message if it exists
            if (purchaseHistory.querySelector('.text-gray-500')) {
                purchaseHistory.innerHTML = '';
            }
            
            // Create purchase item element
            const purchaseEl = document.createElement('div');
            purchaseEl.className = 'purchase-history-item flex items-center p-2 border-b border-gray-100';
            purchaseEl.innerHTML = `
                <div class="flex-shrink-0 w-12 h-12 rounded-md overflow-hidden mr-3">
                    <img src="${purchase.image}" alt="${purchase.name}" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h4 class="text-sm font-semibold">${purchase.name}</h4>
                    <p class="text-xs text-green-600 font-bold">${formatMoney(purchase.price)}</p>
                </div>
            `;
            
            // Add to history (at the top)
            purchaseHistory.insertBefore(purchaseEl, purchaseHistory.firstChild);
        }
        
        // Show purchase animation
        function showPurchaseAnimation(image) {
            const animation = document.createElement('div');
            animation.className = 'purchase-animation';
            animation.innerHTML = `
                <div class="bg-white rounded-full p-2 shadow-lg">
                    <img src="${image}" class="w-16 h-16 rounded-full object-cover" alt="Purchase">
                </div>
            `;
            
            // Position at bottom center
            animation.style.bottom = '20px';
            animation.style.left = '50%';
            animation.style.transform = 'translateX(-50%)';
            
            // Add to body
            document.body.appendChild(animation);
            
            // Remove after animation
            setTimeout(() => {
                document.body.removeChild(animation);
            }, 1500);
        }
        
        // Show game over screen
        function showGameOver() {
            // Update final stats
            finalItemCount.textContent = purchases.length;
            finalMoneySpent.textContent = formatMoney(1000000000);
            
            // Clear previous content
            categoriesBreakdown.innerHTML = '';
            finalPurchases.innerHTML = '';
            
            // Categories breakdown
            const categories = Object.keys(categoryTotals);
            categories.sort((a, b) => categoryTotals[b].amount - categoryTotals[a].amount);
            
            categories.forEach(category => {
                const total = categoryTotals[category];
                const percent = ((total.amount / 1000000000) * 100).toFixed(1);
                
                const categoryEl = document.createElement('div');
                categoryEl.className = 'mb-2';
                categoryEl.innerHTML = `
                    <div class="flex justify-between mb-1">
                        <span class="font-medium">${category}</span>
                        <span class="font-semibold">${formatMoney(total.amount)} <span class="text-sm text-gray-500">(${percent}%)</span></span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full">
                        <div class="h-full bg-purple-600 rounded-full" style="width: ${percent}%"></div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        ${total.count} item${total.count !== 1 ? 's' : ''} purchased
                    </div>
                `;
                
                categoriesBreakdown.appendChild(categoryEl);
            });
            
            // All purchases
            purchases.forEach(purchase => {
                const purchaseEl = document.createElement('div');
                purchaseEl.className = 'flex items-center bg-gray-50 p-3 rounded-lg';
                purchaseEl.innerHTML = `
                    <div class="flex-shrink-0 w-16 h-16 rounded-md overflow-hidden mr-3">
                        <img src="${purchase.image}" alt="${purchase.name}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-semibold">${purchase.name}</h4>
                        <p class="text-sm text-gray-600">${purchase.category}</p>
                        <p class="text-green-600 font-bold">${formatMoney(purchase.price)}</p>
                    </div>
                `;
                
                finalPurchases.appendChild(purchaseEl);
            });
            
            // Show modal
            gameOverModal.classList.remove('hidden');
        }
        
        // Play again
        function playAgain() {
            // Reset game state
            money = 1000000000;
            purchases = [];
            categoryTotals = {};
            
            // Reset UI
            updateMoneyDisplay();
            purchaseHistory.innerHTML = `
                <div class="text-gray-500 text-center text-sm py-8">
                    Your purchases will appear here
                </div>
            `;
            
            // Hide modal
            gameOverModal.classList.add('hidden');
        }
        
        // Initialize the game
        function init() {
            // Set up click handlers for buy buttons
            document.addEventListener('click', function(event) {
                // Buy buttons
                if (event.target.closest('.buy-btn')) {
                    const btn = event.target.closest('.buy-btn');
                    const name = btn.dataset.name;
                    const price = parseInt(btn.dataset.price, 10);
                    const image = btn.dataset.image;
                    const category = btn.dataset.category;
                    
                    const success = addPurchase(name, price, image, category);
                    
                    if (!success) {
                        // Shake button if not enough money
                        btn.classList.add('animate-shake');
                        setTimeout(() => {
                            btn.classList.remove('animate-shake');
                        }, 500);
                        
                        // Maybe show a message
                        alert("You don't have enough money for this purchase!");
                    }
                }
                
                // Category buttons
                if (event.target.closest('.category-btn')) {
                    const btn = event.target.closest('.category-btn');
                    const category = btn.dataset.category;
                    
                    // Remove active class from all buttons
                    document.querySelectorAll('.category-btn').forEach(el => {
                        el.classList.remove('active');
                        el.classList.add('bg-gray-200');
                        el.classList.remove('bg-purple-700');
                        el.classList.remove('text-white');
                    });
                    
                    // Add active class to clicked button
                    btn.classList.add('active');
                    btn.classList.remove('bg-gray-200');
                    btn.classList.add('bg-purple-700');
                    btn.classList.add('text-white');
                    
                    // Hide all category content
                    document.querySelectorAll('.category-content').forEach(el => {
                        el.classList.add('hidden');
                    });
                    
                    // Show selected category content
                    document.getElementById(category).classList.remove('hidden');
                }
            });
            
            // Play again button
            playAgainBtn.addEventListener('click', playAgain);
            
            // Initial money display
            updateMoneyDisplay();
        }
        
        // Start the game when DOM is loaded
        document.addEventListener('DOMContentLoaded', init);
    </script>
</body>
</html>
