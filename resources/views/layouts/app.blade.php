<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JIDS Nepal - Empowering Udayapur since 1995')</title>
    <meta name="description" content="@yield('description', 'Join us in making a positive impact on communities around the world.')">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Effects CSS -->
    <link href="{{ asset('css/effects.css') }}" rel="stylesheet">
    
    <style>
        :root {
            @php($siteColors = \App\Models\Setting::colors())
            --primary-color: {{ $siteColors['primary_color'] ?? '#2c3e50' }};
            --secondary-color: {{ $siteColors['secondary_color'] ?? '#e74c3c' }};
            --accent-color: {{ $siteColors['accent_color'] ?? '#f39c12' }};
            --success-color: {{ $siteColors['success_color'] ?? '#27ae60' }};
            --light-bg: {{ $siteColors['light_bg'] ?? '#f8f9fa' }};
            --dark-bg: {{ $siteColors['dark_bg'] ?? '#2c3e50' }};
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Smooth scroll with reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Top Header Bar */
        .top-header {
            background: var(--secondary-color);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
        }

        .top-header .contact-info {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .top-header .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: white;
            text-decoration: none;
        }

        .top-header .contact-item:hover {
            color: #f0f0f0;
        }

        .top-header .social-links {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 15px;
        }

        .top-header .social-links a {
            color: white;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 14px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.1);
        }

        .top-header .social-links a:hover {
            background: rgba(255,255,255,0.25);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        /* Enhanced alignment for top header right section */
        .top-header .col-md-4 .d-flex {
            align-items: center !important;
            height: 100%;
            min-height: 40px;
        }

        .top-header .contact-item {
            white-space: nowrap;
            font-size: 0.85rem;
        }

        /* Top Header Mobile Responsiveness - Hide on mobile */
        @media (max-width: 991px) {
            .top-header {
                display: none;
            }
        }

        /* Professional Left Drawer Menu Styles */
        .drawer-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .drawer-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .drawer-menu {
            position: fixed;
            top: 0;
            left: -320px;
            width: 320px;
            height: 100%;
            background: white;
            z-index: 9999;
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.2);
            transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .drawer-menu.show {
            left: 0;
        }

        .drawer-header {
            background: linear-gradient(135deg, var(--secondary-color), #d73527);
            color: white;
            padding: 25px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .drawer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .drawer-logo-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary-color);
            font-size: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .drawer-brand-text {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .drawer-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .drawer-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .drawer-nav {
            padding: 15px 0;
        }

        .drawer-nav-item {
            border-bottom: 1px solid #f0f0f0;
        }

        .drawer-nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .drawer-nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--secondary-color);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .drawer-nav-link:hover,
        .drawer-nav-link.active {
            background: rgba(231, 76, 60, 0.05);
            color: var(--secondary-color);
            padding-left: 28px;
        }

        .drawer-nav-link:hover::before,
        .drawer-nav-link.active::before {
            transform: scaleY(1);
        }

        .drawer-nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .drawer-nav-text {
            flex: 1;
        }

        .drawer-dropdown-toggle {
            background: none;
            border: none;
            color: #999;
            font-size: 12px;
            cursor: pointer;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .drawer-dropdown-toggle i {
            transition: transform 0.3s ease;
        }

        .drawer-dropdown-toggle.open i {
            transform: rotate(180deg);
        }

        .drawer-submenu {
            max-height: 0;
            overflow: hidden;
            background: #f8f9fa;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .drawer-submenu.show {
            max-height: 500px;
        }

        .drawer-submenu a {
            display: block;
            padding: 12px 20px 12px 60px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .drawer-submenu a::before {
            content: '•';
            position: absolute;
            left: 45px;
            color: var(--secondary-color);
            font-size: 20px;
        }

        .drawer-submenu a:hover {
            background: rgba(231, 76, 60, 0.08);
            color: var(--secondary-color);
            padding-left: 65px;
        }

        .drawer-footer {
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            margin-top: auto;
        }

        .drawer-contact-info {
            margin-bottom: 15px;
        }

        .drawer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 13px;
            color: #666;
        }

        .drawer-contact-item i {
            color: var(--secondary-color);
            width: 18px;
            text-align: center;
        }

        .drawer-social-links {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .drawer-social-link {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: white;
            border: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .drawer-social-link:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        /* Hamburger Menu Button */
        .hamburger-btn {
            display: none;
            flex-direction: column;
            justify-content: space-around;
            width: 32px;
            height: 26px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .hamburger-btn:hover {
            transform: scale(1.1);
        }

        .hamburger-line {
            width: 100%;
            height: 3px;
            background: #333;
            border-radius: 3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        .hamburger-btn.active .hamburger-line:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }

        .hamburger-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: translateX(-20px);
        }

        .hamburger-btn.active .hamburger-line:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }

        .main-header.scrolled .hamburger-line {
            background: #333;
        }

        /* Desktop Navigation Improvements */
        @media (min-width: 992px) {
            .hamburger-btn {
                display: none !important;
            }
            
            .drawer-overlay,
            .drawer-menu {
                display: none;
            }
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .hamburger-btn {
                display: flex;
            }

            .main-nav {
                display: none !important;
            }

            .mobile-toggle {
                display: none !important;
            }
        }

        @media (max-width: 480px) {
            .drawer-menu {
                width: 280px;
                left: -280px;
            }

            .drawer-brand-text {
                font-size: 1.2rem;
            }

            .drawer-logo-icon {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
        }

        /* Main Navigation with Enhanced Sticky Functionality */
        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease, padding 0.3s ease;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid transparent;
            will-change: box-shadow, background, padding;
        }

        @media (max-width: 768px) {
            .main-header {
                padding: 18px 0;
            }
        }

        @media (max-width: 480px) {
            .main-header {
                padding: 16px 0;
            }
        }
        
        .main-header .row {
            align-items: center;
        }

        .main-header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 
                0 4px 20px rgba(0,0,0,0.15),
                0 1px 3px rgba(0,0,0,0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        /* Removed transform to prevent layout shift */
        .main-header.scrolled .logo-section {
            /* No changes needed */
        }

        .main-header.scrolled .logo-text {
            /* Keep same size to prevent layout shift */
        }

        /* Professional scroll indicator */
        .main-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
            transition: width 0.3s ease;
        }

        .main-header.scrolled::after {
            width: 100%;
        }

        /* Enhanced mobile toggle for sticky header */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: #333;
            font-size: 1.2rem;
            padding: 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: rgba(0,0,0,0.1);
            transform: scale(1.1);
        }

        .main-header.scrolled .mobile-toggle {
            font-size: 1.1rem;
        }

        /* Optimized Back to Top Button - Instant Response */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, var(--secondary-color), #d73527);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px) scale(0.9);
            transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            will-change: transform, opacity;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            transition: all 0.15s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .back-to-top:hover {
            background: linear-gradient(135deg, #d73527, var(--secondary-color));
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
            transition: all 0.1s ease-out;
        }

        .back-to-top:active {
            transform: translateY(0) scale(0.95);
            transition: all 0.05s ease;
        }

        .back-to-top i {
            transition: transform 0.15s ease;
            will-change: transform;
        }

        .back-to-top:hover i {
            transform: translateY(-1px);
        }

        /* Optimized pulse animation for attention */
        .back-to-top.pulse {
            animation: fastPulse 1.5s ease-in-out infinite;
        }

        @keyframes fastPulse {
            0% {
                transform: scale(1);
                box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3), 0 0 0 0 rgba(231, 76, 60, 0.4);
            }
            50% {
                transform: scale(1.02);
                box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4), 0 0 0 10px rgba(231, 76, 60, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3), 0 0 0 0 rgba(231, 76, 60, 0);
            }
        }

        /* Optimized progress indicator */
        .back-to-top::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: conic-gradient(from 0deg, var(--secondary-color), transparent, transparent);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.15s ease;
            z-index: -1;
        }

        .back-to-top.show::before {
            opacity: 0.5;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.1rem;
            }
        }

        /* Accessibility enhancements */
        .back-to-top:focus {
            outline: 3px solid rgba(231, 76, 60, 0.5);
            outline-offset: 2px;
        }

        /* Smooth scroll indicator */
        .back-to-top .progress-ring {
            position: absolute;
            top: -2px;
            left: -2px;
            width: 59px;
            height: 59px;
            transform: rotate(-90deg);
        }

        .back-to-top .progress-ring circle {
            fill: none;
            stroke: rgba(255, 255, 255, 0.3);
            stroke-width: 2;
            stroke-dasharray: 176;
            stroke-dashoffset: 176;
            transition: stroke-dashoffset 0.1s ease;
        }

        /* Toast Notification System */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            pointer-events: none;
        }

        .toast-notification {
            display: flex;
            align-items: center;
            min-width: 350px;
            max-width: 400px;
            padding: 16px 20px;
            margin-bottom: 12px;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            font-size: 14px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            pointer-events: auto;
            transform: translateX(400px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .toast-notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-notification.hide {
            transform: translateX(400px);
            opacity: 0;
        }

        .toast-notification.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
            border-color: rgba(16, 185, 129, 0.4);
        }

        .toast-notification.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(220, 38, 38, 0.95));
            border-color: rgba(239, 68, 68, 0.4);
        }

        .toast-notification.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95), rgba(217, 119, 6, 0.95));
            border-color: rgba(245, 158, 11, 0.4);
        }

        .toast-notification.info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(37, 99, 235, 0.95));
            border-color: rgba(59, 130, 246, 0.4);
        }

        .toast-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            margin-right: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 2px;
            font-size: 14px;
        }

        .toast-message {
            font-weight: 400;
            opacity: 0.9;
            font-size: 13px;
            line-height: 1.4;
        }

        .toast-close {
            width: 20px;
            height: 20px;
            margin-left: 12px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.7;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .toast-close:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.1);
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 0 0 12px 12px;
            transform-origin: left;
            animation: toastProgress 5s linear forwards;
        }

        @keyframes toastProgress {
            from { transform: scaleX(1); }
            to { transform: scaleX(0); }
        }

        @media (max-width: 768px) {
            .toast-container {
                top: 10px;
                right: 10px;
                left: 10px;
            }

            .toast-notification {
                min-width: auto;
                max-width: none;
                width: 100%;
            }
        }

        .logo-section {
            display: flex;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-header.scrolled .logo-circle {
            width: 50px;
            height: 50px;
        }

        .logo-text {
            color: #e01e27;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            line-height: 1.2;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: -0.5px;
        }

        @media (max-width: 768px) {
            .logo-text {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .logo-text {
                font-size: 1.3rem;
            }
        }

        .logo-tagline {
            color: #666;
            font-size: 0.85rem;
            margin: 0;
            font-style: italic;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Logo link hover effects */
        .logo-section a {
            text-decoration: none;
            color: inherit;
            display: block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-section a:hover {
            transform: translateY(-2px);
        }

        .logo-section a:hover .logo-text {
            color: var(--primary-color);
        }

        .logo-section a:hover .logo-tagline {
            color: var(--primary-color);
            opacity: 0.8;
        }

        .main-nav {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 5px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-nav li {
            position: relative;
            display: flex;
            align-items: center;
        }

        .main-nav > li > a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            padding: 12px 18px;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            font-size: 15px;
        }
        
        .main-nav a {
            color: #333;
            text-decoration: none;
        }

        .main-nav > li > a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .main-nav > li > a:hover::before {
            left: 100%;
        }

        .main-header.scrolled .main-nav > li > a {
            padding: 10px 14px;
            font-size: 14px;
        }

        .main-nav > li > a:hover,
        .main-nav > li > a.active {
            background: var(--secondary-color);
            color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        /* Prevent layout shift on hover by using outline instead of border */
        .main-nav > li > a {
            outline: 2px solid transparent;
            outline-offset: -2px;
        }
        
        .main-nav > li > a:hover {
            outline-color: transparent;
        }

        .main-nav .dropdown {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .main-nav .dropdown::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background: transparent;
        }

        .main-nav .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 1px);
            left: 0;
            background: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-radius: 0 0 8px 8px;
            padding: 8px 0;
            min-width: 200px;
            z-index: 1000;
            margin-top: 0;
            border: 1px solid #e9ecef;
            border-top: none;
        }

        .main-nav .dropdown:hover .dropdown-menu {
            display: block;
        }

        .main-nav .dropdown-menu a {
            padding: 10px 20px;
            color: #333;
            border-radius: 0;
            font-weight: 500;
            font-size: 14px;
            display: block;
            transition: all 0.2s ease;
        }

        .main-nav .dropdown-menu a:hover {
            background: #f8f9fa;
            color: var(--secondary-color);
            padding-left: 25px;
        }

        /* Mobile Navigation */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--secondary-color);
            font-size: 1.5rem;
        }

        @media (max-width: 991px) {
            .mobile-toggle {
                display: block;
            }
            
            .main-nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                padding: 20px;
                gap: 10px;
            }
            
            .main-nav.show {
                display: flex;
            }
            
            .top-header .contact-info {
                justify-content: center;
                text-align: center;
            }
        }

        /* Hero Section */
        .hero-section {
            min-height: calc(100vh - 120px); /* Account for header height */
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 60px 0;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: calc(100vh - 100px);
                padding: 40px 0;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                min-height: calc(100vh - 80px);
                padding: 30px 0;
            }
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.3s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button Styles */
        .btn-primary {
            background: var(--accent-color);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #e67e22;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
            text-decoration: none;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-left: 1rem;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .btn-primary,
            .btn-secondary {
                padding: 10px 24px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .btn-primary,
            .btn-secondary {
                padding: 8px 20px;
                font-size: 13px;
                width: 100%;
                text-align: center;
                margin-left: 0;
                margin-top: 0.5rem;
            }
        }

        /* Section Styles */
        .section-padding {
            padding: 80px 0;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: 60px 0;
            }
        }

        @media (max-width: 480px) {
            .section-padding {
                padding: 40px 0;
            }
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--primary-color);
            position: relative;
            animation: fadeInDown 0.8s ease;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--accent-color);
        }

        /* Card Styles */
        .custom-card {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .custom-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        @media (max-width: 768px) {
            .custom-card:hover {
                transform: translateY(-5px);
            }
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        @media (max-width: 480px) {
            .card-img-top {
                height: 180px;
            }
        }

        .custom-card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Stats Section */
        .stats-section {
            background: var(--primary-color);
            color: white;
            padding: 60px 0;
        }

        @media (max-width: 768px) {
            .stats-section {
                padding: 40px 0;
            }
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            animation: fadeInUp 0.8s ease;
        }

        @media (max-width: 480px) {
            .stat-item {
                padding: 15px 10px;
            }
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-color);
            transition: transform 0.3s ease;
        }

        @media (max-width: 768px) {
            .stat-number {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .stat-number {
                font-size: 2rem;
            }
        }

        .stat-item:hover .stat-number {
            transform: scale(1.1);
        }

        .stat-label {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .stat-label {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .stat-label {
                font-size: 0.9rem;
            }
        }

        /* Modern Professional Footer with Clean Single Color */
        .modern-footer {
            background: #f2f4f7;
            position: relative;
            overflow: hidden;
            border-top: 1px solid #e2e8f0;
            color: #334155;
        }

        .modern-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.5);
            pointer-events: none;
        }

        .modern-footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: #cbd5e1;
            z-index: 3;
        }

        @keyframes gentleGlow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .footer-main {
            /* Reduced overall height */
            padding: 48px 0 20px;
            position: relative;
            z-index: 2;
            background: transparent;
            margin: 0 20px;
        }

        .footer-main::before {
            display: none;
        }

        .footer-brand {
            margin-bottom: 30px;
        }

        .footer-logo {
            display: inline-flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e293b;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .footer-logo:hover {
            color: #059669;
            text-decoration: none;
        }

        .footer-logo i {
            width: 45px;
            height: 45px;
            background: #dc2626;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }

        .footer-description {
            color: #64748b;
            font-size: 15px;
            line-height: 1.55;
            margin-bottom: 18px; /* tighter spacing */
            max-width: 100%; /* allow full column width to reduce line wraps */
        }

        .footer-section-title {
            color: #1e293b;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px; /* tighter spacing */
            position: relative;
            padding-bottom: 10px;
        }

        .footer-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #059669;
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
        }

        .footer-links a:hover {
            color: #059669;
            transform: translateX(8px);
            text-decoration: none;
        }

        .footer-links a i {
            width: 18px;
            margin-right: 10px;
            color: #64748b;
            transition: color 0.3s ease;
        }

        .footer-links a:hover i {
            color: #10b981;
        }

        .contact-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-info li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 14px; /* tighter spacing */
            color: #64748b;
            font-size: 15px;
            line-height: 1.5;
        }

        .contact-info li i {
            width: 20px;
            height: 20px;
            background: rgba(5, 150, 105, 0.1);
            color: #059669;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            margin-top: 2px;
            flex-shrink: 0;
            font-size: 12px;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-link:hover {
            background: #059669;
            border-color: #059669;
            color: white;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
            text-decoration: none;
        }

        .footer-bottom {
            padding: 18px 0; /* reduced height */
            background: white;
            border-top: 1px solid #e2e8f0;
            position: relative;
            z-index: 2;
            margin: 0 20px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .footer-bottom::before {
            display: none;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .copyright, .developer-credit {
            color: #64748b;
            font-size: 15px;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .developer-link {
            color: #059669;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            margin-left: 5px;
        }

        .developer-link:hover {
            color: #047857;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .developer-link:before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: #059669;
            transition: width 0.3s ease;
        }

        .developer-link:hover:before {
            width: 100%;
        }

        .copyright i {
            color: #dc2626;
            margin: 0 8px;
            animation: heartbeat 2s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 50%, 100% { transform: scale(1); }
            25%, 75% { transform: scale(1.1); }
        }

        .footer-badges {
            display: flex;
            gap: 15px;
        }

        .footer-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .footer-badge:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        .footer-badge i {
            margin-right: 8px;
            font-size: 12px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-main {
                padding: 36px 0 16px; /* tighter on mobile */
            }
            
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
            }
            
            .social-links {
                justify-content: center;
            }
            
            .footer-badges {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        /* Hero Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.75rem;
            }
            
            .hero-subtitle {
                font-size: 0.95rem;
            }
        }

        /* Loading Animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top: 3px solid var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form Styles */
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
            outline: none;
        }

        @media (max-width: 480px) {
            .form-control {
                padding: 10px 12px;
                font-size: 14px;
            }
        }

        .donation-amount-btn {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 10px 20px;
            border-radius: 25px;
            margin: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .donation-amount-btn:hover,
        .donation-amount-btn.active {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }

        @media (max-width: 480px) {
            .donation-amount-btn {
                padding: 8px 16px;
                font-size: 14px;
                margin: 3px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Loading Screen -->
    <div class="loading" id="loading">
        <div class="spinner"></div>
    </div>

    <!-- Drawer Overlay -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

    <!-- Professional Left Drawer Menu -->
    <div class="drawer-menu" id="drawerMenu">
        <div class="drawer-header">
            <div class="drawer-brand">
                <div class="drawer-logo-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2 class="drawer-brand-text">JIDS Nepal</h2>
            </div>
            <button class="drawer-close" onclick="closeDrawer()" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="drawer-nav">
            <div class="drawer-nav-item">
                <a href="{{ route('home') }}" class="drawer-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="drawer-nav-text">Home</span>
                </a>
            </div>

            <div class="drawer-nav-item">
                <div class="drawer-nav-link" onclick="toggleDrawerSubmenu(this)">
                    <i class="fas fa-users"></i>
                    <span class="drawer-nav-text">About Us</span>
                    <button class="drawer-dropdown-toggle" type="button">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="drawer-submenu">
                    <a href="{{ route('about') }}">About JIDS Nepal</a>
                    <a href="{{ route('team') }}">Our Team</a>
                </div>
            </div>

            <div class="drawer-nav-item">
                <div class="drawer-nav-link" onclick="toggleDrawerSubmenu(this)">
                    <i class="fas fa-handshake"></i>
                    <span class="drawer-nav-text">What We Do?</span>
                    <button class="drawer-dropdown-toggle" type="button">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="drawer-submenu">
                    <a href="{{ route('impact-areas.index') }}">Thematic Areas</a>
                    <a href="{{ route('projects.ongoing') }}">Ongoing Projects</a>
                    <a href="{{ route('projects.completed') }}">Completed Projects</a>
                </div>
            </div>

            <div class="drawer-nav-item">
                <div class="drawer-nav-link" onclick="toggleDrawerSubmenu(this)">
                    <i class="fas fa-book"></i>
                    <span class="drawer-nav-text">Publication</span>
                    <button class="drawer-dropdown-toggle" type="button">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="drawer-submenu">
                    <a href="{{ route('impact-stories.index') }}">Impact Story</a>
                    <a href="{{ route('reports.index') }}">Reports</a>
                    <a href="{{ route('notices.index') }}">Notices</a>
                    <a href="{{ route('acts-policy.index') }}">Acts/Policy</a>
                </div>
            </div>

            <div class="drawer-nav-item">
                <div class="drawer-nav-link" onclick="toggleDrawerSubmenu(this)">
                    <i class="fas fa-images"></i>
                    <span class="drawer-nav-text">Gallery</span>
                    <button class="drawer-dropdown-toggle" type="button">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="drawer-submenu">
                    <a href="{{ route('gallery.photos') }}">Photos</a>
                    <a href="{{ route('gallery.videos') }}">Videos</a>
                </div>
            </div>

            <div class="drawer-nav-item">
                <div class="drawer-nav-link" onclick="toggleDrawerSubmenu(this)">
                    <i class="fas fa-briefcase"></i>
                    <span class="drawer-nav-text">Careers</span>
                    <button class="drawer-dropdown-toggle" type="button">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="drawer-submenu">
                    <a href="{{ route('careers.vacancy') }}">Vacancy</a>
                </div>
            </div>

            <div class="drawer-nav-item">
                <a href="{{ route('contact') }}" class="drawer-nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span class="drawer-nav-text">Contact Us</span>
                </a>
            </div>
        </nav>

        <div class="drawer-footer">
            <div class="drawer-contact-info">
                <div class="drawer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+977 035-420928</span>
                </div>
                <div class="drawer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>info@jidsnepal.org.np</span>
                </div>
                <div class="drawer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Udayapur, Nepal</span>
                </div>
            </div>
            <div class="drawer-social-links">
                <a href="#" class="drawer-social-link" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="drawer-social-link" title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="drawer-social-link" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="drawer-social-link" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Top Header Bar -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="contact-info">
                        <a href="tel:+977035420928" class="contact-item">
                            <i class="fas fa-phone"></i>
                            +977 035-420928
                        </a>
                        <a href="mailto:info@jidsnepal.org.np" class="contact-item">
                            <i class="fas fa-envelope"></i>
                            info@jidsnepal.org.np
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-md-4">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Hamburger Menu for Mobile -->
                        <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleDrawer()" aria-label="Open menu" type="button">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                        
                        <div class="logo-section">
                            <div>
                                <a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">
                                    <h1 class="logo-text">JIDS Nepal</h1>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-8">
                    <div class="d-flex justify-content-end align-items-center">
                        <button class="mobile-toggle" type="button" onclick="toggleMobileNav()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <nav>
                            <ul class="main-nav" id="mainNav">
                                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                                <li class="dropdown">
                                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about*') || request()->routeIs('team') ? 'active' : '' }}">
                                        About Us <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('team') }}">Our Team</a>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="{{ request()->routeIs('impact-areas*') || request()->routeIs('projects*') ? 'active' : '' }}">
                                        What We Do? <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('impact-areas.index') }}">Thematic Areas</a>
                                        <a href="{{ route('projects.ongoing') }}">Ongoing Projects</a>
                                        <a href="{{ route('projects.completed') }}">Completed Projects</a>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="{{ request()->routeIs('publications*') || request()->routeIs('impact-stories*') || request()->routeIs('notices*') || request()->routeIs('acts-policy*') ? 'active' : '' }}">
                                        Publication <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('impact-stories.index') }}">Impact Story</a>
                                        <a href="{{ route('reports.index') }}">Reports</a>
                                        <a href="{{ route('notices.index') }}">Notices</a>
                                        <a href="{{ route('acts-policy.index') }}">Acts/Policy</a>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="{{ request()->routeIs('gallery*') ? 'active' : '' }}">
                                        Gallery <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('gallery.photos') }}">Photos</a>
                                        <a href="{{ route('gallery.videos') }}">Videos</a>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="{{ request()->routeIs('careers*') ? 'active' : '' }}">
                                        Careers <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('careers.vacancy') }}">Vacancy</a>
                                    </div>
                                </li>
                                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact*') ? 'active' : '' }}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Modern Professional Footer -->
    <footer class="modern-footer">
        <div class="footer-main">
            <div class="container">
                <div class="row g-4">
                    <!-- Brand Section -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand">
                            <a href="{{ route('home') }}" class="footer-logo">
                                <i class="fas fa-heart"></i>
                                JIDS Nepal
                            </a>
                            <p class="footer-description">
                                Since 1995, JIDS Nepal has partnered with communities in Udayapur to improve lives through education, health, WASH, environmental conservation, and livelihoods—building a healthy, prosperous, and self‑reliant society.
                            </p>
                            <div class="social-links">
                                <a href="#" class="social-link" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-link" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-link" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-link" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
            <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6">
                        <h6 class="footer-section-title">Explore</h6>
                        <ul class="footer-links">
                <li><a href="{{ route('about') }}"><i class="fas fa-users"></i>About Us</a></li>
                <li><a href="{{ route('team') }}"><i class="fas fa-user-friends"></i>Our Team</a></li>
                <li><a href="{{ route('projects.index') }}"><i class="fas fa-diagram-project"></i>Projects</a></li>
                <li><a href="{{ route('reports.index') }}"><i class="fas fa-file-alt"></i>Reports</a></li>
                <li><a href="{{ route('notices.index') }}"><i class="fas fa-bullhorn"></i>Notices</a></li>
                        </ul>
                    </div>
                    
            <!-- Get Involved -->
                    <div class="col-lg-2 col-md-6">
                        <h6 class="footer-section-title">Take Action</h6>
                        <ul class="footer-links">
                            {{-- Volunteer removed --}}
                            <li><a href="{{ route('contact', ['type' => 'partnership']) }}"><i class="fas fa-handshake"></i>Partner With Us</a></li>
                            <li><a href="{{ route('contact', ['type' => 'media']) }}"><i class="fas fa-bullhorn"></i>Media Enquiries</a></li>
                            <li><a href="{{ route('contact', ['type' => 'support']) }}"><i class="fas fa-life-ring"></i>Support Request</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i>Contact Us</a></li>
                        </ul>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="col-lg-4 col-md-6">
                        <h6 class="footer-section-title">Get in Touch</h6>
                        <ul class="contact-info">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>Headquarters</strong><br>
                                    Triyuga Municipality - 11, Sangam Tole, Pragati Marg<br>
                                    Udayapur, Nepal
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>Phone</strong><br>
                                    +977 035-420928
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <strong>Email</strong><br>
                                    info@jidsnepal.org.np
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p class="copyright">
                        &copy; {{ date('Y') }} JIDS Nepal. All rights reserved. 
                    </p>
                    <p class="developer-credit">
                        Developed by: <a href="https://anayainfotech.com.np/" target="_blank" class="developer-link">Anaya Infotech</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom Effects JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <script>
        // Toast Notification System
        class ToastManager {
            constructor() {
                this.container = document.getElementById('toastContainer');
                this.toasts = [];
            }

            show(options = {}) {
                const {
                    type = 'info',
                    title = '',
                    message = '',
                    duration = 5000,
                    autoClose = true
                } = options;

                const toast = this.createToast(type, title, message, duration, autoClose);
                this.container.appendChild(toast);
                this.toasts.push(toast);

                // Trigger show animation
                requestAnimationFrame(() => {
                    toast.classList.add('show');
                });

                // Auto close if enabled
                if (autoClose && duration > 0) {
                    setTimeout(() => {
                        this.hide(toast);
                    }, duration);
                }

                return toast;
            }

            createToast(type, title, message, duration, autoClose) {
                const toast = document.createElement('div');
                toast.className = `toast-notification ${type}`;

                // Get appropriate icon
                const iconMap = {
                    success: 'fas fa-check-circle',
                    error: 'fas fa-exclamation-circle',
                    warning: 'fas fa-exclamation-triangle',
                    info: 'fas fa-info-circle'
                };

                toast.innerHTML = `
                    <div class="toast-icon">
                        <i class="${iconMap[type] || iconMap.info}"></i>
                    </div>
                    <div class="toast-content">
                        ${title ? `<div class="toast-title">${title}</div>` : ''}
                        <div class="toast-message">${message}</div>
                    </div>
                    <button class="toast-close" onclick="toastManager.hide(this.parentElement)">
                        <i class="fas fa-times"></i>
                    </button>
                    ${autoClose && duration > 0 ? '<div class="toast-progress"></div>' : ''}
                `;

                // Add click to close functionality
                toast.addEventListener('click', (e) => {
                    if (!e.target.closest('.toast-close')) {
                        this.hide(toast);
                    }
                });

                return toast;
            }

            hide(toast) {
                if (!toast) return;

                toast.classList.remove('show');
                toast.classList.add('hide');

                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.parentElement.removeChild(toast);
                    }
                    
                    // Remove from array
                    const index = this.toasts.indexOf(toast);
                    if (index > -1) {
                        this.toasts.splice(index, 1);
                    }
                }, 400);
            }

            // Predefined methods for different types
            success(title, message, duration = 5000) {
                return this.show({ type: 'success', title, message, duration });
            }

            error(title, message, duration = 7000) {
                return this.show({ type: 'error', title, message, duration });
            }

            warning(title, message, duration = 6000) {
                return this.show({ type: 'warning', title, message, duration });
            }

            info(title, message, duration = 5000) {
                return this.show({ type: 'info', title, message, duration });
            }

            // Clear all toasts
            clearAll() {
                this.toasts.forEach(toast => this.hide(toast));
            }
        }

        // Initialize global toast manager
        window.toastManager = new ToastManager();

        // Newsletter validation functions with toast notifications
        function validateNewsletterEmail(email) {
            if (!email || !email.trim()) {
                toastManager.error('Email Required', 'Please enter your email address to subscribe.');
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.trim())) {
                toastManager.error('Invalid Email', 'Please enter a valid email address (e.g., name@example.com).');
                return false;
            }

            return true;
        }

        function validateNewsletterConsent(checkbox) {
            if (!checkbox || !checkbox.checked) {
                toastManager.warning('Consent Required', 'Please accept our privacy policy to continue with the subscription.');
                return false;
            }
            return true;
        }

        function showNewsletterSuccess() {
            toastManager.success(
                'Successfully Subscribed!', 
                'Welcome to our community! Check your email for confirmation.'
            );
        }

        // Newsletter form submission handler
        function handleNewsletterSubmission() {
            const form = document.getElementById('newsletter-form');
            if (!form) return;

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const emailInput = form.querySelector('input[name="email"]');
                const consentCheckbox = form.querySelector('#horizontal-consent');
                const submitButton = form.querySelector('button[type="submit"]');

                // Validate email
                if (!validateNewsletterEmail(emailInput.value)) {
                    emailInput.focus();
                    return;
                }

                // Validate consent
                if (!validateNewsletterConsent(consentCheckbox)) {
                    consentCheckbox.focus();
                    return;
                }

                // Show loading state
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...';

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        showNewsletterSuccess();
                        form.reset();
                        // Reset checkbox visual state
                        const checkmark = consentCheckbox.parentNode.querySelector('.checkbox-checkmark');
                        if (checkmark) {
                            checkmark.style.transform = 'translate(-50%, -50%) scale(0)';
                        }
                    } else {
                        toastManager.error('Subscription Failed', data.message || 'Something went wrong. Please try again.');
                    }
                } catch (error) {
                    toastManager.error('Network Error', 'Unable to process your request. Please check your connection and try again.');
                } finally {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }
            });
        }

        // Initialize newsletter form when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            handleNewsletterSubmission();
        });

        // Mobile Navigation Toggle
        function toggleMobileNav() {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('show');
        }

        // Drawer Menu Functions
        function toggleDrawer() {
            const drawer = document.getElementById('drawerMenu');
            const overlay = document.getElementById('drawerOverlay');
            const hamburger = document.getElementById('hamburgerBtn');
            
            drawer.classList.toggle('show');
            overlay.classList.toggle('show');
            hamburger.classList.toggle('active');
            
            // Prevent body scroll when drawer is open
            if (drawer.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        function closeDrawer() {
            const drawer = document.getElementById('drawerMenu');
            const overlay = document.getElementById('drawerOverlay');
            const hamburger = document.getElementById('hamburgerBtn');
            
            drawer.classList.remove('show');
            overlay.classList.remove('show');
            hamburger.classList.remove('active');
            document.body.style.overflow = '';
        }

        function toggleDrawerSubmenu(element) {
            const submenu = element.nextElementSibling;
            const toggle = element.querySelector('.drawer-dropdown-toggle');
            
            // Close other open submenus
            document.querySelectorAll('.drawer-submenu.show').forEach(menu => {
                if (menu !== submenu) {
                    menu.classList.remove('show');
                    menu.previousElementSibling.querySelector('.drawer-dropdown-toggle').classList.remove('open');
                }
            });
            
            // Toggle current submenu
            submenu.classList.toggle('show');
            toggle.classList.toggle('open');
        }

        // Close drawer when clicking on a link
        document.addEventListener('DOMContentLoaded', function() {
            const drawerLinks = document.querySelectorAll('.drawer-nav-link[href], .drawer-submenu a');
            drawerLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                        closeDrawer();
                    }
                });
            });
        });

        // Close drawer on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDrawer();
            }
        });

        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Hide loading screen
        window.addEventListener('load', function() {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.style.display = 'none';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Counter animation - Individual counter animation
        function animateCounter(counter) {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 seconds animation
            const start = performance.now();
            const startValue = 0;
            
            function updateCounter(currentTime) {
                const elapsed = currentTime - start;
                const progress = Math.min(elapsed / duration, 1);
                
                // Easing function for smooth animation
                const easedProgress = 1 - Math.pow(1 - progress, 3);
                const currentValue = Math.floor(startValue + (target - startValue) * easedProgress);
                
                counter.innerText = currentValue;
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target;
                }
            }
            
            requestAnimationFrame(updateCounter);
        }

        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                counter.innerText = '0'; // Start from 0
                animateCounter(counter);
            });
        }

        // Intersection Observer for counter animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    </script>

    <!-- Professional Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top" title="Back to top">
        <svg class="progress-ring" viewBox="0 0 60 60">
            <circle cx="30" cy="30" r="28" class="progress-ring-circle"></circle>
        </svg>
        <i class="fas fa-chevron-up"></i>
    </button>

    @stack('scripts')
</body>
</html>
