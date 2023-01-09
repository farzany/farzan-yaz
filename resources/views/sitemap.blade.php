<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://farzanyaz.com/</loc>
        <lastmod>2023-01-05T01:00:54+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://farzanyaz.com/resume-assistant</loc>
        <lastmod>2023-01-05T01:00:54+00:00</lastmod>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>https://farzanyaz.com/posts</loc>
        <lastmod>2023-01-05T01:00:54+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://farzanyaz.com/resume</loc>
        <lastmod>2023-01-05T01:00:54+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://farzanyaz.com/projects</loc>
        <lastmod>2023-01-05T01:00:54+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/') }}/posts/{{ $post->slug }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>