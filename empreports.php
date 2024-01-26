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
            <li><a href="empcustomermodule.php"><i class='bx bx-book-content'></i>Customer Module</a></li>
            <li><a href="projects.php"><i class='bx bx-folder-open'></i>Projects</a></li>
            <li class="active"><a href="empreports.php"><i class='bx bxs-report' ></i>Daily Reporting</a></li>

            <ul class="submenu">
                <li><a href="empbrands.php">Brands</a></li>
                <li><a href="empcampaigns.php">Campaigns</a></li>
                <!-- Add more submenu items as needed -->
            </ul>


            <li><a href="empprofile.html"><i class='bx bx-user-circle'></i>Profile</a></li>
            <li><a href="empsettings.html"><i class='bx bx-cog' ></i>Settings</a></li>
            
          
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
<main>
	<div class="header">
		<div class="left">

			<h1>DAILY REPORTING</h1>	
			
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

</div>

 <!-- Scripts -->
  <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>

<script src="ampliva-emp-dashboard.js"></script>
</body>

</html>