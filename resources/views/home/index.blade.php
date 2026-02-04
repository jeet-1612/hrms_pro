@extends('layouts.landing')

@section('title', 'HR Pro - Complete HR & Payroll Solution')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content fade-in">
                    <h1>Streamline Your HR Operations with AI-Powered Solutions</h1>
                    <p class="lead">Manage employees, track attendance, process payroll, and generate payslips - all in one integrated platform. Boost productivity by 40% with our comprehensive HR management system.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3">
                            <i class="fas fa-rocket me-2"></i> Start Free Trial
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-play-circle me-2"></i> Watch Demo
                        </a>
                    </div>
                    <div class="mt-4">
                        <p class="mb-2"><i class="fas fa-check-circle me-2"></i> Free 14-day trial</p>
                        <p class="mb-2"><i class="fas fa-check-circle me-2"></i> No credit card required</p>
                        <p><i class="fas fa-check-circle me-2"></i> Cancel anytime</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                         alt="HR Dashboard" 
                         class="img-fluid rounded shadow-lg slide-up"
                         style="animation-delay: 0.3s;">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up">
                    <h2 class="display-4 fw-bold text-primary">500+</h2>
                    <p class="text-muted">Companies Trust Us</p>
                </div>
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="display-4 fw-bold text-primary">50K+</h2>
                    <p class="text-muted">Employees Managed</p>
                </div>
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="display-4 fw-bold text-primary">99.9%</h2>
                    <p class="text-muted">Uptime Guarantee</p>
                </div>
                <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="display-4 fw-bold text-primary">24/7</h2>
                    <p class="text-muted">Customer Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Powerful Features for Modern HR Teams</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Everything you need to manage your workforce efficiently and effectively.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Employee Management</h4>
                        <p class="text-muted">Centralize employee records, track personal details, employment history, documents, and more in one secure location.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Digital employee profiles</li>
                            <li><i class="fas fa-check text-success me-2"></i> Document management</li>
                            <li><i class="fas fa-check text-success me-2"></i> Role-based permissions</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4>Attendance Tracking</h4>
                        <p class="text-muted">Automated attendance system with real-time tracking, overtime management, and detailed reporting.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Biometric integration</li>
                            <li><i class="fas fa-check text-success me-2"></i> Shift management</li>
                            <li><i class="fas fa-check text-success me-2"></i> Geo-fencing</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h4>Payroll Processing</h4>
                        <p class="text-muted">Automated payroll calculation, tax compliance, direct deposit, and comprehensive payslip generation.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Auto tax calculation</li>
                            <li><i class="fas fa-check text-success me-2"></i> Multi-country support</li>
                            <li><i class="fas fa-check text-success me-2"></i> Bank integration</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-plane"></i>
                        </div>
                        <h4>Leave Management</h4>
                        <p class="text-muted">Streamlined leave requests, approvals, and tracking with customizable leave policies and balances.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Self-service portal</li>
                            <li><i class="fas fa-check text-success me-2"></i> Approval workflows</li>
                            <li><i class="fas fa-check text-success me-2"></i> Calendar view</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Analytics & Reports</h4>
                        <p class="text-muted">Gain insights with powerful analytics, custom reports, and real-time dashboards for data-driven decisions.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Custom report builder</li>
                            <li><i class="fas fa-check text-success me-2"></i> Export to PDF/Excel</li>
                            <li><i class="fas fa-check text-success me-2"></i> Real-time dashboards</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile App</h4>
                        <p class="text-muted">Access HR features on the go with our mobile app for employees and managers.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> iOS & Android apps</li>
                            <li><i class="fas fa-check text-success me-2"></i> Push notifications</li>
                            <li><i class="fas fa-check text-success me-2"></i> Offline access</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">How It Works</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Get started in three simple steps</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-up">
                    <div class="text-center p-4">
                        <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                            <i class="fas fa-user-plus fa-2x text-white"></i>
                        </div>
                        <h4>1. Sign Up & Import Data</h4>
                        <p>Create your account and import employee data using our templates or API integration.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center p-4">
                        <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                            <i class="fas fa-cogs fa-2x text-white"></i>
                        </div>
                        <h4>2. Configure Settings</h4>
                        <p>Set up your company policies, leave rules, attendance settings, and payroll configurations.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center p-4">
                        <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                            <i class="fas fa-rocket fa-2x text-white"></i>
                        </div>
                        <h4>3. Go Live & Optimize</h4>
                        <p>Launch the system, onboard your team, and start optimizing your HR processes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Simple, Transparent Pricing</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Choose the perfect plan for your business</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h5 class="card-title">Starter</h5>
                                <h2 class="display-4 fw-bold">₹999<span class="fs-6 text-muted">/month</span></h2>
                                <p class="text-muted">For small businesses</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Up to 50 employees</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Basic payroll processing</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Attendance tracking</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Leave management</li>
                                <li class="mb-3"><i class="fas fa-times text-secondary me-2"></i> Advanced analytics</li>
                                <li class="mb-3"><i class="fas fa-times text-secondary me-2"></i> API access</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Get Started</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-primary border-2 shadow-lg h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <span class="badge bg-primary mb-3">Most Popular</span>
                                <h5 class="card-title">Professional</h5>
                                <h2 class="display-4 fw-bold">₹2,499<span class="fs-6 text-muted">/month</span></h2>
                                <p class="text-muted">For growing companies</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Up to 200 employees</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Advanced payroll</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Biometric integration</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Custom reports</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Basic analytics</li>
                                <li class="mb-3"><i class="fas fa-times text-secondary me-2"></i> Full API access</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-primary w-100">Try Free for 14 Days</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h5 class="card-title">Enterprise</h5>
                                <h2 class="display-4 fw-bold">Custom</h2>
                                <p class="text-muted">For large organizations</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Unlimited employees</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Full payroll suite</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> All integrations</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Advanced analytics</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Full API access</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Dedicated support</li>
                            </ul>
                            <a href="#contact" class="btn btn-outline-primary w-100">Contact Sales</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Trusted by Leading Companies</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">See what our customers have to say</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-up">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" class="rounded-circle me-3" width="60" height="60" alt="User">
                                <div>
                                    <h5 class="mb-0">Priya Sharma</h5>
                                    <p class="text-muted mb-0">HR Manager, TechCorp</p>
                                </div>
                            </div>
                            <p class="card-text">"HR Pro reduced our payroll processing time by 70%. The automated system eliminated errors and saved us countless hours."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="60" height="60" alt="User">
                                <div>
                                    <h5 class="mb-0">Rajesh Kumar</h5>
                                    <p class="text-muted mb-0">CEO, StartUpGrid</p>
                                </div>
                            </div>
                            <p class="card-text">"The employee self-service portal empowered our team and reduced HR queries by 60%. Excellent platform!"</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-3" width="60" height="60" alt="User">
                                <div>
                                    <h5 class="mb-0">Anjali Patel</h5>
                                    <p class="text-muted mb-0">Finance Head, RetailChain</p>
                                </div>
                            </div>
                            <p class="card-text">"Comprehensive tax compliance and reporting features. HR Pro made financial audits smooth and stress-free."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="display-6 fw-bold mb-3">Ready to Transform Your HR Operations?</h2>
                    <p class="lead mb-4">Join thousands of companies that trust HR Pro for their HR and payroll needs.</p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3">
                        <i class="fas fa-calendar-check me-2"></i> Start Free Trial
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Get in Touch</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Have questions? We'd love to hear from you.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-lg" data-aos="fade-up">
                        <div class="card-body p-5">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection