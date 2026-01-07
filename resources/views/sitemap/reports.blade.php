<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($reports as $report)
    <url>
        <loc>{{ route('reports.show', $report) }}</loc>
        <lastmod>{{ $report->updated_at->toAtomString() }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
</urlset>
