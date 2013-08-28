<?php

class loadFiles {
    
    protected $root; 
    protected $env;
    protected $addr;
    public function __construct($root , $env , $address)  
     {
            $this->root = $root; 
            $this->env  = $env;
            $this->addr = $root . $address;

     }  
    public function loadFiles(){}

}
?>