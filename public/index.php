<?php

require '../app/Autoloader.php';
App\Autoloader::register();

if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

// Initialise objects
$db = new App\Database('blog');


ob_start();

if ($p === 'home') {
    require '../pages/home.php';
} elseif ($p === 'article') {
    require '../pages/single.php';
}

$content = ob_get_clean();

require '../pages/templates/default.php';

?>

<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

</body>
</html>