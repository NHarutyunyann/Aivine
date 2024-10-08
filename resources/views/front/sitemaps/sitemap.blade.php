<?php '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php '<?xml-stylesheet type="text/xsl" href="' . url('/main-sitemap.xsl') . '"?>'; ?>


<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($items as $item)
        <url>
            <loc>{{ $item['loc'] }}</loc>
            <lastmod>{{ $item['lastmod'] }}</lastmod>
        </url>
    @endforeach
</urlset>