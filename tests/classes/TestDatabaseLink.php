<?php
    declare(strict_types=1);
        
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    require_once(__DIR__ . "/../../src/AbstractDatabaseLink.php");        
    require_once(__DIR__ . "/../../src/enums/DatabaseQueryResultsMode.php");

    require_once(__DIR__ . "/TestDatabaseResults.php");

    use dblink\enums\DatabaseQueryResultsMode;
    use dblink\AbstractDatabaseLink;
    
    class TestDatabaseLink extends AbstractDatabaseLink {
        protected int $currentId = 0;
        protected int $affectedRows = 0;
        protected int $numRows = 0;

        public function Connect(string $hostName, string $userName, string $password, string $database, int $port, string $socket): bool { 
            return true;
        }

        public function IsConnected(): bool { 
            return true;
        }

        public function SelectDatabase(string $databaseName): bool { 
            return true;
        }

        public function Close(): bool { 
            return true;
        }

        public function EscapeString(string $str): string { 
            return $str;
        }

        public function InsertId(): string { 
            $this->currentId ++;

            return strval($this->currentId);
        }

        public function AffectedRows(): string { 
            return strval($this->affectedRows);
        }

        public function Query(string $query, ?DatabaseQueryResultsMode $resultsMode = null) : ?TestDatabaseResults { 
            if ($query != "SELECT * FROM users") {
                $this->AddError("TestDatabaseLink:Query", "Only supported query is 'SELECT * FROM users'");
                return null;
            }

            return new TestDatabaseResults();
        }
    }
?>