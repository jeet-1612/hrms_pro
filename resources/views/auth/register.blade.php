@extends('layouts.landing')

@section('title', 'Create Account - HR Pro')

@section('styles')
<style>
    /* Main Container */
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    /* Card Styling */
    .register-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }
    
    /* Left Side - Visual Appeal */
    .register-visual {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 40px;
        position: relative;
        overflow: hidden;
        min-height: 600px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .register-visual::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
        background-size: cover;
    }
    
    .visual-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
        position: relative;
        z-index: 2;
    }
    
    .visual-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 40px;
        line-height: 1.6;
        position: relative;
        z-index: 2;
    }
    
    /* Feature List */
    .visual-features {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
        z-index: 2;
    }
    
    .visual-features li {
        padding: 12px 0;
        font-size: 1rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .visual-features li:last-child {
        border-bottom: none;
    }
    
    .visual-features i {
        width: 24px;
        height: 24px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    /* Right Side - Form */
    .register-form {
        padding: 60px 50px;
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .form-header h2 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .form-header p {
        color: #7f8c8d;
        font-size: 1rem;
    }
    
    /* Form Groups */
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 0.95rem;
        display: block;
    }
    
    .form-control {
        border: 2px solid #e8e8e8;
        border-radius: 12px;
        padding: 14px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .form-control:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }
    
    .form-control.is-invalid {
        border-color: #e74c3c;
    }
    
    /* Password Input Container */
    .password-container {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #7f8c8d;
        cursor: pointer;
        padding: 5px;
        transition: color 0.3s;
    }
    
    .password-toggle:hover {
        color: #667eea;
    }
    
    /* Checkbox Styling */
    .form-check {
        padding-left: 35px;
        margin-bottom: 20px;
    }
    
    .form-check-input {
        width: 20px;
        height: 20px;
        margin-left: -35px;
        margin-top: 2px;
        border: 2px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    
    .form-check-label {
        color: #555;
        font-size: 0.95rem;
        cursor: pointer;
        line-height: 1.5;
    }
    
    .form-check-label a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }
    
    .form-check-label a:hover {
        text-decoration: underline;
    }
    
    /* Submit Button */
    .btn-register {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 16px;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }
    
    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-register:active {
        transform: translateY(-1px);
    }
    
    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        margin: 30px 0;
        color: #95a5a6;
    }
    
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #ecf0f1;
    }
    
    .divider-text {
        padding: 0 20px;
        font-size: 0.9rem;
    }
    
    /* Social Buttons */
    .social-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .btn-social {
        flex: 1;
        padding: 12px;
        border: 2px solid #e8e8e8;
        border-radius: 12px;
        background: white;
        color: #555;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-social:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .btn-google:hover {
        border-color: #DB4437;
        color: #DB4437;
    }
    
    .btn-microsoft:hover {
        border-color: #00A4EF;
        color: #00A4EF;
    }
    
    /* Login Link */
    .login-link {
        text-align: center;
        margin-top: 25px;
        color: #7f8c8d;
        font-size: 0.95rem;
    }
    
    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        margin-left: 5px;
        transition: color 0.3s;
    }
    
    .login-link a:hover {
        color: #764ba2;
        text-decoration: underline;
    }
    
    /* Error Messages */
    .error-message {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }
    
    /* Password Strength Indicator */
    .password-strength {
        margin-top: 8px;
    }
    
    .strength-bar {
        height: 4px;
        background: #ecf0f1;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 5px;
    }
    
    .strength-fill {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }
    
    .strength-text {
        font-size: 0.8rem;
        color: #95a5a6;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .register-visual {
            min-height: auto;
            padding: 40px 30px;
        }
        
        .register-form {
            padding: 40px 30px;
        }
        
        .visual-title {
            font-size: 2.2rem;
        }
    }
    
    @media (max-width: 768px) {
        .register-container {
            padding: 40px 0;
        }
        
        .register-card {
            border-radius: 15px;
        }
        
        .social-buttons {
            flex-direction: column;
        }
        
        .visual-features li {
            font-size: 0.95rem;
        }
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-up {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="register-card">
                    <div class="row g-0">
                        <!-- Left Side - Visual Section -->
                        <div class="col-lg-6">
                            <div class="register-visual">
                                <div class="animate-up">
                                    <h1 class="visual-title">Join Our HR Community</h1>
                                    <p class="visual-subtitle">
                                        Streamline your HR operations with our powerful platform. 
                                        Join thousands of companies managing their workforce efficiently.
                                    </p>
                                </div>
                                
                                <ul class="visual-features">
                                    <li class="animate-up delay-1">
                                        <i class="fas fa-user-check"></i>
                                        <span>Manage unlimited employees with ease</span>
                                    </li>
                                    <li class="animate-up delay-2">
                                        <i class="fas fa-chart-line"></i>
                                        <span>Real-time analytics and reporting</span>
                                    </li>
                                    <li class="animate-up delay-3">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <span>Automated payroll processing</span>
                                    </li>
                                    <li class="animate-up delay-4">
                                        <i class="fas fa-mobile-alt"></i>
                                        <span>Mobile app for on-the-go access</span>
                                    </li>
                                    <li class="animate-up delay-1">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Enterprise-grade security & compliance</span>
                                    </li>
                                    <li class="animate-up delay-2">
                                        <i class="fas fa-headset"></i>
                                        <span>24/7 dedicated support team</span>
                                    </li>
                                </ul>
                                
                                <div class="mt-5 pt-4 animate-up delay-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="rounded-circle bg-white p-3 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-award text-primary fa-2x"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-4">
                                            <h5 class="mb-1">Trusted by 500+ Companies</h5>
                                            <p class="small mb-0 opacity-75">From startups to enterprises</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side - Registration Form -->
                        <div class="col-lg-6">
                            <div class="register-form">
                                <div class="form-header animate-up">
                                    <a href="{{ route('home') }}" class="text-decoration-none">
                                        <h2 class="fw-bold text-primary mb-2">
                                            <i class="fas fa-chart-line me-2"></i>HR<span class="text-secondary">Pro</span>
                                        </h2>
                                    </a>
                                    <p>Create your account in 30 seconds</p>
                                </div>
                                
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show animate-up" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-3"></i>
                                            <div>
                                                <strong>Please fix the following:</strong>
                                                <ul class="mb-0 mt-2">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                                
                                <form method="POST" action="{{ route('register') }}" id="registerForm">
                                    @csrf
                                    
                                    <!-- Name Field -->
                                    <div class="form-group animate-up delay-1">
                                        <label for="name" class="form-label">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0">
                                                <i class="fas fa-user text-muted"></i>
                                            </span>
                                            <input id="name" type="text" 
                                                   class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                                   name="name" 
                                                   value="{{ old('name') }}" 
                                                   required 
                                                   autocomplete="name" 
                                                   autofocus
                                                   placeholder="John Doe">
                                        </div>
                                        @error('name')
                                            <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Email Field -->
                                    <div class="form-group animate-up delay-2">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0">
                                                <i class="fas fa-envelope text-muted"></i>
                                            </span>
                                            <input id="email" type="email" 
                                                   class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                                   name="email" 
                                                   value="{{ old('email') }}" 
                                                   required 
                                                   autocomplete="email"
                                                   placeholder="john@example.com">
                                        </div>
                                        @error('email')
                                            <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Password Field -->
                                    <div class="form-group animate-up delay-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="password-container">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input id="password" type="password" 
                                                       class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                                       name="password" 
                                                       required 
                                                       autocomplete="new-password"
                                                       placeholder="••••••••"
                                                       oninput="updatePasswordStrength(this.value)">
                                            </div>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength">
                                            <div class="strength-bar">
                                                <div class="strength-fill" id="strengthFill"></div>
                                            </div>
                                            <div class="strength-text" id="strengthText">Password strength</div>
                                        </div>
                                        @error('password')
                                            <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Confirm Password -->
                                    <div class="form-group animate-up delay-4">
                                        <label for="password-confirm" class="form-label">Confirm Password</label>
                                        <div class="password-container">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input id="password-confirm" type="password" 
                                                       class="form-control border-start-0" 
                                                       name="password_confirmation" 
                                                       required 
                                                       autocomplete="new-password"
                                                       placeholder="••••••••">
                                            </div>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Terms Checkbox -->
                                    <div class="form-group animate-up delay-1">
                                        <div class="form-check">
                                            <input class="form-check-input @error('terms') is-invalid @enderror" 
                                                   type="checkbox" 
                                                   name="terms" 
                                                   id="terms" 
                                                   {{ old('terms') ? 'checked' : '' }}
                                                   required>
                                            <label class="form-check-label" for="terms">
                                                I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                                            </label>
                                            @error('terms')
                                                <span class="error-message d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="newsletter" 
                                                   id="newsletter"
                                                   {{ old('newsletter') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="newsletter">
                                                Send me product updates, tips, and offers (optional)
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    <div class="form-group animate-up delay-2">
                                        <button type="submit" class="btn-register">
                                            <i class="fas fa-user-plus me-2"></i> Create Account
                                        </button>
                                    </div>
                                    
                                    <!-- Divider -->
                                    <div class="divider animate-up delay-3">
                                        <span class="divider-text">Or sign up with</span>
                                    </div>
                                    
                                    <!-- Social Buttons -->
                                    <div class="social-buttons animate-up delay-4">
                                        <button type="button" class="btn-social btn-google">
                                            <i class="fab fa-google"></i>
                                            <span>Google</span>
                                        </button>
                                        <button type="button" class="btn-social btn-microsoft">
                                            <i class="fab fa-microsoft"></i>
                                            <span>Microsoft</span>
                                        </button>
                                    </div>
                                    
                                    <!-- Login Link -->
                                    <div class="login-link animate-up delay-1">
                                        Already have an account?
                                        <a href="{{ route('login') }}">Sign in here</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Security Footer -->
                <div class="text-center mt-4 animate-up">
                    <p class="text-muted small">
                        <i class="fas fa-shield-alt text-success me-1"></i> 
                        <strong>Secure Registration:</strong> All your data is encrypted and protected
                        <span class="mx-2">•</span>
                        <i class="fas fa-bolt text-warning me-1"></i> 
                        Free 14-day trial
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock text-info me-1"></i> 
                        Setup in 5 minutes
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Password Toggle
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.parentElement.querySelector('.password-toggle i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    // Password Strength Checker
    function updatePasswordStrength(password) {
        let strength = 0;
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        
        // Length check
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        
        // Complexity checks
        if (/[A-Z]/.test(password)) strength++; // Uppercase
        if (/[a-z]/.test(password)) strength++; // Lowercase
        if (/[0-9]/.test(password)) strength++; // Numbers
        if (/[^A-Za-z0-9]/.test(password)) strength++; // Special chars
        
        // Update visual indicator
        const percentage = (strength / 6) * 100;
        strengthFill.style.width = percentage + '%';
        
        // Update color and text
        if (strength <= 2) {
            strengthFill.style.background = '#e74c3c';
            strengthText.textContent = 'Weak password';
            strengthText.style.color = '#e74c3c';
        } else if (strength <= 4) {
            strengthFill.style.background = '#f39c12';
            strengthText.textContent = 'Good password';
            strengthText.style.color = '#f39c12';
        } else {
            strengthFill.style.background = '#2ecc71';
            strengthText.textContent = 'Strong password';
            strengthText.style.color = '#2ecc71';
        }
    }
    
    // Form Validation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;
        const terms = document.getElementById('terms').checked;
        
        // Password match validation
        if (password !== confirmPassword) {
            e.preventDefault();
            showToast('Passwords do not match!', 'error');
            document.getElementById('password-confirm').focus();
            return false;
        }
        
        // Terms validation
        if (!terms) {
            e.preventDefault();
            showToast('Please agree to the Terms of Service', 'error');
            return false;
        }
        
        // Password strength validation
        if (password.length < 8) {
            e.preventDefault();
            showToast('Password must be at least 8 characters long', 'error');
            return false;
        }
    });
    
    // Toast notification function
    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast-alert toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'error' ? '#e74c3c' : '#2ecc71'};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'} me-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Add CSS for toast animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
    
    // Real-time password match indicator
    const confirmPasswordField = document.getElementById('password-confirm');
    const passwordField = document.getElementById('password');
    
    confirmPasswordField.addEventListener('input', function() {
        const password = passwordField.value;
        const confirmPassword = this.value;
        
        if (confirmPassword === '') return;
        
        if (password === confirmPassword) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    });
    
    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-up');
        animatedElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 * (index + 1));
        });
    });
</script>
@endsection