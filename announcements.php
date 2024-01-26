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

if($_SESSION['role'] == 'employee') {
  if(basename($_SERVER['PHP_SELF']) !== 'announcements.php') {
      header('Location: announcements.php'); // Redirect to customer dashboard
      exit();
  }
} elseif ($_SESSION['role'] == 'customer') {
    header('Location: cust-dash.php'); // Redirect to customer dashboard
    exit();
} elseif ($_SESSION['role'] == 'admin') {
    header('Location: AdminDash.php'); // Redirect to customer dashboard
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
	<link rel="stylesheet" type="text/css" href="styleemp.css">
	<title>Ampliva Employee Dashboard</title>

</head>

<body>


<!---sidebar--->
<div class="sidebar">
	<a href="#" class="logo">
	<i class='bx bx-code-alt'></i>
	<div class="logo-name"><span>Ampliva</span></div>
</a>

<ul class="side-menu">
    <li><a href="ampliva-emp-dashboard.php"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
    <li class="active"><a href="announcements.php"><i class='bx bx-calendar-event'></i>Announcements</a></li>
    <li><a href="tasklists.php"><i class='bx bx-task' ></i>Task Lists</a></li>
    <li><a href="empcustomermodule.php"><i class='bx bx-book-content'></i>Customer Module</a></li>
    <li><a href="projects.php"><i class='bx bx-folder-open'></i>Projects</a></li>
    <li><a href="empreports.php"><i class='bx bxs-report' ></i>Reports</a></li>
    <li><a href="empprofile.php"><i class='bx bx-user-circle'></i>Profile</a></li>
    <li><a href="empsettings.php"><i class='bx bx-cog' ></i>Settings</a></li>
	
</ul>
<ul class="side-menu">
	<li><a href="#" class="logout"><i class='bx bx-log-out' ></i>Logout</a></li>
</ul>

</div>
<!--- end of sidebar --->

<!--- main content --->
<div class="content">
	<nav>
		<i class='bx bx-menu'></i>
		<form action="#">
			<div class="form-input">
		<input type="search" placeholder="Search...">
        <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
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

<!--- announcements --->
<header>
        <h1>Announcements</h1>
    </header>

    <section>
        <div class="announcement-container">
            <h2>Announcement 1</h2>
            <p>--- announcement---</p>
            <p>What:</p>
            <p>Where:</p>
            <p>When: Date: Time: </p>
        </div>

        <div class="announcement-container">
            <h2>Announcement 2</h2>
            <p>--- announcement---</p>
            <p>What:</p>
            <p>Where:</p>
            <p>When: Date: Time: </p>
        </div>

        <div class="latest-announcement">
            <h2>Latest Announcement</h2>
            <p>--- announcement---</p>
            <p>What:</p>
            <p>Where:</p>
            <p>When: Date: Time: </p>
        </div>

        <div class="upcoming-event">
            <h2>Upcoming Event</h2>
            <p>--- announcement---</p>
            <p>What:</p>
            <p>Where:</p>
            <p>When: Date: Time: </p>
        </div>
    </section>

</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>