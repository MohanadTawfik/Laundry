<?php
ob_start();
session_start();
$pageTitle = "الصفحة الرئيسية";
$dir = 'rtl';
$noNavbar = "";
// // error_reporting(0);

include 'init.php';
?>

<section class="home">
    <div class="hero-section">
        <div class="overlay"></div>
        <div class="content">
            <h1>نكفيك مشاويرك الزائدة </h1>
            <p>
                إطلب غسيل ملابسك أونلاين في أي وقت
                <span>نجيك ونغسل ملابسك ونرجعها لك </span>
            </p>
            <div class="d-flex gap-2  mb-3">
                <a class="btn btn-primary " type="button" href="#services">تصنيف الخدمات</a>
                <a class="btn btn-outline-primary text-white " type="button" href="items-main.php">
                    جميع الخدمات
                </a>
            </div>
        </div>
    </div>

    <!-- Start Services -->
    <div class="services" id="services">
        <div class="main-heading">
            <h2>خدماتنا</h2>
            <p>
                لا تتردد .. ملابسك في أيدي أمينة
            </p>
        </div>
        <div class="container">
            <a href="items-main.php?otype=w_i_fast">
                <div class="box">
                    <img src="<?php echo $img . "1مستعجل-أيقونة.webp"; ?>" alt="" />
                    <h3>غسل وكوي مستعجل</h3>
                    <div class="info">
                        <h3>غسل وكوي مستعجل</h3>
                    </div>
                </div>
            </a>
            <a href="items-main.php?otype=w_i">
                <div class="box">
                    <img src="<?php echo $img . "1غسيل-وكوي.webp"; ?>" alt="" />
                    <h3>غسل وكوي</h3>
                    <div class="info">
                        <h3>غسل وكوي</h3>
                    </div>
                </div>
            </a>
            <a href="items-main.php?otype=w_only">
                <div class="box">
                    <img src="<?php echo $img . "1غسيل-أيقونة.webp"; ?>" alt="" />
                    <h3>غسل فقط</h3>
                    <div class="info">
                        <h3>غسل فقط</h3>
                    </div>
                </div>
            </a>
            <a href="items-main.php?otype=i_only">
                <div class="box">
                    <img src="<?php echo $img . "1كوي-جديد.webp"; ?>" alt="" />
                    <h3>كوي فقط</h3>
                    <div class="info">
                        <h3>كوي فقط</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End Services -->

</section>
<?php
include $tpl . 'footer.php';

ob_end_flush();
?>