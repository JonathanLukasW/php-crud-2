<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit6a4d1419c52491f624eb8b2f5081b28a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit6a4d1419c52491f624eb8b2f5081b28a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit6a4d1419c52491f624eb8b2f5081b28a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit6a4d1419c52491f624eb8b2f5081b28a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
