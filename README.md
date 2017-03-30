# Larablog

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

A minimal and simple blog package for your laravel project.

## Install

You can install the package via Composer:

``` bash
$ composer require naoray/larablog
```

Now add the service provider in config/app.php file:

``` php
'providers' => [
    // ...
    Naoray\Larablog\LarablogServiceProvider::class,
];
```

You can publish migration with:

```bash
$ php artisan vendor:publish --provider="Naoray\Larablog\LarablogServiceProvider" --tag="migrations"
```

After the migration has been published you can create the posts-table by running the migrations:

```bash
$ php artisan migrate
```

Publish the assets with:

```bash
$ php artisan vendor:publish --provider="Naoray\Larablog\LarablogServiceProvider" --tag="public"
```

You can publish the config-file with:

```bash
$ php artisan vendor:publish --provider="Naoray\Larablog\LarablogServiceProvider" --tag="config"
```

This is the contents of the published config/larablog.php config file:

```php
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
];
```

## Usage

If you haven't already created the laravel out-of-the-box authentification, do it now:

```bash
$ php artisan make:auth
```

Browse to your app, register as a user and enter `/admin/posts`, after your base url, into your browser address bar.

*Note:* You can change the routes in the config file to whatever route you like.

Click on "create Post" to create your first blog post.

After creating your Post and publishing it, all your website visitors can view them under `/blog`. You may also change this route in the `larablog`-configs.

## Themes

By default the [larablog-default-theme](https://github.com/naoray/larablog-default-theme) is used. You may change the layout, customize it or even build your own to whatever you want.

### Customize Existing Theme

You can publish views with:

```bash
$ php artisan vendor:publish --provider="Naoray\Larablog\LarablogServiceProvider" --tag="views"
```

Got to `resources/views/vendor/larablog` and customize the views as you like.

### Adding Own Themes

You may develop your own package like the [default one](https://github.com/naoray/larablog-default-theme). Just take a look at the defaults-theme-repo and you'll get an idea of how to develop your own themes.

After publishing your package just require it via composer in your project and change the `theme` - config in the `conifg/larablog` config file to `your_github_name/package_name`.

## Using 3rd Party Role/Permission Packages

In this package the Laravel build in authorization Gates are used to determine if the current user is allowed to update/delete or view a post. If you want to use roles/permissions instead, you could use [Spatie\laravel-permission](https://github.com/spatie/laravel-permission). Just make sure you create the permissions (located in the PermissionRegistrar file):

- view posts
- edit post
- delete post

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

Currently there are no tests to cover the code. Tests will be added soon.

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email krishan.koenig@googlemail.com instead of using the issue tracker.

## Credits

- [Naoray](https://github.com/Naoray)
- [All Contributors](https://github.com/Naoray/larablog/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/naoray/larablog.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/naoray/larablog.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/naoray/larablog
[link-downloads]: https://packagist.org/packages/naoray/larablog
[link-author]: https://github.com/naoray
[link-contributors]: ../../contributors