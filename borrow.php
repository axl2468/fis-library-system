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
      $isbn = "0";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isbn = $_POST['isbn'];
      }

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
      <form action="books.php" method="post">
        <input type="hidden" name="isbn" value="<?php echo $isbn;?>">
        <input type="text" name="id" placeholder="Enter Student ID Number...">
        <button type="submit" class="search">Submit</button>
      </form>
    </main>
    <?php
      require 'headers/securityheader.php';
    ?>
    <footer>
      <p>Copyright &copy; 2023 Library Management System</p>
    </footer>
  </body>
</html>
