<?php

ob_start();
session_start();
$pageTitle = "معلومات المنتج";
$dir = 'rtl';
$noNavbar = "";
// error_reporting(0);

include 'init.php';
?>

<section class="home hero">
    <main>
        <div class="container">
            <?php
            if (isset($_GET['item'])) {
                // check if get request itemid is numeric & get the integer value of it
                $itemid = (is_numeric($_GET["item"])) ? intval($_GET['item']) : 0;
                $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?  LIMIT 1");
                $stmt->execute(array($itemid));
                $info = $stmt->fetch();
                $count = $stmt->rowCount();
                if ($count > 0) {
                    $item_id = $info['Item_ID']; ?>

                    <div class="mt-5">
                        <div class="container ">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row live-review">
                                        <div>
                                            <div class="product-card live-preview">
                                                <div class="main-images">
                                                    <img class="live-image" src=" <?php echo $itemImg; ?><?php echo (!empty($info["Image"])) ? $info["Image"] : "img.png"; ?>" alt="logo">">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="mb-4">
                                                <h1 style="font-size: 28px;"><?php echo $info['Name']; ?></h1>
                                            </div>
                                            <div class="mb-4"> <strong style="font-size: 16px;"><span><?php echo $info['Price']; ?></span> ر.س</strong></div>
                                            <div>
                                                <p style="font-size: 16px;"><?php echo $info['Description']; ?></p>
                                            </div>
                                            <?php
                                            if ((isset($_SESSION["admin_id"]))) { ?>
                                                <form class="from-horizontal main-form" action="?do=update" method="POST" enctype="multipart/form-data">
                                                    <div class="mb-3 row">
                                                        <label for="order_type">
                                                            <h2 style="font-size: 16px;">نوع الخدمة </h2>
                                                        </label>
                                                        <div class="input-container col-6">
                                                            <select class="form-select" name="order_type" id="order_type" required aria-label="Default select example">
                                                                <option value="غسيل وكوي مستعجل" <?php if (isset($_GET["otype"]) && $_GET["otype"]  === "w_i_fast") echo "selected"; ?>>غسيل وكوي مستعجل</option>
                                                                <option value="غسيل وكوي" <?php if (isset($_GET["otype"]) && $_GET["otype"]  === "w_i") echo "selected"; ?>> غسيل وكوي </option>
                                                                <option value="غسيل فقط" <?php if (isset($_GET["otype"]) && $_GET["otype"]  === "w_only") echo "selected"; ?>> غسيل فقط</option>
                                                                <option value="كوي فقط" <?php if (isset($_GET["otype"]) && $_GET["otype"]  === "i_only") echo "selected"; ?>> كوي فقط</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label for="order_type">
                                                            <p style="font-size: 16px;">الكمية</p>
                                                        </label>
                                                        <div class="input-container col-6">
                                                            <input class="form-control " type="number" name="quantity" min="1" value="1" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <span></span>
                                                        <div class="input-container col-6">
                                                            <button type="submit" class="btn btn-primary mb-3" style="border-radius: 7px !important;">إظافة للسلة <i class="fas fa-shopping-cart"></i> </button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="item_id" value="<?php echo $itemid; ?>">
                                                    <input type="hidden" name="customer_id" value="<?php echo $_SESSION['admin_id']; ?>">
                                                    <input type="hidden" name="status" value="طلب جديد">
                                                </form>
                                            <?php } ?>
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



                $items = get_from_table("*", "items", "WHERE Cat_ID = {$info['Cat_ID']} ", "AND Item_ID != {$info['Item_ID']}", "Item_ID", "DESC");
                if (!empty($items)) {
                ?>
                    <div id=" my-item" class="row profile-info">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fas fa-user-tag"></i>
                                <p>منتجات مقترحة</p>
                            </div>
                            <div class="panel-body">

                                <div class="slide-container swiper">
                                    <div class="slide-content">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($items as $item) { ?>
                                                <div class="card swiper-slide">
                                                    <a href="item_info.php?item=<?php echo $item['Item_ID']; ?>" tabindex="-1">
                                                        <div class="image-content">
                                                            <span class="overlay"></span>
                                                            <div class="card-image">
                                                                <img src='<?php echo $itemImg; ?><?php echo (!empty($item["Image"])) ? $item["Image"] : "item.png"; ?>'>
                                                            </div>
                                                        </div>

                                                        <div class="card-content">
                                                            <h2 class="name primary"> <?php echo $item['Name'] ?></h2>
                                                            <span class="price-tag"> <?php echo $item['Price']; ?> ر.س </span>
                                                            <p class="description"><?php echo $item['Description'] ?></p>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <?php if (count_from_table("*", "items", "", "") > 3) { ?>
                                        <div class="swiper-button-next swiper-navBtn"></div>
                                        <div class="swiper-button-prev swiper-navBtn"></div>
                                        <div class="swiper-pagination"></div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }

            ?>

        </div>
    </main>
</section>
<?php

if (isset($_GET['do']) && $_GET['do'] == "update") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // get variables from from
        $item_id     = $_POST['item_id'];
        $quantity   = $_POST['quantity'];
        $order_type  = $_POST['order_type'];
        $status   = $_POST['status'];
        $customer_id  = $_POST['customer_id'];


        $formErrors = [];
        if (empty($order_type)) {
            $formErrors[] = 'يجب ان تختار احد  <b>الخدمات</b>';
        }


        foreach ($formErrors as $error) {
            if (!empty($error)) {
                echo " <div class='container'>";
                echo  "<div class ='alert alert-danger' role='alert'>$error</div>";
                echo " </div>";
            }
        }

        // check if no error 
        if (empty($formError)) {
            $check = get_one_from_table("*", "orders", "WHERE customer_id = {$_SESSION["admin_id"]}", "AND item_id  = {$item_id} AND order_type = '{$order_type}' AND 'status' = 'طلب جديد'", "order_id ");
            if ($check > 0) {
                $stmt = $con->prepare("UPDATE orders SET `quantity` = ? WHERE order_id =?");
                $stmt->execute(array($check["quantity"] + $quantity, $check["order_id"]));
                redirectHome("success", "تم إضافة الطلب الى سلة مشترياتك", "userCart.php");
            } else {
                $stmt = $con->prepare("INSERT INTO `orders`(`customer_id`, `status`, `quantity`, `item_id`, `order_type`,`order_date`) 
                                            VALUES (?,?,?,?,?,now())");
                $stmt->execute(array($customer_id, $status, $quantity, $item_id, $order_type));
                if ($stmt) {
                    $order_id = $con->lastInsertId();
                    $stmt1 = $con->prepare("INSERT INTO `notify`(`touser`, `massage`, `order_id`) VALUES (0,'يوجد طلب جديد',?)");
                    $stmt1->execute(array($order_id));


                    if ($stmt1) {
                        redirectHome("success", "تم إضافة الطلب الى سلة مشترياتك", "userCart.php");
                    }
                } else {
                    redirectHome("warning", "عذراَ هناك خطا .. حاول مجددا", "item_info.php?itemid=$item_id");
                }
            }
        }
    } else {
        header("location:item_info.php?itemid=$item_id");
    }
}
?>

<?php
include $tpl . 'footer.php';
ob_end_flush();
