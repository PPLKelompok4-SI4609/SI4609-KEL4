<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue - Post-Flood Cleaning Services</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/logo.svg') }}" alt="FloodRescue Logo">
            <span>FloodRescue</span>
        </div>
        <div class="nav-links">
            <a href="#" class="active">Home</a>
            <a href="#services">Services</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>Professional Post-Flood Cleaning Service for Your Home</h1>
            <p>Restoring homes and businesses after flood damage with expert care and precision</p>
            <a href="#services" class="cta-button">Take Our Service</a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="about-content">
            <h2>Best Cleaning Services Provider Since 2001</h2>
            <ul class="features">
                <li>✓ Licensed with Professional and Honest Cleaners</li>
                <li>✓ Provide the Finest Cleaning Supplies</li>
                <li>✓ 100% Satisfaction Cleaning Service</li>
                <li>✓ We are Bonded and Insured</li>
            </ul>
            <div class="experience">
                <span class="years">20+</span>
                <span class="text">Years Experience</span>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <h2>We Offer Different Services to Clean Your Area</h2>
        <div class="services-grid">
            <div class="service-card">
                <img src="{{ asset('assets/icons/house.svg') }}" alt="House Cleaning">
                <h3>House Cleaning</h3>
                <p>Professional flood damage restoration for residential properties</p>
            </div>
            <div class="service-card">
                <img src="{{ asset('assets/icons/office.svg') }}" alt="Office Cleaning">
                <h3>Office Cleaning</h3>
                <p>Commercial flood cleanup and restoration services</p>
            </div>
            <div class="service-card">
                <img src="{{ asset('assets/icons/furniture.svg') }}" alt="Furniture Cleaning">
                <h3>Furniture Cleaning</h3>
                <p>Specialized cleaning for flood-damaged furniture</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <h2>Contact Us</h2>
        <p>Get in touch for immediate flood cleanup assistance</p>
        <div class="contact-info">
            <p>📞 Emergency Hotline: (123) 456-7890</p>
            <p>📧 Email: info@floodrescue.com</p>
        </div>
    </section>
</body>
</html>