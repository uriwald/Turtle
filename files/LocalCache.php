<?php

namespace Cache;

class LocalCache
{
    /**
     * Constructor (defines a basic set of local storage JavaScript functions)
     */
    public function __construct()
    {
        $js = <<<JAVASCRIPT
        <script>
        if ('localStorage' in window && window['localStorage'] !== null) {
            function set(key, data) {
                localStorage.setItem(key, data);
            }
            var gett = function get(key) {
                //return localStorage.getItem(key);
                return window['localStorage'][key];
            }
            
            function remove(key) {
                localStorage.removeItem(key);
            }
            function clear() {
                localStorage.clear();
            }
        }
        </script>
JAVASCRIPT;
        echo $js;
    }
    
    /**
     * Save an item to the local storage
     */ 
    public function set($key, $data)
    {
        if (!is_string($key) || !is_string($data)) {
            throw new LocalCacheException('The supplied key and data for the set() method must be strings.');   
        }   
       // echo '<script>set('' . $key . '',' . ''' . $data . '');</script>' . "n";
        echo "<script>set('' . $key . '',' . ''' . $data . '');</script>". "n";
        return $this; 
    }
    
    /**
     * Get an item from the local storage (basic implementation)
     */ 
    public function get($key)
    {
       // echo window.gett(" . $key . ");;
        if (!is_string($key)) {
            throw new LocalCacheException('The supplied key for the get() method must be a string.');  
        }
       // echo '<script>get($key);</script>' . "end of get";
        
        echo '<script>window.gett("' . $key . '");</script> ' . "n";

        
    }
    
    /**
     * Remove an item from the local storage
     */ 
    public function delete($key)
    {
        if (!is_string($key)) {
            throw new LocalCacheException('The supplied key for the delete() method must be a string.');      
        }
        echo "<script>remove('' . $key . '');</script>" . "n";
    }
    
    /**
     * Clear the local storage
     */ 
    public function clear()
    {
        echo '<script>clear();</script>' . "n";
    }              
}


?>