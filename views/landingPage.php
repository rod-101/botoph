<?php
    if(
        isset($_SESSION['email']) &&
        isset($_SESSION['fullname']) &&
        isset($_SESSION['role'])
    ) {
        header('Location: voterDashboard.html');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->

    <title>Home</title>
</head>
<body id="bodyContainer">

    <script type="module">
        import { navbar } from '../js/navbar.js';
        let bodyContainer = document.getElementById('bodyContainer');
        navbar(bodyContainer);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- MDB -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.0.0/mdb.umd.min.js">
    </script>
</body>
</html>