<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <main>
        <div class="container">
            <div class="px-4 py-3 my-5">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h1>Project 1: String Processor</h1>
                        </div>
                    </div>
                </div>
                <div class="row" id="instructions">
                    <div class="col-12">
                        <div class="text-start">
                            <h2>Instructions</h2>
                            <p>Enter a word to find out...</p>
                            <ul>
                                <li>Is it a palindrome? (same forwards and backwards)</li>
                                <li>How many vowels does it contain?</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row" id="form">
                    <div class="col-12">
                        <div class="text-center">
                            <form method="POST" action="process.php">
                                <div class="mb-3">
                                    <label for="word" class="form-label">Enter your word:</label>
                                    <input type="text" id="word" name="word" class="form-control"
                                        value="<?php echo $originalWord ?>">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php if(isset($isPalindrome)) { ?>
                <div class="row" id="results">
                    <div class="col-12">
                        <div class="text-start">


                            <h2> Results for: <span id="entry"><?php echo $originalWord ?></span></h2>
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

                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        </div>
    </main>
</body>

</html>