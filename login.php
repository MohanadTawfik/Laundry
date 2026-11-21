<?php
ob_start();
session_start();
$no_head_and_nav = "";
$pageTitle = "تسجيل الدخول";
$dir = 'ltr';
// error_reporting(0);



if (isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit(0);
} else {
    include 'init.php';
?>

    <style>
        /*-------------------- 23. Login ------------------- */

        .login-area {
            background: #f3f8fb;
        }

        .login-box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            min-height: 100vh;
        }

        .login-box form {
            margin: auto;
            width: 450px;
            max-width: 100%;
            background: #fff;
            border-radius: 3px;
        }

        .login-form-head {
            text-align: center;
            background: #8655fc;
            padding: 50px;
        }

        .login-form-head h4 {
            letter-spacing: 0;
            text-transform: uppercase;
            font-size: calc(1.275rem + 0.3vw);
            font-weight: 600;
            margin-bottom: 7px;
            color: #fff;
        }

        .login-form-head p {
            color: #fff;
            font-size: 14px;
            line-height: 22px;
        }

        .login-form-body {
            padding: 50px;
        }

        .form-gp {
            margin-bottom: 25px;
            position: relative;
            font-weight: bold;
        }

        .login-form-body a {
            color: #007bff;
            text-align: right;
        }

        .login-form-body label {
            color: #b3b2b2;
            font-weight: 700;
        }


        .form-gp label {
            position: absolute;
            left: 0;
            top: 0;
            transition: all 0.3s ease 0s;
            display: inline-block;
            margin-bottom: 8px;
            margin-bottom: 0.5rem;
        }

        .form-gp.focused label {
            top: -20px;
            color: #7e74ff;
        }

        .form-gp input,
        .form-gp select {
            width: 100%;
            height: 30px;
            color: #4070f4;
            border: none;
            border-bottom: 2px solid #e6e6e6;
            font-weight: bold;
            background: transparent;
        }

        .form-gp select option {
            color: #4070f4;
            font-weight: bold;
        }

        .form-gp input:focus,
        .form-gp select:focus {
            outline: none;
        }



        .form-gp input::-webkit-input-placeholder,
        .form-gp select::-webkit-input-placeholder {
            color: #dad7d7;
        }

        .form-gp input::-moz-placeholder,
        .form-gp select::-moz-placeholder {
            color: #dad7d7;
        }

        .form-gp input:-ms-input-placeholder,
        .form-gp select:-ms-input-placeholder {
            color: #dad7d7;
        }

        .form-gp input:-moz-placeholder,
        .form-gp select:-moz-placeholder {
            color: #dad7d7;
        }

        .form-gp i {
            position: absolute;
            right: 5px;
            color: #7e74ff;
            font-size: 16px;
        }

        .rmber-area {
            float: right;
            font-size: 13px;
        }

        .submit-btn-area {
            text-align: center;
        }

        .submit-btn-area button {
            width: 100%;
            height: 40px;
            border: none;
            background: #fff;
            color: #585b5f;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0;
            font-weight: 600;
            font-size: 12px;
            box-shadow: 0 0 22px rgba(0, 0, 0, 0.07);
            -webkit-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .submit-btn-area button:hover {
            background: #2c71da;
            color: #ffffff;
        }

        .submit-btn-area button i {
            margin-left: 15px;
            transition: margin-right 0.3s ease 0s;
        }

        .submit-btn-area button:hover i {
            margin-right: 20px;
        }

        /* login-s2 */

        .login-s2 {
            background: #fff;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .login-s2:before {
            content: "";
            position: absolute;
            height: 206%;
            width: 97%;
            background: #fcfcff;
            border-radius: 50%;
            left: -42%;
            z-index: -1;
            top: -47%;
            box-shadow: inset 0 0 51px rgba(0, 0, 0, 0.1);
        }

        .login-s2 .login-form-head,
        .login-s2 .login-box form,
        .login-s2 .login-box form .form-gp input {
            background: transparent;
        }

        .login-s2 .login-form-head h4,
        .login-s2 .login-form-head p {
            color: #444;
        }

        /*-------------------- END Login ------------------- */
    </style>


    <!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <?php if (isset($_GET["page"]) && $_GET["page"] == "login") { ?>
                    <form id="login" name="login" action="?page=dologin" autocomplete="off" method="POST">
                        <div class="login-form-head">
                            <h4>لوحة تسجيل الدخول </h4>
                            <p>نظام المغسلة الذكية</p>
                            <?php if (isset($msg)) { ?><div class="alert alert-info "> <?php echo htmlentities($msg); ?> </div><?php } ?>
                        </div>

                        <div class="login-form-body">
                            <div class="form-gp">
                                <input type="text" id="username" name="username" autocomplete="off" required>
                                <label for="username">إسم المستخدم</label>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <input type="password" id="password" name="password" autocomplete="off" required>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <label for="password">كلمة المرور</label>
                                <div class="text-danger"></div>
                            </div>
                            <div class="row mb-4 rmber-area">
                                <div class="mr-sm-2">
                                    <a href="login.php?page=signup">
                                        إنشاء حساب
                                    </a>
                                    <label class="form-check-label" for="customControlAutosizing">ليس لدي حساب ؟</label>
                                </div>
                            </div>
                            <div class="submit-btn-area">
                                <button id="form_submit" type="submit" name="signin"><i class="fa fa-arrow-left" aria-hidden="true"></i> تسجيل الدخول</button>
                            </div>
                        </div>
                    </form>

                <?php } else if (isset($_GET["page"]) && $_GET["page"] == "signup") { ?>

                    <form id="signup" name="signup" action="?page=dosignup" method="POST" autocomplete="off">
                        <div class="login-form-head">
                            <h4>لوحة إنشاء حساب </h4>
                            <?php if (isset($msg)) { ?><div class="alert alert-info "> <?php echo htmlentities($msg); ?> </div><?php } ?>
                        </div>

                        <div class="login-form-body">
                            <div class="form-gp">
                                <input type="text" id="user" name="user" autocomplete="off" required>
                                <label for="user">إسم المستخدم</label>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <input type="password" id="pass" name="pass" autocomplete="off" required>
                                <label for="pass">كلمة المرور</label>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <input type="password" id="con-pass" name="con-pass" autocomplete="off" required>
                                <label for="con-pass">تـاكيد كلمة المرور </label>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <input type="email" id="email" name="email" autocomplete="off" required>
                                <label for="email">البريد الالكتروني</label>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <input type="text" id="full" name="full" autocomplete="off" required>
                                <label for="full"> الاسم الكامل</label>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <select name="group" id="group" required>
                                    <option value="عميل" selected> عميل </option>
                                    <option value="عامل"> عامل </option>
                                </select>
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <div class="text-danger"></div>

                            </div>
                            <div class="row mb-4 rmber-area">
                                <div class="mr-sm-2">
                                    <a href="login.php?page=login">
                                        تسجيل الدخول
                                    </a>
                                    <label class="form-check-label" for="customControlAutosizing"> لدي حساب بالفعل ؟</label>
                                </div>
                            </div>

                            <div class="submit-btn-area">
                                <button id="form_submit" type="submit" name="signin"><i class="fa fa-arrow-left" aria-hidden="true"></i> تسجيل الدخول</button>
                            </div>
                        </div>
                    </form>
                <?php } elseif (isset($_GET["page"]) && $_GET["page"] == "dologin") {
                    /// check if user coming from HTTP request
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $hashPass = sha1($password);


                        // check if user exist in database
                        $stmt = $con->prepare("SELECT UserID , Username, `password`, user_type FROM users WHERE Username = ? AND `password` = ?");
                        $stmt->execute(array($username, $hashPass));
                        $row = $stmt->fetch();
                        $count = $stmt->rowCount();

                        // if count > 0 this mean the database contain the record about this username
                        if ($count > 0) {
                            $_SESSION['admin_name'] = $username; // register session name
                            $_SESSION['admin_id'] = $row['UserID']; // register session ID
                            $_SESSION['role'] = $row['user_type']; // register session ID

                            if ($row['user_type']  == 'عامل') {
                                header('location: dashboard.php');
                            } else {
                                header('location: index.php');
                            }
                        } else {
                            header('location: login.php?page=login');
                        }
                    }
                } elseif (isset($_GET["page"]) && $_GET["page"] == "dosignup") {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $user = $_POST['user'];
                        $password = $_POST['pass'];
                        $password2 = $_POST['con-pass'];
                        $email = $_POST['email'];
                        $full = $_POST['full'];
                        $group = $_POST['group'];

                        $form_errors = [];
                        // filter name
                        if (isset($user)) {
                            $filter_user = filter_var($user, FILTER_SANITIZE_STRING);
                            if (strlen($filter_user) < 4) {
                                $form_errors[] = "إسم المستخدم  يجب أن يكون أكبر من 4 أحرف";
                            }
                        }

                        // filter name
                        if (isset($full)) {
                            $filter_user = filter_var($user, FILTER_SANITIZE_STRING);
                            if (strlen($filter_user) < 4) {
                                $form_errors[] = "الاسم الكامل يجب أن يكون أكبر من 4 أحرف";
                            }
                        }

                        // filter password
                        if (isset($password) && isset($password2)) {
                            if (empty($password)) {
                                $form_errors[] = "عذراً كلمة المرور فارغة";
                            }
                            if (sha1($password) !== sha1($password2)) {
                                $form_errors[] = "عذراً كلمة المرور غير مطابقه";
                            }
                        }

                        // filter email
                        if (isset($email)) {
                            $filter_email = filter_var($email, FILTER_SANITIZE_EMAIL);
                            if (filter_var($filter_email, FILTER_VALIDATE_EMAIL) != true) {
                                $form_errors[]  = "الإيميل غير صحيح";
                            }
                        }


                        // check if no error 
                        if (empty($form_errors)) {
                            //check if user exist in database
                            $check = checkItem("Username", 'users', $filter_user);
                            if ($check == 1) {
                                $form_errors[] =  "عذراً هذا المستخدم موجود";
                            } else {
                                // insert user info to database 
                                $stmt = $con->prepare("INSERT INTO users(Username,`password`,UserEmail, FullName ,user_type) VALUES(:userV, :passV ,:emailV,:fullV, :group)");
                                $stmt->execute(array('userV' => $filter_user, 'passV' => sha1($password), 'emailV' => $filter_email, 'fullV' => $full, 'group' => $group));
                                $successMsg = "تم إنشاء الحساب بنجاح .. بمكنك الان تسجيل الدخول";
                                header('location: login.php?page=login');
                            }
                        }
                    }
                } ?>
            </div>
        </div>

    </div>





<?php
}
include $tpl . 'footer.php';
ob_end_flush();
