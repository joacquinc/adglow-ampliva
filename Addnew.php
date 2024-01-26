<?php
  require_once('config.php');
  session_start();

  if (isset($_SESSION['userid'])) {
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    }
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
    if (isset($_SESSION['password'])) {
        $password = $_SESSION['password'];
    }
    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    }
} elseif (!isset($_SESSION['userid']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
} else {
    
}

if($_SESSION['role'] == 'admin') {
  if(basename($_SERVER['PHP_SELF']) !== 'Addnew.php') {
      header('Location: Addnew.php'); // Redirect to customer dashboard
      exit();
  }
} elseif ($_SESSION['role'] == 'customer') {
    header('Location: cust-dash.php'); // Redirect to customer dashboard
    exit();
} elseif ($_SESSION['role'] == 'employee') {
    header('Location: ampliva-emp-dashboard.php'); // Redirect to customer dashboard
    exit();
} else {
    header("Location: index.php");
    exit;
}

if (isset($_POST['register'])) {
  // Get form data
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['psw'];
  $role = $_POST['user-type'];

  // Validate and sanitize form data if needed

  // Insert data into the 'users' table
  $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ssss", $name, $email, $password, $role);
  $stmt->execute();
  
  // Check if the insertion was successful
  if ($stmt->affected_rows > 0) {
      // Registration successful
      header("Location: AdminDash.php");
    exit;
  } else {
      // Handle registration failure
  }
}

// Logout Function
if (isset($_POST['logout'])) {
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to the login page or any other page as needed
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="styleadmin.css">
  <title>Ampliva Admin Dashboard</title>

</head>

<body>


<!---sidebar--->
<div class="sidebar">
  <a href="#" class="logo">
  <i class='bx bx-code-alt'></i>
  <div class="logo-name"><span>Ampliva</span></div>
</a>

<ul class="side-menu">
  <li><a href="AdminDash.php"><i class='bx bx-home' ></i>Home</a></li>
  <li><a href="AdminAccountsPage.php"><i class='bx bxs-user-account' ></i>Accounts</a></li>
  <li><a href="Adminprofile.php"><i class='bx bx-user-circle'></i>Profile</a></li>
  <li><a href="Adminsettings.php"><i class='bx bx-cog' ></i>Settings</a></li>
  
</ul>
<ul class="side-menu">
  <li>
    <form method="post">
      <button type="submit" name="logout" class="logout">
        <i class='bx bx-log-out'></i>Logout
      </button>
    </form>
  </li>
</ul>

</div>
<!--- end of sidebar --->

<!--- main content --->
<div class="content">
  <nav>
    <i class='bx bx-menu'></i>
    <form action="#">
      <div class="form-input">
        <button></button>
      </div>
    </form>
    <input type="checkbox" id="theme-toggle"hidden>
    <label for="theme-toggle" class="theme-toggle"></label>
    <a href="#"><i class='bx bx-bell'></i><span class="count">12</span></a>
    <a href="#" class="profile">
      <img src="logo.png">
    </a>
  </nav>

<!--- end of nav bar --->
<!--- start of add new user --->

<form method="post" action="Addnew.php">
  <div class="container">
    <h1>Add new user</h1>
    <p>Please fill in this form to add new user.</p>
    <hr>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Confirm Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

    <label for="user-type"><b>UserType:</b></label>
    <select id="user-type" name="user-type">
    <option value="selection">Please Select</option>
    <option value="admin">Admin</option>
    <option value="employee">Employee</option>
    <option value="sales">Employee/Sales</option>
    <option value="customer">Customer</option>
    </select>


    <hr>
    <button type="submit" name="register" class="registerbtn">Register</button>
    
</form>

  



</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>