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
              <form class="from-horizontal main-form" action="newItem.php" method="POST" enctype="multipart/form-data">
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
  <div class="container">

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    }
    ?>
  </div>

</section>
<?php

include $tpl . 'footer.php';

ob_end_flush();
?>