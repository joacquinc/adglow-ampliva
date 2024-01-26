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
  if(basename($_SERVER['PHP_SELF']) !== 'tasklists.php') {
      header('Location: tasklists.php'); // Redirect to customer dashboard
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

//Table Tasks
$queryTask = "SELECT * FROM OpsTaskDB ORDER BY id";
    $resultTask = mysqli_query($mysqli, $queryTask);
    if ($resultTask) {
        while ($row = mysqli_fetch_assoc($resultTask)) {
            $recentTask[] = $row;
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
    <li><a href="announcements.php"><i class='bx bx-calendar-event'></i>Announcements</a></li>
    <li class="active"><a href="tasklists.php"><i class='bx bx-task' ></i>Task Lists</a></li>
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

<main>
	<div class="header">
		<div class="left">

			<h1>Tasklists</h1>
			
             

			</ul>
			
		</div>
	</div>

	<!--- start of task lists --->

<div class="bottom-data">
<div class="orders">
<div class="header">
<i class='bx bx-task' ></i>
<h3>Tasks Assigned</h3>
<a href="addtasks.php"><i class='bx bx-plus'></i></a>
<i class='bx bx-filter' ></i>

</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Task Name</th>
            <th>Task Start Date</th>
            <th>Task Deadline</th>
            <th>Date Added</th>
            <th>Due Date</th>
            <th>Assigned to</th>
            <th>Assigned By</th>
            <th>Designated Team</th>
            <th>PRIORITY</th>
            <th>Label</th>
            <th>AGENCY</th>
            <th>BRAND</th>
            <th>TASK</th>
            <th>STATUS</th>
            <th>Email Subject</th>
            <th>Collaborator</th>
            <th>Remarks</th>
        </tr>
 <tbody>
      <?php foreach ($recentTask as $Task) { ?>
        <tr>
          <td><?php echo $Task['id']; ?></td>
          <td><?php echo $Task['name']; ?></td>
          <td><?php echo $Task['task_name']; ?></td>
          <td><?php echo $Task['start_date']; ?></td>
          <td><?php echo $Task['deadline']; ?></td>
          <td><?php echo $Task['date_added']; ?></td>
          <td><?php echo $Task['due_date']; ?></td>
          <td><?php echo $Task['assigned_to']; ?></td>
          <td><?php echo $Task['assigned_by']; ?></td>
          <td><?php echo $Task['designated_team']; ?></td>
          <td><?php echo $Task['priority']; ?></td>
          <td><?php echo $Task['label']; ?></td>
          <td><?php echo $Task['agency']; ?></td>
          <td><?php echo $Task['brand']; ?></td>
          <td><?php echo $Task['task']; ?></td>
          <td><?php echo $Task['status']; ?></td>
          <td><?php echo $Task['email_subject']; ?></td>
          <td><?php echo $Task['collaborator']; ?></td>
          <td><?php echo $Task['remarks']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
        <!--name, task_name, start_date, deadline, date_added, due_date, assigned_to, assigned_by, designated_team, priority, label, agency, brand, task, status, email_subject, collaborator, remarks -->
</table>

               </div>
<!--- reminders --->

<div class="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Reminders</h3>
                        <i class='bx bx-plus'></i>  
                        <i class='bx bx-filter'></i>
                        
                    </div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Task Name</th>
            <th>Task Name</th>
        </tr>
 <tbody>
      <?php foreach ($recentTask as $Task) { ?>
        <tr>
          <td><?php echo $Task['id']; ?></td>
          <td><?php echo $Task['name']; ?></td>
          <td><?php echo $Task['task_name']; ?></td>
          <td><?php echo $Task['task_name']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
        <!--name, task_name, start_date, deadline, date_added, due_date, assigned_to, assigned_by, designated_team, priority, label, agency, brand, task, status, email_subject, collaborator, remarks -->
</table>

                </div>

                <!-- End of Reminders-->



</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>