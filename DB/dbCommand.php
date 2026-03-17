<?php
  require 'dbconfig.php';

  try {
    //code...
    // $sql = "CREATE DATABASE DB";

    // command to create table 

  // $sql = "CREATE TABLE MyGuests (
  // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  // firstname VARCHAR(30) NOT NULL,
  // lastname VARCHAR(30) NOT NULL,
  // email VARCHAR(50),
  // reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  // )";
  // inserting into the database
    // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    // VALUES ('oshi', 'agarwal', 'oshi@example.com'),
    //         ('mohnish', 'yadav', 'mohnish@example.com'),
    //         ('priyam', 'patel', 'priyam@example.com')";
    // $pdo->exec($sql);
    // $last_id = $pdo->lastInsertId();
    // echo "New record created successfully\n";
    // echo "New record created successfully. Last inserted ID is: " . $last_id;

    // fetching latest data

  //   $sql = "SELECT id, firstname, lastname FROM MyGuests";
  // // Execute the SQL query
  // $result = $pdo->query($sql);
  // // Process the result set
  // if ($result->rowCount() > 0) {
  //   echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th></tr>";
  //   // Output data of each row
  //   while($row = $result->fetch()) {
  //     echo "<tr>";
  //     echo "<td>" . $row['id'] . "</td>";
  //     echo "<td>" . $row['firstname'] . "</td>";
  //     echo "<td>" . $row['lastname'] . "</td>";
  //     echo "</tr>";
  //   }
  //   echo "</table>";
  //   unset($result);
  // }else {
  //   echo "No records found.";
  // }

  //  using the where clause

  // $sql = "SELECT id, firstname, lastname FROM MyGuests WHERE lastname='yadav'";
  // // Execute the SQL query
  // $result = $pdo->query($sql);
  // // Process the result set
  // if ($result->rowCount() > 0) {
  //   echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th></tr>";
  //   // Output data of each row
  //   while($row = $result->fetch()) {
  //     echo "<tr>";
  //     echo "<td>" . $row['id'] . "</td>";
  //     echo "<td>" . $row['firstname'] . "</td>";
  //     echo "<td>" . $row['lastname'] . "</td>";
  //     echo "</tr>";
  //   }
  //   echo "</table>";
  //   unset($result);
  // }
  // else {
  //   echo "No records found.";
  // }


  $sql = "SELECT id, firstname, lastname FROM MyGuests ORDER BY 'lastname'";
  // Execute the SQL query
  $result = $pdo->query($sql);
  // Process the result set
  if ($result->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th></tr>";
    // Output data of each row
    while($row = $result->fetch()) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['firstname'] . "</td>";
      echo "<td>" . $row['lastname'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    unset($result);
  }else {
    echo "No records found.";
  }

  // // SQL to delete a record
  // $sql = "DELETE FROM MyGuests WHERE lastname = 'agarwal'";
  // $pdo->exec($sql);
  // echo "Record deleted successfully";

  } catch (PDOException $e) {
    //throw $th;
    echo "Error creating database: " . $sql . "<br>" . $e->getMessage();
  }

?>