<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SitemapXmlController extends Controller
{
    /**
     * Displays the Sitemap view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('sitemap', [
            'posts' => Post::latest('created_at')->get(),
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * Pings Google about updates to the Sitemap.
     *
     */
    public function ping()
    {
        $sitemapUrl = "http://www.farzanyaz.com/sitemap.xml";

        function myCurl($url){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $httpCode;
        }

        // Pinging Google
        $url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=".$sitemapUrl;
        $returnCode = myCurl($url);
        dump( "<p>Google Sitemaps has been pinged (return code: $returnCode).</p>");
    }
}