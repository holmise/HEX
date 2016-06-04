<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$color = sprintf("#%06x",rand(0,16777215));
$color2 = sprintf("#%06x",rand(0,16777215));

$base = dirname($_SERVER['PHP_SELF']);
$pagePath = substr($_SERVER['REQUEST_URI'], strlen($base)+1);

// Remove any URI variables
$pagePath = explode('?', $pagePath);
$pagePath = $pagePath[0];

// Trim any leading forward slash
$pagePath = trim($pagePath,"/");

if ( ! $pagePath )
{
  $pagePath = 'home';
}

$pageView = "views/$pagePath.php";

include ('template/header.php');
include ( $pageView);
include ('template/footer.php');

?>
