<?php

session_start();

$originalWord = '';

if(isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    
    $originalWord = $results['originalWord'];
    $alphaWord = $results['alphaWord'];
    $isPalindrome = $results['isPalindrome'];
    $vowelCount = $results['vowelCount'];
} 
    

$_SESSION['results'] = null;

require 'index-view.php';