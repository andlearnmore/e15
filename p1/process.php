<?php

session_start();

$ogWord = $_POST['word'];
$arrayWord = str_split(strtolower($ogWord));
# TO DO: input algorithm for finding if it's a palindrome.
# Remember: (1) make case-sensitive (2) ignore non-alphabetic
$isPalindrome = $arrayWord;

# TODO: input algorithm for counting vowels
// substr_count — Count the number of substring occurrences
// in_array(mixed $needle, array $haystack, bool $strict = false): bool
// str_split(string $string, int $length = 1): array
$vowelCount = 0;

$vowels = ['a', 'e', 'i', 'o', 'u' ];
$vowelCount = in_array($vowels, $arrayWord);


$_SESSION['results'] = [
    'ogWord' => $ogWord,
    'arrayWord' => $arrayWord,
    'isPalindrome' => $isPalindrome,
    'vowelCount' => $vowelCount
];

# Redirect
header('Location: index.php');