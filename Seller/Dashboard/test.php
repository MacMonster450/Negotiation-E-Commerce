<?php
$sentence = "This is a sample sentence to demonstrate the splitting of words into groups of three.";

$words = explode(" ", $sentence);

$newSentence = '';

$count = count($words);
for ($i = 0; $i < $count; $i++) {
    $newSentence .= $words[$i] . " ";
    
    if (($i + 1) % 3 == 0) {
        // Add a line break
        $newSentence .= "<br>";
    }
}

echo $newSentence;
?>
