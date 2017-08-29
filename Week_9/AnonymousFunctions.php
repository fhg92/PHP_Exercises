<?php

// By the tutorial of http://www.elated.com/articles/php-anonymous-functions/

// Declare a basic anonymous function
// (not much use on its own!)
function( $name, $timeOfDay ) {
  return ( "Good $timeOfDay, $name!" );
};

// Assign an anonymous function to a variable
$makeGreeting = function( $name, $timeOfDay ) {
  return ( "Good $timeOfDay, $name!" );
};

// Call the anonymous function
echo $makeGreeting( "Fred", "morning" ) . "<br>";
echo $makeGreeting( "Mary", "afternoon" ) . "<br>";

// Store 3 anonymous functions in an array
$luckyDip = array(
 
  function() {
    echo "You got a bag of toffees!";
  },
 
  function() {
    echo "You got a toy car!";
  },
 
  function() {
    echo "You got some balloons!";
  }
);

// Call a random function
$choice = rand( 0, 2 );
$luckyDip[$choice]();

// Create a regular callback function...
function nameToGreeting( $name ) {
  return "Hello " . ucfirst( $name ) . "!";
}
 
// ...then map the callback function to elements in an array.
$names = array( "fred", "mary", "sally" );
print_r( array_map( nameToGreeting, $names ) );

// A neater way:
// Map an anonymous callback function to elements in an array.
print_r ( array_map( function( $name ) {
  return "Hello " . ucfirst( $name ) . "!";
}, $names ) );

$people = array(
  array( "name" => "Fred", "age" => 39 ),
  array( "name" => "Sally", "age" => 23 ),
  array( "name" => "Mary", "age" => 46 )
);

usort( $people, function( $personA, $personB ) {
  return ( $personA["age"] < $personB["age"] ) ? -1 : 1;
} );
 
print_r( $people );

// A simple example of a closure
 
function getGreetingFunction() {
 
  $timeOfDay = "morning";
 
  return ( function( $name ) use ( &$timeOfDay ) {
    $timeOfDay = ucfirst( $timeOfDay ); 
    return ( "Good $timeOfDay, $name!" );
  } );
};
 
$greetingFunction = getGreetingFunction();
echo $greetingFunction( "Fred" ); // Displays "Good Morning, Fred!"

$people = array(
  array( "name" => "Fred", "age" => 39 ),
  array( "name" => "Sally", "age" => 23 ),
  array( "name" => "Mary", "age" => 46 )
);
 
function getSortFunction( $sortKey ) {
  return function( $personA, $personB ) use ( $sortKey ) {
    return ( $personA[$sortKey] < $personB[$sortKey] ) ? -1 : 1;
  };
}
 
echo "Sorted by name:<br><br>";
usort( $people, getSortFunction( "name" ) );
print_r( $people );
echo "<br>";
 
echo "Sorted by age:<br><br>";
usort( $people, getSortFunction( "age" ) );
print_r( $people );
echo "<br>";

?>