<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($notices as $notice)
    <url>
        <loc>{{ route('notices.show', $notice) }}</loc>
        <lastmod>{{ $notice->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
</urlset>
