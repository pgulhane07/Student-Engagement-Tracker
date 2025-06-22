<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'dbms_project');
    $sql = "SELECT * FROM files";
    $result = mysqli_query($conn, $sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
    $type1 = $_GET['type'];
    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE ID= '$id' and Type='$type1'";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['Name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['Name']));
        readfile('uploads/' . $file['Name']);

        // Now update downloads count
      /*  $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery); */
        exit;
    }

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
  <title>Download files</title>
</head>
<body>

<table>
<thead>
    <th>ID</th>
    <th>Type</th>
    <th>Filename</th>
    <th>size (in kb)</th>
    <th>Action</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr>
      <td><?php echo $file['ID']; ?></td>
      <td><?php echo $file['Type']; ?></td>
      <td><?php echo $file['Name']; ?></td>
      <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
      <td><a href="downloads.php?file_id=<?php echo $file['ID'] ?>&type=<?php echo $file['Type'] ?>">Download</a></td>
    </tr>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>