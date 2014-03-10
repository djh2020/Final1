
<?php
/**
 * This code will benchmark your server to determine how high of a cost you can
 * afford. You want to set the highest cost that you can without slowing down
 * you server too much. 10 is a good baseline, and more is good if your servers
 * are fast enough.
 */
$timeTarget = 0.5; 

$cost = 9;
do {
    $cost++;
    $start = microtime(true);
    password_hash("password", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Appropriate Cost Found: " . $cost . "\n";
?>

<br>


<?php
/**
 * We just want to hash our password using the current DEFAULT algorithm.
 * This is presently BCRYPT, and will produce a 60 character result.
 *
 * Beware that DEFAULT may change over time, so you would want to prepare
 * By allowing your storage to expand past 60 characters (255 would be good)
 */
echo password_hash("password", PASSWORD_DEFAULT)."\n";
?>

<br>

<?php

$hash = '$2y$10$SVANLI.FyNJtm00LNXoyHug3FaVeed5JelcJlMD6xtPacaAwpX5QW';

if (password_verify('password', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

// Output: Password is valid!

?>