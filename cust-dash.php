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
      if(basename($_SERVER['PHP_SELF']) !== 'cust-dash.php') {
          header('Location: cust-dash.php'); // Redirect to customer dashboard
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

</head>

<body>


<!---sidebar--->
<div class="sidebar">
	<a href="#" class="logo">
	<i class='bx bx-code-alt'></i>
	<div class="logo-name"><span>Ampliva</span></div>
</a>

<ul class="side-menu">
    <li class="active"><a href="cust-dash.php"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
    <li><a href="cust-mybrands.php"><i class='bx bxs-report' ></i>My Brands</a></li>
    <li><a href="#"><i class='bx bx-task' ></i>My Bills</a></li>
    <li><a href="#"><i class='bx bx-cog' ></i>Settings</a></li>
    
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
                    <h1>Dashboard</h1>
            </div>
               
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-user-voice' ></i>
                    <span class="info">
                        <h3>
                            12
                        </h3>
                        <p>My Brands</p>
                    </span>
                </li>

               
            </ul>

<!--- end of insights --->
<!--- start of recent users --->    
<div class="bottom-data">
<div class="orders">
<div class="header">
<i class='bx bx-task' ></i>
<h3>Recent Brands Added</h3>
<i class='bx bx-filter' ></i>   
</div>
<table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>No. Of Campaigns</th>
                                <th>Date added</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="user.jpg">
                                    <p>User</p>
                                </td>
                                <td>Admin</td>
                                <td>11-20-2023</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="user.jpg">
                                    <p>User</p>
                                </td>
                                <td>Employee</td>
                                <td>08-22-2023</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="user.jpg">
                                    <p>User</p>
                                </td>
                                <td>Employee</td>
                                <td>12-12-2023</td>
                            </tr>
                        </tbody>
                    </table> 
               </div>
<!---end of recent users --->

</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>