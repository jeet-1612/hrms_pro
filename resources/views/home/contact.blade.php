@extends('layouts.landing')

@section('title', 'Contact Us - HR Pro')

@section('content')
    <section class="hero" style="background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center hero-content">
                    <h1 class="display-4 fw-bold">Contact Us</h1>
                    <p class="lead">We're here to help. Get in touch with our team.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-lg-4 mb-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                                </div>
                                <h4>Office Address</h4>
                                <p class="text-muted">123 Business Street<br>Corporate Tower, 5th Floor<br>Mumbai, Maharashtra 400001</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-phone fa-2x text-white"></i>
                                </div>
                                <h4>Contact Numbers</h4>
                                <p class="text-muted">
                                    <strong>Sales:</strong> +91 98765 43210<br>
                                    <strong>Support:</strong> +91 98765 43211<br>
                                    <strong>Fax:</strong> +91 22 1234 5678
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-envelope fa-2x text-white"></i>
                                </div>
                                <h4>Email Addresses</h4>
                                <p class="text-muted">
                                    <strong>General:</strong> info@hrpro.com<br>
                                    <strong>Support:</strong> support@hrpro.com<br>
                                    <strong>Sales:</strong> sales@hrpro.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-lg" data-aos="fade-up">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4">Send Us a Message</h2>
                            
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
                                        <label class="form-label">Your Name *</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Your Email *</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Subject *</label>
                                    <input type="text" name="subject" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message *</label>
                                    <textarea name="message" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        Send Message <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection