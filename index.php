<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <div class="side-container">
        <img src="assets/pup-logo.png" alt="PUP Logo">
        <div id="site-title">
            <h1>PUP</h1>
            <h2>Online Transaction Management System</h2>
        </div>
        <p><i class="fa-solid fa-arrow-down"></i> Please click or tap the appropriate button</p>
        <a id="student" class="link-btn" href="login/student.php">Student</a>
        <a id="client" class="link-btn" href="login/client.php">
            <div>
                <p>Client</p>
                <p class="small">PUP Alumnus/Alumna, Parent, General Public, Others</p>
            </div>
        </a>
        <a id="admin" class="link-btn" href="login/admin.php">College/Office Administrator</a>
        <p>Haven't registered an account yet? <a id="signup-link" href="#">Sign up</a></p>
        <p>By using this service, you understood and agree to the PUP Online Services <a href="https://www.pup.edu.ph/terms/" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/privacy/" target="_blank">Privacy Statement</a></p>
    </div>
    <div id="signup-modal">
        <div class="modal-bg"></div>
        <div class="modal-container">
            <div class="col-container">
                <p>Create New Account</p>
                <a class="modal-close" href="#"><i class="fa-solid fa-xmark"></i></a>
            </div>
            <form method="post" actions="register.php" id="signup-form">
                <h2>Personal Details</h2>
                <div class="personal-details">
                    <div class="form-group">
                        <label class="required" for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" required>
                    </div>
                    <div class="form-group">
                        <label for="middle-name">Middle Name</label>
                        <input type="text" id="middle-name" name="middle-name">
                    </div>
                    <div class="form-group">
                        <label for="extension-name">Extension Name</label>
                        <input type="text" id="extension-name" name="extension-name">
                    </div>
                    <div class="form-group">
                        <label class="required" for="contact-number">Contact Number</label>
                        <input type="tel" id="contact-number" name="contact-number" pattern="[0-9]{10}" required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="birthdate">Birthdate</label>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="sex">Sex</label>
                        <select id="sex" name="sex" required>
                            <option value="">-- Select --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="required" for="home-address">Home Address</label>
                        <textarea id="home-address" name="home-address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="required" for="province">Province</label>
                        <input type="text" id="province" name="province" required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="barangay">Barangay</label>
                        <input type="text" id="barangay" name="barangay" required>
                    </div>
                    <div class="form-group">
                        <label for="zip-code">Zip Code</label>
                        <input type="text" id="zip-code" name="zip-code" pattern="[0-9]{4}">
                    </div>
                </div>
                <div class="account-details">
                    <h2>Account Details</h2>
                    <div class="form-group">
                    <label class="required" for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                    <label class="required" for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                    <label class="required" for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                </div>
                <div class="col-container">
                    <a class="btn modal-close" href="#">Close</a>
                    <button class="btn" type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#signup-link').click(function(e) {
                e.preventDefault();
                $('#signup-modal').fadeIn(150).css('display', 'flex');
                $('.modal-container').animate({
                    top: '91%',
                    opacity: '1'
                }, 300);
            });

            $('.modal-close').click(function(e) {
                $('.modal-container').animate({
                    top: '85%',
                    opacity: '0'
                }, 300);
                $('#signup-modal').fadeOut(150).css('display', 'none');
            });
        });
    </script>
</body>
</html>