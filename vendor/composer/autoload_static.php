<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit373d959e0d9ba00bdd0bfdb7568f2831
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'eftec\\bladeone\\' => 15,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'eftec\\bladeone\\' => 
        array (
            0 => __DIR__ . '/..' . '/eftec/bladeone/lib',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit373d959e0d9ba00bdd0bfdb7568f2831::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit373d959e0d9ba00bdd0bfdb7568f2831::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
