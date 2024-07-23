<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            // 'title'        => "It's Over 9000!", // set false to total remove
            'title'        => "Hạt Giống Giá Rẻ", // set false to total remove
            // 'title'        => false, // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Hạt giống giá rẻ nhà cung cấp hạt giống chất lượng, giá cả phải chăng, giao hàng trên toàn quốc', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['hạt giống rau', 'hạt giống hoa', 'hạt giống cỏ sân vườn','hạt giống cây ăn trái','hạt giống dễ trồng','hạt giống giá rẻ','hạt giống giá sỉ','cung cấp hạt giống'],
            //'canonical'    => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'canonical'    => "full", // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Hạt Giống Giá Rẻ', // set false to total remove
            'description' => 'Hạt giống giá rẻ nhà cung cấp hạt giống chất lượng, giá cả phải chăng, giao hàng trên toàn quốc', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Hạt Giống Giá Rẻ', // set false to total remove
            'description' => 'Hạt giống giá rẻ nhà cung cấp hạt giống chất lượng, giá cả phải chăng, giao hàng trên toàn quốc', // set false to total remove
            'url'         => 'full', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
