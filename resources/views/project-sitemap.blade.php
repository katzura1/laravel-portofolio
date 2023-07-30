<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($projects as $project)
    <url>
        <loc>{{ route('home.project.detail',['id'=>$project->id]) }}</loc>
        <lastmod>{{ date('Y-m-d', strtotime($project->created_at)) }}</lastmod>
    </url>
    @endforeach
</urlset>