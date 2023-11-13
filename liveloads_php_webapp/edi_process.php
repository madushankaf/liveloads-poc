<html>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo file_get_contents('php://input');
    }
?>

</body>
</html>