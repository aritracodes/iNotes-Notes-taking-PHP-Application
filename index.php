<?php 

$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";


$conn = mysqli_connect($servername, $username, $password, $database);



if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

  // Sql query to be executed
  $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $title = $_POST["title"];
    $description = $_POST["description"];

  // Sql query to be executed
  $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}




// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//   if(isset($_POST['snoEdit'])){
//     // update the record
//     $title =  $_POST['titleEdit'];
//     $sno = $_POST['snoEdit'];
//     $description = $_POST['descriptionEdit'];


//     // sql to be executed
//     $sql = "UPDATE `notes` SET `title` = '$title, `description` = '$description' WHERE `notes`.`sno` = $sno";
//     $result = mysqli_query($conn, $sql);

//     if($result){
//       echo "updated";
//     }else {
//       echo "not updated";
//     }
    
//   }else{

//   $title = $_POST['title'];
//   $description = $_POST['description'];

//   $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
//   $result = mysqli_query($conn, $sql);

//   if($result){
//     $insert = true;
//   }else {
//     echo "no" . mysqli_error($conn);
//   }
// }
// }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <title>iNotes - Taking notes made easy.</title>
  </head>
  <body>
    


    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form action="/crud/index.php" method="POST">
      <div class="modal-body">
        

        <input type="hidden" name="snoEdit" id="snoEdit">
        <h1>Update Note</h1>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
        </div>

        <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Leave a comment here" id="descriptionEdit" name="descriptionEdit" style="height: 100px"></textarea>
        <label for="desc">Add Description</label>
      </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>








    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>




<div class="container my-4">


<?php 

if($insert)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note was successfully added to the list.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}


if($delete)
{
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note was deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

if($update)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note was updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}


?>





    <form action="/crud/index.php" method="POST">
        <h1>Add a Note</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
  </div>

  <div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 100px"></textarea>
  <label for="desc">Add Description</label>
</div>

  <button type="submit" class="btn btn-primary">Add Note</button>
</form>

</div>


<div class="container mt-4 my-4">


    <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php 

      $sql = "SELECT * FROM `notes`";
      $result = mysqli_query($conn, $sql);

      $sno = 0;
      while($row = mysqli_fetch_assoc($result))
      {
        $sno = $sno + 1;
      echo "<tr>
            <th scope='row'>". $sno ."</th>
            <td>". $row['title'] ."</td>
            <td>". $row['description'] ."</td>
            <td><button type='button' class='edit btn btn-primary btn-sm' id=" . $row['sno'] .">Edit</button> <button type='button' class='delete btn btn-danger btn-sm' id=d".$row['sno'].">Delete</button></td>
            </tr>"; 
      }

    ?>
    

  </tbody>
</table>

</div>

<div class="container mb-4">

</div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>


    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    

    <script>
        $(document).ready( function () {
         $('#myTable').DataTable();
        } );  
    </script> 

        <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    
deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    
  </script>

  </body>
</html>