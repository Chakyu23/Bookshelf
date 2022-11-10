<?php
    include_once "function.php";
    
    $bddBiblio = connect();

    if( test($_POST) ) {
        if( test($_POST["bookName"]) ) {
            if( $_POST["bookAuthor"] != null) {
                if( $_POST["bookGenre"] != null) {
                    $sql_insert = "INSERT INTO book (`name`, `genre_id`,`author_id`) VALUES (:bookName, :bookGenre, :bookAuthor)";
                    $stmt = $bddBiblio->prepare($sql_insert);
                    $stmt->execute(['bookGenre' => $_POST["bookGenre"],
                    'bookName' => $_POST["bookName"], 
                    'bookAuthor' => $_POST["bookAuthor"]]);
        
                }
            }
        }
    };
    if($_POST["suprBook"]) { 
        $sql_drop = "DELETE FROM book WHERE `id` = :suprBook";
        $stmt = $bddBiblio->prepare($sql_drop);
        $stmt->execute(['suprBook' => $_POST["suprBook"]]);
    };

    $bddBook =  "SELECT book.id AS id, book.name AS Book, author.name AS Author, genre.name AS Genre 
        FROM book INNER JOIN author, genre 
        WHERE author.id = book.author_id AND genre.id = book.genre_id ORDER BY id ASC;";
    $bddAuthor =  "SELECT * FROM author;";
    $bddGenre =  "SELECT * FROM genre;";
    $book = $bddBiblio->query($bddBook)->fetchAll();
    $author = $bddBiblio->query($bddAuthor)->fetchAll();
    $genre = $bddBiblio->query($bddGenre)->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblio-V2 | Book table</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php 
  include_once 'bar.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Book</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Book</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Book table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th class="id-col">ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th class="act-col">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($book as $bk): ?>
                    <tr>
                        <td><?php echo($bk["id"]); ?></td>
                        <td><?php echo($bk["Book"]); ?></td>
                        <td><?php echo($bk["Author"]); ?></td>
                        <td><?php echo($bk["Genre"]); ?></td>
                        <td class="act-cell">
                            <form action="bookUpdate.php" method="GET">
                              <button type="submit"><i class="fa fa-pen"></i></button>
                              <input type="hidden" name="updateB" value=<?php echo($bk["id"]); ?>>
                            </form>
                            <form action="" method="POST">
                              <button type="submit"><i class="fa fa-trash"></i></button>
                              <input type="hidden" name="suprBook" value=<?php echo($bk["id"]); ?>>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>

                <!-- <div class="pagin-container">
                  <?php if( $_GET["page"] > 0) :?> 
                    <a class="pagebtn" href="?page=<?php echo $page - 1;?>">Page précédante</a>
                  <?php endif; ?>
                  <?php if( $_GET["page"] < $lastPage) :?>
                    <a class="pagebtn" href="?page=<?php echo $page + 1;?>">Page suivante</a>
                  <?php endif; ?>
                </div> -->

                
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add a Book</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" class="form-1">
                    <input type="text" class="text-input decal" name="bookName" placeholder="book name">
                      <select name="bookAuthor" class="decal">
                        <option value="">--</option>
                        <?php foreach($author as $ath): ?>
                          <option value =<?php echo($ath["id"]); ?>><?php echo($ath["name"]); ?></option>
                        <?php endforeach; ?>
                      </select>
                      <select name="bookGenre" class="decal">
                        <option value="">--</option>
                        <?php foreach($genre as $gr): ?>
                          <option value =<?php echo($gr["id"]); ?>><?php echo($gr["name"]); ?></option>
                        <?php endforeach; ?>
                      </select>
                    <input class="btn btn-primary decal" type="submit" value="Envoyer !">
                  </form>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
