<?php

ob_start();
session_start();
$dir = 'rtl';
// error_reporting(0);

if (!isset($_SESSION['userCart']) && (!isset($_SESSION["admin_name"]))) {
    header("location:index.php");
    exit(0);
} else {

    $pageTitle = " سلة " . $_SESSION["admin_name"];

    include 'init.php';

    if (!isset($_GET['do'])) {
?>

        <section class="home hero">
            <div class="container">
                <main>
                    <div class="insights"></div>
                    <div class="recent-orders">
                        <div class="d-flex mb-2  gap-4">
                            <h2 class="d-flex align-items-center"> آخر الطلبات</h2>
                        </div>
                        <?php
                        $statement = $con->prepare("SELECT orders.*, items.* 
                                                            FROM orders
                                                            INNER JOIN items ON  items.Item_ID  = orders.item_id 
                                                            WHERE orders.customer_id = {$_SESSION["admin_id"]}
                                                            AND orders.status = 'طلب جديد'
                                                            ORDER BY orders.order_date DESC
                                                            ");
                        $statement->execute();
                        $items  = $statement->fetchAll();
                        if (!empty($items)) { ?>
                            <table class="data_table table table-responsive card-table">
                                <thead>
                                    <tr>
                                        <th colspan="2">المنتج</th>
                                        <th>نوع الخدمة</th>
                                        <th>سعر المنتج</th>
                                        <th>الكمية</th>
                                        <th>المجموع</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($items as $item) {
                                    ?>
                                        <form action="?do=update" method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $item['order_id']; ?>">
                                            <tr price="<?php echo $item['Price']; ?>">
                                                <td>
                                                    <a href='#' class="username">
                                                        <div class="image"><img src='<?php echo $itemImg; ?><?php echo (!empty($item["Image"])) ? $item["Image"] : "img.png"; ?>'></div>
                                                    </a>
                                                </td>
                                                <td><?php echo $item["Name"] ?></td>
                                                <td><?php echo $item['order_type']; ?></td>
                                                <td><?php echo $item['Price']; ?> ر.س</td>
                                                <td class="price"><input type="number" name="quantity" class="quantity" value="<?php echo $item['quantity'] ?>" style="max-width: 100px; height: 50%; border: 2px solid var(--color-primary) !important;   box-shadow:none !important;" min="0"></td>
                                                <td class="total_price" style="font-weight: bold;"><span class="price"></span> ر.س</td>
                                                <td class="primary">
                                                    <span class=" control d-flex gap-2">
                                                        <button type="submit" class='show-tittle confirm round' style="background-color: transparent;" my_tittle="تحديث الطلب"> <i class="fa fa-refresh success" aria-hidden="true"></i> </button>
                                                        <a href='?do=delete&itemid=<?php echo $item["order_id"] ?>' class='show-tittle confirm round ' my_tittle="حذف الطلب"> <i class="fa fa-remove danger" aria-hidden="true"></i></a>
                                                    </span>
                                                </td>
                                            </tr>
                                        </form>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        } else { ?>
                            <div class="border border-2 border-danger p-3 text-center round-2 font-bold">
                                <h2>لا يوجد منتجات </h2>
                            </div>
                        <?php  } ?>
                    </div>
                </main>
                <?php if (!empty($items)) { ?>
                    <div class="title-date primary mb-2">
                        <a href="payment.php" class="product-card ">
                            <div class="total mb-3">
                                <h4 class="me-4"> الإجمالي: </h4>
                                <h2 class="date">
                                    <span class="price"></span>
                                    <span class="warning">ر.س</span>
                                </h2>
                            </div>
                            <div class="button">
                                <div class="button-layer"></div>
                                <button>شراء<i class="fas fa-shopping-cart"></i> </button>
                            </div>
                        </a>
                    </div>
                <?php  } ?>
            </div>
        </section>

<?php

    } elseif (isset($_GET['do']) && $_GET['do'] == "update") { // update page 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_id = $_POST['order_id'];
            $quantity = $_POST['quantity'];

            if ($quantity === 0) {
                $stmt = $con->prepare("DELETE FROM orders WHERE order_id  = ? ");
                $stmt->execute(array($order_id));
            } else {
                $stmt = $con->prepare("UPDATE orders SET `quantity` = ? WHERE order_id =?");
                $stmt->execute(array($quantity, $order_id));
            }
            header('location: userCart.php');
        }
    } elseif ($_GET['do'] == "delete") { // delete page

        // check if get request itemid is numeric & get the integer value of it
        $order_id = (isset($_GET["itemid"]) && is_numeric($_GET["itemid"])) ? intval($_GET['itemid']) : 0;
        //check if item exist in database
        $check = checkItem("order_id", 'orders', $order_id);
        if ($check > 0) {
            $stmt = $con->prepare("DELETE FROM orders WHERE order_id  = ? ");
            $stmt->execute(array($order_id));
        }
        header('location: userCart.php');
    }
}
include $tpl . 'footer.php';
?>