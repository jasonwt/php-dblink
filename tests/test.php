<?php

    declare(strict_types=1);

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once(__DIR__ . "/classes/TestDatabaseLink.php");
    require_once(__DIR__ . "/classes/TestDatabaseResults.php");

    $dbLink = new TestDatabaseLink();
    $dbLink->Connect("hostname", "username", "password", "database", ($port = 0), "socket");

    $testQueries = [
        "SELECT * FROM users",
        "SELECT COUNT(users.id) AS useridcount FROM users"
    ];

    foreach ($testQueries as $query) {
        echo "\nQuery: $query\n";
        if (is_null($results = $dbLink->Query($query))) {
            for ($cnt = 0; $cnt < count($dbLink->Errors()); $cnt ++)
                echo "\nError [" . $dbLink->Errno($cnt) . "]: " . $dbLink->Error($cnt);
        } else {
            while ($row = $results->FetchAssoc())
                print_r($row);        
        }
    }
?>