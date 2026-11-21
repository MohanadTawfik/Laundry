    <?php
    if (isset($_SESSION['admin_id'])) { ?>
        <div class="dropdown notifying">

            <?php $userid = $_SESSION['admin_id'];
            $isread = 0;
            if ($_SESSION['role'] == "عامل") {
                $touser = 0;
            } else {
                $touser = $userid;
            }
            $query = $con->prepare("SELECT notify.*
                                    FROM notify 
                                    WHERE touser = {$touser}
                                    ");
            $query->execute();
            $results = $query->fetchAll();
            if ($query->rowCount() > 0) {
                $unreadcount = $query->rowCount();
            } else {
                $unreadcount = 0;
            }
            ?>
            <i class="bell-notify fa fa-bell" data-bs-toggle="dropdown">
                <span class="translate-middle badge bg-danger "><?php echo $unreadcount; ?></span>
            </i>

            <div class="dropdown-menu bell-notify-box notify-box">
                <span class="notify-title">
                    <?php if ($unreadcount == 0) {  ?>
                        <?php if ($_SESSION['role'] == "عامل") {  ?>
                            <strong class="ms-auto"> لا يوجد طلبات جديدة </strong>
                        <?php } else { ?>
                            <strong class="ms-auto"> لا يوجد إي إشعارات جديدة </strong>
                        <?php }  ?>
                    <?php } else { ?>
                        <?php if ($_SESSION['role'] == "عامل") {  ?>
                            <strong class="ms-auto"> يوجد <?php echo $unreadcount; ?> طلبات جديدة </strong>
                        <?php } else { ?>
                            <strong class="ms-auto"> يوجد <?php echo $unreadcount; ?> تحديث جديد </strong>
                        <?php }  ?>
                        <small class="text-body-secondary">الان</small>
                    <?php }  ?>
                    <i class="fa fa-close me-3 close" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
                </span>

                <div class="notify-list">
                    <?php
                    if (!empty($results)) {
                        foreach ($results as $result) {
                            $statement = $con->prepare("SELECT orders.*, items.* 
                                                            FROM orders
                                                            INNER JOIN items ON  items.Item_ID  = orders.item_id 
                                                            WHERE orders.order_id = {$result["order_id"]}
                                                            ");
                            $statement->execute();
                            $item  = $statement->fetch();

                    ?>
                            <a href="?makeread&id=<?php echo $result['id']; ?>">
                                <div class="notify-item dropdown-item">
                                    <div class="notify-thumb profile-photo">
                                        <img src='<?php echo $itemImg; ?><?php echo (!empty($item["Image"])) ? $item["Image"] : "img.png"; ?>'>
                                    </div>
                                    <div class="notify-text">
                                        <div>
                                            <h3> <?php echo $item['Name'] . " "; ?></h3>
                                            <strong>
                                                <p><?php echo $item['order_type']; ?></p>
                                            </strong>
                                        </div>
                                        <div>
                                            <p class="<?php if ($item['status']  === "تم التسليم") echo "success";
                                                        elseif ($item['status']  === "مرفوض") echo "danger";
                                                        elseif ($item['status']  === "قيد المعالجة") echo "warning";
                                                        ?>"> <?php echo $result['massage']; ?></p>
                                        </div>
                                    </div>
                                    <div class="notify-control">
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                </div>
                            </a>
                    <?php }
                    }
                    ?>

                </div>
            </div>

        </div>


    <?php
    }
    if (isset($_GET['makeread'])) {
        $id = (isset($_GET['id'])) ? $_GET['id'] : 0;
        $check = checkItem("id", 'notify', $id);
        if ($check > 0) {
            $stmt = $con->prepare("DELETE FROM notify WHERE id =?");
            $stmt->execute(array($id));
            header("refresh:0;url={$_SERVER['HTTP_REFERER']}");
        } else {
            redirectHome("danger", "عذرا هناك خطأ ما", "back", 0);
        }
    }
    ?>