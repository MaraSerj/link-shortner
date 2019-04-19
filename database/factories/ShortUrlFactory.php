<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ShortUrl;
use Faker\Generator as Faker;

$factory->define(ShortUrl::class, function (Faker $faker) {
    return [
        'slug' => \Illuminate\Support\Str::random(config('app.slug_length')),
        'link' => 'https://www.google.com/search?biw=1920&bih=929&tbm=isch&sa=1&ei=6825XMaxBJPamwXhz52oBA&q=url&oq=url&gs_l=img.3..0l10.913.4022..4241...1.0..0.86.251.3......1....1..gws-wiz-img.......0i5i30j0i30j0i24j35i39j0i8i30.9A-QnKY8tHA',
    ];
});
