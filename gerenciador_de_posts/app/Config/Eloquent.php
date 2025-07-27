<?php

namespace Config;

use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent
{
    public static function start()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'blog_db',
            'username'  => 'root',
            'password'  => '', 
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
