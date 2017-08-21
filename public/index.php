<?php
require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


if (!function_exists('app')) {
	function app()
	{
		require __DIR__.'/../config/database.php';
		$app = new \stdClass;
		$app->db_config = json_decode(json_encode($db_config));
		return $app;
	}
}

if (!function_exists('request')) {
	function request()
	{
		return Request::createFromGlobals();
	}
}

if (!function_exists('response')) {
	function response($data, $headers = ['content-type' => 'text/json'], $status = Response::HTTP_OK)
	{
		$res =  new Response(
		    $data,
		    $status,
		    $headers
		);

		$res->send();
	}
}
if (!function_exists('view')) {
	function view($path, $data)
	{
		$pug    = new Pug\Pug();
        $vars   = $data ?: array();
        $output = $pug->render(__DIR__ . '/../resources/views/' . $path . $pug->getExtension(), $vars);
        echo $output;
	}
}


require __DIR__.'/../bootstraps/database.php';
require __DIR__.'/../bootstraps/router.php';
