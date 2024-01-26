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
  if(basename($_SERVER['PHP_SELF']) !== 'empcustomermodule.php') {
      header('Location: empcustomermodule.php'); // Redirect to customer dashboard
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

//Table Cust
$queryCust = "SELECT * FROM Customer_DB ORDER BY id";
    $resultCust = mysqli_query($mysqli, $queryCust);
    if ($resultCust) {
        while ($row = mysqli_fetch_assoc($resultCust)) {
            $recentCust[] = $row;
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styleemp.css">
    <title>Ampliva Employee Account</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Ampliva</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="ampliva-emp-dashboard.php"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
            <li><a href="announcements.php"><i class='bx bx-calendar-event'></i>Announcements</a></li>
            <li><a href="tasklists.php"><i class='bx bx-task' ></i>Task Lists</a></li>
            <li class="active"><a href="empcustomermodule.php"><i class='bx bx-book-content'></i>Customer Module</a></li>
            <li><a href="projects.php"><i class='bx bx-folder-open'></i>Projects</a></li>
            <li><a href="empreports.php"><i class='bx bxs-report' ></i>Reports</a></li>
            <li><a href="empprofile.php"><i class='bx bx-user-circle'></i>Profile</a></li>
            <li><a href="empsettings.php"><i class='bx bx-cog' ></i>Settings</a></li>
            
          
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="logo.png">
            </a>
        </nav>

        <!-- End of Navbar -->
         <!-- module Page-->
         <div class="table_responsive">
    <div class="outer-wrapper">
    <div class="table-wrapper">
            <table class="table-sortable">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Platform</th>
                    <th>Agency</th>
                    <th>Agency (New)</th>
                    <th>Agency Grouping (New)</th>
                    <th>Brand</th>
                    <th>Brand (New)</th>
                    <th>Sub Brand (New)</th>
                    <th>Currency</th>
                    <th>Ad Account Name</th>
                    <th>Margin Fee</th>
                    <th>Credit Line Owner</th>
                    <th>Business Model</th>
                    <th>Industry</th>
                    <th>Report Type</th>
                    <th>Billing Name (Bill To)*</th>
                    <th>Billing Address*</th>
                    <th>Billing Contact Person*</th>
                    <th>Email Address*</th>
                    <th>Contact Number*</th>
                    <th>Collection Contact Person*</th>
                    <th>Email Address*</th>
                    <th>Contact Number*</th>
                    <th>Payment Terms*</th>
                    <th>Special Billing Instructions*</th>
                    <th>Billing Supporting Documents*</th>
                    <th>Invoice Type: Soft Copy or Hard Copy or Both?*</th>
                    <th>Billing Type*</th>
                    <th>Billing Entity*</th>
                    <th>Rebates %</th>
                    <th>Ampliva Share %</th>
                    <th>Action</th>
                </tr>
                  </thead>
    <tbody>
      <?php foreach ($recentCust as $cust) { ?>
        <tr>
          <td><?php echo $cust['id']; ?></td>
          <td><?php echo $cust['Platform']; ?></td>
          <td><?php echo $cust['Agency']; ?></td>
          <td><?php echo $cust['Agency (New)']; ?></td>
          <td><?php echo $cust['Agency Grouping (New)']; ?></td>
          <td><?php echo $cust['Brand']; ?></td>
          <td><?php echo $cust['Brand (New)']; ?></td>
          <td><?php echo $cust['Sub Brand (New)']; ?></td>
          <td><?php echo $cust['Currency']; ?></td>
          <td><?php echo $cust['Ad Account Name']; ?></td>
          <td><?php echo $cust['Margin Fee']; ?></td>
          <td><?php echo $cust['Credit Line Owner']; ?></td>
          <td><?php echo $cust['Business Model']; ?></td>
          <td><?php echo $cust['Industry']; ?></td>
          <td><?php echo $cust['Report Type']; ?></td>
          <td><?php echo $cust['Billing Name (Bill To)']; ?></td>
          <td><?php echo $cust['Billing Address']; ?></td>
          <td><?php echo $cust['Billing Contact Person']; ?></td>
          <td><?php echo $cust['Email Address']; ?></td>
          <td><?php echo $cust['Contact Number']; ?></td>
          <td><?php echo $cust['Collection Contact Person']; ?></td>
          <td><?php echo $cust['Email Address 2nd']; ?></td>
          <td><?php echo $cust['Contact Number 2nd']; ?></td>
          <td><?php echo $cust['Payment Terms']; ?></td>
          <td><?php echo $cust['Special Billing Instructions*']; ?></td>
          <td><?php echo $cust['Billing Supporting Documents*']; ?></td>
          <td><?php echo $cust['Invoice Soft Copy or Hard Copy?*']; ?></td>
          <td><?php echo $cust['Billing Type']; ?></td>
          <td><?php echo $cust['Billing Entity*']; ?></td>
          <td><?php echo $cust['Rebates %']; ?></td>
          <td><?php echo $cust['Adglow Share']; ?></td>
          <td>
            <span class="action_btn">
              <a href="#">Edit</a>
              <a href="#">Delete</a>
            </span>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
          
   </div>
   </div>
          
          
            
          </div>

    </main>

</div>

<script src="ampliva-emp-dashboard.js"></script>
<script src="tablesort.js"></script>

</body>

</html>