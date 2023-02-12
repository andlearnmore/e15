<?php

session_start();

$ogWord = '';

if(isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    
    $ogWord = $results['ogWord'];
    $arrayWord = $results['arrayWord'];
    $isPalindrome = $results['isPalindrome'];
    $vowelCount = $results['vowelCount'];
    var_dump($results);

} 
    

$_SESSION['results'] = null;

require 'index-view.php';