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

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($servername, $db_username, $db_password, $dbName);
        if (isset($_POST['genre']) && isset($_POST['title']) && isset($_POST['isbn'])) {
          $genre = $_POST['genre'];
          $title = $_POST['title'];
          $isbn = $_POST['isbn'];
          $updatequery = "INSERT INTO books(genre, title, isbn, borrowed) VALUES('$genre', '$title', '$isbn', 'N/A')";
          $conn->query($updatequery);
          echo '<script type="text/javascript">', 'alert("Successfully added book!");','</script>';
        }
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
        <div class="login-form" id="login-form">
          <form action="index.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <div class="form-container">
               <input type="submit" class="login-button" value="Login">
            </div>
          </form>
         </div>      
    </header>
    <main id="main">
      <form action="addbook.php" method="post">
        <label>Genre:</label>
        <input type="text" name="genre" placeholder="Fiction/Non-Fiction">
        <label>Title:</label>
        <input type="text" name="title" placeholder="Title">
        <label>ISBN:</label>
        <input type="text" name="isbn" placeholder="ISBN">
        <button type="submit" class="search">Submit</button>
      </form>
    </main>
    <?php
      require 'headers/securityheader.php';
      if(isset($_SESSION['username'])) {
        echo '<script type="text/javascript">', 'document.getElementById("login-form").innerHTML = "Logged in as ' . $_SESSION['username'] . '<br><a href=logout.php>Logout</a>";','</script>';
      } //i loooooooove css!!!!!!!!!! batchest
    ?>
    <footer>
      <p>Copyright &copy; 2023 Library Management System</p>
    </footer>
  </body>
</html>
