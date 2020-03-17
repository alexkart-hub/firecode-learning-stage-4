<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2539cd05ac11f3378a73c89956f85a1
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static $classMap = array (
        'app\\classes\\Pagination' => __DIR__ . '/../..' . '/application/classes/pagination.php',
        'app\\classes\\Parser' => __DIR__ . '/../..' . '/application/classes/parser.php',
        'app\\classes\\Product' => __DIR__ . '/../..' . '/application/classes/product.php',
        'app\\classes\\Singleton' => __DIR__ . '/../..' . '/application/classes/singleton.php',
        'app\\classes\\db\\A_Db' => __DIR__ . '/../..' . '/application/classes/db/a_db.php',
        'app\\classes\\db\\Db' => __DIR__ . '/../..' . '/application/classes/db/db.php',
        'app\\classes\\db\\DbMysqli' => __DIR__ . '/../..' . '/application/classes/db/dbmysqli.php',
        'app\\controllers\\Controller_404' => __DIR__ . '/../..' . '/application/controllers/controller_404.php',
        'app\\controllers\\Controller_Cart' => __DIR__ . '/../..' . '/application/controllers/controller_cart.php',
        'app\\controllers\\Controller_Category' => __DIR__ . '/../..' . '/application/controllers/controller_category.php',
        'app\\controllers\\Controller_Main' => __DIR__ . '/../..' . '/application/controllers/controller_main.php',
        'app\\controllers\\Controller_Parser' => __DIR__ . '/../..' . '/application/controllers/controller_parser.php',
        'app\\controllers\\Controller_Product' => __DIR__ . '/../..' . '/application/controllers/controller_product.php',
        'app\\core\\Controller' => __DIR__ . '/../..' . '/application/Core/controller.php',
        'app\\core\\Model' => __DIR__ . '/../..' . '/application/Core/Model.php',
        'app\\core\\Route' => __DIR__ . '/../..' . '/application/Core/Route.php',
        'app\\core\\View' => __DIR__ . '/../..' . '/application/Core/View.php',
        'app\\models\\Model_Cart' => __DIR__ . '/../..' . '/application/Models/model_cart.php',
        'app\\models\\Model_Category' => __DIR__ . '/../..' . '/application/Models/model_category.php',
        'app\\models\\Model_Main' => __DIR__ . '/../..' . '/application/Models/model_main.php',
        'app\\models\\Model_Product' => __DIR__ . '/../..' . '/application/Models/model_product.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2539cd05ac11f3378a73c89956f85a1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2539cd05ac11f3378a73c89956f85a1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2539cd05ac11f3378a73c89956f85a1::$classMap;

        }, null, ClassLoader::class);
    }
}
