<?php
    declare(strict_types=1);
    
    namespace dblink\interfaces;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    require_once(__DIR__ . "/../enums/DatabaseQueryResultsMode.php");
    
    require_once(__DIR__ . "/DatabaseResultsInterface.php");  
    
    use dblink\enums\DatabaseQueryResultsMode;
    
    const DATABASE_ERRNO_NOT_CONNECTED = -1;
    const DATABASE_ERRNO_SELECT_DATABASE_FAILED = -2;

    interface DatabaseLinkInterface {
        public function Errno(int $index = 0) : string;            
        public function Error(int $index = 0) : string;
        public function Errors() : array;

        public function Connect(string $hostName, string $userName, string $password, string $database, int $port, string $socket) : bool;
        public function IsConnected() : bool;
        public function SelectDatabase(string $databaseName) : bool;
        public function Close() : bool;

        public function EscapeString(string $str) : string;
        public function InsertId() : string;
        public function AffectedRows() : string;

        public function Query(string $query, ?DatabaseQueryResultsMode $resultsMode = null) : ?DatabaseResultsInterface;
    }
    
?>