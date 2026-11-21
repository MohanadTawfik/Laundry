<?php

// ob_start();
session_start();
$dir = 'rtl';
// error_reporting(0);
include 'init.php';
?>

<section class="home">
  <div class="container">
    <?php if (isset($_GET["page-id"])  && is_numeric($_GET['page-id']) && isset($_GET['page-name'])) {
      $page_id = intval($_GET['page-id']);
      $page_name = $_GET['page-name'];
      $items = get_from_table("*", "items", "WHERE Cat_ID = {$page_id} ", "", "Item_ID", "DESC");
      $pageTitle = "منتجات " . $page_name;
    } else {
      $pageTitle = " كافة المنتجات ";
      $items = get_from_table('*', "items", "", "", "Item_ID", 'DESC');
    } ?>

    <main>
      <div class="logo navbar-brand">
        <h2 class=" text-center primary mb-2"> <i class=" fa-solid fa-shirt"></i> <?php echo $pageTitle; ?></h2>
      </div>
      <div class="container">

        <?php
        if (!empty($items)) { ?>

          <div class="items-container">
            <?php foreach ($items as $item) { ?>
              <form>
                <?php $otype = (isset($_GET["otype"])) ? '&otype=' . $_GET["otype"] : ''; ?>
                <a href="item_info.php?item=<?php echo $item['Item_ID'] . $otype  ?>" class="button">
                  <div class="product-card  id=" item<?php echo $item['Item_ID'] ?>">
                    <div class="main-images">
                      <img src="<?php echo $itemImg; ?><?php echo (!empty($item["Image"])) ? $item["Image"] : "item.png"; ?>">
                    </div>
                    <div class="shoe-details">
                      <div class="details">
                        <span class="shoe_name"> <?php echo $item['Name'] ?></span>
                        <span class="price_num"><?php echo $item['Price']; ?>R.S</span>
                      </div>
                      <div class="price">
                        <div class="price">
                          <p> <?php echo $item['Description'] ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </form>
            <?php
            } ?>
          </div>
        <?php
        } else { ?>
          <div class="border border-2 border-danger p-3 text-center round-2 font-bold">
            <h2>لا يوجد منتجات </h2>
          </div>
        <?php }
        ?>
      </div>
    </main>
  </div>
</section>

<?php

include $tpl . 'footer.php';
// ob_end_flush();

?>