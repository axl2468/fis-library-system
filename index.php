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
      require_once 'headers/loginheader.php';

      $conn = "";

      // Create connection
      if(!isset($_SESSION['username'])) {
        $conn = new mysqli($servername, $db_username, $db_password, $dbName);
        // Check connection
        if ($conn->connect_error) {
          die("Connection to SQL server failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (!isset($_POST['username']) or !isset($_POST['password']) ) {
            incorrectMessage($username);
          }
          else {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $password_check = PasswordValid($password, $conn, $username);

            if ($password_check) {
              generateSession($username);
              echo '<script type="text/javascript">', 'alert("Welcome ' . $user . '!");','</script>';
              if ($username == "ADMIN") {
                $_SESSION["ADMINUSER"] = TRUE;
              }
              $conn->close();
              unset($_SESSION['token']); //unset token
            }
            else {
              incorrectMessage($username);
            }
            
          }	
        }
      }
      
      //i dont like php
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
    <main>
      <h2>Welcome to our Library Management System</h2>
      <p>Please login and then use the navbar above to navigate the application.</p>
    </main>
    <footer>
      <p>Copyright &copy; 2023 Library Management System</p>
    </footer>
    <?php
      if(isset($_SESSION['username'])) {
        echo '<script type="text/javascript">', 'document.getElementById("login-form").innerHTML = "Logged in as ' . $_SESSION['username'] . '<br><a href=logout.php>Logout</a>";','</script>';
      } //i loooooooove css!!!!!!!!!! batchest
    ?>
  </body>
</html>
