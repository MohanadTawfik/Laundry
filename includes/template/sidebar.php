  <div class="sidebar close">
    <!-- ========== Logo ============  -->
    <a href="#" class="logo-box">
      <img src="<?php echo $img; ?>favicon.jpg" alt="" srcset="" />
      <div class="right logo-name">
        <div class="logo_ ">
          <h2>المغسلة </h2>
        </div>
        <h2 class="primary">الذكية</h2>
      </div>
    </a>
    <div class="toggle-sidebar">
      <i class="fa fa-caret-right" aria-hidden="true"></i>
    </div>

    <!-- ========== List ============  -->
    <ul class="sidebar-list">
      <?php if ((isset($_SESSION["admin_name"])) && (isset($_SESSION['role'])) && ($_SESSION['role'] == "عامل")) { ?>
        <li>
          <div class="title">
            <a href="dashboard.php" class="link">
              <span class="icon">
                <i class="fa fa-dashboard" aria-hidden="true"></i>
              </span>
              <h3 class="name">لوحة التحكم</h3>
            </a>
          </div>
          <div class="submenu">
            <a href="dashboard.php" class="link submenu-title">لوحة التحكم</a>
          </div>
        </li>

        <li class="dropdown">
          <div class="title">
            <a class="link">
              <span class="icon">
                <i class="fas fa-tasks" aria-hidden="true"></i>
              </span>
              <h3 class="name">الأقسام</h3>
              <i class="fa fa-sort-down arrow" aria-hidden="true"></i>
            </a>
          </div>
          <div class="submenu">
            <a href="categories.php" class="link submenu-title"> إدارة الأقسام</a>
            <a href="categories.php?do=add" class="link">إضافة قسم </a>
          </div>
        </li>


        <li class="dropdown">
          <div class="title">
            <a class="link">
              <span class="icon">
                <i class="fa fa-tags" aria-hidden="true"></i>
              </span>
              <h3 class="name">المنتجات</h3>
              <i class="fa fa-sort-down arrow" aria-hidden="true"></i>
            </a>
          </div>
          <div class="submenu">
            <a href="items.php" class="link submenu-title"> إدارة المنتجات</a>
            <a href="items.php?do=add" class="link">إضافة منتج </a>
          </div>
        </li>


        <li class="dropdown">
          <div class="title">
            <a class="link">
              <span class="icon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </span>
              <h3 class="name">الطلبات</h3>
              <i class="fa fa-shopping-cart arrow" aria-hidden="true"></i>
            </a>
          </div>
          <div class="submenu">
            <a href="orders.php" class="link submenu-title"> إدارة الطلبات</a>
            <a href="orders.php?do=add" class="link">إضافة طلب </a>
            <hr>
            <a href="orders.php?do=manage&otype=w_i_fast" class="link">غسل وكوي مستعجل</a>
            <a href="orders.php?do=manage&otype=w_i" class="link">غسل وكوي</a>
            <a href="orders.php?do=manage&otype=w_only" class="link">غسل فقط</a>
            <a href="orders.php?do=manage&otype=i_only" class="link">كوي فقط</a>
            <hr>
            <a href="orders.php?do=manage&status=new" class="link"> طلب جديد</a>
            <a href="orders.php?do=manage&status=process" class="link"> طلب قيد المعالجة</a>
            <a href="orders.php?do=manage&status=received" class="link"> طلب تم التسليم</a>
            <a href="orders.php?do=manage&status=dropped" class="link"> طلب مرفوض</a>
          </div>
        </li>
      <?php } else { ?>
        <li>
          <div class="title">
            <a href="index.php" class="link">
              <span class="icon">
                <i class="fa fa-home" aria-hidden="true"></i>
              </span>
              <h3 class="name">الرئيسية</h3>
            </a>
          </div>
          <div class="submenu">
            <a href="index.php" class="link submenu-title">الرئيسية</a>
          </div>
        </li>

        <li class="dropdown">
          <div class="title">
            <a href="#" class="link">
              <span class="icon">
                <i class="fas fa-tasks" aria-hidden="true"></i>
              </span>
              <h3 class="name">الأقسام</h3>
              <i class="fa fa-sort-down arrow" aria-hidden="true"></i>
            </a>
          </div>
          <div class="submenu">
            <a href="#" class="link submenu-title">الأقسام</a>
            <?php foreach (get_from_table("*", "categories", "", "", "ID", "ASC") as $cat) { ?>
              <a class="nav-link  active" aria-current="page" href="items-main.php?page-id=<?php echo $cat['ID'] . '&page-name=' . str_replace(" ", "-", $cat['Name']) ?>"><?php echo $cat['Name']; ?></a>
            <?php } ?>
          </div>
        </li>
        <?php if ((isset($_SESSION["admin_name"])) && (isset($_SESSION['role'])) && ($_SESSION['role'] == "عميل")) { ?>
          <li>
            <div class="title">
              <a href="">
                <span class="icon">
                  <i class="fa fa-tag" aria-hidden="true"></i>
                </span>
                <h3 class="name"> نوع الخدمات</h3>
              </a>
            </div>
            <div class="submenu">
              <a href="#" class="link submenu-title"> نوع الخدمات</a>
              <a class="nav-link  active" aria-current="page" href="items-main.php?otype=w_i_fast"> غسل وكوي مستعجل </a>
              <a class="nav-link  active" aria-current="page" href="items-main.php?otype=w_i">غسل وكوي</a>
              <a class="nav-link  active" aria-current="page" href="items-main.php?otype=w_only">غسل فقط</a>
              <a class="nav-link  active" aria-current="page" href="items-main.php?otype=i_only">كوي فقط</a>
            </div>
          </li>
        <?php } ?>
      <?php } ?>

    </ul>


    <ul class="sidebar-list">
      <li>
        <div class="title">
          <a href="logout.php" class="link">
            <span class="icon">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
            </span>
            <h3 class="name">تسجيل الخروج</h3>
          </a>
        </div>
        <div class="submenu">
          <a href="#" class="link submenu-title">تسجيل الخروج</a>
        </div>
      </li>
    </ul>
  </div>