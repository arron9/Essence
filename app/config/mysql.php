<?php
return array(
    'dev' => array(
        'admin' => array(
            'host'		=> '127.0.0.1',
            'username'	=> 'root',
            'password'	=> '123456',
            'dbname'	=> 'admin',
            'charset'	=> 'utf8',
            'persistent'=> true,
            "options"  => array(
                \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
            )
        ),
    )
);
 
