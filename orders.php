<?php
ob_start();
session_start();
$pageTitle = "ادارة الطلبات ";
$dir = 'rtl';
$noNavbar = "";
// error_reporting(0);
if ((!isset($_SESSION["admin_name"])) && (!isset($_SESSION['role'])) && ($_SESSION['role'] != 1)) {
  header("location:index.php");
  exit();
}
include 'init.php'; ?>


<!-- ============= Home Section =============== -->

<section class="home">
  <!-- ==================== START MAIN ==================== -->
  <div class="title-date ">
    <h1 class="me-4">إدارة الطلبات</h1>
    <div class="date">
      <?php echo Date("d-m-Y"); ?>
      <!-- <input type="date" dir="ltr" value="2023-Apr-02" /> -->
    </div>
  </div>
  <main>
    <div class="insights">
      <div class="sales">
        <a href="orders.php?do=manage">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3> كافة الطلبات</h3>
              <h1><?php echo countItems("order_id", "orders") ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo countItems("order_id", "orders") ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- ----------------------- END SALES ----------------------- -->
      <div class="expanses">
        <a href="orders.php?do=manage&otype=w_i_fast">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3>غسل وكوي مستعجل </h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE order_type = 'غسيل وكوي مستعجل'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE order_type = 'غسيل وكوي مستعجل'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- ----------------------- END EXPENSES ----------------------- -->
      <div class="income">
        <a href="orders.php?do=manage&otype=w_i">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3>غسل وكوي </h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE order_type = 'غسيل وكوي'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE order_type = 'غسيل وكوي'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="sales">
        <a href="orders.php?do=manage&otype=w_only">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3>غسل فقط </h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE order_type = 'غسيل فقط'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE order_type = 'غسيل فقط'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="expanses">
        <a href="orders.php?do=manage&otype=i_only">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3> كوي فقط </h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE order_type = 'كوي فقط'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE order_type = 'كوي فقط'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="income">
        <a href="orders.php?do=manage&status=new">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3>طلب جديد </h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE status = 'طلب جديد'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE status = 'طلب جديد'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="sales">
        <a href="orders.php?do=manage&status=process">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3>طلب قيد المعالجة </h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE status = 'قيد المعالجة'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE status = 'قيد المعالجة'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="expanses">
        <a href="orders.php?do=manage&status=received">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3>تم التسليم</h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE status = 'تم التسليم'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE status = 'تم التسليم'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="income">
        <a href="orders.php?do=manage&status=dropped">
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <div class="middle">
            <div class="left">
              <h3> طلب مرفوض</h3>
              <h1><?php echo count_fields("order_id", "orders", "WHERE status = 'مرفوض'"); ?></h1>
            </div>
            <div class="my-progress">
              <div class="circular-progress">
                <span class="progress-value"><?php echo count_fields("order_id", "orders", "WHERE status = 'مرفوض'"); ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- ----------------------- END INCOME ----------------------- -->
    </div>
    <!-- ----------------------- END INSIGHTS ----------------------- -->
    <div class="recent-orders">
      <a href="orders.php?do=add" class="btn btn-primary col-lg-6 col-md-6 col-sm-8"><i class="fa fa-plus"></i> عميل جديد</a>
      <?php
      // start member page 
      $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

      $where = NULL;
      if ($do == "manage") { // manage page
        if (isset($_GET['otype'])) {
          if ($_GET['otype'] === "w_i_fast") {
            $where = "WHERE order_type = 'غسيل وكوي مستعجل'";
          }
          if ($_GET['otype'] === "w_i") {
            $where = "WHERE order_type = 'غسيل وكوي'";
          }
          if ($_GET['otype'] === "w_only") {
            $where = "WHERE order_type = 'غسيل فقط' ";
          }
          if ($_GET['otype'] === "i_only") {
            $where = "WHERE order_type = 'كوي فقط'";
          }
        }
        if (isset($_GET['status'])) {
          if ($_GET['status'] === "new") {
            $where = "WHERE status ='طلب جديد'";
          }
          if ($_GET['status'] === "process") {
            $where = "WHERE status = 'قيد المعالجة'";
          }
          if ($_GET['status'] === "received") {
            $where = "WHERE status = 'تم التسليم' ";
          }
          if ($_GET['status'] === "dropped") {
            $where = "WHERE status = 'مرفوض'";
          }
        }
        $statement = $con->prepare("SELECT orders.*, items.* 
                                    FROM orders
                                    INNER JOIN items ON  items.Item_ID  = orders.item_id 
                                    {$where}
                                    ORDER BY orders.order_date DESC
                                    ");
        $statement->execute();
        $items  = $statement->fetchAll();
        if (!empty($items)) {
      ?>

          <div class="row mb-2">
            <h2 class=" d-flex align-items-center"> آخر الطلبات </h2>

          </div>
          <table class="data_table table table-responsive">
            <thead>
              <tr>
                <th colspan="2">المنتج</th>
                <th>نوع الخدمة</th>
                <th>التاريخ</th>
                <th>سعر المنتج</th>
                <th>الكمية</th>
                <th>المجموع</th>
                <th>الحالة</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($items as $item) {
              ?>
                <tr class="<?php if ($item['status']  === "تم التسليم") echo "success";
                            elseif ($item['status']  === "مرفوض") echo "danger";
                            elseif ($item['status']  === "قيد المعالجة") echo "warning"; ?>">
                  <td>
                    <a href='#' class="username">
                      <div class="image"><img src='<?php echo $itemImg; ?><?php echo (!empty($item["Image"])) ? $item["Image"] : "img.png"; ?>'></div>
                    </a>
                  </td>
                  <td><?php echo $item["Name"] ?></td>
                  <td><?php echo $item['order_type'] ?></td>
                  <td><?php echo $item['order_date'] ?></td>
                  <td><?php echo $item['Price']; ?> ر.س</td>
                  <td><?php echo $item['quantity'] ?></td>
                  <td class="total_price"><span class="price"> <?php echo $item['quantity'] * $item['Price']; ?></span> ر.س</td>
                  <td><strong> <?php echo $item['status'] ?></strong></td>
                  <td>
                    <span class=" control d-flex gap-2">
                      <a href='?do=agree&orderid=<?php echo $item["order_id"] ?>' class='show-tittle round' my_tittle="قبول الطلب"> <i class="fas fa-thumbs-up success "></i> </a>
                      <a href='?do=disagree&orderid=<?php echo $item["order_id"] ?>' class='show-tittle round' my_tittle="رفض الطلب"> <i class="fas fa-thumbs-down danger "></i> </a>
                      <a href='?do=done&orderid=<?php echo $item["order_id"] ?>' class='show-tittle round' my_tittle="تم التسليم"> <i class="fas fa-truck primary "></i> </a>
                    </span>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php
        } else { ?>
          <div class="border border-2 border-danger p-3 text-center round-2 font-bold">
            <h2>لا يوجد طلبات </h2>
          </div>
        <?php  } ?>
    </div>
  </main>

<?php
      } elseif ($do == "agree") {

        $order_id = (isset($_GET["orderid"]) && is_numeric($_GET["orderid"])) ? intval($_GET['orderid']) : 0;
        $order = get_one_from_table("*", 'orders', "WHERE order_id = {$order_id}", "", "order_id");

        if ($order > 0) {
          $stmt = $con->prepare("UPDATE orders SET `status` = 'قيد المعالجة' WHERE order_id =?");
          $stmt->execute(array($order_id));
          if ($stmt) {

            $stmt_del = $con->prepare("DELETE FROM notify WHERE order_id =?");
            $stmt_del->execute(array($order_id));

            $stmt_insert = $con->prepare("INSERT INTO `notify`(`touser`, `massage`, `order_id`) VALUES (?,'طلبك قيد المعالجة',?)");
            $stmt_insert->execute(array($order['customer_id'], $order_id));

            if ($stmt_insert) {
              redirectHome("success", "تم تحديث حالة الطلب بنجاح ", "orders.php");
            }
          }
        } else {
          redirectHome("warning", "عذراَ هذا الطلب غير موجود", "orders.php");
        }
      } elseif ($do == "disagree") {

        $order_id = (isset($_GET["orderid"]) && is_numeric($_GET["orderid"])) ? intval($_GET['orderid']) : 0;
        $order = get_one_from_table("*", 'orders', "WHERE order_id = {$order_id}", "", "order_id");

        if ($order > 0) {
          $stmt = $con->prepare("UPDATE orders SET `status` = 'مرفوض' WHERE order_id =?");
          $stmt->execute(array($order_id));
          if ($stmt) {

            $stmt_del = $con->prepare("DELETE FROM notify WHERE order_id =?");
            $stmt_del->execute(array($order_id));

            $stmt_insert = $con->prepare("INSERT INTO `notify`(`touser`, `massage`, `order_id`) VALUES (?,'تم رفض طلبك',?)");
            $stmt_insert->execute(array($order['customer_id'], $order_id));

            if ($stmt_insert) {
              redirectHome("success", "تم تحديث حالة الطلب بنجاح ", "orders.php");
            }
          }
        } else {
          redirectHome("warning", "عذراَ هذا الطلب غير موجود", "orders.php");
        }
      } elseif ($do == "done") {

        $order_id = (isset($_GET["orderid"]) && is_numeric($_GET["orderid"])) ? intval($_GET['orderid']) : 0;
        $order = get_one_from_table("*", 'orders', "WHERE order_id = {$order_id}", "", "order_id");

        if ($order > 0) {
          $stmt = $con->prepare("UPDATE orders SET `status` = 'تم التسليم' WHERE order_id =?");
          $stmt->execute(array($order_id));
          if ($stmt) {

            $stmt_del = $con->prepare("DELETE FROM notify WHERE order_id =?");
            $stmt_del->execute(array($order_id));

            $stmt_insert = $con->prepare("INSERT INTO `notify`(`touser`, `massage`, `order_id`) VALUES (?,'لقد تم تسليم طلبك , شكرا للتعمل معنا',?)");
            $stmt_insert->execute(array($order['customer_id'], $order_id));

            if ($stmt_insert) {
              redirectHome("success", "تم تحديث حالة الطلب بنجاح ", "orders.php");
            }
          }
        } else {
          redirectHome("warning", "عذراَ هذا الطلب غير موجود", "orders.php");
        }
      }
?>

</section>


<?php
include $tpl . 'footer.php';

ob_end_flush();
?>