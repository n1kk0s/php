<?php
$output = shell_exec('ls -lah');
echo "<pre>$output</pre>"; //displays the code as it appears in the terminal including spacing....the <code> tag strips spaces

$pwd = shell_exec('pwd');
$pwd = rtrim($pwd);
echo "<pre>$pwd</pre>";

echo $pwd . '/' . 'test';
if (is_dir($pwd . '/' . 'test')){
  echo "<br>This directory exists!<br>";

  $dirArray = scandir("test/");

echo "<br><br>The following is a list of all of the users who are currently logged into 23.30.218.171:<br>";
$hi = shell_exec("who -m");
echo $hi;
  foreach ($hi as $key => $value) {
    echo $value;
  }


  //var_dump($dirArray);
  echo "<br><br>The following is a list of all of the items in this directory:<br>";
  foreach ($dirArray as $key => $value) {  //Goes through each array element of dirArray...should be the number in the index
    if ($value == "." || $value == ".."){continue;}
    echo $value . "<br>";
  }
}

else{
  echo "<br>This is not a directory!";
  exec('mkdir test');
  echo "<br>We have created it for you!<br>";
}
 ?>
