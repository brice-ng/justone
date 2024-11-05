<?php
use \Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

require_once 'vendor/autoload.php';


$locator = new FileLocator(__DIR__);
$yaml= new YamlFileLoader($locator);
$collection =$yaml->load('routes.yaml');


$oneContext = new RequestContext('','POST');

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



