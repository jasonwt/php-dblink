<?php
    declare(strict_types=1);
    
    namespace pctlib\dblink\enums;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once(__DIR__ . "/../../vendor/autoload.php");

    use pctlib\enums\Enum;
    
    class DatabaseQueryResultsMode extends Enum {
        public static function STORE_RESULTS() {return static::__callStatic("STORE_RESULTS");}
        public static function USE_RESULTS()   {return static::__callStatic("USE_RESULTS");}
        public static function ASYNC()         {return static::__callStatic("ASYNC");}

        protected static function EnumElements(): array { 
            return ["STORE_RESULTS", "USE_RESULTS", "ASYNC"];
        }
    };    
?>