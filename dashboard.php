<?php
ob_start();
session_start();
$pageTitle = "لوحة التحكم ";
$dir = 'rtl';
$noNavbar = '';
// // error_reporting(0);

if ((!isset($_SESSION["admin_name"])) && (!isset($_SESSION['role'])) && ($_SESSION['role'] != "عامل")) {
    header("location:index.php");
    exit();
}
include 'init.php';
// start Dashboard

// latest Registered Users
$order_limit = 3;
$statement = $con->prepare("SELECT orders.*, items.* 
                            FROM orders
                            INNER JOIN items ON  items.Item_ID  = orders.item_id 
                            ORDER BY orders.order_date DESC
                            LIMIT {$order_limit}
                            ");
$statement->execute();
$latest_orders  = $statement->fetchAll();



// latest Registered items
$item_limit = 3;
$stmt = $con->prepare("SELECT items.* ,categories.Name AS cat_name
                          FROM items
                          INNER JOIN categories ON  categories.ID = items.Cat_ID 
                          ORDER BY Item_ID DESC
                          LIMIT $item_limit ");
$stmt->execute();
$latest_items = $stmt->fetchAll();


// latest comments
$cat_limit = 3;
$latest_catagories = getLatest('*', 'categories', 'ID', $cat_limit);

?>

<section class="home ">

    <div class="title-date ">
        <h1>لوحة التحكم</h1>
        <h1 class="me-4">
            <div class="date">
                <?php echo Date("d-m-Y"); ?>
                <!-- <input type="date" dir="ltr" value="2023-Apr-02" /> -->
            </div>
        </h1>
    </div>
    <main>
        <div class="insights ">
            <div class="sales">
                <a href="items.php?do=manage">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <div class="middle">
                        <div class="left">
                            <h3>عدد المنتجات</h3>
                            <h1><?php echo countItems("Item_ID", "items") ?></h1>
                        </div>
                        <div class="my-progress">
                            <div class="circular-progress">
                                <span class="progress-value"><?php echo countItems("Item_ID", "items") ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="expanses">
                <a href="orders.php?do=manage">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <div class="middle">
                        <div class="left">
                            <h3>عدد الطلبات</h3>
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

            <div class="income">
                <a href="categories.php?do=manage">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <div class="middle">
                        <div class="left">
                            <h3>عدد الاقسام</h3>
                            <h1><?php echo countItems("ID", "categories"); ?></h1>
                        </div>
                        <div class="my-progress">
                            <div class="circular-progress">
                                <span class="progress-value"><?php echo countItems("ID", "categories"); ?> </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="page-container">
            <div class="control-analytics">
                <h2> آخر <?php echo $item_limit ?> منتجات تم اضافتها</h2>
                <?php
                if (!empty($latest_items)) {
                    foreach ($latest_items as $item) { ?>

                        <div class="item online">
                            <div class="profile-photo">
                                <img src='<?php echo $itemImg;
                                            echo (!empty($item["Image"])) ? $item["Image"] : "img.png"; ?>'>
                            </div>
                            <div class="right">
                                <div class="info">
                                    <h3><?php echo $item["Name"] ?></h3>
                                    <small class="text-muted"><?php echo $item["Description"] ?></small>
                                </div>

                                <h3><?php echo $item["cat_name"] ?></h3>
                            </div>
                        </div>

                    <?php     }
                } else {
                    ?>
                    <div class="border border-2 border-danger m-3 p-3 text-center round-2 font-bold">
                        <p>لا يوجد منتجات </p>
                    </div>
                <?php
                }
                ?>
                <div class="item add">
                    <a href='items.php'>
                        <i class="fas fa-tags"></i>
                        <h3>لوحة تحكم المنتجات</h3>
                    </a>
                </div>
            </div>

            <div class="control-analytics">
                <h2> آخر <?php echo $order_limit ?> طلبات مسجلة</h2>
                <?php
                if (!empty($latest_orders)) {

                    foreach ($latest_orders as $order) { ?>
                        <div class="item online">
                            <div class="profile-photo">
                                <img src='<?php echo $itemImg;
                                            echo (!empty($order["Image"])) ? $order["Image"] : "img.png"; ?>'>
                            </div>
                            <div class="right">
                                <div class="info">
                                    <h3><?php echo $order['Name']; ?></h3>
                                    <small class="text-muted"><?php echo $order['order_date']; ?></small>
                                </div>
                                <h5><?php echo $order['order_type'] ?></h5>
                                <h3> كمية : <?php echo $order['quantity'] ?></h3>
                            </div>
                        </div>
                    <?php     }
                } else {
                    ?>
                    <div class="border border-2 border-danger m-3 p-3 text-center round-2 font-bold">
                        <p>لا يوجد طلبات </p>
                    </div>
                <?php
                }
                ?>
                <div class="item add">
                    <a href='orders.php'>
                        <i class="fas fa-users    "></i>
                        <h3>لوحة تحكم الطلبات</h3>
                    </a>
                </div>
            </div>

            <div class="control-analytics">
                <h2> آخر <?php echo $cat_limit ?> اقسام مسجلة</h2>
                <?php
                if (!empty($latest_catagories)) {
                    foreach ($latest_catagories as $cat) { ?>
                        <div class="item online">
                            <div class="cat-photo">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            </div>
                            <div class="right">
                                <div class="info">
                                    <h3><?php echo $cat['Name']; ?></h3>
                                    <small class="text-muted"><?php echo $cat['Description']; ?></small>
                                </div>
                            </div>
                        </div>

                    <?php     }
                } else {
                    ?>
                    <div class="border border-2 border-danger m-3 p-3 text-center round-2 font-bold">
                        <p>لا يوجد أقسام مسجلة </p>
                    </div>
                <?php
                }
                ?>
                <div class="item add">
                    <a href='categories.php'>
                        <i class="fa fa-comments" aria-hidden="true"></i>
                        <h3>لوحة تحكم الاقسام</h3>
                    </a>
                </div>
            </div>

        </div>
    </main>
</section>


<?php
include $tpl . 'footer.php';

ob_end_flush();
?>