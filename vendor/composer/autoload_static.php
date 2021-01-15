<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit298462a792725687fb7ecd99b1234c51
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WilcityListingProExportImport\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WilcityListingProExportImport\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit298462a792725687fb7ecd99b1234c51::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit298462a792725687fb7ecd99b1234c51::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit298462a792725687fb7ecd99b1234c51::$classMap;

        }, null, ClassLoader::class);
    }
}
