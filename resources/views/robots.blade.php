User-agent: *
Allow: /

# Disallow admin/dashboard areas
Disallow: /dashboard/
Disallow: /login
Disallow: /logout

# Allow public uploads
Allow: /uploads/
Allow: /storage/

# Sitemap
Sitemap: {{ url('/sitemap.xml') }}
