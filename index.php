<?php
function show_highscore($all) {
  echo "<td valign=top><h2>Highscore</h2>";
  $handle = fopen("highscore.dat","r");
  $i=1;
  if($all=="1") 
    $max = 101;
  else 
    $max = 21;
  while (!feof($handle) && $i < $max) {
    $h = fgets($handle,100);
    $n = fgets($handle,100);
    if(!feof($handle)) {
      if($i < 10) {
        if($i == 1)
          echo "<font color=red><b>0".$i.".</b> ".$h." ".$n."</font><br>";
        else {
          if($i == 2)
            echo "<font color=green><b>0".$i.".</b> ".$h." ".$n."</font><br>";
          else {
            if($i == 3)
              echo "<font color=blue><b>0".$i.".</b> ".$h." ".$n."</font><br>";
            else
              echo "<b>0".$i.".</b> ".$h." ".$n."<br>";
          }
        }
      }
      else
        echo "<b>".$i.".</b> ".$h." ".$n."<br>";
      $i++;
    }
  }
  fclose($handle);
  if($all != "1")
    echo "<a href=index.php?all=1>Show all</a>";
  else
    echo "<a href=index.php>Collapse</a>";
}

function add_highscore($score,$name) {
  while($name != strip_tags($name)) {
    $name = strip_tags($name);
  }
  $handle = fopen("highscore.dat","r");
  $i=0;
  while (!feof($handle) && $i < 100) {
    $highscore_p[] = fgets($handle,100);
    $highscore_p[$i] += 1;
    $highscore_p[$i] -= 1;
    $highscore_n[] = fgets($handle,100);
    $highscore_n[$i] = trim($highscore_n[$i]);
    $i++;
  }
  fclose($handle);
 // for($i=0;$i<100;$i++) {
 //   echo $i." ".$highscore_p[$i]." ".$highscore_n[$i]."<br>";//fputs($handle,$highscore_p[$i]."\n".$highscore_n[$i]);
 // }
  $i=0;
  while(($highscore_p[$i] > $score) && ($i < 100)) {
    $i++;
  }
  //if($i>0)
  //  $i--;
  //echo $i."<br>";
  if($i < 100) {
    for($j=99;$j>$i;$j--) {
      $highscore_p[$j] = $highscore_p[$j-1];
      $highscore_n[$j] = $highscore_n[$j-1];
    }
    $highscore_p[$i]=$score;
    $highscore_n[$i]=$name;
  }
  $handle = fopen("highscore.dat","w+");
  for($i=0;$i<100;$i++) {
    fputs($handle,$highscore_p[$i]."\n");
    fputs($handle,$highscore_n[$i]."\n");
    //fputs($handle,$highscore_n[$i]);
  }
  fclose($handle);

  //exit;
 // show_highscore();
}


$flag = $_GET["flag"];
$all = $_GET["all"];
if($flag==2) {
  $name = $_GET["xc"];
  $score = $_GET["xy"];
  add_highscore($score,$name);
  header("Location: http://www.baigtetris.webhop.org");
  exit;
}else {
  //show_highscore();
}
?>
<font face="Courier">
<table align=center><tr><td><img src=Tetris.gif></td></tr><tr><td valign=top><applet code="Tetris.class" height="425" width="315"></applet></td>
<td><?php show_highscore($all); ?></td></tr></table>
<br>
<p align=center>If you don't see the game, please download Java RE <a href="http://java.com/de/download/windows_xpi.jsp?locale=de&host=java.com:80" target="_blank">download now</a></p>
</font>