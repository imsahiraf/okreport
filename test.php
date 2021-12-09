<?php 
$array  = array("dog", "rabbit", "horse", "rat", "cat");
$x = 1;
$length = count($array);

foreach($array as $animal){
    if($x === 1){
        //first item
        echo $animal; // output: dog
    }else if($x === $length){
        echo $animal; // output: cat
    }
    $x++;
}
?>