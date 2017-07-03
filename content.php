<?php
$mypage = $_GET['id'];
switch($mypage)
{
case "1":
    @include("servers/server1.php");
    break;

// Uncomment below if you are gonna have multuple servers, and copy paste fore more
// case "2":
//     @include("servers/server2.php");
//     break;

default:
    @include("servers/server1.php");
}
?>
