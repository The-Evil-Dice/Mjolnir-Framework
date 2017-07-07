<?php
class Additional_Functions {

    protected static $_instance;

    public static final function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    //Include system specific functions here!
}