<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b0dd7618b36b029d1d22d1ffc6e087e
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b0dd7618b36b029d1d22d1ffc6e087e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b0dd7618b36b029d1d22d1ffc6e087e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2b0dd7618b36b029d1d22d1ffc6e087e::$classMap;

        }, null, ClassLoader::class);
    }
}
