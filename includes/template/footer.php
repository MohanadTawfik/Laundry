<?php if (!isset($no_head_and_nav)) { ?>
  <section class="footer">
    <div class="container">
      <div class="features-section">
        <h4>لماذا نحن افضل خيار؟</h4>
        <div class="qualities">
          <div class="quality">
            <i class="fa fa-eye" aria-hidden="true"></i>
            <h3>الرؤية</h3>
            <p>إنشاء خدمات افضل لمجتمع رقمي</p>
          </div>
          <div class="quality">
            <i class="fa fa-envelope-square" aria-hidden="true"></i>
            <h3>الرسالة</h3>
            <p>نسعر لتقديم خدمة افضل في مجتمع تواكب التقنية الحديثة </p>
          </div>
          <div class="quality">
            <i class="fas fa-sort-amount-up-alt"></i>
            <h3>تشكيلة واسعة</h3>
            <p>أحدث الالبسة المتوفرة لدينا</p>
          </div>
          <div class="quality">
            <i class="fas fa-phone-square"></i>
            <h3>دعم الفني</h3>
            <p>دعم فني على مدار 24 ساعة لحل المشكلة</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
<?php }
?>
<script src="<?php echo $js; ?>jquery-3.6.4.min.js"></script>
<script src="<?php echo $js; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo $js; ?>dataTables.bootstrap5.min.js"></script>
<script src="<?php echo $js; ?>bootstrap.bundle.min.js"></script>
<script src="<?php echo $js; ?>swiper-bundle.min.js"></script>
<script src="layout/js/main.js"></script>

<script>
  <?php if (isset($_SESSION['state']) && isset($_SESSION['massage'])) { ?>
    notify("<?php echo $_SESSION['state'] ?>", "<?php echo $_SESSION['massage'] ?>");
  <?php
    unset($_SESSION['state']);
    unset($_SESSION['massage']);
  } ?>
</script>

</body>

</html>