@props([
    'title' => 'Communities We Serve',
    'subtitle' => 'Reached Registered Children (RC) in Local Governments - FY 2025/26',
    'data' => [],
    'bgColor' => '#f8f9fa'
])

<section class="communities-section section-padding" style="background-color: {{ $bgColor }};">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge" style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(5, 150, 105, 0.1)); border-radius: 50px; margin-bottom: 20px;">
                <span style="color: #2563eb; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fas fa-map-marked-alt me-2"></i>Our Reach
                </span>
            </div>
            <h2 class="section-title mb-3" style="font-size: 2.5rem; font-weight: 700; color: #1e3a8a;">
                {{ $title }}
            </h2>
            <p class="text-muted" style="font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
                {{ $subtitle }}
            </p>
        </div>

        <!-- Statistics Summary Cards -->
        <div class="row g-4 mb-5" data-aos="fade-up" data-aos-delay="100">
            @php
                $totalBoys = collect($data)->sum('boys');
                $totalGirls = collect($data)->sum('girls');
                $totalRC = collect($data)->sum('total');
                $totalLGs = count($data);
            @endphp
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);">
                    <i class="fas fa-map-marker-alt mb-3" style="font-size: 2.5rem; opacity: 0.9;"></i>
                    <h3 class="mb-1" style="font-size: 2.5rem; font-weight: 700;">{{ $totalLGs }}</h3>
                    <p class="mb-0" style="opacity: 0.9; font-size: 1rem;">Local Governments</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 10px 30px rgba(5, 150, 105, 0.3);">
                    <i class="fas fa-child mb-3" style="font-size: 2.5rem; opacity: 0.9;"></i>
                    <h3 class="mb-1" style="font-size: 2.5rem; font-weight: 700;">{{ number_format($totalRC) }}</h3>
                    <p class="mb-0" style="opacity: 0.9; font-size: 1rem;">Total Children Reached</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);">
                    <i class="fas fa-male mb-3" style="font-size: 2.5rem; opacity: 0.9;"></i>
                    <h3 class="mb-1" style="font-size: 2.5rem; font-weight: 700;">{{ number_format($totalBoys) }}</h3>
                    <p class="mb-0" style="opacity: 0.9; font-size: 1rem;">Boys</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" style="background: linear-gradient(135deg, #ec4899, #db2777); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 10px 30px rgba(236, 72, 153, 0.3);">
                    <i class="fas fa-female mb-3" style="font-size: 2.5rem; opacity: 0.9;"></i>
                    <h3 class="mb-1" style="font-size: 2.5rem; font-weight: 700;">{{ number_format($totalGirls) }}</h3>
                    <p class="mb-0" style="opacity: 0.9; font-size: 1rem;">Girls</p>
                </div>
            </div>
        </div>

        <!-- Detailed Table -->
        <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
            <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead style="background: linear-gradient(135deg, #1e3a8a, #2563eb); color: white;">
                        <tr>
                            <th style="padding: 20px; font-weight: 600; text-align: center; border: none;">SN</th>
                            <th style="padding: 20px; font-weight: 600; border: none;">Municipality</th>
                            <th style="padding: 20px; font-weight: 600; text-align: center; border: none;">Ward No</th>
                            <th style="padding: 20px; font-weight: 600; text-align: center; border: none;"><i class="fas fa-male me-2"></i>Boys</th>
                            <th style="padding: 20px; font-weight: 600; text-align: center; border: none;"><i class="fas fa-female me-2"></i>Girls</th>
                            <th style="padding: 20px; font-weight: 600; text-align: center; border: none;"><i class="fas fa-users me-2"></i>Total RC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $index => $item)
                        <tr style="transition: all 0.3s ease; border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 18px; text-align: center; font-weight: 600; color: #2563eb;">{{ $index + 1 }}</td>
                            <td style="padding: 18px; font-weight: 500; color: #1e3a8a;">
                                <i class="fas fa-map-pin me-2" style="color: #2563eb;"></i>{{ $item['name'] }}
                            </td>
                            <td style="padding: 18px; text-align: center; color: #6b7280;">{{ $item['wards'] }}</td>
                            <td style="padding: 18px; text-align: center; font-weight: 600; color: #7c3aed;">{{ number_format($item['boys']) }}</td>
                            <td style="padding: 18px; text-align: center; font-weight: 600; color: #db2777;">{{ number_format($item['girls']) }}</td>
                            <td style="padding: 18px; text-align: center; font-weight: 700; color: #059669; font-size: 1.1rem;">{{ number_format($item['total']) }}</td>
                        </tr>
                        @endforeach
                        <tr style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); font-weight: 700;">
                            <td colspan="3" style="padding: 20px; text-align: right; font-size: 1.1rem; color: #1e3a8a;">
                                <i class="fas fa-chart-bar me-2"></i>Grand Total
                            </td>
                            <td style="padding: 20px; text-align: center; color: #7c3aed; font-size: 1.2rem;">{{ number_format($totalBoys) }}</td>
                            <td style="padding: 20px; text-align: center; color: #db2777; font-size: 1.2rem;">{{ number_format($totalGirls) }}</td>
                            <td style="padding: 20px; text-align: center; color: #059669; font-size: 1.3rem;">{{ number_format($totalRC) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
            <p class="text-muted" style="font-size: 0.95rem;">
                <i class="fas fa-info-circle me-2"></i>
                Data reflects our active programs in partnership with local governments and communities
            </p>
        </div>
    </div>
</section>
