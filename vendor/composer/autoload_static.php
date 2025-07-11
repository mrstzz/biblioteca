<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb585beec1219f590a7030283df1b6538
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb585beec1219f590a7030283df1b6538::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb585beec1219f590a7030283df1b6538::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb585beec1219f590a7030283df1b6538::$classMap;

        }, null, ClassLoader::class);
    }
}
