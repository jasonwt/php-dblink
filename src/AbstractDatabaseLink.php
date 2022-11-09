<?php
    declare(strict_types=1);
    
    namespace dblink;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    require_once(__DIR__ . "/interfaces/DatabaseLinkInterface.php");
    require_once(__DIR__ . "/traits/ErrorsTrait.php");

    use dblink\interfaces\DatabaseLinkInterface; 
    use dblink\traits\ErrorsTrait;   

    abstract class AbstractDatabaseLink implements DatabaseLinkInterface {
        use ErrorsTrait;

        protected int $errno = 0;
        protected array $errnoDescriptionsArray = array();
    }
    
?>