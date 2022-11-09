<?php
    declare(strict_types=1);
    
    namespace pctlib\dblink\traits;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    trait ErrorsTrait {
        protected $errors = [];

        static public function GetDebugString() {
            $debugString = "";

            for ($cnt = 0; $cnt < count(func_get_args()); $cnt ++)
                $debugString .= print_r(func_get_args()[$cnt], true);

            $debugString .= "\n\nStack trace:\n";

            for ($cnt = 2; $cnt < count(debug_backtrace()); $cnt ++) {
                $debugString .= 
                    "#" . ($cnt-2) . " " . 
                    debug_backtrace()[$cnt]["file"] . "(" . debug_backtrace()[$cnt]["line"] . "): " .                 
                    (isset(debug_backtrace()[$cnt]["class"]) ? debug_backtrace()[$cnt]["class"] . "::" : "") .                
                    debug_backtrace()[$cnt]["function"] . "()\n";
            }

            return $debugString . "\n";
        }
//
        static protected function Die(string $message) {
            die ($message . self::GetDebugString());
        }
//        
        public function Error(int $index = 0) : string {
            if (count($this->errors) == 0)
                return "";

            return $this->errors[max(0, min($index, count($this->errors)))]["error"];
        }
//
        public function Errno(int $index = 0) : string {
            if (count($this->errors) == 0)
                return "";

            return $this->errors[max(0, min($index, count($this->errors)))]["errno"];
        }
//
        public function Errors() : array {
            return $this->errors;
        }
//
        protected function AddError(string $errno, string $error) {            
            if ($errno != "")
                $this->errors[] = ["errno" => $errno, "error" => $error . self::GetDebugString()];
        }
//
        protected function ClearErrors() {
            $this->errors = [];            
        }
//
        
    }   
?>