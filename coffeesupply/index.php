<?php 

function addToFile($nameOfFile, $content) {
  $fp = fopen($nameOfFile, 'a');//opens file in append mode  
  fwrite($fp, $content . "\n");  
  fclose($fp);
  echo "<br/>" . "Coffee type appended successfully." . "<br/>";
}

function addSupply($coffeeType) {
  addToFile("supply.txt", $coffeeType);
}
?>
<?php
function viewAllSupply($coffeeType) {
  
  // Read in the file -> returns a string that represents file contents
  $content = file_get_contents("supply.txt");
  
  // turn the string contents into an array explode()
  $contentsAsList = explode("\n", $content);

  // loop through the array and keep track of how many times we see something
  $counter = 0;

  // --write loop that goes through $contentsAsList--
  foreach ($contentsAsList as $index => $value) {
    // -- if(element ===$coffeeType)
    if ($value === $coffeeType){
      // --increment our $counter ($counter++)
      $counter++;     
    }
  }
  return $counter;
}

function main($coffeeType) {
  print("The total number of " . "$coffeeType" . " in the supply: " . viewAllSupply("$coffeeType"));
  addSupply($coffeeType);
  print("The total number of " . "$coffeeType" . " in the supply: " . viewAllSupply("$coffeeType"));
  print("<br/>" . "Program is completed.");  
}

main("blonde");
?>