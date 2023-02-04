<!DOCTYPE html>
<html lang='en'>

<head>

    <title>PHPiggy Bank</title>
    <meta charset='utf-8'>
    <link href=data:, rel=icon>

</head>

<body>

    <img alt='PHPiggy Bank Logo' src='https://s3.amazonaws.com/making-the-internet/php-piggy-bank-logo@2x.png'
        style='width:202px;'>

    <p>
        You have $<?php echo $total; ?> in your piggy bank.
    </p>

    <ul>
        <?php foreach($coins as $coin => $value) { ?>
        <li><?php echo $coin; ?>: <?php echo $value; ?>
        </li>
        <?php } ?>
    </ul>

    <?php if($goal) {?>
    Congrats, you reached your savings goal!
    <?php } else { ?>
    Keep saving!
    <?php } ?>
</body>

</html>