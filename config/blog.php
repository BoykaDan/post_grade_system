<?php
/**
 * Created by PhpStorm.
 * User: xiii_
 * Date: 2017/7/18
 * Time: 15:01
 */
return [
    'title' => '文章系统',
    'posts_per_page' => 30,
    'uploads' => [
        'storage' => 'local',
        'webpath' => '/uploads',
    ],
        'name' => "文章",
        'subtitle' => 'http://localhost/article_system/public',
        'description' => 'This is my meta description',
        'author' => '机构名',
        'page_image' => 'home-bg.jpg',
        'rss_size' => 25,
        'contact_email' => env('MAIL_FROM'),

];