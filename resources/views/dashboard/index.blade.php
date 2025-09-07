@extends('layouts.dashboard')

@section('title', 'Dashboard - JIDS Nepal')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* Modern Professional Dashboard Styles */
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --success-gradient: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
    --warning-gradient: linear-gradient(135deg, #FFB347 0%, #FF8C69 100%);
    --info-gradient: linear-gradient(135deg, #4FACFE 0%, #00F2FE 100%);
    --danger-gradient: linear-gradient(135deg, #FF6B6B 0%, #FFE66D 100%);
    --neutral-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    
    --bg-primary: #f8fafc;
    --bg-secondary: #ffffff;
    --text-primary: #1a202c;
    --text-secondary: #4a5568;
    --text-muted: #718096;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.1);
}

body {
    background-color: var(--bg-primary);
    color: var(--text-primary);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.dashboard-card {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
    border-color: #cbd5e0;
}

.stat-card {
    position: relative;
    padding: 2.5rem 2rem;
    color: white;
    overflow: hidden;
    background: var(--primary-gradient);
}

.stat-card.primary { 
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
}

.stat-card.success { 
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
}

.stat-card.warning { 
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

.stat-card.info { 
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.stat-card.danger { 
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    backdrop-filter: blur(10px);
}

.stat-card::after {
    content: '';
    position: absolute;
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
    background: rgba(16, 185, 129, 0.2);
    color: #065f46;
    border-color: rgba(16, 185, 129, 0.3);
}

.growth-negative { 
    background: rgba(239, 68, 68, 0.2);
    color: #991b1b;
    border-color: rgba(239, 68, 68, 0.3);
}

.growth-neutral { 
    background: rgba(107, 114, 128, 0.2);
    color: #374151;
    border-color: rgba(107, 114, 128, 0.3);
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    border-radius: 16px;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.activity-item:hover {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
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
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

.performance-metric {
    text-align: center;
    padding: 2rem 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
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
}

.metric-circle::before {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
    z-index: -1;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-radius: 16px;
    text-decoration: none;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
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
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    transition: width 0.3s ease;
    z-index: 0;
}

.quick-action-btn:hover {
    color: white;
    border-color: #6366f1;
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
    background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
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
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
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
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    border-color: #6366f1;
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
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
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
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.badge {
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
}

.badge.bg-info {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
    color: white;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
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
    background: linear-gradient(135deg, #cbd5e0 0%, #a0aec0 100%);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
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
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
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
                <div class="metric-circle" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    {{ $performance['response_rate'] }}%
                </div>
                <h6 class="font-weight-bold">Response Rate</h6>
                <p class="text-muted small mb-0">Percentage of messages replied to</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="dashboard-card performance-metric">
                <div class="metric-circle" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                    {{ $performance['engagement_score'] }}%
                </div>
                <h6 class="font-weight-bold">Engagement Score</h6>
                <p class="text-muted small mb-0">Newsletter verification rate</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="dashboard-card performance-metric">
                <div class="metric-circle" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
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
