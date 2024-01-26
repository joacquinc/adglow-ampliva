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
  if(basename($_SERVER['PHP_SELF']) !== 'addtasks.php') {
      header('Location: addtasks.php'); // Redirect to customer dashboard
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

if (isset($_POST['register'])) {
  // Get form data
    $name = $_POST['name']; // Assuming this is user's name
    $task_name = $_POST['task_name'];
    $start_date = $_POST['start_date'];
    $deadline = $_POST['deadline'];
    $date_added = $_POST['date_added'];
    $due_date = $_POST['due_date'];
    $assigned_to = $_POST['assigned_to'];
    $assigned_by = $_POST['assigned_by'];
    $designated_team = $_POST['designated_team'];
    $priority = $_POST['priority'];
    $label = $_POST['label'];
    $agency = $_POST['agency'];
    $brand = $_POST['brand'];
    $task = $_POST['task'];
    $status = $_POST['status'];
    $email_subject = $_POST['email_subject'];
    $collaborator = $_POST['collab']; // Assuming this is collaborator
    $remarks = $_POST['remarks'];

  // Validate and sanitize form data if needed

  // Insert data into the 'OpsTasks' table
    $sql = "INSERT INTO OpsTaskDB (name, task_name, start_date, deadline, date_added, due_date, assigned_to, assigned_by, designated_team, priority, label, agency, brand, task, status, email_subject, collaborator, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssssssssssss", $name, $task_name, $start_date, $deadline, $date_added, $due_date, $assigned_to, $assigned_by, $designated_team, $priority, $label, $agency, $brand, $task, $status, $email_subject, $collab, $remarks);
    $stmt->execute();
  
  // Check if the insertion was successful
  if ($stmt->affected_rows > 0) {
      // Registration successful
      header("Location: tasklists.php");
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
            <li class="active"><a href="tasklists.php"><i class='bx bx-task' ></i>Task Lists</a></li>
            <li><a href="empcustomermodule.php"><i class='bx bx-book-content'></i>Customer Module</a></li>
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
        <!--Add tasks-->
    <form method="post" action="addtasks.php">
  <div class="container">
    <h1>Add new Task</h1>
    <p>Please fill in this form to add new Task.</p>
    <hr>

    <label for="name">Name:</label>
    <input type="text" id="name" required>

    <label for="task_name">Task Name:</label>
    <input type="text" id="task_name" required>

    <label for="date_added">Date Added:</label>
    <input type="date" id="date_added" required>

    <label for="due_date">Due Date:</label>
    <input type="date" id="due_date" required>

    <label for="assigned_to">Assigned to:</label>
    <input type="text" id="assigned_to" required>

    <label for="assigned_by">Assigned By:</label>
    <input type="text" id="assigned_by" required>

    <label for="designated_team">Designated Team:</label>
    <input type="text" id="designated_team" required>

<label for="priority">PRIORITY:</label>
    <select id="priority" required>
        <option value="High">High</option>
        <option value="Low">Low</option>
        <!-- Add other options -->
    </select>

    <label for="label">Label:</label>
    <select id="label" required>
        <option value="QA / Double Checking">QA / Double Checking</option>
        <option value="For Implem (Meta)">For Implem (Meta)</option>
        <option value="For Implem (Tiktok)">For Implem (Tiktok)</option>
        <option value="For Revision">For Revision</option>
        <option value="Add Material">Add Material</option>
        <option value="For Follow-Up">For Follow-Up</option>
        <option value="For Optimization">For Optimization</option>
        <option value="Follow Up Approval">Follow Up Approval</option>
        <option value="For Confirmation">For Confirmation</option>
        <option value="For Update">For Update</option>
        <option value="Unlink">Unlink</option>
        <option value="Publish Post">Publish Post</option>
        <option value="For Proposal">For Proposal</option>
        <option value="Media Review">Media Review</option>
        <option value="Requested Report">Requested Report</option>
        <option value="Status Report">Status Report</option>
        <option value="EOC Report">EOC Report</option>
        <option value="Facebook Support">Facebook Support</option>
        <option value="Rule">Rule</option>
        <option value="JIRA">JIRA</option>
        <option value="Disapproved Ad">Disapproved Ad</option>
        <option value="Disabled Ad Account">Disabled Ad Account</option>
        <option value="Ops Table">Ops Table</option>
        <option value="Incident Report">Incident Report</option>
        <option value="Pixel Code">Pixel Code</option>
        <option value="Weekly Report">Weekly Report</option>
        <option value="For Appeal">For Appeal</option>
            <!-- Add other options -->
    </select>

    <label for="agency">AGENCY:</label>
    <input type="text" id="agency" required>

    <label for="brand">BRAND:</label>
    <input type="text" id="brand" required>

    <label for="task">TASK:</label>
    <input type="text" id="task" required>

    <label for="status">STATUS:</label>
    <input type="text" id="status" required>

    <label for="email_subject">Email Subject:</label>
    <input type="text" id="email_subject" required>

    <label for="remarks">Collaborator:</label>
    <input type="text" id="collab" required>

    <label for="remarks">Remarks:</label>
    <input type="text" id="remarks" required>


    <hr>
    <button type="submit" name="register" class="registerbtn">Add Tasks</button>
    
</form>


    </main>

</div>

<script src="ampliva-emp-dashboard.js"></script>
</body>

</html>