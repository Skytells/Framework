<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd1a02d72f8a3498648d6de2887210386
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '9397d6162da51345cb5233170ea586e9' => __DIR__ . '/..' . '/skytells/support/helpers.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Translation\\' => 30,
            'Symfony\\Component\\Finder\\' => 25,
            'Symfony\\Component\\Debug\\' => 24,
            'Skytells\\View\\' => 14,
            'Skytells\\Translation\\' => 21,
            'Skytells\\Support\\' => 17,
            'Skytells\\Filesystem\\' => 20,
            'Skytells\\Events\\' => 16,
            'Skytells\\Database\\' => 18,
            'Skytells\\Contracts\\' => 19,
            'Skytells\\Container\\' => 19,
            'Skytells\\Cache\\' => 15,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'I' => 
        array (
            'IntelliSense\\' => 13,
        ),
        'C' => 
        array (
            'Carbon\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Symfony\\Component\\Debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/debug',
        ),
        'Skytells\\View\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/view',
        ),
        'Skytells\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/translation',
        ),
        'Skytells\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/support',
        ),
        'Skytells\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/filesystem',
        ),
        'Skytells\\Events\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/events',
        ),
        'Skytells\\Database\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/database',
        ),
        'Skytells\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/contracts',
        ),
        'Skytells\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/container',
        ),
        'Skytells\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/skytells/cache',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'IntelliSense\\' => 
        array (
            0 => __DIR__ . '/..' . '/IntelliSense',
        ),
        'Carbon\\' => 
        array (
            0 => __DIR__ . '/..' . '/nesbot/carbon/src/Carbon',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Doctrine\\Common\\Inflector\\' => 
            array (
                0 => __DIR__ . '/..' . '/doctrine/inflector/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd1a02d72f8a3498648d6de2887210386::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd1a02d72f8a3498648d6de2887210386::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd1a02d72f8a3498648d6de2887210386::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
