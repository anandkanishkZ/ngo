@extends('layouts.dashboard')

@section('title', 'Dashboard - JIDS Nepal')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* Modern Professional Dashboard Styles */
:root {
    --dashboard-primary: #2563eb;     /* Modern blue - professional and trustworthy */
    --dashboard-success: #059669;     /* Modern green - success and growth */
    --dashboard-warning: #d97706;     /* Modern orange - attention and action */
    --dashboard-info: #0891b2;       /* Modern cyan - information and clarity */
    --dashboard-danger: #dc2626;     /* Modern red - alerts and warnings */
    --dashboard-neutral: #64748b;    /* Modern gray - balance and sophistication */
    
    --bg-primary: #f8fafc;          /* Very light blue-gray background */
    --bg-secondary: #ffffff;        /* Pure white for cards */
    --bg-light: #f1f5f9;           /* Light blue-gray for hover states */
    --text-primary: #0f172a;        /* Deep slate for primary text */
    --text-secondary: #475569;      /* Medium slate for secondary text */
    --text-muted: #64748b;          /* Light slate for muted text */
    --border-color: #e2e8f0;        /* Light border color */
    --border-light: #f1f5f9;        /* Very light border */
    
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.08);
    --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.1);
    --shadow-card: 0 1px 3px rgba(0, 0, 0, 0.05);
}

body {
    background-color: var(--bg-primary);
    color: var(--text-primary);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Professional Card Design */
.dashboard-card {
    background: var(--bg-secondary);
    border-radius: 16px;
    box-shadow: var(--shadow-card);
    border: 1px solid var(--border-color);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.dashboard-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--border-light);
}

/* Professional Statistics Cards */
.stat-card {
    position: relative;
    padding: 2rem 1.5rem;
    color: white;
    overflow: hidden;
    border: none;
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card:hover {
    transform: translateY(-4px) scale(1.02);
}

.stat-card.primary { 
    background: var(--dashboard-primary);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
}

.stat-card.success { 
    background: var(--dashboard-success);
    box-shadow: 0 8px 25px rgba(5, 150, 105, 0.25);
}

.stat-card.warning { 
    background: var(--dashboard-warning);
    box-shadow: 0 8px 25px rgba(217, 119, 6, 0.25);
}

.stat-card.info { 
    background: var(--dashboard-info);
    box-shadow: 0 8px 25px rgba(8, 145, 178, 0.25);
}

.stat-card.danger { 
    background: var(--dashboard-danger);
    box-shadow: 0 8px 25px rgba(220, 38, 38, 0.25);
}

/* Clean geometric patterns instead of gradients */
.stat-card::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.stat-card::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: -15px;
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.stat-number {
    font-size: 2.75rem;
    font-weight: 700;
    margin: 1rem 0 0.5rem 0;
    line-height: 1;
    position: relative;
    z-index: 2;
}

.stat-label {
    font-size: 0.875rem;
    font-weight: 600;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 2;
}

/* Professional Growth Badges */
.growth-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 2;
}

.growth-positive { 
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.growth-negative { 
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.growth-neutral { 
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

/* Professional Activity Items */
.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 0.75rem;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
    position: relative;
}

.activity-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: var(--dashboard-primary);
    border-radius: 0 3px 3px 0;
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.activity-item:hover {
    background: var(--bg-secondary);
    transform: translateX(4px);
    box-shadow: var(--shadow-md);
    border-color: var(--dashboard-primary);
}

.activity-item:hover::before {
    transform: scaleY(1);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1rem;
    font-weight: 600;
    background: var(--bg-secondary);
    color: var(--dashboard-primary);
    box-shadow: var(--shadow-sm);
}

/* Professional Chart Container */
.chart-container {
    position: relative;
    height: 350px;
    padding: 1.5rem;
    background: var(--bg-secondary);
}

/* Professional Performance Metrics */
.performance-metric {
    text-align: center;
    padding: 1.5rem;
    background: var(--bg-secondary);
}

.metric-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    font-weight: 700;
    position: relative;
    color: white;
    border: 3px solid rgba(255, 255, 255, 0.9);
}

.metric-circle.primary {
    background: var(--dashboard-primary);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
}

.metric-circle.success {
    background: var(--dashboard-success);
    box-shadow: 0 8px 25px rgba(5, 150, 105, 0.25);
}

.metric-circle.info {
    background: var(--dashboard-info);
    box-shadow: 0 8px 25px rgba(8, 145, 178, 0.25);
}

.metric-circle.warning {
    background: var(--dashboard-warning);
    box-shadow: 0 8px 25px rgba(217, 119, 6, 0.25);
}

/* Professional Quick Action Buttons */
.quick-action-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.25rem;
    border-radius: 12px;
    text-decoration: none;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    color: var(--text-primary);
    font-weight: 500;
    transition: all 0.3s ease;
    margin-bottom: 0.75rem;
    position: relative;
}

.quick-action-btn:hover {
    color: var(--dashboard-primary);
    border-color: var(--dashboard-primary);
    background: var(--bg-secondary);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    text-decoration: none;
}

.quick-action-btn i {
    color: var(--dashboard-primary);
}

/* Professional Welcome Card */
.welcome-card {
    background: var(--text-primary);
    color: white;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    border: none;
    box-shadow: var(--shadow-xl);
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    transform: translate(50px, -50px);
}

.welcome-card h1 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 0.75rem;
    position: relative;
    z-index: 2;
}

.welcome-card p {
    font-size: 1rem;
    line-height: 1.6;
    opacity: 0.9;
    position: relative;
    z-index: 2;
}

/* Professional Button Groups */
.btn-group .btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.btn-group .btn.active,
.btn-group .btn:hover {
    background: var(--dashboard-primary);
    border-color: var(--dashboard-primary);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

/* Professional Tables */
.table {
    background: var(--bg-secondary);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

.table thead th {
    background: var(--bg-light);
    border: none;
    font-weight: 600;
    color: var(--text-primary);
    padding: 1rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 1rem;
    border-color: var(--border-color);
    color: var(--text-secondary);
    font-weight: 500;
}

.table tbody tr:hover {
    background: var(--bg-light);
}

/* Professional Badges */
.badge {
    font-weight: 500;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge.bg-info {
    background: var(--dashboard-info) !important;
    color: white;
}

.badge.bg-danger {
    background: var(--dashboard-danger) !important;
    color: white;
}

.badge.bg-success {
    background: var(--dashboard-success) !important;
    color: white;
}

/* Professional Text Colors */
.text-muted {
    color: var(--text-muted) !important;
}

/* Professional Scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: var(--bg-primary);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: var(--border-color);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--text-muted);
}

/* Professional Responsive Design */
@media (max-width: 768px) {
    .stat-card { 
        padding: 1.5rem 1.25rem; 
    }
    
    .stat-number { 
        font-size: 2.25rem; 
    }
    
    .welcome-card {
        padding: 2rem 1.5rem;
    }
    
    .welcome-card h1 {
        font-size: 1.75rem;
    }
    
    .metric-circle {
        width: 80px;
        height: 80px;
        font-size: 1.25rem;
    }
    
    .performance-metric {
        padding: 1.25rem;
    }
}

@media (max-width: 576px) {
    .dashboard-card {
        border-radius: 12px;
    }
    
    .stat-card {
        padding: 1.25rem 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .welcome-card {
        padding: 1.5rem 1.25rem;
        border-radius: 16px;
    }
    
    .chart-container {
        padding: 1rem;
        height: 300px;
    }
}

/* Professional Loading Animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.loading-pulse {
    animation: pulse 1.5s infinite;
}

/* Professional Focus States */
.btn:focus,
.quick-action-btn:focus {
    outline: 2px solid var(--dashboard-primary);
    outline-offset: 2px;
}

/* Professional Card Headers */
.card-header-professional {
    background: var(--bg-light);
    border-bottom: 1px solid var(--border-color);
    padding: 1.25rem 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
}

.stat-card::after {
    bottom: -30px;
    left: -30px;
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    margin: 1rem 0;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    line-height: 1;
    position: relative;
    z-index: 2;
}

.stat-label {
    font-size: 0.9rem;
    font-weight: 600;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    z-index: 2;
}

.growth-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 700;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    z-index: 2;
}

.growth-positive { 
    background: rgba(5, 150, 105, 0.15);
    color: #065f46;
    border-color: rgba(5, 150, 105, 0.3);
}

.growth-negative { 
    background: rgba(220, 38, 38, 0.15);
    color: #991b1b;
    border-color: rgba(220, 38, 38, 0.3);
}

.growth-neutral { 
    background: rgba(100, 116, 139, 0.15);
    color: #334155;
    border-color: rgba(100, 116, 139, 0.3);
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    border-radius: 16px;
    margin-bottom: 1rem;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.activity-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: var(--dashboard-primary);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.activity-item:hover {
    background: var(--bg-secondary);
    transform: translateX(8px);
    box-shadow: var(--shadow-lg);
}

.activity-item:hover::before {
    transform: scaleY(1);
}

.activity-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.25rem;
    font-size: 1.1rem;
    font-weight: 600;
    box-shadow: var(--shadow-sm);
}

.chart-container {
    position: relative;
    height: 350px;
    padding: 2rem;
    background: var(--bg-secondary);
}

.performance-metric {
    text-align: center;
    padding: 2rem 1.5rem;
    background: var(--bg-secondary);
}

.metric-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.8rem;
    font-weight: 800;
    position: relative;
    box-shadow: var(--shadow-lg);
    border: 4px solid rgba(255, 255, 255, 0.9);
    color: white;
}

.metric-circle.primary {
    background: var(--dashboard-primary);
}

.metric-circle.success {
    background: var(--dashboard-success);
}

.metric-circle.info {
    background: var(--dashboard-info);
}

.metric-circle::before {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 50%;
    background: var(--bg-light);
    z-index: -1;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-radius: 16px;
    text-decoration: none;
    background: var(--bg-secondary);
    border: 2px solid var(--border-color);
    color: var(--text-primary);
    font-weight: 600;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    position: relative;
    overflow: hidden;
}

.quick-action-btn::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    background: var(--dashboard-primary);
    transition: width 0.3s ease;
    z-index: 0;
}

.quick-action-btn:hover {
    color: white;
    border-color: var(--dashboard-primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.quick-action-btn:hover::before {
    width: 100%;
}

.quick-action-btn * {
    position: relative;
    z-index: 1;
}

.welcome-card {
    background: var(--dashboard-primary);
    color: white;
    padding: 3rem 2.5rem;
    border-radius: 24px;
    position: relative;
    overflow: hidden;
    border: none;
    box-shadow: 0 25px 50px rgba(30, 41, 59, 0.3);
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    transform: translate(100px, -100px);
}

.welcome-card h1 {
    font-weight: 800;
    font-size: 2.5rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.welcome-card p {
    font-size: 1.1rem;
    line-height: 1.6;
    opacity: 0.9;
    position: relative;
    z-index: 2;
}

.btn-group .btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    border: 2px solid var(--border-color);
}

.btn-group .btn.active,
.btn-group .btn:hover {
    background: var(--dashboard-primary);
    border-color: var(--dashboard-primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.table {
    background: var(--bg-secondary);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.table thead th {
    background: var(--bg-light);
    border: none;
    font-weight: 700;
    color: var(--text-primary);
    padding: 1.25rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 1.25rem;
    border-color: var(--border-color);
    color: var(--text-secondary);
    font-weight: 500;
}

.table tbody tr:hover {
    background: var(--bg-light);
}

.badge {
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
}

.badge.bg-info {
    background: var(--dashboard-info) !important;
    color: white;
}

.badge.bg-danger {
    background: var(--dashboard-danger) !important;
    color: white;
}

.text-muted {
    color: var(--text-muted) !important;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg-primary);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: var(--dashboard-neutral);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary);
}

/* Responsive Design */
@media (max-width: 768px) {
    .stat-card { 
        padding: 2rem 1.5rem; 
    }
    
    .stat-number { 
        font-size: 2.5rem; 
    }
    
    .welcome-card {
        padding: 2rem 1.5rem;
    }
    
    .welcome-card h1 {
        font-size: 2rem;
    }
    
    .metric-circle {
        width: 100px;
        height: 100px;
        font-size: 1.5rem;
    }
}

/* Loading Animation */
@keyframes shimmer {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}

.loading-shimmer {
    background: var(--bg-light);
    background-size: 200px 100%;
    animation: shimmer 1.5s infinite;
}
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card dashboard-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="h3 mb-2">Welcome back, {{ $user->name }}! 👋</h1>
                        <p class="mb-0 opacity-90">
                            Here's what's happening with JIDS Nepal today. 
                            You have {{ $stats['contact_messages']['unread'] }} new messages waiting for your attention.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="text-white-50">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ now()->format('l, F j, Y') }}
                        </div>
                        <div class="text-white-50 mt-1">
                            <i class="fas fa-clock me-2"></i>
                            <span id="current-time">{{ now()->format('h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Contact Messages -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card primary">
                <div class="stat-label">Contact Messages</div>
                <div class="stat-number">{{ number_format($stats['contact_messages']['total']) }}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <small>{{ $stats['contact_messages']['unread'] }} unread</small>
                    <span class="growth-badge {{ $stats['contact_messages']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['contact_messages']['growth'] >= 0 ? 'up' : 'down' }} me-1"></i>
                        {{ abs($stats['contact_messages']['growth']) }}%
                    </span>
                </div>
            </div>
        </div>

        <!-- Newsletter Subscribers -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card success">
                <div class="stat-label">Newsletter Subscribers</div>
                <div class="stat-number">{{ number_format($stats['newsletter_subscribers']['total']) }}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <small>{{ $stats['newsletter_subscribers']['verified'] }} verified</small>
                    <span class="growth-badge {{ $stats['newsletter_subscribers']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['newsletter_subscribers']['growth'] >= 0 ? 'up' : 'down' }} me-1"></i>
                        {{ abs($stats['newsletter_subscribers']['growth']) }}%
                    </span>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card info">
                <div class="stat-label">Reports</div>
                <div class="stat-number">{{ number_format($stats['reports']['total']) }}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <small>{{ $stats['reports']['published'] }} published</small>
                    <span class="growth-badge {{ $stats['reports']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['reports']['growth'] >= 0 ? 'up' : 'down' }} me-1"></i>
                        {{ abs($stats['reports']['growth']) }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="dashboard-card performance-metric">
                <div class="metric-circle primary">
                    {{ $performance['response_rate'] }}%
                </div>
                <h6 class="font-weight-bold">Response Rate</h6>
                <p class="text-muted small mb-0">Percentage of messages replied to</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="dashboard-card performance-metric">
                <div class="metric-circle success">
                    {{ $performance['engagement_score'] }}%
                </div>
                <h6 class="font-weight-bold">Engagement Score</h6>
                <p class="text-muted small mb-0">Newsletter verification rate</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="dashboard-card performance-metric">
                <div class="metric-circle info">
                    {{ $performance['content_health'] }}%
                </div>
                <h6 class="font-weight-bold">Content Health</h6>
                <p class="text-muted small mb-0">Active content percentage</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Analytics Chart -->
        <div class="col-xl-8 mb-4">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="mb-0 font-weight-bold">Activity Overview</h5>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active" onclick="updateChart('contact_messages')">Messages</button>
                        <button type="button" class="btn btn-outline-primary" onclick="updateChart('newsletter_signups')">Subscribers</button>
                        <button type="button" class="btn btn-outline-primary" onclick="updateChart('reports')">Reports</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Sidebar Content -->
        <div class="col-xl-4">
            <!-- Quick Actions -->
            <div class="dashboard-card mb-4">
                <div class="p-3 border-bottom">
                    <h6 class="mb-0 font-weight-bold">Quick Actions</h6>
                </div>
                <div class="p-3">
                    <a href="{{ route('dashboard.contact-messages.index') }}" class="quick-action-btn">
                        <i class="fas fa-envelope me-2"></i>
                        View Messages
                        @if($stats['contact_messages']['unread'] > 0)
                            <span class="badge bg-danger ms-auto">{{ $stats['contact_messages']['unread'] }}</span>
                        @endif
                    </a>
                    <a href="{{ route('dashboard.newsletters.index') }}" class="quick-action-btn">
                        <i class="fas fa-users me-2"></i>
                        Manage Subscribers
                    </a>
                    <a href="{{ route('dashboard.reports.create') }}" class="quick-action-btn">
                        <i class="fas fa-plus me-2"></i>
                        Create Report
                    </a>
                    <a href="{{ route('dashboard.notices.create') }}" class="quick-action-btn">
                        <i class="fas fa-bullhorn me-2"></i>
                        New Notice
                    </a>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="dashboard-card">
                <div class="p-3 border-bottom">
                    <h6 class="mb-0 font-weight-bold">Recent Activities</h6>
                </div>
                <div class="p-3" style="max-height: 400px; overflow-y: auto;">
                    @forelse($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-icon bg-{{ $activity['color'] }} text-white">
                                <i class="{{ $activity['icon'] }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="font-weight-semibold">{{ $activity['title'] }}</div>
                                <div class="text-muted small">{{ $activity['description'] }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    {{ $activity['time']->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-clock fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No recent activities</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if($recentMessages->count() > 0)
    <!-- Recent Unread Messages -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Unread Messages</h6>
                        <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Type</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMessages as $message)
                            <tr>
                                <td class="font-weight-semibold">{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ Str::limit($message->subject, 40) }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $message->inquiry_type_formatted }}</span>
                                </td>
                                <td class="text-muted">{{ $message->time_ago }}</td>
                                <td>
                                    <a href="{{ route('dashboard.contact-messages.show', $message) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Real-time clock
function updateTime() {
    const now = new Date();
    document.getElementById('current-time').textContent = now.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
}
setInterval(updateTime, 1000);

// Chart data from backend - with error handling
const chartData = @json($chartData ?? []);
let currentChart = null;

// Validate chart data
if (!chartData || typeof chartData !== 'object') {
    console.error('Chart data is invalid:', chartData);
}

// Initialize chart with professional styling
function initChart() {
    try {
        // Check if chart data exists and has required structure
        if (!chartData || !chartData.contact_messages || !chartData.contact_messages.labels) {
            console.error('Chart data is missing or invalid');
            return;
        }
        
        const ctx = document.getElementById('activityChart');
        if (!ctx) {
            console.error('Chart canvas element not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        currentChart = new Chart(context, {
            type: 'line',
            data: {
                labels: chartData.contact_messages.labels,
                datasets: [{
                    label: 'Contact Messages',
                data: chartData.contact_messages.data,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.08)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 8,
                pointHoverRadius: 12,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointHoverBackgroundColor: '#6366f1',
                pointHoverBorderColor: '#ffffff',
                pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 41, 59, 0.95)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#6366f1',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: false,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12
                }
            },
            scales: {
                x: {
                    grid: {
                        display: true,
                        color: 'rgba(226, 232, 240, 0.8)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        padding: 10
                    },
                    border: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(226, 232, 240, 0.6)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        padding: 15,
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        }
                    },
                    border: {
                        display: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            elements: {
                line: {
                    borderCapStyle: 'round',
                    borderJoinStyle: 'round'
                }
            }
        }
    });
    } catch (error) {
        console.error('Error initializing chart:', error);
        // Hide chart container if there's an error
        const chartContainer = document.getElementById('activityChart');
        if (chartContainer && chartContainer.parentElement) {
            chartContainer.parentElement.innerHTML = '<div class="text-center py-4"><p class="text-muted">Chart unavailable</p></div>';
        }
    }
}

// Update chart based on selection
function updateChart(type) {
    try {
        if (!currentChart || !chartData || !chartData[type]) {
            console.error('Chart or data not available for type:', type);
            return;
        }
        
        // Update active button
        document.querySelectorAll('.btn-group button').forEach(btn => {
            btn.classList.remove('active');
        });
        if (event && event.target) {
            event.target.classList.add('active');
        }
    
    // Chart configurations with professional colors
    const configs = {
        contact_messages: {
            label: 'Contact Messages',
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.08)',
            pointBackgroundColor: '#6366f1'
        },
        newsletter_signups: {
            label: 'Newsletter Signups',
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.08)',
            pointBackgroundColor: '#10b981'
        },
        reports: {
            label: 'Reports',
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.08)',
            pointBackgroundColor: '#3b82f6'
        }
    };
    
    const config = configs[type];
    
    // Update chart data with enhanced styling
    currentChart.data.labels = chartData[type].labels;
    currentChart.data.datasets[0].data = chartData[type].data;
    currentChart.data.datasets[0].label = config.label;
    currentChart.data.datasets[0].borderColor = config.borderColor;
    currentChart.data.datasets[0].backgroundColor = config.backgroundColor;
    currentChart.data.datasets[0].pointBackgroundColor = config.pointBackgroundColor;
    currentChart.data.datasets[0].pointBorderColor = '#ffffff';
    currentChart.data.datasets[0].pointHoverBackgroundColor = config.pointBackgroundColor;
    currentChart.data.datasets[0].pointHoverBorderColor = '#ffffff';
    currentChart.data.datasets[0].data = chartData[type].data;
    currentChart.data.datasets[0].label = config.label;
    currentChart.data.datasets[0].borderColor = config.borderColor;
    currentChart.data.datasets[0].backgroundColor = config.backgroundColor;
    currentChart.data.datasets[0].pointBackgroundColor = config.borderColor;
    
    currentChart.update('active');
    } catch (error) {
        console.error('Error updating chart:', error);
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initChart();
});

// Auto-refresh dashboard every 5 minutes
setInterval(function() {
    // Refresh statistics without full page reload
    fetch(window.location.href, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update only the statistics if needed
        console.log('Dashboard data refreshed');
    })
    .catch(error => {
        console.log('Auto-refresh failed:', error);
    });
}, 300000); // 5 minutes
</script>
@endpush
