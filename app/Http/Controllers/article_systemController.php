<?php

namespace App\Http\Controllers;

use App\Jobs\Article_systemIndexData;
use App\Jobs\showAllGrade;
use App\Post;
use App\Grade;
use Illuminate\Http\Request;
use App\Services\RssFeed;
use App\Services\SiteMap;

class article_systemController extends Controller
{

    public function index(Request $request)
    {
        $grade = $request->get('grade');
        $data = $this->dispatch(new Article_systemIndexData($grade));
        $layout =  'article_system.layouts.index';

        return view($layout, $data);

    }
    public function showGrade(Request $request)
    {
        $grade = $request->get('grade');
        $data = $this->dispatch(new showAllGrade($grade));
        $layout =  'article_system.layouts.grade';

        return view($layout, $data);

    }
    public function showPost($slug, Request $request)
    {
        $post = Post::with('grades')->whereSlug($slug)->firstOrFail();
        $grade = $request->get('grade');
        if ($grade) {
            $grade = Grade::wheregrade($grade)->firstOrFail();
            }
        return view($post->layout, compact('post', 'grade'));
    }


    public function rss(RssFeed $feed)
    {
        $rss = $feed->getRSS();

        return response($rss)
            ->header('Content-type','application/rss+xml');
    }
        public function siteMap(SiteMap $siteMap)
    {
        $map = $siteMap->getSiteMap();

        return response($map)
            ->header('content-type','text/xml');
    }

}