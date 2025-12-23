<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($urls as $u)
    <url>
        <loc>{{ $u }}</loc>
    </url>
    @endforeach

    @foreach($productUrls as $p)
    <url>
        <loc>{{ $p[`loc`] }}</loc>
        @if(!empty($p[`lastmod`]))
        <lastmod>{{ $p[`lastmod`] }}</lastmod>
        @endif
    </url>
    @endforeach
</urlset>