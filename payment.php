<?php

ob_start();
session_start();
$dir = 'rtl';
error_reporting(0);

if (!isset($_SESSION['userCart']) && (!isset($_SESSION["user_name"]))) {
    header("location:index.php");
    exit(0);
} else {

    $pageTitle = " سلة " . $_SESSION["user_name"];

    include 'init.php';
?>

    <section class="home hero">
        <div class="container">
            <div class="title-date primary mb-2">
                <div class="payment-form" style="width:400px; max-width:500px;">
                    <div class="d-flex gap-2" style=" justify-content: space-between; align-items:center; justify-content: space-between; align-items:center;">
                        <div class="total">
                            <h3>Credit Card </h3>
                        </div>
                        <div class="d-flex" style=" justify-content: space-between; align-items:center;">
                            <img style=" width: 60px;" src="layout/images/logo-visa.png" alt="Visa" />
                            <img style=" width: 60px;" src="layout/images/logo-mastercard.png" alt="MasterCard" />
                        </div>
                    </div>
                </div>
            </div>
            <main>

                <div class="row">
                    <form class="from-horizontal main-form payment-form">
                        <div class="mb-3 row ">
                            <label for="name">رقم البطاقة</label>
                            <div class="input-container">
                                <input type="text" id="name" class="form-control" required placeholder="8542 9731 9192 2193">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="region">تاريخ الإنتهاء</label>
                            <div class="d-flex gap-2">
                                <div class="input-container col">
                                    <select class="form-select" name="region" id="region" required aria-label="Default select example">
                                        <option selected> 01 </option>
                                        <option> 02 </option>
                                        <option> 03 </option>
                                        <option> 04 </option>
                                        <option> 05 </option>
                                        <option> 06 </option>
                                        <option> 07 </option>
                                        <option> 08 </option>
                                        <option> 09 </option>
                                        <option> 10 </option>
                                        <option> 11 </option>
                                        <option> 12 </option>
                                    </select>
                                </div>
                                <div class="input-container col">
                                    <select class="form-select" required aria-label="Default select example">
                                        <option> 01 </option>
                                        <option> 02 </option>
                                        <option> 03 </option>
                                        <option> 04 </option>
                                        <option> 05 </option>
                                        <option> 06 </option>
                                        <option> 07 </option>
                                        <option> 08 </option>
                                        <option> 09 </option>
                                        <option> 10 </option>
                                        <option> 11 </option>
                                        <option> 12 </option>
                                        <option> 13 </option>
                                        <option> 14 </option>
                                        <option> 15 </option>
                                        <option selected> 16 </option>
                                        <option> 17 </option>
                                        <option> 18 </option>
                                        <option> 19 </option>
                                        <option> 20 </option>
                                        <option> 21 </option>
                                        <option> 22 </option>
                                        <option> 23 </option>
                                        <option> 24 </option>
                                        <option> 25 </option>
                                        <option> 26 </option>
                                        <option> 27 </option>
                                        <option> 28 </option>
                                        <option> 29 </option>
                                        <option> 30 </option>
                                        <option> 31 </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="category">كود CVV </label>
                            <div class="input-container col">
                                <input type="text" id="category" class="form-control " required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="card">الإسم في البطاقة</label>
                            <div class=" input-container">
                                <input type="text" isd="card" class="form-control " required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="input-container">
                                <a href="index.php" type="button" class="btn btn-primary mb-3"> تأكيد <i class="fas fa-money-check "></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>


            </main>
        </div>
    </section>

<?php
}
include $tpl . 'footer.php';
?>