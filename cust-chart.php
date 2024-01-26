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

if($_SESSION['role'] == 'customer') {
  if(basename($_SERVER['PHP_SELF']) !== 'cust-chart.php') {
      header('Location: cust-chart.php'); // Redirect to customer dashboard
      exit();
  }
} elseif ($_SESSION['role'] == 'employee') {
    header('Location: ampliva-emp-dashboard.php'); // Redirect to customer dashboard
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
	<link rel="stylesheet" type="text/css" href="styledash.css">
	<title>Ampliva Customer Dashboard</title>
        <!-- Montserrat Font -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
        <!-- Custom CSS -->
        <link rel="stylesheet" href="styleschart.css">

</head>

<body>


<!---sidebar--->
<div class="sidebar">
	<a href="#" class="logo">
	<i class='bx bx-code-alt'></i>
	<div class="logo-name"><span>Ampliva</span></div>
</a>

<ul class="side-menu">
	<li><a href="cust-dash.php"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
	<li class="active"><a href="cust-mybrands.php"><i class='bx bxs-report' ></i>My Brands</a></li>
	<li><a href="#"><i class='bx bx-task' ></i>My Bills</a></li>
	<li><a href="#"><i class='bx bx-cog' ></i>Settings</a></li>
	
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
				<button class="search-btn" type="submit"><i class='bx bx-search-alt'></i></button>
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

<main>
	<div class="header">
		<div class="left">

			<h1>REPORT</h1>	
			
		</div>
	</div>
    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
      
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <h3>Impressions</h3>
              <span class="material-icons-outlined">inventory_2</span>
            </div>
            <h1>178K</h1>
          </div>

           

          <div class="card">
            <div class="card-inner">
              <h3>Clicks</h3>
              <span class="material-icons-outlined">category</span>
            </div>
            <h1>6,017</h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>Reach</h3>
              <span class="material-icons-outlined">groups</span>
            </div>
            <h1>204K</h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>Amounth spend</h3>
              <span class="material-icons-outlined">notification_important</span>
            </div>
            <h1>$1,263.00</h1>
          </div>

          
          <div class="card">
            <div class="card-inner">
              <h3>Average CPC</h3>
              <span class="material-icons-outlined">new</span>
            </div>
            <h1>$3.21</h1>
          </div>

          
          <div class="card">
            <div class="card-inner">
              <h3>Average CPM</h3>
              <span class="material-icons-outlined">new</span>
            </div>
            <h1>$0.98</h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>Page Likes</h3>
              <span class="material-icons-outlined">new</span>
            </div>
            <h1>78</h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>Post Reaction</h3>
              <span class="material-icons-outlined">new</span>
            </div>
            <h1>182</h1>
          </div>

        </div>

        <div class="charts">

          <div class="charts-card">
            <h2 class="chart-title">Clicks</h2>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Impressions</h2>
            <div id="area-chart"></div>
          </div>

          
          <div class="charts-card">
            <h2 class="chart-title">Page Likes</h2>
            <div id="third-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Post Reaction</h2>
            <div id="fourth-chart"></div>
          </div>

        
            
          

        </div>
      </main>
      <!-- End Main -->

	
             
    
                    

  <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>

</body>



</html>