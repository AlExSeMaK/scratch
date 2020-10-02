<?php


class DB
{
    private const HOST = 'localhost';
    private const DBNAME = 'test';
    private const USERNAME = 'root';
    private const PASSWORD = 'root';
    private const COD_ERROR = 0;


    public static function query(){
        try{
            return  new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME, self::USERNAME, self::PASSWORD);
        }
        catch (PDOException $e){
            var_dump("Error: ".$e->getMessage());
            return self::COD_ERROR;
        }

    }
}