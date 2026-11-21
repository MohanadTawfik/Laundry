<?php
ob_start();
session_start();
$pageTitle = "ادارة المنتجات ";
$dir = 'rtl';
$noNavbar = "";
// error_reporting(0);
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
    <div class="insights"></div>
    <!-- ----------------------- END INSIGHTS ----------------------- -->
    <div class="recent-orders">
      <?php
      // start member page 
      $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

      if ($do == "manage") { // manage page
      ?>
        <a href="items.php?do=add" class="btn btn-primary col-lg-6 col-md-6 col-sm-8"><i class="fa fa-plus"></i> منتج جديد</a>
        <?php
        // latest Registered Items

        $sort = "desc";

        $sort_array = ["asc", "desc"];
        $stmt = $con->prepare("SELECT items.* ,categories.Name AS cat_name
                          FROM items
                          INNER JOIN categories ON  categories.ID = items.Cat_ID 
                           ");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        ?>

        <div class="row mb-2">
          <h2 class=" d-flex align-items-center"> آخر المنتجات</h2>
        </div>

        <table class="data_table table table-responsive">
          <thead>
            <tr>
              <th>ID</th>
              <th></th>
              <th>إسم المنتج</th>
              <th>وصف المنتج</th>
              <th>سعر المنتج</th>
              <th>القسم</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($rows)) {
            ?>
              <?php
              foreach ($rows as $row) { ?>
                <tr>
                  <td> <?php echo $row["Item_ID"]  ?></td>
                  <td>
                    <a href='#' class="username">
                      <div class="image"><img src='<?php echo $itemImg; ?><?php echo (!empty($row["Image"])) ? $row["Image"] : "img.png"; ?>'></div>
                    </a>
                  </td>
                  <td><?php echo $row["Name"] ?> </td>
                  <td> <?php echo $row["Description"] ?></td>
                  <td> <?php echo $row["Price"] ?></td>
                  <td> <?php echo $row["cat_name"] ?></td>
                  <td>
                    <span class=" control d-flex gap-2">
                      <a href='items.php?do=edit&itemid=<?php echo $row["Item_ID"] ?>' class='show-tittle round' my_tittle="تعديل المنتج"><i class='fa fa-edit success'></i></a>
                      <a href='items.php?do=delete&itemid=<?php echo $row["Item_ID"] ?>' class='show-tittle confirm round ' my_tittle="حذف المنتج"><i class='fa fa-trash danger'></i></a>
                    </span>
                  </td>
                </tr>
              <?php } ?>

            <?php
            } else { ?>
              <tr class="odd">
                <td valign="top" colspan="10" class="dataTables_empty">لا يوجد منتجات </td>
              </tr>

            <?php  } ?>
          </tbody>
        </table>
    </div>
  </main>
  <!-- ==================== END MAIN ==================== -->

  <!-- ==================== END LEFT ==================== -->
<?php
      } elseif ($do == "add") { // add page 
?>
  <h1 class="text-center mb-4"> إضافة منتج </h1>
  <div>
    <div class="container ">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row live-review">
            <!-- live review -->
            <div>
              <div class="product-card live-preview">
                <div class="main-images">
                  <img class="live-image" src=" <?php echo $itemImg . "img.png"; ?>" alt="logo">">
                </div>
                <div class="shoe-details">
                  <div class="details">
                    <span class="shoe_name live-title" text=" اسم المنتج"> اسم المنتج</span>
                    <span class=" price_num "><span class=" live-price" text="0">0</span> ر.س </span>
                  </div>
                  <div class="price">
                    <p class="live-desc" text="الوصف">الوصف</p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <form class="from-horizontal main-form" action="?do=insert" method="POST" enctype="multipart/form-data">
                <div class="mb-3 row ">
                  <label for="Name">اسم المنتج</label>
                  <div class=" input-container ">
                    <input type="text" name="name" class="form-control live" pattern=".{4,}" title="This Field Require At Least 4 Characters" data-class=".live-title" id="Name" autocomplete="off" required placeholder="اسم المنتج">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="description">وصف المنتج</label>
                  <div class=" input-container ">
                    <input type="text" name="description" class=" form-control live" pattern=".{10,}" title="This Field Require At Least 10 Characters" data-class=".live-desc" id="description" required placeholder="وصف المنتج  ">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="price">سعر المنتج ر.س</label>
                  <div class="input-container input-group ">
                    <input type="text" name="price" class="form-control live" required data-class=".live-price" id="price" placeholder="سعر المنتج   ">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="category">القسم</label>
                  <div class=" input-container ">
                    <select class="form-select" name="category" id="category" aria-label="Default select example">
                      <option selected>إختر القسم </option>
                      <?php
                      $cats = get_from_table('*', "categories",  "", "", "ID");
                      foreach ($cats as $cat) {
                        echo "<option value=" . $cat['ID'] . ">" . $cat['Name'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="image">الصورة</label>
                  <div class="  input-container ">
                    <input type="file" name="image" class="form-control" data-class=".live-image" id="image">
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


          </div>
        </div>
      </div>
    </div>
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
          $price     = $_POST['price'];
          $cat  = $_POST['category'];

          // Uploads Variable
          $avatar_name = $_FILES['image']['name'];
          $avatar_type = $_FILES['image']['type'];
          $avatar_tmp = $_FILES['image']['tmp_name'];
          $avatar_size = $_FILES['image']['size'];

          // list of allowed extension to upload
          $allowed_extension = ["jpeg", "jpg", "png", "gif", "ico"];

          // get avatar extension
          // $avatar_extension = strtolower(end(explode('.', $avatar_name)));
          $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

          // validate the form 
          $formErrors = [];
          if (empty($name)) {
            $formErrors[] = 'الاسم <b>فارغ</b>';
          }
          if (empty($price)) {
            $formErrors[] = ' السعر<b>فارغ</b>';
          }

          if ($cat == 0) {
            $formErrors[] = 'يجب ان تختار القسم ';
          }
          if (empty($avatar_name)) {
            $formErrors[] = 'الصورة  <b> مطلوبة</b>';
          }

          if (!empty($avatar_name) && !in_array($avatar_extension, $allowed_extension)) {
            $formErrors[] = 'هذه الصيفة <b> غير مسموح بها</b>';
          }

          if ($avatar_size > 4194304) { // 4MB
            $formErrors[] = "الحجم لا يجب ان يكون اكبر من <b>4MB</b>";
          }

          foreach ($formErrors as $error) {
            if (!empty($error)) {
              echo "<div class='container'>";
              echo  "<div class ='alert alert-danger' role='alert'>$error</div>";
              echo "</div>";
            }
          }

          // check if no error 
          if (empty($formError)) {
            $image = rand(0, 100000000000) . '_' . $avatar_name;
            move_uploaded_file($avatar_tmp, $itemImg  . $image);


            // insert Item info to database 
            $stmt = $con->prepare("INSERT INTO items(`Name` ,`Description`, Price  , Cat_ID ,`Image`) VALUES(?, ?, ?, ?, ?)");
            $stmt->execute(array($name, $desc, $price, $cat, $image));
            $count = $stmt->rowCount();
            echo "<div class='container'>";
            echo "<div class ='alert alert-success' role='alert'>تمت الاضافة</div>";
            echo "</div>";
          }
        } else {
          redirectHome("danger", "عذراَ لا يمكنك الوصول المباشر لهذه الصفحة", "items.php");
        }
    ?>
    </div>
    <?php

      } elseif ($do == "edit") { // edit page 

        // check if get request item id is numeric & get the integer value of it
        $itemid = (isset($_GET["itemid"]) && is_numeric($_GET['itemid'])) ? intval($_GET['itemid']) : 0;
        $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");
        $stmt->execute(array($itemid));
        $Item = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) {
    ?>
      <h1 class="text-center mb-4"> تعديل البيانات </h1>
      <div>
        <div class="container ">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row live-review">
                <!-- live review -->
                <!-- live review -->
                <div>
                  <div class="product-card live-preview">
                    <div class="main-images">
                      <img class="live-image" src=" <?php echo $itemImg; ?><?php echo (!empty($Item["Image"])) ? $Item["Image"] : "img.png"; ?>" alt="logo">">
                    </div>
                    <div class="shoe-details">
                      <div class="details">
                        <span class="shoe_name live-title" text=" <?php echo (!empty($Item["Name"])) ? $Item["Name"] : " "; ?>"> <?php echo (!empty($Item["Name"])) ? $Item["Name"] : " "; ?></span>
                        <span class=" price_num "><span class=" live-price" text="<?php echo (!empty($Item["Price"])) ? $Item["Price"] : "0"; ?>"><?php echo (!empty($Item["Price"])) ? $Item["Price"] : "0"; ?></span> ر.س </span>
                      </div>
                      <div class="price">
                        <p class="live-desc" text="<?php echo (!empty($Item["Description"])) ? $Item["Description"] : " "; ?>"><?php echo (!empty($Item["Description"])) ? $Item["Description"] : " "; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <form class="from-horizontal main-form" action="?do=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
                    <div class="mb-3 row ">
                      <label for="Name">اسم المنتج</label>
                      <div class=" input-container ">
                        <input type="text" name="name" value="<?php echo $Item["Name"]; ?>" class="form-control live" pattern=".{4,}" title="This Field Require At Least 4 Characters" data-class=".live-title" id="Name" autocomplete="off" required placeholder="اسم المنتج">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="description">وصف المنتج</label>
                      <div class=" input-container ">
                        <input type="text" name="description" value="<?php echo $Item["Description"]; ?>" class=" form-control live" pattern=".{10,}" title="This Field Require At Least 10 Characters" data-class=".live-desc" id="description" required placeholder="وصف المنتج  ">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="price">سعر المنتج ر.س</label>
                      <div class="input-container input-group ">
                        <input type="text" name="price" class="form-control live" value="<?php echo $Item["Price"]; ?>" required data-class=".live-price" id="price" placeholder="سعر المنتج   ">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="category">القسم</label>
                      <div class=" input-container ">
                        <select class="form-select" name="category" id="category" required aria-label="Default select example">
                          <?php
                          $stmt_cat = $con->prepare("SELECT * FROM categories ");
                          $stmt_cat->execute();
                          $cats = $stmt_cat->fetchAll();
                          foreach ($cats as $cat) { ?>
                            <option value=" <?php echo $cat['ID']; ?>" <?php if ($Item["Cat_ID"] == $cat['ID']) echo "selected"; ?>>
                              <?php echo $cat['Name']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="image">الصورة</label>
                      <div class="  input-container ">
                        <input type="file" name="image" class="form-control live" data-class=".live-image" id="image">
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


              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
        } else {
          redirectHome("warning", "عذرا هذا المنتج غير موجود", "back");
        }
      } elseif ($do == "update") { // update page 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?>
      <div class="container">
      <?php
          // get variables from from

          $id   = $_POST['itemid'];
          $name   = $_POST['name'];
          $desc  = $_POST['description'];
          $price     = $_POST['price'];

          $cat  = $_POST['category'];

          // Uploads Variable
          $avatar_name = $_FILES['image']['name'];
          $avatar_type = $_FILES['image']['type'];
          $avatar_tmp = $_FILES['image']['tmp_name'];
          $avatar_size = $_FILES['image']['size'];

          // list of allowed extension to upload
          $allowed_extension = ["jpeg", "jpg", "png", "gif", "ico"];

          // get image extension
          // $avatar_extension = strtolower(end(explode('.', $avatar_name)));
          $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

          // validate the form 
          $formErrors = [];
          if (empty($name)) {
            $formErrors[] = 'الاسم <b>فارغ</b>';
          }
          if (empty($price)) {
            $formErrors[] = ' السعر<b>فارغ</b>';
          }
          if ($cat == 0) {
            $formErrors[] = 'يجب ان تختار القسم ';
          }

          // if (empty($avatar_name)) {
          //   $formErrors[] = 'الصورة  <b> مطلوبة</b>';
          // }

          if (!empty($avatar_name) && !in_array($avatar_extension, $allowed_extension)) {
            $formErrors[] = 'هذه الصيفة <b> غير مسموح بها</b>';
          }

          if ($avatar_size > 4194304) { // 4MB
            $formErrors[] = "الحجم لا يجب ان يكون اكبر من <b>4MB</b>";
          }


          foreach ($formErrors as $error) {
            if (!empty($error))
              echo  "<div class ='alert alert-danger' role='alert'>$error</div>";
          }
          // check if no error 
          if (empty($formError)) {
            if (!empty($avatar_name)) {
              $image = rand(0, 100000000000) . '_' . $avatar_name;
              move_uploaded_file($avatar_tmp, $itemImg  . $image);
            }

            if (!empty($avatar_name)) {
              $stmt = $con->prepare("UPDATE items SET `Name` = ?, `Description` =?, Price =?,Cat_ID = ?,`Image`=? WHERE Item_ID =?");
              $stmt->execute(array($name, $desc, $price, $cat, $image, $id));
              $count = $stmt->rowCount();
            } else {
              $stmt = $con->prepare("UPDATE items SET `Name` = ?, `Description` =?, Price =?,Cat_ID = ? WHERE Item_ID =?");
              $stmt->execute(array($name, $desc, $price, $cat, $id));
            }

            redirectHome("success", "تم تحديث المنتج بنجاح", "items.php");
          }
        } else {
          redirectHome("danger", "عذراَ لا يمكنك الوصول المباشر لهذه الصفحة", "items.php");
        }
      ?>
      </div>
    <?php
      } elseif ($do == "delete") { // delete page
    ?>
      <div class="container">
        <?php

        // check if get request itemid is numeric & get the integer value of it
        $itemid = (isset($_GET["itemid"]) && is_numeric($_GET["itemid"])) ? intval($_GET['itemid']) : 0;
        //check if item exist in database
        $check = checkItem("Item_ID", 'items', $itemid);

        if ($check > 0) {
          $stmt = $con->prepare("DELETE FROM items WHERE Item_ID  = :itemid");
          $stmt->bindParam("itemid", $itemid);
          $stmt->execute();
          $count = $stmt->rowCount();
          redirectHome("success", "تم حذف المنتج بنجاح", "items.php");
        } else {
          redirectHome("warning", "عذرا هذا المنتج غير موجود", "items.php");
        }
        ?>
      </div>
    <?php
      } ?>

</section>
<?php

include $tpl . 'footer.php';

ob_end_flush();
?>