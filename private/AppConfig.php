<?php
/**
 * Created by PhpStorm.
 * User: MRG
 * Date: 11/5/14 AD
 * Time: 4:36 PM
 */

$configs = array(
    "application" => array(
        "name" => "Agent 168",
        "title" => "Agent 168",
        "version" => "1.0",
        "base_url" => "http://localhost:81",
        "site_url" => "http://localhost:81",
        "share_url" => "http://agent168th.com",
        "directory" => dirname(__FILE__),
        "view" => "default"
    ),
    "route"=> array(
        "base_path"=> ""
    ),
    "crud" => array(
        "dbhost" => "localhost",
        "dbname" => "dev_agent_168",
        "dbuser" => "root",
        "dbpass" => "",
        "theme" => "bootstrap" , // can be 'default', 'bootstrap', 'minimal' or your custom. Theme of xCRUD visual presentation. For using bootstrap you need to load it on your page.
        "language" => "en" , // sets default localization
        "dbencoding"  => "utf8", // Your database encoding, default is 'utf8'. Do not change, if not sure.
        "db_time_zone" => "", // database time zone, if you want use system default - leave empty.
        "mbencoding" => "utf-8", // Your mb_string encoding, default is 'utf-8'. Do not change, if not sure.
    ),
    "db" => array(
        "mongodb" => array(
            "host" => "localhost",
            "name" => "",
            "user" => "",
            "password" => ""
        ),
        "mysql" => array(
            "host" => "localhost",
            "name" => "",
            "user" => "",
            "password" => ""
        ),
        "medoo" => array(
            "master"=> array(
                "database_type"=> "mysql",
                "database_name" => "dev_agent_168",
                "server" => "localhost",
                "username" => 'root',
                'password' => '',

                // optional
                'port' => 3306,
                'charset' => 'utf8',
                // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
                'option' => array(
                    \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                    \PDO::ATTR_EMULATE_PREPARES => false,
                    \PDO::ATTR_STRINGIFY_FETCHES => false
                )
            )
        )
    ),
    "apple_apn" => array(
        "development_file" => "",
        "development_link" => "",
        "distribution_file" => "",
        "distribution_link" => ""
    ),
    "android" => array(
        "key" => ""
    ),
    "olo" => array(
        "version" => "1.1"
    ) ,
    "views" => array(

    )
);

return $configs;
