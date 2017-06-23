<?php

class Settings {
    
    protected static $_instance;

    public static final function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getSettings() {
        return simplexml_load_file(__DIR__ . '/SETTINGS.xml');
    }

    public function getRoot() {
        return $this->getSettings()->root;
    }
    
    public function getTable($tablename = "") {
        if ($tablename == "") {
            return $this->getSettings()->DBMS->tables;
        } else {
            foreach ($this->getSettings()->DBMS->tables as $table) {
                if($table->attributes()['ref'] == $tablename) {
                    return $table;
                }
            }
        }
    }

}
