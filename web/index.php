<<<<<<< HEAD
<?php
    $website = require_once __DIR__.'/../app/app.php';
    SassCompiler::run("scss/", "css/");
    $website->run();
=======

<?php
	$website = require_once __DIR__.'/../app/app.php';
	$website->run();
>>>>>>> master
?>
