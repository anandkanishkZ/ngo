<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($vacancies as $vacancy)
    <url>
        <loc>{{ route('careers.show', $vacancy->id) }}</loc>
        <lastmod>{{ $vacancy->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
</urlset>
