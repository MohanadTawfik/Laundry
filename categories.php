<?php
ob_start();
session_start();
$pageTitle = "ادارة الاقسام ";
$dir = 'rtl';
$noNavbar = "";
// // error_reporting(0);

if ((!isset($_SESSION["admin_name"])) && (!isset($_SESSION['role'])) && ($_SESSION['role'] != 1)) {
  header("location:index.php");
  exit();
}
include 'init.php';
?>

<section class="home">
  <!-- ==================== START MAIN ==================== -->
  <div class="title-date ">
    <h1 class="me-4">
      <div class="date">
        <?php echo Date("d-m-Y"); ?>
        <!-- <input type="date" dir="ltr" value="2023-Apr-02" /> -->
      </div>
    </h1>
  </div>

  <main>
    <div class="insights">

    </div>
    <!-- ----------------------- END INSIGHTS ----------------------- -->
    <div class="recent-orders">

      <?php
      // start member page 
      $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

      if ($do == "manage") { // manage page
      ?>
        <a href="categories.php?do=add" class="btn btn-primary col-lg-6 col-md-6 col-sm-8"><i class="fa fa-plus"></i> قسم جديد</a>
        <?php
        // latest Registered Items



        $stmt = $con->prepare("SELECT * FROM categories ");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        if (!empty($rows)) {
        ?>

          <div class="row mb-2">
            <h2 class=" d-flex align-items-center"> آحر الاقسام </h2>

          </div>

          <table class="data_table table table-responsive">
            <thead>
              <tr>
                <th>ID</th>
                <th>إسم القسم</th>
                <th>الوصف</th>
                <th>عدد المنتجات</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rows as $row) { ?>
                <tr>
                  <td> <?php echo $row["ID"]  ?></td>
                  <td><?php echo $row["Name"] ?> </td>
                  <td> <?php echo $row["Description"] ?></td>
                  <td> <?php echo count_from_table("*", "items", "WHERE Cat_ID = {$row["ID"]}", ""); ?></td>
                  <td class="primary">
                    <span class=" control d-flex gap-2">
                      <a href='categories.php?do=edit&catid=<?php echo $row["ID"] ?>' class='show-tittle round' my_tittle="تعديل القسم"><i class='fa fa-edit success'></i></a>
                      <a href='categories.php?do=delete&catid=<?php echo $row["ID"] ?>' class='show-tittle confirm round ' my_tittle="حذف القسم"><i class='fa fa-trash danger'></i></a>
                    </span>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php
        } ?>
    </div>
  </main>
  <!-- ==================== END MAIN ==================== -->

  <!-- ==================== END LEFT ==================== -->
<?php
      } elseif ($do == "add") { // add page 
?>
  <h1 class="text-center mb-4">إضافة قسم جديد</h1>
  <div class="container">
    <form class="from-horizontal" action="categories.php?do=insert" method="POST">
      <div class="mb-3 row ">
        <label for="Name">الأسم</label>
        <div class=" input-container ">
          <input type="text" name="name" class="form-control " id="Name" autocomplete="off" required placeholder="إسم القسم">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="description">الوصف</label>
        <div class=" input-container ">
          <input type="text" name="description" class=" form-control" id="description" placeholder="وصف القسم">
        </div>
      </div>
      <div class="row">
        <span></span>
        <div class="input-container ">
          <button type="submit" class="btn btn-primary mb-3"> حفظ <i class="fa fa-save"></i> </button>
        </div>
      </div>
    </form>
  </div>
  <?php

      } elseif ($do == "insert") { // insert page 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  ?>
    <div class="container">

    <?php
          // get variables from from

          $name   = $_POST['name'];
          $desc  = $_POST['description'];

          //  check if no error 
          if (!empty($name)) {
            //check if Category exist in database
            $check = checkItem("Name", 'categories', $name);
            if ($check == 0) {
              // insert Category info to database 
              $stmt = $con->prepare("INSERT INTO categories(`Name`,`Description`) 
                                              VALUES(:nameV, :descV )");
              $stmt->execute(array(
                "nameV" => $name,
                "descV" => $desc,
              ));
              redirectHome("success", "تم إضافة القسم بنجاح", "categories.php");
            } else {
              redirectHome("warning", "عذرا هذا القسم موجود مسبقا", "categories.php");
            }
          } else {
            redirectHome("warning", "عذرا الاسم لا يجب ان يكون <b>فارغا</b>", 'back');
          }
        } else {
          redirectHome("danger", "عذراَ لا يمكنك الوصول المباشر لهذه الصفحة");
        }

    ?>
    </div>
    <?php

      } elseif ($do == "edit") { // edit page 

        // check if get request Category id is numeric & get the integer value of it
        $catid = (isset($_GET["catid"]) && is_numeric($_GET['catid'])) ? intval($_GET['catid']) : 0;

        $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
        $stmt->execute(array($catid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) {
    ?>

      <h1 class="text-center mb-4">تعديل القسم</h1>

      <form class="from-horizontal ms-auto me-auto" action="categories.php?do=update" method="POST">
        <input type="hidden" name="catid" value="<?php echo $catid; ?>">
        <div class="mb-3 row">
          <label for="Name">الإسم</label>
          <div class=" input-container ">
            <input type="text" name="name" value="<?php echo $row["Name"]; ?>" class="form-control " id="Name" required placeholder="Name of Category">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="description">الوصف</label>
          <div class=" input-container ">
            <input type="text" name="description" value="<?php echo $row["Description"]; ?>" class=" form-control" id="description" placeholder="Description the Category">
          </div>
        </div>
        <div class="row">
          <span></span>
          <div class="input-container ">
            <button type="submit" class="btn btn-primary mb-3"> حفظ <i class="fa fa-save"></i> </button>
          </div>
        </div>
      </form>
  <?php
        } else {
          redirectHome("warning", "عذرا هذا القسم غير موجود ", "categories.php");
        }
      } elseif ($do == "update") { // update page 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

          // get variables from from

          $id   = $_POST['catid'];
          $name   = $_POST['name'];
          $desc  = $_POST['description'];

          // check if no error 
          if (!empty($name)) {
            //check if item exist in database
            $statement = $con->prepare("SELECT * FROM categories WHERE `Name` = ? AND ID != ? ");
            $statement->execute(array($name, $id));
            $check = $statement->rowCount();
            if ($check == 0) {
              // update database with this info 
              $stmt = $con->prepare("UPDATE categories SET `Name` = ?, `Description` =? WHERE ID =?");
              $stmt->execute(array($name, $desc, $id));

              redirectHome("success", "تم تحديث القسم بنجاح", "categories.php");
            } else {
              redirectHome("warning", "عذرا هذا القسم غير موجود", "categories.php");
            }
          } else {
            redirectHome("warning", "عذرا هذا القسم موجود مسبقا", "categories.php");
          }
        } else {
          redirectHome("danger", "عذراَ لا يمكنك الوصول المباشر لهذه الصفحة");
        }
      } elseif ($do == "delete") { // delete page


        // check if get request catid is numeric & get the integer value of it
        $catid = (isset($_GET["catid"]) && is_numeric($_GET["catid"])) ? intval($_GET['catid']) : 0;
        //check if Category exist in database
        $check = checkItem("ID", 'categories', $catid);

        if ($check > 0) {
          $stmt = $con->prepare("DELETE FROM categories WHERE ID  = :catid");
          $stmt->bindParam("catid", $catid);
          $stmt->execute();
          $count = $stmt->rowCount();
          redirectHome("success", "تم حذف القسم بنجاح", "categories.php");
        } else {
          redirectHome("warning", "عذرا هذا القسم غير موجود", "categories.php");
        }
      }

  ?>

</section>
<?php
include $tpl . 'footer.php';

ob_end_flush();
?>