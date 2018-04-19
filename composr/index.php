<?php
error_reporting(E_ALL);

// namespace and autoloaders
use Ritesh\Detact\FaceDetection as FaceDetection;
use Ritesh1\Test\FaceDetection as FaceDetection1;
require_once __DIR__ . '/vendor/autoload.php';

// let's use Justin Bieber's photo
$image = array(
	'url' => 'http://img2.timeinc.net/people/i/2014/database/140831/justin-bieber-300.jpg',
);

$var1 = "test";
$var2 = "test";
$var3 = "test";
$var4 = "test";

// detect face
$face = new FaceDetection1($image);
$face->analyzeAll()->getFaces();