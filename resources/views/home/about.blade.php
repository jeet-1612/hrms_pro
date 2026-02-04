@extends('layouts.landing')

@section('title', 'About Us - HRMS Pro')

@section('content')
    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Left Content -->
                <div class="lg:w-1/2">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                        Revolutionizing <span class="gradient-text">HR Management</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        At HRMS Pro, we're on a mission to simplify human resource management for businesses of all sizes. Our innovative platform combines cutting-edge technology with deep HR expertise.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('contact') }}" class="bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-dark transition">
                            Get in Touch
                        </a>
                        <a href="#story" class="border-2 border-primary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-primary/10 transition">
                            Our Story
                        </a>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div class="lg:w-1/2 mt-12 lg:mt-0 lg:pl-12">
                    <div class="relative">
                        <div class="bg-white rounded-2xl shadow-2xl p-8">
                            <div class="grid grid-cols-2 gap-6">
                                <!-- Team Stats -->
                                <div class="bg-blue-50 rounded-xl p-6 text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">50+</div>
                                    <div class="text-gray-700">Team Members</div>
                                </div>
                                <div class="bg-purple-50 rounded-xl p-6 text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">5+</div>
                                    <div class="text-gray-700">Years Experience</div>
                                </div>
                                <div class="bg-green-50 rounded-xl p-6 text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">500+</div>
                                    <div class="text-gray-700">Happy Clients</div>
                                </div>
                                <div class="bg-yellow-50 rounded-xl p-6 text-center">
                                    <div class="text-4xl font-bold text-primary mb-2">24/7</div>
                                    <div class="text-gray-700">Support</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 bg-primary text-white p-6 rounded-xl shadow-xl">
                            <i class="fas fa-award text-3xl"></i>
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-green-500 text-white p-6 rounded-xl shadow-xl">
                            <i class="fas fa-rocket text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section id="story" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Our <span class="gradient-text">Story</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    From a simple idea to a leading HR management platform
                </p>
            </div>
            
            <!-- Timeline -->
            <div class="max-w-4xl mx-auto">
                <div class="relative">
                    <!-- Timeline line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-primary to-purple-600 hidden md:block"></div>
                    
                    <!-- Timeline items -->
                    @foreach([
                        [
                            'year' => '2019',
                            'title' => 'The Beginning',
                            'description' => 'Founded by HR professionals who saw the need for better HR management tools in the market.',
                            'position' => 'left'
                        ],
                        [
                            'year' => '2020',
                            'title' => 'First Version Launch',
                            'description' => 'Released our first MVP with basic employee management and attendance tracking features.',
                            'position' => 'right'
                        ],
                        [
                            'year' => '2021',
                            'title' => 'Major Update',
                            'description' => 'Added payroll processing, performance management, and mobile applications.',
                            'position' => 'left'
                        ],
                        [
                            'year' => '2022',
                            'title' => 'Enterprise Launch',
                            'description' => 'Launched enterprise version with advanced features and custom solutions.',
                            'position' => 'right'
                        ],
                        [
                            'year' => '2023',
                            'title' => 'Global Expansion',
                            'description' => 'Expanded our services to international markets with multi-language support.',
                            'position' => 'left'
                        ],
                        [
                            'year' => '2024',
                            'title' => 'AI Integration',
                            'description' => 'Integrated AI-powered analytics and predictive insights into our platform.',
                            'position' => 'right'
                        ]
                    ] as $item)
                    <div class="flex flex-col md:flex-row items-center mb-12 {{ $item['position'] == 'right' ? 'md:flex-row-reverse' : '' }}">
                        <!-- Year -->
                        <div class="w-full md:w-1/2 {{ $item['position'] == 'right' ? 'md:pr-12 md:text-right' : 'md:pl-12' }}">
                            <div class="inline-block">
                                <div class="bg-primary text-white text-2xl font-bold px-6 py-3 rounded-lg">
                                    {{ $item['year'] }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timeline dot -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-primary rounded-full border-4 border-white shadow-lg hidden md:block"></div>
                        
                        <!-- Content -->
                        <div class="w-full md:w-1/2 {{ $item['position'] == 'right' ? 'md:pr-12' : 'md:pl-12' }} mt-4 md:mt-0">
                            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $item['title'] }}</h3>
                                <p class="text-gray-600">{{ $item['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Mission -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 mb-6">
                            <i class="fas fa-bullseye text-3xl text-primary"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">
                        To empower organizations with innovative HR technology that simplifies complex processes, enhances employee experience, and drives business growth.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Simplify HR processes for businesses</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Enhance employee engagement and satisfaction</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Provide data-driven insights for better decisions</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Ensure compliance and security</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Vision -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-purple-100 mb-6">
                            <i class="fas fa-eye text-3xl text-purple-600"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">
                        To become the global leader in HR technology solutions, recognized for innovation, reliability, and exceptional customer experience.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Global presence in 50+ countries by 2030</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Serve over 10,000 organizations worldwide</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Pioneer AI-driven HR solutions</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>Set industry standards for HR technology</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Our Core <span class="gradient-text">Values</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    The principles that guide everything we do
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    [
                        'icon' => 'user-shield',
                        'title' => 'Integrity',
                        'description' => 'We believe in doing the right thing, even when no one is watching. Transparency and honesty are at the core of our operations.'
                    ],
                    [
                        'icon' => 'lightbulb',
                        'title' => 'Innovation',
                        'description' => 'We continuously push boundaries to deliver cutting-edge solutions that solve real HR challenges.'
                    ],
                    [
                        'icon' => 'users',
                        'title' => 'Customer Success',
                        'description' => 'Our success is measured by our customers\' success. We go above and beyond to ensure their satisfaction.'
                    ],
                    [
                        'icon' => 'handshake',
                        'title' => 'Collaboration',
                        'description' => 'We believe in the power of teamwork, both within our organization and with our partners and customers.'
                    ],
                    [
                        'icon' => 'rocket',
                        'title' => 'Excellence',
                        'description' => 'We strive for excellence in everything we do, from product development to customer support.'
                    ],
                    [
                        'icon' => 'heart',
                        'title' => 'Passion',
                        'description' => 'We're passionate about transforming HR management and making a positive impact on organizations.'
                    ]
                ] as $value)
                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:shadow-xl transition-shadow">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-primary to-purple-600 mb-6">
                        <i class="fas fa-{{ $value['icon'] }} text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $value['title'] }}</h3>
                    <p class="text-gray-600">{{ $value['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Leadership Team -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Meet Our <span class="gradient-text">Leadership</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    The passionate leaders driving HRMS Pro forward
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    [
                        'name' => 'Rajesh Kumar',
                        'position' => 'CEO & Founder',
                        'image' => 'RK',
                        'color' => 'bg-primary',
                        'bio' => '20+ years in HR technology, previously led HR at Fortune 500 companies.'
                    ],
                    [
                        'name' => 'Priya Sharma',
                        'position' => 'CTO',
                        'image' => 'PS',
                        'color' => 'bg-purple-600',
                        'bio' => 'Tech visionary with expertise in cloud architecture and AI integration.'
                    ],
                    [
                        'name' => 'Amit Patel',
                        'position' => 'Head of Product',
                        'image' => 'AP',
                        'color' => 'bg-green-600',
                        'bio' => 'Product management expert focused on user experience and innovation.'
                    ],
                    [
                        'name' => 'Neha Gupta',
                        'position' => 'Head of Customer Success',
                        'image' => 'NG',
                        'color' => 'bg-pink-600',
                        'bio' => 'Dedicated to ensuring customer satisfaction and building lasting relationships.'
                    ]
                ] as $leader)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-8">
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 rounded-full {{ $leader['color'] }} flex items-center justify-center text-white text-4xl font-bold mb-6">
                                {{ $leader['image'] }}
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $leader['name'] }}</h3>
                            <p class="text-primary font-semibold mb-4">{{ $leader['position'] }}</p>
                            <p class="text-gray-600 text-center">{{ $leader['bio'] }}</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Join Our Growing Community
            </h2>
            <p class="text-xl text-gray-200 mb-10 max-w-3xl mx-auto">
                Be part of the HR revolution. Together, we're shaping the future of work.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-primary px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                        Start Free Trial
                    </a>
                    <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white/10 transition">
                        Contact Our Team
                    </a>
                @endauth
            </div>
        </div>
    </section>
@endsection