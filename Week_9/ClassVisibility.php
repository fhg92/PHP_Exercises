<?php

class Visibility
{
    public function testPublic()
    {
        echo 'Public<br>';
    }
    
    protected function testProtected()
    {
        echo 'Protected<br>';
    }

    private function testPrivate()
    {
        echo 'Private<br>';
    }
    
    final function testFinal()
    {
        echo 'Final<br>';
    }
}

$test = new Visibility();
$test->testPublic();
//$test->testProtected();
//$test->testPrivate();
$test->testFinal();

?>