@props([
    'name' => 'Chairperson',
    'image' => null,
    'message',
    'signature' => null,
    'position' => 'Chairperson',
    'bgColor' => '#f8f9fa'
])

<section class="chairperson-message-section section-padding" style="background-color: {{ $bgColor }};">
    <div class="container">
        <div class="row align-items-center">
            <!-- Message Content -->
            <div class="col-lg-8 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="message-header mb-4">
                    <div class="section-badge" style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(5, 150, 105, 0.1)); border-radius: 50px; margin-bottom: 20px;">
                        <span style="color: #2563eb; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fas fa-quote-left me-2"></i>Message from the {{ $position }}
                        </span>
                    </div>
                    <h2 class="section-title text-start mb-3" style="font-size: 2.5rem; font-weight: 700; color: #1e3a8a;">
                        A Message from Our Leadership
                    </h2>
                </div>
                
                <div class="message-content" style="font-size: 1.05rem; line-height: 1.8; color: #4b5563; text-align: justify;">
                    {!! nl2br(e($message)) !!}
                </div>

                @if($signature || $name)
                <div class="message-signature mt-4 pt-4" style="border-top: 2px solid #e5e7eb;">
                    @if($signature)
                        <img src="{{ asset($signature) }}" alt="{{ $name }} Signature" style="max-width: 200px; margin-bottom: 10px;">
                    @endif
                    <p class="mb-1" style="font-weight: 600; font-size: 1.1rem; color: #1e3a8a;">{{ $name }}</p>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">{{ $position }}</p>
                    <p class="text-muted" style="font-size: 0.9rem;">Jalpa Integrated Development Society (JIDS)</p>
                </div>
                @endif
            </div>

            <!-- Image Column -->
            @if($image)
            <div class="col-lg-4" data-aos="fade-left">
                <div class="chairperson-image-wrapper position-relative" style="overflow: hidden; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                    <img src="{{ asset($image) }}" alt="{{ $name }}" class="img-fluid" style="width: 100%; height: auto; border-radius: 12px;" loading="lazy" decoding="async">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                        <p class="text-white mb-0" style="font-weight: 600; font-size: 1.1rem;">{{ $name }}</p>
                        <p class="text-white-50 mb-0" style="font-size: 0.9rem;">{{ $position }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
