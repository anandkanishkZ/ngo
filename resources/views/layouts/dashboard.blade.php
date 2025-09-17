<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --ds-bg:#0f172a;
      --ds-card:#111827;
      --ds-soft:#1f2937;
      --ds-text:#e5e7eb;
      --ds-muted:#9ca3af;
      --ds-accent:#f59e0b;
      --ds-primary:#3b82f6;
      --ds-success:#10b981;
      --ds-danger:#ef4444;
      --sidebar-width:260px;
      --ds-border: rgba(255,255,255,.06);
      --ds-hover: rgba(255,255,255,.06);
      --ds-topbar-bg: rgba(17,24,39,.65);
      --ds-sidebar-start:#0b1224;
      --ds-sidebar-end:#0f172a;
      --ds-active-bg: rgba(59,130,246,.12);
      --ds-active-border: rgba(59,130,246,.25);
    }
    [data-theme="light"]{
      --ds-bg:#f3f4f6; /* gray-100 */
      --ds-card:#ffffff;
      --ds-soft:#e5e7eb; /* gray-200 */
      --ds-text:#111827; /* gray-900 */
      --ds-muted:#6b7280; /* gray-500 */
      --ds-accent:#d97706; /* amber-600 */
      --ds-primary:#2563eb; /* blue-600 */
      --ds-success:#059669; /* emerald-600 */
      --ds-danger:#dc2626; /* red-600 */
      --ds-border: rgba(17,24,39,.08);
      --ds-hover: rgba(17,24,39,.06);
      --ds-topbar-bg: rgba(255,255,255,.85);
      --ds-sidebar-start:#ffffff;
      --ds-sidebar-end:#f3f4f6;
      --ds-active-bg: rgba(37,99,235,.10);
      --ds-active-border: rgba(37,99,235,.22);
    }
    html,body{height:100%;background:var(--ds-bg);color:var(--ds-text);font-family:'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;} 
    .ds-layout{display:flex;min-height:100vh;}
    
    /* Enhanced Professional Sidebar */
    .ds-sidebar{
      width:var(--sidebar-width);
      background:linear-gradient(180deg,var(--ds-sidebar-start) 0%, var(--ds-sidebar-end) 100%);
      border-right:1px solid var(--ds-border);
      position:sticky;
      top:0;
      height:100vh;
      z-index:1010;
      transition:width .3s cubic-bezier(0.4, 0, 0.2, 1); /* Only animate width changes */
      box-shadow:2px 0 20px rgba(0,0,0,0.08);
      backdrop-filter:blur(10px);
      display:flex;
      flex-direction:column;
      /* Prevent any unwanted animations during navigation */
      will-change:width; /* Only optimize width changes */
    }
    .ds-sidebar.collapsed{width:80px;}
    
    /* Ensure stable layout - no shifts during page navigation */
    .ds-layout{
      display:flex;
      min-height:100vh;
      /* Prevent layout shifts */
      contain:layout style;
    }
    
    /* Enhanced Brand Section */
    .ds-brand{
      display:flex;
      align-items:center;
      gap:.8rem;
      padding:1.5rem 1.25rem;
      border-bottom:1px solid var(--ds-border);
      background:rgba(255,255,255,0.02);
      position:relative;
      overflow:hidden;
    }
    .ds-brand::before{
      content:'';
      position:absolute;
      top:0;
      left:0;
      right:0;
      height:2px;
      background:linear-gradient(90deg, var(--ds-accent), var(--ds-primary));
    }
    .ds-brand i{
      color:var(--ds-accent);
      font-size:1.3rem;
      padding:8px;
      background:rgba(245,158,11,0.1);
      border-radius:8px;
      min-width:40px;
      text-align:center;
    }
    .ds-brand strong{
      font-weight:700;
      font-size:1.1rem;
      letter-spacing:-0.025em;
    }
    
    /* Scrollable Navigation Container */
    .ds-nav-container{
      flex:1;
      overflow-y:auto;
      overflow-x:hidden;
      padding:0.75rem;
    }
    .ds-nav-container::-webkit-scrollbar{width:6px;}
    .ds-nav-container::-webkit-scrollbar-track{background:transparent;}
    .ds-nav-container::-webkit-scrollbar-thumb{
      background:rgba(255,255,255,0.1);
      border-radius:3px;
      transition:background 0.2s ease;
    }
    .ds-nav-container::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,0.2);}
    
    /* Enhanced Navigation */
    .ds-nav{padding:0;}
    .ds-nav a{
      display:flex;
      align-items:center;
      gap:1rem;
      color:var(--ds-text);
      text-decoration:none;
      border-radius:12px;
      padding:12px 16px;
      transition:all .2s ease-out; /* Reduced from .3s for snappier feel */
      margin-bottom:4px;
      position:relative;
      font-weight:500;
      letter-spacing:-0.025em;
      border:1px solid transparent;
    }
    .ds-nav a::before{
      content:'';
      position:absolute;
      left:0;
      top:50%;
      transform:translateY(-50%);
      width:3px;
      height:0;
      background:var(--ds-accent);
      border-radius:0 3px 3px 0;
      transition:height 0.2s ease-out; /* Reduced for snappier response */
    }
    .ds-nav a:hover{
      background:var(--ds-hover);
      transform:translateX(3px); /* Reduced from 4px for subtlety */
      border-color:rgba(255,255,255,0.1);
    }
    .ds-nav a:hover::before{height:18px;} /* Reduced from 20px */
    .ds-nav a.active{
      background:var(--ds-active-bg);
      color:var(--ds-primary);
      border:1px solid var(--ds-active-border);
      transform:translateX(2px);
      box-shadow:0 2px 8px rgba(59,130,246,0.12); /* Reduced shadow */
    }
    .ds-nav a.active::before{height:22px;background:var(--ds-primary);} /* Reduced from 24px */
    
    /* Enhanced Icons */
    .ds-icon{
      width:20px;
      text-align:center;
      font-size:1rem;
      transition:transform 0.2s ease;
    }
    .ds-nav a:hover .ds-icon{transform:scale(1.1);}
    .ds-nav a.active .ds-icon{transform:scale(1.05);}
    
    /* Enhanced Labels */
    .ds-label{
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
      font-size:0.9rem;
      line-height:1.4;
    }
    .ds-sidebar.collapsed .ds-label{display:none;}
    
    /* Enhanced Separators */
    .ds-nav hr{
      border:none;
      height:1px;
      background:linear-gradient(90deg, transparent, var(--ds-border), transparent);
      margin:12px 0;
      opacity:1;
    }
    
    /* Logout Button Enhancement */
    .ds-nav .btn{
      display:flex;
      align-items:center;
      gap:1rem;
      color:var(--ds-danger);
      text-decoration:none;
      border-radius:12px;
      padding:12px 16px;
      transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);
      margin-top:8px;
      font-weight:500;
      font-size:0.9rem;
      border:1px solid transparent;
      background:transparent;
      width:100%;
      text-align:left;
    }
    .ds-nav .btn:hover{
      background:rgba(239,68,68,0.1);
      border-color:rgba(239,68,68,0.2);
      transform:translateX(2px);
    }
    
    /* Professional Animation Control - Only animate when necessary */
    @keyframes slideInLeft {
      from { transform: translateX(-100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    
    /* Remove automatic animation on page load for professional UX */
    .ds-sidebar {
      /* No automatic animation - sidebar should be stable during navigation */
      opacity: 1;
      transform: translateX(0);
    }
    
    /* Only animate on mobile toggle and initial load */
    .ds-sidebar.opening { 
      animation: slideInLeft 0.3s ease-out; 
    }
    
    /* Smooth transitions for hover and active states only */
    .ds-sidebar * {
      transition-duration: 0.2s;
    }
    
    /* Enhanced Mobile Responsiveness */
    @media (max-width: 992px){
      .ds-sidebar{
        position:fixed;
        left:-100%;
        height:100vh;
        box-shadow:4px 0 30px rgba(0,0,0,0.15);
        z-index:1050;
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      .ds-sidebar.open{
        left:0;
        /* Remove automatic animation - use transition instead */
      }
      .ds-content{margin-left:0;}
      
      /* Mobile backdrop */
      .ds-sidebar.open::after{
        content:'';
        position:fixed;
        top:0;
        left:var(--sidebar-width);
        right:0;
        bottom:0;
        background:rgba(0,0,0,0.5);
        z-index:-1;
        animation: fadeIn 0.3s ease-out;
      }
      
      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }
    }
    .ds-content{flex:1;display:flex;flex-direction:column;min-width:0}
  .ds-topbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:.85rem 1rem;border-bottom:1px solid var(--ds-border);background:var(--ds-topbar-bg);backdrop-filter:blur(8px);position:sticky;top:0;z-index:1020}
    .hamburger{border:1px solid var(--ds-border);background:transparent;color:var(--ds-text);border-radius:.6rem;padding:.45rem .65rem}
    .hamburger:hover{background:var(--ds-hover)}
    .ds-search{position:relative;max-width:420px;flex:1}
  .ds-search input{background:var(--ds-card);border:1px solid var(--ds-border);color:var(--ds-text);border-radius:.6rem;padding:.6rem .9rem .6rem 2.2rem;width:100%}
  .ds-search input::placeholder{color:var(--ds-muted)}
    .ds-search i{position:absolute;left:.65rem;top:50%;transform:translateY(-50%);color:var(--ds-muted)}
    .ds-body{padding:1.25rem}
  .ds-card{background:var(--ds-card);border:1px solid var(--ds-border);border-radius:.9rem}
    .metric{display:flex;align-items:center;gap:1rem;padding:1rem}
  .metric .badge{border:1px solid var(--ds-border)}
    .metric .icon{width:46px;height:46px;border-radius:.75rem;display:flex;align-items:center;justify-content:center}
    .icon.blue{background:rgba(59,130,246,.15);color:#93c5fd}
    .icon.green{background:rgba(16,185,129,.15);color:#86efac}
    .icon.amber{background:rgba(245,158,11,.15);color:#fde68a}
    .icon.red{background:rgba(239,68,68,.15);color:#fecaca}
  .card-title{color:var(--ds-text)}
    .muted{color:var(--ds-muted)}
  .ds-nav hr{border-color:var(--ds-border)!important;opacity:1}
    @media (max-width: 992px){.ds-sidebar{position:fixed;left:-100%;height:100vh}.ds-sidebar.open{left:0}.ds-content{margin-left:0}}
  </style>
  @stack('styles')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="data:,">
  <style>/* hide default site nav */ nav.navbar{display:none!important}</style>
</head>
<body>
  <div class="ds-layout">
    <aside class="ds-sidebar">
      <div class="ds-brand">
        <i class="fa-solid fa-gauge-high"></i>
        <strong class="ds-label">Dashboard</strong>
      </div>
      <div class="ds-nav-container">
        <nav class="ds-nav">
          <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-house"></span>
            <span class="ds-label">Overview</span>
          </a>
          <hr class="text-white-50">
          <a href="#">
            <span class="ds-icon fa-solid fa-gear"></span>
            <span class="ds-label">Settings</span>
          </a>
          <a href="{{ route('dashboard.appearance.edit') }}" class="{{ request()->routeIs('dashboard.appearance.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-palette"></span>
            <span class="ds-label">Appearance</span>
          </a>
          <a href="{{ route('dashboard.hero.index') }}">
            <span class="ds-icon fa-solid fa-image"></span>
            <span class="ds-label">Hero Slides</span>
          </a>
          <a href="{{ route('dashboard.statistics.index') }}" class="{{ request()->routeIs('dashboard.statistics.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-chart-line"></span>
            <span class="ds-label">Statistics</span>
          </a>
          <a href="{{ route('dashboard.impact-areas.index') }}" class="{{ request()->routeIs('dashboard.impact-areas.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-hands-helping"></span>
            <span class="ds-label">Impact Areas</span>
          </a>
          <a href="{{ route('dashboard.partners.index') }}" class="{{ request()->routeIs('dashboard.partners.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-handshake"></span>
            <span class="ds-label">Partners</span>
          </a>
          <a href="{{ route('dashboard.media.index') }}" class="{{ request()->routeIs('dashboard.media.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-photo-film"></span>
            <span class="ds-label">Media Library</span>
          </a>
          <a href="{{ route('dashboard.team.index') }}" class="{{ request()->routeIs('dashboard.team.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-users"></span>
            <span class="ds-label">Team Management</span>
          </a>
          <a href="{{ route('dashboard.notices.index') }}" class="{{ request()->routeIs('dashboard.notices.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-bullhorn"></span>
            <span class="ds-label">Notice Management</span>
          </a>
          <a href="{{ route('dashboard.newsletters.index') }}" class="{{ request()->routeIs('dashboard.newsletters.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-envelope"></span>
            <span class="ds-label">Newsletter Subscribers</span>
          </a>
          <a href="{{ route('dashboard.contact-messages.index') }}" class="{{ request()->routeIs('dashboard.contact-messages.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-comments"></span>
            <span class="ds-label">Contact Messages</span>
            @php
                $unreadCount = \App\Models\ContactMessage::unread()->count();
            @endphp
      @if($unreadCount > 0)
        <span class="badge rounded-pill text-bg-danger ms-auto">{{ $unreadCount }}</span>
      @endif
          </a>
          <a href="{{ route('dashboard.reports.index') }}" class="{{ request()->routeIs('dashboard.reports.*') ? 'active' : '' }}">
            <span class="ds-icon fa-solid fa-file-alt"></span>
            <span class="ds-label">Reports</span>
          </a>
          <hr class="text-white-50">
          <form class="mt-2" method="POST" action="{{ route('logout') }}">@csrf
            <button class="btn w-100 text-start text-danger">
              <i class="fa-solid fa-right-from-bracket me-2"></i>
              <span class="ds-label">Logout</span>
            </button>
          </form>
        </nav>
      </div>
    </aside>
    <main class="ds-content">
      <div class="ds-topbar">
        <div class="d-flex align-items-center gap-2">
          <button id="ds-toggle" class="hamburger"><i class="fa-solid fa-bars"></i></button>
          <button id="ds-open" class="hamburger d-lg-none"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </div>
        <div class="ds-search d-none d-md-block">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="search" placeholder="Search...">
        </div>
        <div class="d-flex align-items-center gap-2">
          <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Visit Site
          </a>
          <button id="ds-theme" class="hamburger" title="Toggle theme"><i class="fa-solid fa-moon"></i></button>
          <span class="badge rounded-pill text-bg-warning">Admin</span>
          <div class="rounded-circle" style="width:36px;height:36px;background:var(--ds-soft);display:flex;align-items:center;justify-content:center">
            <i class="fa-solid fa-user"></i>
          </div>
        </div>
      </div>
      <div class="ds-body">
        @yield('content')
      </div>
    </main>
  </div>
  <script>
    (function(){
      const root = document.documentElement;
      // Sidebar state
      const sidebar=document.querySelector('.ds-sidebar');
      const state=localStorage.getItem('ds-sidebar')||'expanded';
      if(state==='collapsed') sidebar.classList.add('collapsed');
      document.getElementById('ds-toggle')?.addEventListener('click',()=>{
        sidebar.classList.toggle('collapsed');
        localStorage.setItem('ds-sidebar', sidebar.classList.contains('collapsed')?'collapsed':'expanded');
      });
      document.getElementById('ds-open')?.addEventListener('click',()=>{sidebar.classList.toggle('open')});

      // Theme state
      const themeBtn = document.getElementById('ds-theme');
      const themeIcon = themeBtn?.querySelector('i');
      let theme = localStorage.getItem('ds-theme') || 'dark';
      root.setAttribute('data-theme', theme);
      const setIcon = () => {
        if (!themeIcon) return;
        themeIcon.classList.remove('fa-moon','fa-sun');
        themeIcon.classList.add(theme === 'light' ? 'fa-sun' : 'fa-moon');
      };
      setIcon();
      themeBtn?.addEventListener('click', ()=>{
        theme = (theme === 'dark') ? 'light' : 'dark';
        root.setAttribute('data-theme', theme);
        localStorage.setItem('ds-theme', theme);
        setIcon();
        // notify pages to adapt (e.g., charts)
        window.dispatchEvent(new CustomEvent('ds-theme-changed', { detail: { theme } }));
      });
    })();
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
