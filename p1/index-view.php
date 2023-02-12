<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 1: String Processor</title>
</head>

<body>
    <main>
        <h1>Project 1</h1>
        <form method='POST' action='process.php'>
            <label for='word'>Enter your word:</label>
            <input type='text' id='word' name='word' value=<?php echo $ogWord ?>>
            <button type='submit'>Submit</button>
        </form>



        <?php if(isset($isPalindrome)) { ?>
        <h2> Results for: <?php echo $ogWord ?></h2>
        <div>
            <h3>Is it a palindrome?</h3>
        </div>
        <div>
            <?php if ($isPalindrome) { ?>
            <p>Yes</p>
            <?php } else { ?>
            <p>No</p>
            <?php } ?>
        </div>
        <div>
            <h3>How many vowels does it contain?</h3>
        </div>
        <div>
            <?php echo $vowelCount ?>
        </div>
        <div>
            <h3>Letter shift</h3>
        </div>
        <div>
            <!-- result -->
        </div>
        <?php } ?>
    </main>
</body>

</html>