<?php
//Check to see if session has started
if (!isset($_SESSION)){  //If the session variable is not set, then set it..else do nothing
  session_start();
}

if(!isset($_SESSION['username'])){
  header('Location: login.php');
}

//Bring in database connection
require('dbconnection.php');

if (isset($_POST['id']) && isset($_POST['kill'])){
  $sql = "DELETE FROM users WHERE userid = " . $_POST['id'];
  $result = $conn->query($sql);
}

//Create the SQL query
$sql = "SELECT * FROM users";

//Execute the SQL Query
$result = $conn->query($sql);


//Close DB connection
$conn->close();
 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
      <table>
        <tr>
          <th>User ID</th>
          <th>Username</th>
          <th>Password Hash</th>
          <th>Actions</th>
        </tr>


        <?php
          //Loops through all of the table records

          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
              echo "<td>" . $row['userid'] . "</td>";
              echo "<td>" . $row['username'] . "</td>";
              echo "<td>" . $row['password'] . "</td>";
              echo "<td>
                <form action=\"edituser.php\" method=\"get\">
                <input type=\"hidden\" name=\"id\" value=\"" . $row['userid'] . "\">
                <input type=\"submit\" value=\"edit\" name=\"edit\">
              </td>";

              echo
              "<td>
                <form action=\"\" method=\"post\">
                <input name = \"id\" type=\"hidden\" value=\"" . $row['userid'] . "\">
                <input type=\"submit\" value=\"DELETE\" style=\"color: red;\" name=\"kill\">
                </form>
              </td>";
              //could also end php if we wanted to and do it that way..Then we don't have to echo everything out

            echo "</tr>";
          }

        ?>



      </table>
   </body>
 </html>
