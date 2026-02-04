@extends('layouts.landing')

@section('title', 'Features - HR Pro')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center hero-content">
                    <h1 class="display-4 fw-bold">Powerful Features for Modern HR Teams</h1>
                    <p class="lead">Discover all the tools you need to manage your workforce efficiently.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Features -->
    <section class="py-5">
        <div class="container">
            <!-- Employee Management -->
            <div class="row align-items-center mb-5" data-aos="fade-up">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1551836026-d5c2c5af78e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                         alt="Employee Management" 
                         class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Complete Employee Management</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Centralized Database:</strong> Store all employee information in one secure location</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Document Management:</strong> Upload and manage employee documents digitally</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Onboarding Workflows:</strong> Streamline new hire processes</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Offboarding:</strong> Manage exit processes and documentation</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Organization Chart:</strong> Visualize your company structure</li>
                    </ul>
                </div>
            </div>

            <!-- Payroll Features -->
            <div class="row align-items-center mb-5" data-aos="fade-up">
                <div class="col-lg-6 order-lg-2">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                         alt="Payroll Processing" 
                         class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2 class="fw-bold mb-3">Automated Payroll Processing</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Auto Calculation:</strong> Automatic salary, tax, and deduction calculations</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Tax Compliance:</strong> Stay compliant with latest tax regulations</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Direct Deposit:</strong> Seamless bank transfers</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Payslip Generation:</strong> Professional PDF payslips</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> <strong>Year-end Reports:</strong> Form 16, tax summaries, and more</li>
                    </ul>
                </div>
            </div>

            <!-- More features can be added similarly -->
        </div>
    </section>

    <!-- Feature Comparison -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3">Feature Comparison</h2>
                </div>
            </div>
            
            <div class="table-responsive" data-aos="fade-up">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Feature</th>
                            <th>Starter</th>
                            <th>Professional</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Employee Management</td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                        </tr>
                        <tr>
                            <td>Payroll Processing</td>
                            <td>Basic</td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                        </tr>
                        <!-- Add more rows -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection