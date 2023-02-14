<?php

session_start();

$originalWord = $_POST['word'];
$word = strtolower(($originalWord));
$wordArray = str_split($word);

# Is it a palindrome?

$alphaWord = [];

$alphabet = 'abcdefghijklmnopqrstuvwxyz';
$alphabetArray = str_split($alphabet);

// Look at each character in the word; if it's in the alphabet, add it to a new $alphaWord array.
for ($i = 0; $i < strlen($word); $i++) {
    if (array_search($wordArray[$i], $alphabetArray)) {
        array_push($alphaWord, $wordArray[$i]);
    };
};

// Determine if the new $alphaWord array is a palindrome.
$isPalindrome = $alphaWord == array_reverse($alphaWord);
    
# How many vowels in the word?

$vowelCount = 0;

$vowels = ['a', 'e', 'i', 'o', 'u'];

$vowelsLength = count($vowels);

for ($i = 0; $i < $vowelsLength; $i++) {
    $vowelCount = $vowelCount + substr_count($word, $vowels[$i]);
}


$_SESSION['results'] = [
    'originalWord' => $originalWord,
    'alphaWord' => $alphaWord,
    'isPalindrome' => $isPalindrome,
    'vowelCount' => $vowelCount
];

# Redirect
header('Location: index.php');