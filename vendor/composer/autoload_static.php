<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5bd5f4aad99542050be3161c1aaa2658
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Masudrana\\Wpdocker\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Masudrana\\Wpdocker\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Masudrana\\Wpdocker\\Admin\\AdminSettings' => __DIR__ . '/../..' . '/includes/Admin/AdminSettings.php',
        'Masudrana\\Wpdocker\\Admin\\Ajax' => __DIR__ . '/../..' . '/includes/Admin/Ajax.php',
        'Masudrana\\Wpdocker\\PostType' => __DIR__ . '/../..' . '/includes/PostType.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5bd5f4aad99542050be3161c1aaa2658::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5bd5f4aad99542050be3161c1aaa2658::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5bd5f4aad99542050be3161c1aaa2658::$classMap;

        }, null, ClassLoader::class);
    }
}