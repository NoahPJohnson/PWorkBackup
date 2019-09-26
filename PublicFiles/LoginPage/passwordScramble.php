<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty(trim($_POST["passwordToScramble"])))
    {
        $passwordToScramble = trim($_POST["passwordToScramble"]);
        echo "Scrambled Password:  " . password_hash($passwordToScramble, PASSWORD_DEFAULT);
    }
}
?>


<!DOCTYPE html>
<html>
<body>

<form action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post" enctype="multipart/form-data">
    Enter Password:
    <input type="text" name="passwordToScramble" id="passField">
    <input type="submit" value="ScramblePassword" name="submit">
</form>

</body>
</html>