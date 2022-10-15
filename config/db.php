<?php

class Database{

    public static function connect(){
        $databasename='konecta_db';
        $user='root';
        $password='';

        $db=new mysqli('localhost',$user,$password,$databasename);
        $db->query("SET NAMES 'UTF8'");
        return $db;
    }

}