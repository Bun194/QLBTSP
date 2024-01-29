<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit51b86da65bad94ccc3cb2ac82c9345a9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit51b86da65bad94ccc3cb2ac82c9345a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit51b86da65bad94ccc3cb2ac82c9345a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit51b86da65bad94ccc3cb2ac82c9345a9::$classMap;

        }, null, ClassLoader::class);
    }
}
