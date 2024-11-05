<?php

require_once 'vendor/autoload.php';
use \Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$route_index = new Route('/index');
$route_index->setMethods(['GET']);
$autre_route = new Route('/{suite}');

$collection = new RouteCollection();

$collection->add('home',$route_index);
$collection->add('toto',new Route('/toto/{suite}'));

$autre_route->setRequirement('suite','[a-z]*');
$autre_route->addDefaults(['suite'=>'default']);


$collection->add('autre', $autre_route,1);

$context = new RequestContext();
$oneContext = new RequestContext('','GET');

$analyser = new UrlMatcher($collection,$oneContext);
try {

    $route_trouvee = $analyser->match('/index');
    var_dump($route_trouvee);
}catch (\Symfony\Component\Routing\Exception\MethodNotAllowedException $e){
    print ("Seulement POST pour Index");
}
catch (\Exception $e){
    print ("Erreur: ".$e->getMessage());
}



