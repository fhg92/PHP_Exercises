<?php

class ThisIsAIterator implements Iterator
{   
    private $countries = ['Japan', 'China', 'Thailand', 'India'];
    
    private $position = 0;
    
    public function __construct() {
        $this->position = 0;
    }

    public function current() {
        return $this->countries[$this->position];
    }
    
    public function next() {
        ++$this->position;
    }
    
    public function rewind() {
        $this->position = 0;
    }

    public function key() {
        return $this->position;
    }

    public function valid() {
        return isset($this->countries[$this->position]);
    }
}

$obj = new ThisIsAIterator;

foreach($obj as $key => $value) {
    var_dump($key, $value);
    echo PHP_EOL;
}

?>