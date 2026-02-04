@extends('layouts.landing')

@section('title', 'Pricing Plans - HRMS Pro')

@section('content')
    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                Simple, <span class="gradient-text">Transparent</span> Pricing
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10">
                Choose the perfect plan for your organization. All plans include core HR features.
            </p>
            
            <!-- Billing Toggle -->
            <div class="flex justify-center items-center mb-12">
                <span class="text-gray-700 font-medium mr-4">Monthly</span>
                <div class="relative">
                    <input type="checkbox" id="billing-toggle" class="sr-only" checked>
                    <label for="billing-toggle" class="block w-16 h-8 bg-primary rounded-full cursor-pointer">
                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform"></div>
                    </label>
                </div>
                <span class="text-gray-700 font-medium ml-4">Yearly <span class="bg-green-100 text-green-800 text-sm px-2 py-1 rounded-full ml-2">Save 20%</span></span>
            </div>
        </div>
    </section>

    <!-- Pricing Plans -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Starter Plan -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 transform hover:scale-105 transition-transform duration-300">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Starter</h3>
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-gray-900 monthly-price">₹999</span>
                            <span class="text-5xl font-bold text-gray-900 yearly-price hidden">₹799</span>
                            <span class="text-gray-600 monthly-price">/month</span>
                            <span class="text-gray-600 yearly-price hidden">/month</span>
                        </div>
                        <p class="text-gray-600">Perfect for small businesses up to 50 employees</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Up to 50 Employees</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Basic Employee Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Attendance Tracking</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Leave Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-times text-gray-400 mr-3"></i>
                            <span class="text-gray-400">Payroll Processing</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-times text-gray-400 mr-3"></i>
                            <span class="text-gray-400">Performance Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-times text-gray-400 mr-3"></i>
                            <span class="text-gray-400">Mobile App Access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-times text-gray-400 mr-3"></i>
                            <span class="text-gray-400">Dedicated Support</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="block w-full bg-gray-100 text-gray-900 text-center py-4 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Get Started
                    </a>
                </div>
                
                <!-- Professional Plan (Most Popular) -->
                <div class="bg-gradient-to-br from-primary to-purple-600 rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition-transform duration-300 relative">
                    <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 px-4 py-1 rounded-bl-lg rounded-tr-2xl font-bold">
                        MOST POPULAR
                    </div>
                    
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-white mb-4">Professional</h3>
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-white monthly-price">₹2,499</span>
                            <span class="text-5xl font-bold text-white yearly-price hidden">₹1,999</span>
                            <span class="text-blue-100 monthly-price">/month</span>
                            <span class="text-blue-100 yearly-price hidden">/month</span>
                        </div>
                        <p class="text-blue-100">Ideal for growing businesses up to 200 employees</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Up to 200 Employees</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Advanced Employee Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Biometric Integration</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Leave & Attendance</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Payroll Processing</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Performance Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-300 mr-3"></i>
                            <span class="text-white">Mobile App Access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-times text-gray-300 mr-3"></i>
                            <span class="text-gray-300">Dedicated Support</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="block w-full bg-white text-primary text-center py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Get Started
                    </a>
                </div>
                
                <!-- Enterprise Plan -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 transform hover:scale-105 transition-transform duration-300">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Enterprise</h3>
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-gray-900 monthly-price">₹4,999</span>
                            <span class="text-5xl font-bold text-gray-900 yearly-price hidden">₹3,999</span>
                            <span class="text-gray-600 monthly-price">/month</span>
                            <span class="text-gray-600 yearly-price hidden">/month</span>
                        </div>
                        <p class="text-gray-600">For large organizations with custom requirements</p>
                    </div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Unlimited Employees</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Complete Employee Management</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Advanced Biometric Systems</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Full Leave & Attendance Suite</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Advanced Payroll with Tax</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Complete Performance Suite</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Mobile & Web Apps</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>24/7 Dedicated Support</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('contact') }}" class="block w-full bg-primary text-white text-center py-4 rounded-lg font-semibold hover:bg-primary-dark transition">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Feature <span class="gradient-text">Comparison</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    See how our plans compare across all features
                </p>
            </div>
            
            <div class="overflow-x-auto rounded-2xl shadow-lg">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-6 px-8 text-left text-lg font-semibold text-gray-900">Features</th>
                            <th class="py-6 px-8 text-center text-lg font-semibold text-gray-900">Starter</th>
                            <th class="py-6 px-8 text-center text-lg font-semibold text-gray-900">Professional</th>
                            <th class="py-6 px-8 text-center text-lg font-semibold text-gray-900">Enterprise</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach([
                            ['feature' => 'Employee Records', 'starter' => '✓', 'professional' => '✓', 'enterprise' => '✓'],
                            ['feature' => 'Attendance Tracking', 'starter' => 'Basic', 'professional' => 'Advanced', 'enterprise' => 'Premium'],
                            ['feature' => 'Biometric Integration', 'starter' => '✗', 'professional' => '✓', 'enterprise' => '✓'],
                            ['feature' => 'Payroll Processing', 'starter' => '✗', 'professional' => 'Basic', 'enterprise' => 'Advanced'],
                            ['feature' => 'Tax Compliance', 'starter' => '✗', 'professional' => '✓', 'enterprise' => '✓'],
                            ['feature' => 'Leave Management', 'starter' => '✓', 'professional' => '✓', 'enterprise' => '✓'],
                            ['feature' => 'Performance Reviews', 'starter' => '✗', 'professional' => '✓', 'enterprise' => '✓'],
                            ['feature' => 'Mobile App', 'starter' => '✗', 'professional' => '✓', 'enterprise' => '✓'],
                            ['feature' => 'API Access', 'starter' => '✗', 'professional' => 'Limited', 'enterprise' => 'Full'],
                            ['feature' => 'Custom Reports', 'starter' => '✗', 'professional' => '5/month', 'enterprise' => 'Unlimited'],
                            ['feature' => 'Support', 'starter' => 'Email', 'professional' => 'Chat + Email', 'enterprise' => '24/7 Phone'],
                            ['feature' => 'Data Backup', 'starter' => 'Daily', 'professional' => 'Hourly', 'enterprise' => 'Real-time'],
                        ] as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="py-6 px-8 font-medium text-gray-900">{{ $row['feature'] }}</td>
                            <td class="py-6 px-8 text-center">
                                <span class="{{ $row['starter'] == '✓' ? 'text-green-500' : ($row['starter'] == '✗' ? 'text-red-500' : 'text-gray-700') }} font-semibold">
                                    {{ $row['starter'] }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-center">
                                <span class="{{ $row['professional'] == '✓' ? 'text-green-500' : ($row['professional'] == '✗' ? 'text-red-500' : 'text-gray-700') }} font-semibold">
                                    {{ $row['professional'] }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-center">
                                <span class="{{ $row['enterprise'] == '✓' ? 'text-green-500' : ($row['enterprise'] == '✗' ? 'text-red-500' : 'text-gray-700') }} font-semibold">
                                    {{ $row['enterprise'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Frequently Asked <span class="gradient-text">Questions</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Get answers to common questions about our pricing and plans
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                @foreach([
                    [
                        'question' => 'Can I switch plans later?',
                        'answer' => 'Yes, you can upgrade or downgrade your plan at any time. When upgrading, you\'ll be charged the prorated difference. When downgrading, changes take effect at the next billing cycle.'
                    ],
                    [
                        'question' => 'Is there a free trial available?',
                        'answer' => 'Yes! We offer a 14-day free trial for all plans. No credit card required. You can test all features during the trial period.'
                    ],
                    [
                        'question' => 'What payment methods do you accept?',
                        'answer' => 'We accept all major credit/debit cards (Visa, MasterCard, American Express), net banking, UPI, and offer invoice-based billing for enterprise customers.'
                    ],
                    [
                        'question' => 'Are there any setup fees?',
                        'answer' => 'No, there are no setup fees for any of our plans. You only pay the monthly or yearly subscription fee.'
                    ],
                    [
                        'question' => 'Can I cancel my subscription anytime?',
                        'answer' => 'Yes, you can cancel your subscription at any time. If you cancel, you\'ll continue to have access until the end of your billing period.'
                    ],
                    [
                        'question' => 'Do you offer discounts for non-profits?',
                        'answer' => 'Yes, we offer special pricing for registered non-profit organizations and educational institutions. Please contact our sales team for more information.'
                    ]
                ] as $faq)
                <div class="mb-6 border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-center cursor-pointer faq-question">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $faq['question'] }}</h3>
                        <i class="fas fa-chevron-down text-primary transform transition-transform"></i>
                    </div>
                    <div class="faq-answer mt-4 hidden">
                        <p class="text-gray-600">{{ $faq['answer'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Still have questions -->
            <div class="text-center mt-16">
                <p class="text-xl text-gray-700 mb-8">Still have questions? We're here to help!</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-dark transition">
                    <i class="fas fa-headset mr-3"></i> Contact Support
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-xl text-gray-200 mb-10 max-w-3xl mx-auto">
                Join thousands of companies using HRMS Pro to streamline their HR processes
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
                        Schedule a Demo
                    </a>
                @endauth
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Billing toggle functionality
    document.getElementById('billing-toggle').addEventListener('change', function(e) {
        const isYearly = e.target.checked;
        const monthlyPrices = document.querySelectorAll('.monthly-price');
        const yearlyPrices = document.querySelectorAll('.yearly-price');
        const dot = document.querySelector('.dot');
        
        if (isYearly) {
            monthlyPrices.forEach(el => el.style.display = 'none');
            yearlyPrices.forEach(el => el.style.display = 'inline');
            dot.style.transform = 'translateX(32px)';
        } else {
            monthlyPrices.forEach(el => el.style.display = 'inline');
            yearlyPrices.forEach(el => el.style.display = 'none');
            dot.style.transform = 'translateX(0)';
        }
    });
    
    // FAQ accordion
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('i');
            
            // Toggle answer visibility
            answer.classList.toggle('hidden');
            
            // Rotate icon
            if (answer.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
@endpush