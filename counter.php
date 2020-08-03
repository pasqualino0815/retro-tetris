<?php
  if(!isset($_COOKIE['count']))
  {
    if(!file_exists("count.txt"))
    {
      $counter=fopen("count.txt", "a");
    } 
    else
    {
      $counter=fopen("count.txt", "r+");
    }
    $aufruf=fgets($counter,10000);
    $aufruf=$aufruf+1; rewind($counter);
    fputs($counter,$aufruf); fclose($counter);
  }
  setcookie("count", "1", time()+(86400));
?>