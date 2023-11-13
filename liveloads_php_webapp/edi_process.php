<html>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            echo $key . ": " . $value . "<br>";
        }
    }
?>

</body>
</html>