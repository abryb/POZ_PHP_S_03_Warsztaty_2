<?php

abstract class activeRecord implements activeRecordInterface {
    
    protected $id;
    protected static $db;
    
    public function __construct() {
        self::connect();
        $this->id = -1;
    }
    
    public static function connect() {
        if(!self::$db){
            self::$db = new db();
            self::$db->changeDB('twitter');
        }
        return true; // Czy to tak ma być, a co jak nieuda się stworzenie obiektu db?
    }
    
    public function save(){}
}