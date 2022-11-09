<?php
    declare(strict_types=1);
    
    namespace pctlib\dblink;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once(__DIR__ . "/interfaces/DatabaseResultsInterface.php");

    use pctlib\dblink\enums\DatabaseResultsFetchMode;
    use pctlib\dblink\interfaces\DatabaseResultsInterface;

    abstract class AbstractDatabaseResults implements DatabaseResultsInterface {
//                        
        public function FetchArray(?DatabaseResultsFetchMode $mode = null) : ?array {
            if (is_null($mode))
                $mode = DatabaseResultsFetchMode::BOTH();
                
            if (is_null($row = $this->FetchAssoc()))
                return null;

//                if ($row === false)
//                  return false;

            $resultsArray = array();

            foreach ($row as $k => $v) {
                if ($mode == DatabaseResultsFetchMode::NUM() || $mode == DatabaseResultsFetchMode::BOTH())
                    $resultsArray[] = $v;

                if ($mode == DatabaseResultsFetchMode::ASSOC() || $mode == DatabaseResultsFetchMode::BOTH())
                    $resultsArray[$k] = $v;
            }

            return $resultsArray;                    
        }
//
        public function FetchAll(?DatabaseResultsFetchMode $mode = null) : ?array {
            $resultsArray = array();

            while ($row = $this->FetchArray($mode)) {
//                if ($row === false)
//                    break;

                $resultsArray[] = $row;
            }

            if (is_null($row))
                return $resultsArray;
            
            return null;                
        }
//
        public function FetchObject(string $className, array $constructorArguments = []) {
            if (is_null($row = $this->FetchAssoc()))
                return null;

//            if ($row === false)
//                return false;

            return new $className($constructorArguments);
        }           
        
        public function FetchRow() : ?array {
            if (is_null($row = $this->FetchAssoc()))
                return null;

//            if ($row === false)
  //              return false;

            return array_values($row);                
        }
    }
?>