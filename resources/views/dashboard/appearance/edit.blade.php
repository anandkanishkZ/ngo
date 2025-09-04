@extends('layouts.dashboard')

@section('title', 'Appearance Settings')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-12">
      <div class="ds-card p-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h5 class="mb-0"><i class="fa-solid fa-palette me-2"></i>Appearance</h5>
          <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Preview</a>
        </div>

        @if (session('status'))
          <div class="alert alert-success py-2">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('dashboard.appearance.update') }}" class="row g-3">
          @csrf

          @php($fields = [
            'primary_color' => 'Primary Color',
            'secondary_color' => 'Secondary Color',
            'accent_color' => 'Accent Color',
            'success_color' => 'Success Color',
            'light_bg' => 'Light Background',
            'dark_bg' => 'Dark Background',
          ])
          @foreach($fields as $key => $label)
            <div class="col-12 col-md-6 col-lg-4">
              <label class="form-label">{{ $label }}</label>
              <div class="d-flex align-items-center gap-2">
                <input type="color" name="{{ $key }}" value="{{ old($key, $colors[$key] ?? '#000000') }}" class="form-control form-control-color" style="width:60px; padding:0.2rem">
                <input type="text" value="{{ old($key, $colors[$key] ?? '#000000') }}" oninput="this.previousElementSibling.value=this.value" class="form-control" placeholder="#ffffff">
              </div>
              @error($key)
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>
          @endforeach

          <div class="col-12 d-flex gap-2 mt-2">
            <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i> Save Changes</button>
            <button type="button" class="btn btn-outline-secondary" onclick="resetDefaults()"><i class="fa-solid fa-rotate-left me-1"></i> Reset to defaults</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-12">
      <div class="ds-card p-3">
        <h6 class="mb-3">Live Preview</h6>
        <div class="p-3 rounded" id="preview" style="background: var(--light-bg); border:1px solid var(--ds-border)">
          <div class="p-4 rounded mb-3" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color:#fff;">
            <h3 style="margin:0">Primary + Secondary</h3>
            <p class="mb-0" style="opacity:.9">Accent highlights <span style="color: var(--accent-color)">accent</span></p>
          </div>
          <div class="d-flex gap-2">
            <button class="btn" style="background: var(--accent-color); color:#fff; border:none">Primary CTA</button>
            <button class="btn btn-outline-success" style="border-color: var(--success-color); color: var(--success-color)">Success</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function resetDefaults(){
    const defaults = @json(\App\Models\Setting::DEFAULT_COLORS);
    Object.entries(defaults).forEach(([k,v])=>{
      const colorInput = document.querySelector(`input[name="${k}"]`);
      if(colorInput){
        colorInput.value = v;
        const textInput = colorInput.nextElementSibling;
        if(textInput) textInput.value = v;
      }
    });
  }
</script>
@endpush
@endsection
