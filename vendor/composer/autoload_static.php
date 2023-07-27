<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4cce4aaf87f9b20fcb10968d8cac1bc4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\ImageCrud\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\ImageCrud\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4cce4aaf87f9b20fcb10968d8cac1bc4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4cce4aaf87f9b20fcb10968d8cac1bc4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4cce4aaf87f9b20fcb10968d8cac1bc4::$classMap;

        }, null, ClassLoader::class);
    }
}