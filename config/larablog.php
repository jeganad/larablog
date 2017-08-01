<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Blog Title
    |--------------------------------------------------------------------------
    |
    | This value is the title of your blog. This value is used when the
    | package needs to place the blog's title in a page layout or any
    | any other location as required by the package.
    */

    'title' => 'Larablog',

    /*
    |--------------------------------------------------------------------------
    | Blog Theme
    |--------------------------------------------------------------------------
    |
    | This value determines the current theme of your blog. The default
    | template uses bulma as css framework. You may change it to
    | 'bootstrap' to use the bootstrap layout of the blog. Or
    | you could create your own theme and paste the name in
    | this configuration option.
    */

    'theme' => 'naoray/larablog-default-theme',

    /*
    |--------------------------------------------------------------------------
    | Posts per Page
    |--------------------------------------------------------------------------
    |
    | This value determines how many posts are displayed at the initial
    | blog page. By default it is set to 10, so 10 posts are shown to
    | the blog visitor. If more posts are available for display,
    | they'll be shown on the next blog page.
    */

    'posts_per_page' => 10,

    /*
    |--------------------------------------------------------------------------
    | Table Name
    |--------------------------------------------------------------------------
    |
    | This value determines how the table is named where the posts
    | are stored. By default its name is set to 'posts'.
    */

    'table_name' => 'posts',

    /*
    |--------------------------------------------------------------------------
    | Load Blog Permissions
    |--------------------------------------------------------------------------
    |
    | This value determines if the permissions defined via Laravels
    | build in Gate facade are loaded within this packages
    | Service Provider. If you decide to use a roles or
    | permission package, you should set this value
    | to false, and register your own permissions
    | like mentioned in the readme file.
    */

    'load_permissions' => true,

    /*
    |--------------------------------------------------------------------------
    | Blog Time Setting
    |--------------------------------------------------------------------------
    |
    | This value is used to display the published_at time of your posts to
    | your locale setting. Carbon is used to format the time to the
    | proper string. However, I did not know how to fix this issue
    | otherwise. Make sure the locale you are using is installed
    | on your system. Form more information take a look at the
    | following issue https://github.com/briannesbitt/Carbon/issues/430
    | German Time Format: de_DE.utf8
    */

    'locale_time_setting' => '',

    /*
    |--------------------------------------------------------------------------
    | Post Preview Length
    |--------------------------------------------------------------------------
    |
    | This value determines how much characters of the post are shown at the
    | blog posts overview page.
    */

    'post_preview_length' => 500,

    /*
    |--------------------------------------------------------------------------
    | Blog Routes
    |--------------------------------------------------------------------------
    |
    | This value determines the route prefixes of your blog. It is used to
    | determine on which route the blog should be shown and where the
    | backend configurations for this blog should be made.
    */

    'routes' => [

        /*
        |--------------------------------------------------------------------------
        | Frontend Route
        |--------------------------------------------------------------------------
        |
        | This value is used to determine your blogs frontend route location.
        | By default the route for the frontend is set to 'blog'. This
        | means your blog will be located at '/blog'. If you change
        | it to e.g. 'news', your new route will be at '/news'.
        */

        'frontend' => 'blog',

        /*
        |--------------------------------------------------------------------------
        | Backend Route
        |--------------------------------------------------------------------------
        |
        | This value is used to determine your blogs backend route location.
        | By default the route to access the backend of this package is
        | set to 'admin'. This means your blog's backend will be
        | located at '/admin/posts'. If you change it to e.g.
        | 'admin/blog', your new backend access route
        |  be at '/admin/blog/posts'.
        */
       
        'backend' => 'admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Blog Layouts
    |--------------------------------------------------------------------------
    |
    | With this options you are able to control which header and footer
    | is assigned to your blog pages in the backend and frontend area.
    | By default larablog's own header and footer will be displayed,
    | you may create your own header and footer or just reference
    | existing ones.
    */

    'layouts' => [

        /*
        |--------------------------------------------------------------------------
        | Header Layouts
        |--------------------------------------------------------------------------
        |
        | Replace these values with your own headers if you want to. E.g. your
        | own frontend header is saved under '/views/layouts/header'. Then
        | you have to change the header.frontend into 'layouts.header'.
        */
       
        'header' => [
            'backend' => 'larablog::backend.partials.header',
            'frontend' => 'larablog::frontend.partials.header',
        ],

        /*
        |--------------------------------------------------------------------------
        | Footer Layouts
        |--------------------------------------------------------------------------
        |
        | Replace these values with your own footers if you want to. E.g. your
        | own frontend footer is saved under '/views/layouts/footer'. Then
        | you have to change the header.frontend into 'layouts.footer'.
        */

        'footer' => [
            'backend' => 'larablog::shared.footer',
            'frontend' => 'larablog::shared.footer',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Larablog third party Providers
    |--------------------------------------------------------------------------
    |
    | Is used to keep track of each provider used in Larablog package and
    | beeing able to publish their ressources later on.
    */

    'providers' => []
];
