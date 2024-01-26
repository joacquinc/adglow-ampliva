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
  if(basename($_SERVER['PHP_SELF']) !== 'Adminsettings.php') {
      header('Location: Adminsettings.php'); // Redirect to customer dashboard
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
	<li class="active"><a href="Adminsettings.php"><i class='bx bx-cog' ></i>Settings</a></li>
	
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
<!--- Admin settings --->
<div class="settings-container">
        <h1>Account Settings</h1>
        <form>
            <label for="name">Change Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your new name">

            <label for="email">Change Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your new email">

            <label for="address">Change Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your new address">

            <label for="contact">Change Contact:</label>
            <input type="text" id="contact" name="contact" placeholder="Enter your new contact">

            <label for="password">Change Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your new password">

            <label for="password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your new password">

            <button type="submit">Save Changes</button>
        </form>
    </div>

</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>