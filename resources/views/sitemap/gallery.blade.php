<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($photos as $photo)
    <url>
        <loc>{{ route('gallery.show', $photo->id) }}</loc>
        <lastmod>{{ $photo->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
@endforeach
</urlset>
