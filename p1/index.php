<?php

session_start();

// Setting to empty string because index-view relies on this for value in form; on first visit it's undefined.
$originalWord = '';

if(isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    
    $originalWord = $results['originalWord'];
    $alphaWord = $results['alphaWord'];
    $isPalindrome = $results['isPalindrome'];
    $vowelCount = $results['vowelCount'];
}
    
# Clear session results
$_SESSION['results'] = null;

require 'index-view.php';