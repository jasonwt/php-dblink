<?php
    declare(strict_types=1);
    
    namespace pctlib\dblink\interfaces;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once(__DIR__ . "/../enums/DatabaseResultsFetchMode.php");

    require_once(__DIR__ . "/DatabaseLinkInterface.php");

    use pctlib\dblink\enums\DatabaseResultsFetchMode;
            
    interface DatabaseResultsInterface {
        public function NumRows() : string;
        
        public function FetchAll(?DatabaseResultsFetchMode $mode = null) : ?array;
        public function FetchArray(?DatabaseResultsFetchMode $mode = null) :?array;
        public function FetchAssoc() : ?array;
        public function FetchRow() : ?array;
        public function FetchObject(string $className, array $constructorArguments = []);
        
    }
?>