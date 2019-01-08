<?php

require __DIR__.'/../vendor/autoload.php';
//public/form.php
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
// activer le mode debug et le mode de variables strictes
$twig = new Twig_Environment($loader, [
    'debug' => true,
    'strict_variables' => true,
]);

// charger l'extension Twig_Extension_Debug
$twig->addExtension(new Twig_Extension_Debug());



try {
    // connexion à la base de donnée
    $bdd = new PDO('mysql:dbname=bus;host=localhost', 'nahjo', 'J0han/62410');
} catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM route');
while ($req = $reponse->fetch()){
    $routes[] = $req;
    $routes_id[] = $req['route_id'];
    $routes_long_name[] = $req['route_long_name'];
}

$page = 10;
echo $twig->render('home.html.twig', [
    'routes' => $routes,
    'routes_id' => $routes_id ,
    'routes_long_name' => $routes_long_name,   
]);