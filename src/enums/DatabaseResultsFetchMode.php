<?php
    declare(strict_types=1);
    
    namespace pctlib\dblink\enums;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once("vendor/autoload.php");

    use pctlib\enums\Enum;

    class DatabaseResultsFetchMode extends Enum {       
        static public function NUM()   {return static::__callStatic("NUM", array());}
        static public function ASSOC() {return static::__callStatic("ASSOC", array());}
        static public function BOTH()  {return static::__callStatic("BOTH", array());}     
        static protected function EnumElements() : array {
            return ["NUM", "ASSOC", "BOTH"];
        }
    };
?>
