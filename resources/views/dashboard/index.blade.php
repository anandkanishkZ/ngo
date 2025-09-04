@extends('layouts.dashboard')

@section('title', 'Dashboard | Hope Foundation')

@section('content')
<div class="container-fluid">
  <div class="row g-3 mb-3">
    <div class="col-12 col-md-6 col-xl-3">
      <div class="ds-card metric">
        <div class="icon blue"><i class="fa-solid fa-handshake"></i></div>
        <div>
          <div class="muted">Partners</div>
          <div class="h4 mb-0">{{ \App\Models\Partner::count() }}</div>
        </div>
        <span class="badge text-bg-success ms-auto">+4.2%</span>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <div class="ds-card metric">
        <div class="icon green"><i class="fa-solid fa-bullhorn"></i></div>
        <div>
          <div class="muted">Active Notices</div>
          <div class="h4 mb-0">{{ \App\Models\Notice::where('is_active', true)->count() }}</div>
        </div>
        <span class="badge text-bg-success ms-auto">+2.1%</span>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <div class="ds-card metric">
        <div class="icon amber"><i class="fa-solid fa-calendar-days"></i></div>
        <div>
          <div class="muted">Upcoming Events</div>
          <div class="h4 mb-0">{{ \App\Models\Event::where('date','>=',now())->count() }}</div>
        </div>
        <span class="badge text-bg-warning ms-auto">New</span>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <div class="ds-card metric">
        <div class="icon green"><i class="fa-solid fa-users"></i></div>
        <div>
          <div class="muted">Team Members</div>
          <div class="h4 mb-0">{{ \App\Models\TeamMember::count() }}</div>
        </div>
        <span class="badge text-bg-success ms-auto">Active</span>
      </div>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-xl-8">
      <div class="ds-card p-3">
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Events Overview (last 6 months)</h5>
          <span class="muted small">Activity</span>
        </div>
        <canvas id="eventsChart" height="110"></canvas>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="ds-card p-3">
        <h5 class="card-title">Quick Actions</h5>
        <div class="d-grid gap-2">
          <a href="{{ route('contact') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>View Contacts</a>
          <a href="{{ route('events') }}" class="btn btn-outline-primary"><i class="fa-solid fa-calendar-plus me-2"></i>Create Event</a>
          <a href="{{ route('dashboard.notices.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-bullhorn me-2"></i>New Notice</a>
        </div>
      </div>
      <div class="ds-card p-3 mt-3">
        <h6 class="card-title">You are logged in</h6>
        <div class="muted">{{ $user->name }} ({{ $user->email }})</div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  const ctx = document.getElementById('eventsChart');
  if (ctx) {
    const labels = ['Mar','Apr','May','Jun','Jul','Aug'];
    const data = [3, 5, 2, 4, 6, 3];
    const getVars = () => {
      const cs = getComputedStyle(document.documentElement);
      const text = cs.getPropertyValue('--ds-text').trim();
      const muted = cs.getPropertyValue('--ds-muted').trim();
      const border = cs.getPropertyValue('--ds-border').trim();
      const primary = cs.getPropertyValue('--ds-primary').trim();
      const bgFill = primary.includes('rgb') ? primary.replace(')', ', .2)') : 'rgba(37,99,235,.2)';
      return { text, muted, border, primary, bgFill };
    }
    let vars = getVars();
    const chart = new Chart(ctx, {
      type: 'line',
      data: { labels, datasets: [{ label: 'Events', data, borderColor: vars.primary, backgroundColor: vars.bgFill, tension:.3, fill:true }] },
      options: { plugins:{ legend:{ labels:{ color:vars.text } } }, scales:{ x:{ ticks:{ color:vars.muted }, grid:{ color:vars.border } }, y:{ ticks:{ color:vars.muted }, grid:{ color:vars.border } } } }
    });
    window.addEventListener('ds-theme-changed', ()=>{
      vars = getVars();
      chart.options.plugins.legend.labels.color = vars.text;
      chart.options.scales.x.ticks.color = vars.muted;
      chart.options.scales.y.ticks.color = vars.muted;
      chart.options.scales.x.grid.color = vars.border;
      chart.options.scales.y.grid.color = vars.border;
      chart.data.datasets[0].borderColor = vars.primary;
      chart.data.datasets[0].backgroundColor = vars.bgFill;
      chart.update();
    });
  }
</script>
@endpush
@endsection
