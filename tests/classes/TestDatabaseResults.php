<?php
    declare(strict_types=1);
    
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once(__DIR__ . "/../../src/AbstractDatabaseResults.php");        

    use dblink\enums\DatabaseResultsFetchMode;
    use dblink\AbstractDatabaseResults;

    class TestDatabaseResults extends AbstractDatabaseResults {
        protected $resultsArray = [];
        protected $resultsArrayIndex = 0;

        public function __construct(int $minResults = 0, int $maxResults = 1000) {
            $minResults = max($minResults, 0);
            $maxResults = max($minResults, $maxResults);

            $firstNamesArray = [
                "John", "Jill", "Tom", "Bob", "Stacy", "Peyton","Payton","Sarah","Steve","Bill",
                "Roger","Savannah","Shane","Diane","Richard","Georga","Jenny","Angie","Stacey","Beth","Cathy",
                "Donna","Ed","Frank","Harry","Ian","Jason","Jerry","Larry","Mary","Matt","Misty",
                "Mack", "Jimmy", "Ted", "Dave", "Kyle", "Ken", "Ryan", "Nancy", "Manny", "Mable", 
                "Oscar", "Olivia", "Peter", "Amy", "Pepper", "Randy", "Ralf", "Robert", "Brent", "Sam", 
                "Stella", "Tim", "Terry", "James", "Robin", "Kevin", "Joe", "Joel", "Jessy", "Cole"
            ];

            $lastNamesArray = [
                "Rogers", "Gates", "Musk", "Thomas", "Thompson", "Craig", "Huard", "Wilson", "Smith", "Jones", 
                "Niles", "Kilpatrick", "James", "Griffey", "Ryan", "Brady", "Kissling", "Hope", "Diaz", "Bullard", 
                "Rosser", "Johnson", "Jefferson", "Washington", "Adams", "Madison", "Tylor", "Polk", "Taylor", "Grant", 
                "Filmore", "Bush", "Musk", "Clinton", "Biden", "Parks", "Roe", "Wade", "Hilton", "Dove"
            ];

            for ($cnt = 0; $cnt < random_int($minResults, $maxResults); $cnt ++) {
                $this->resultsArray["users"][$cnt] = [
                    "id" => $cnt,
                    "age" => random_int(3, 97),
                    "firstName" => $firstNamesArray[random_int(0, count($firstNamesArray)-1)],
                    "lastName" => $lastNamesArray[random_int(0, count($lastNamesArray)-1)],
                ];
            }
        }

        public function NumRows(): string { 
            return strval(count($this->resultsArray["users"]));
        }

        public function FetchAssoc() : ?array { 
            if ($this->resultsArrayIndex >= count($this->resultsArray["users"])) {
                $this->resultsArray["users"] = [];
                $this->resultsArrayIndex = 0;
                return null;
            }

            $this->resultsArrayIndex ++;

            return $this->resultsArray["users"][$this->resultsArrayIndex-1];
        }
    }

?>