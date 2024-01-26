<?php
  require_once('config.php');
  session_start();

  //Login Function and Check Admins/Table
  if(isset($_POST['login'])){
    if(isset($_POST['email'], $_POST['password'])){ // Check if email and password are set
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT userid, name, password, role, email FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);  
        $stmt->execute(); 
        $result = $stmt->get_result(); // Get the result set

        if($result->num_rows > 0){
            $user = $result->fetch_assoc(); // Fetch the result as an associative array

            if($user['password'] == $password){ // Compare passwords (consider using password_verify)
                echo "Login Successful";
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on user role
                if($user['role'] == 'admin'){
                    header('Location: AdminDash.php');
                    exit();
                } elseif($user['role'] == 'customer'){
                    header('Location: cust-dash.php');
                    exit();
                } elseif($user['role'] == 'employee'){
                  header('Location: ampliva-emp-dashboard.php');
                  exit();
              }
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found";
        }
    } else {
        echo "Email or password is missing";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ampliva Login</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <nav class="nav">
        <a href="#" class="nav_logo">Ampliva</a>


        <button class="button" id="form-open">Login</button>
      </nav>
    </header>

    <!-- Home -->
    
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
          <form method="post" action="index.php">
            <h2>Login</h2>
            <div class="input_box">
              <input type="email" name="email" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" name="password" placeholder="Enter your password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="forgotpass.php" class="forgot_pw">Forgot password?</a>
            </div>
 
            <button class="button" name="login">Login Now</button>
          </form>
        </div>
      </div>
    </section>

    <script src="script.js"></script>
  </body>
</html>
