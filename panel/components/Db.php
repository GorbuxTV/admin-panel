<?php

/* Подключение к базе данных */

class Db
{

    public static function getConnection()
    {
        //Подключение файла с параметрами БД
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        //Подключение к БД
        $mysqli = @new mysqli($params['host'], $params['user'], $params['password'], $params['db_name']);
        if ($mysqli->connect_errno) exit('Ошибка соединения с базой данных');
        $mysqli->set_charset('utf8');

        return $mysqli;
    }

}

?>