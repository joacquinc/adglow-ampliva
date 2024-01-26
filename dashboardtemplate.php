<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="styledash.css">
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
	<li><a href="AdminDash.html"><i class='bx bx-home' ></i>Home</a></li>
	<li><a href="AdminAccountsPage.html"><i class='bx bxs-user-account' ></i>Accounts</a></li>
	<li><a href="Adminprofile.html"><i class='bx bx-user-circle'></i>Profile</a></li>
	<li><a href="Adminsettings.html"><i class='bx bx-cog' ></i>Settings</a></li>
	
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



</main>


</div>

<script src="ampliva-emp-dashboard.js"></script>

</body>



</html>