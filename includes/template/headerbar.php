<div class="top header">

  <a href="index.php" class="logo-box">
    <img src="<?php echo $img; ?>favicon.jpg" alt="" srcset="" />
    <div class="right logo-name">
      <div class="logo_ ">
        <h2>المغسلة </h2>
      </div>
      <h2 class="primary">الذكية</h2>
    </div>
  </a>


  <div class="left">
    <div class="buttons ">

      <div class="theme-toggler">
        <i class="fas fa-sun "></i>
        <i class="fas fa-moon active"></i>
      </div>

      <div class="notification-area d-flex gap-2">
        <!-- Notification bell -->
        <?php include 'notification.php' ?>
        <!-- notification ends -->
        <?php if (isset($_SESSION['admin_id'])) { ?>

          <a href="userCart.php" class="notifying">
            <i class="fa fa-shopping-cart ">
              <span class="translate-middle badge bg-danger ">
                <?php
                echo count_from_table("*", "orders", "WHERE customer_id = {$_SESSION["admin_id"]}", " AND orders.status = 'طلب جديد'");
                ?>
              </span>
            </i>
          </a>
        <?php } ?>
      </div>
    </div>

    <?php if (isset($_SESSION['admin_id'])) {
      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?  LIMIT 1");
      $stmt->execute(array($_SESSION['admin_id']));
      $info = $stmt->fetch();
      $count = $stmt->rowCount();
      if ($count > 0) {
    ?>
        <div class="profile">
          <div class="profile-photo">
            <a href='userProfile.php?userid=<?php echo $info['UserID'] ?>' class="username">
              <img src="<?php echo $avatars;
                        echo (!empty($info["Avatar"])) ?  $info["Avatar"] : "user.ico"; ?>" alt="" />
            </a>
          </div>
        </div>
      <?php
      }
    } else { ?>
      <div class="buttons">
        <a class="btn-login btn btn-primary " href="login.php?page=login">
          <span id="login_button">
            <i class="fas fa-right-to-bracket"></i>
            تسجيل الدخول
          </span>
        </a>
      </div>
    <?php } ?>
  </div>
</div>