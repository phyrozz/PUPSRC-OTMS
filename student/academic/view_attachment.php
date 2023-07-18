<?php
include "../../conn.php";

// Fetching student_no, last_name, first_name from the "users" table
$query = "SELECT student_no, last_name, first_name FROM users WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Extracting file_name from the fetched user data
$file_name = "";
if (!empty($userData)) {
    $user = $userData[0];
    $file_name = $user['student_no'] . "_" . $user['last_name'] . "_" . $user['first_name'] . "_%"; 
    // The "%" wildcard will match any characters that come after the student_no, last_name, and first_name
}

// Querying the "files" table to fetch file_path using file_name and type
$query = "SELECT file_path FROM files WHERE file_name LIKE ? AND type = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $file_name, $type);

$type = "text/plain"; // Replace with the actual type you want to search for

$stmt->execute();
$result = $stmt->get_result();
$filePaths = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();

// Debugging: Output the value of $filePaths
var_dump($filePaths);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Queried Files</title>
</head>
<body>
  <h1>Queried Files</h1>
  <table>
    <thead>
      <tr>
        <th>File Path</th>
        <th>Attachment</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($filePaths as $filePath) { ?>
        <tr>
          <td><?php echo $filePath['file_path']; ?></td>
          <td><a href="<?php echo $filePath['file_path']; ?>" target="_blank" download>View Attachment</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
