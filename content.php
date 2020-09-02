<?php
$mypage = $_GET['id'];
switch($mypage)
{
case "1":
    @include("servers/server1.php");
    break;

case "2":
     @include("servers/server2.php");
     break;

case "3":
     @include("servers/server3.php");
     break;

case "4":
    @include("servers/server4.php");
    break;

case "5":
     @include("servers/server5.php");
     break;

case "6":
     @include("servers/server6.php");
     break;


default:
    @include("servers/server1.php");
}
?>