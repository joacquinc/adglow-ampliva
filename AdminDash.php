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
  if(basename($_SERVER['PHP_SELF']) !== 'AdminDash.php') {
      header('Location: AdminDash.php'); // Redirect to customer dashboard
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

//Table users
$queryUsers = "SELECT * FROM users ORDER BY userid";
    $resultUsers = mysqli_query($mysqli, $queryUsers);
    if ($resultUsers) {
        while ($row = mysqli_fetch_assoc($resultUsers)) {
            $recentUsers[] = $row;
        }
    }

//Admin
$sql = "SELECT COUNT(*) as admin_count FROM users WHERE role = 'admin'";
$result = $mysqli->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminCount = $row['admin_count'];
} else {
    echo "No users with the role 'admin' found.";
}

//Customer
$sql = "SELECT COUNT(*) as customer_count FROM users WHERE role = 'customer'";
$result = $mysqli->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customerCount = $row['customer_count'];
} else {
    echo "No users with the role 'customer' found.";
}

//Employee
$sql = "SELECT COUNT(*) as employee_count FROM users WHERE role = 'employee'";
$result = $mysqli->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $employeeCount = $row['employee_count'];
} else {
    echo "No users with the role 'employee' found.";
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
	<li class="active"><a href="AdminDash.php"><i class='bx bx-home' ></i>Home</a></li>
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
                            <?php echo $adminCount; ?>
                        </h3>
                        <p>Admins</p>
                    </span>
                </li>

                <li><i class='bx bx-user' ></i>
                    <span class="info">
                        <h3>
                            <?php echo $employeeCount; ?>
                        </h3>
                        <p>Employees</p>
                    </span>
                </li>

                <li><i class='bx bx-male-female' ></i>
                    <span class="info">
                        <h3>
                            <?php echo $customerCount; ?>
                        </h3>
                        <p>Customers</p>
                    </span>
                </li>
            </ul>

<!--- end of insights --->
<!--- start of recent users --->	
<div class="bottom-data">
<div class="orders">
<div class="header">
<i class='bx bx-task' ></i>
<h3>Recent Users Added</h3>
<i class='bx bx-filter' ></i>   
</div>
<table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>UserType</th>
                                <th>Date added</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentUsers as $user) { ?>
                                <tr>
                                    <td>
                                        <img src="user.jpg">
                                        <p><?php echo $user['name']; ?></p>
                                    </td>
                                    <td><?php echo $user['role']; ?></td>
                                    <td>11-20-2023</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table> 
               </div>
<!---end of recent users --->

</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>