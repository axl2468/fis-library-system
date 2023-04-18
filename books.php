<html>
  <head>
    <title>Library Management System</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php
      require 'headers/header.php';

      $conn = new mysqli($servername, $db_username, $db_password, $dbName);

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updatequery = "";
        if (isset($_POST['isbn'])) {
          $isbn = $_POST['isbn'];
          if (!isset($_POST['delete'])) {
            $updatequery = "UPDATE books SET borrowed='N/A' WHERE isbn='".$isbn."'";
            if (isset($_POST['id'])) {
              $updatequery = "UPDATE books SET borrowed='".$_POST['id']."' WHERE isbn='".$isbn."'";
            }
            $conn->query($updatequery);
            echo '<script type="text/javascript">', 'alert("Successfully changed status of book with ISBN ' . $isbn . '!");','</script>';
          }
          else {
            $updatequery = "DELETE FROM books WHERE isbn='".$isbn."'";
            $conn->query($updatequery);
            echo '<script type="text/javascript">', 'alert("Successfully deleted book with ISBN ' . $isbn . '!");','</script>';
          }
        }
        
        
      }

      $showbooks = "SELECT genre, title, isbn, borrowed FROM books";
      $result = $conn->query($showbooks);

      
    ?>
    <header>
        <div class="fislogo">
             <img src="fis_logo.png" alt="FIS LOGO">
        </div>
      <h1>Library Management System</h1>
      <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="addbook.php">Add Book</a></li>
          </ul>
        </nav> 
    </header>
    <main id="main">
      <input type="text" id="bookSearch" onkeyup="searchFunction()" placeholder="Search by ISBN">
      <table id="booksTable">
        <tr class="header">
          <th>Genre</th>
          <th>Title</th>
          <th>ISBN</th>
          <th>Borrowed</th>
          <th>Actions</th>
        </tr>
      </table>
    </main>
    <?php
      require 'headers/securityheader.php';
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $borrowbtn = "<form action='borrow.php' method='post'><input type='submit' value='Borrow'><input type='hidden' name='isbn' value='".$row['isbn']."'></form>";

          if ($row['borrowed'] != "N/A") {
            $borrowbtn = "<form action='books.php' method='post'><input type='submit' value='Unborrow'><input type='hidden' name='isbn' value='".$row['isbn']."'></form>";
          }

          $deletebtn = "<form action='books.php' method='post'><input type='submit' value='Delete'><input type='hidden' name='delete' value='delete'><input type='hidden' name='isbn' value='".$row['isbn']."'></form>";

          echo '<script type="text/javascript">',
		      'document.getElementById("booksTable").innerHTML += "<tr><td>'.$row['genre'].'<td>'.$row['title'].'</td> <td>'.$row['isbn'].'</td> <td>'.$row['borrowed'].'</td> <td>'.$borrowbtn.''.$deletebtn.'</td> </tr>";',
		      '</script>';
        }
        
      }
    ?>
    <footer>
      <p>Copyright &copy; 2023 Library Management System</p>
    </footer>
    <script>
      function searchFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("bookSearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("booksTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[2];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
}
    </script>
  </body>
</html>
