<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda807e99d0a81769a3b42ae89d3c5030
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitda807e99d0a81769a3b42ae89d3c5030::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda807e99d0a81769a3b42ae89d3c5030::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda807e99d0a81769a3b42ae89d3c5030::$classMap;

        }, null, ClassLoader::class);
    }
}
