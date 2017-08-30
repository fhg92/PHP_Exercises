<?php

class ThisIsASeekableIterator implements SeekableIterator
{   
    private $countries = ['Japan', 'China', 'Thailand', 'India'];
    
    private $position = 0;
    
    public function __construct() {
        $this->position = 0;
    }

    public function seek($position) {
        // If position not found throw exception.
        if(!isset($this->countries[$position])) {
            throw new OutOfBoundsException("Position $position doesn't exist 
            in array.");
        }
        $this->position = $position;
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

try {
    
    $seek = new ThisIsASeekableIterator;
    echo $seek->current().'<br>'.PHP_EOL;
    
    $seek->seek(2);
    echo $seek->current().'<br>'.PHP_EOL;
    
    $seek->seek(1);
    echo $seek->current().'<br>'.PHP_EOL;

    //Testing not existing position:
    $seek->seek(6);
    
} catch(OutOfBoundsException $e) {
    echo $e->getMessage();
}

?>