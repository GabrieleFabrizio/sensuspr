<!-- include ADMIN PAGE -->

<script type="text/javascript" src="<?=$root?>template/js/utilities.js"></script>

<!-- include per FORM con upload -->
<script type="text/javascript" src="<?=$root?>template/js/jquery.form.min.js"></script>

<!-- admin js files -->
<script type="text/javascript" src="<?=$root?>pages/admin/inc/admin_script.js"></script>

<script>
window.csrfToken = <?= json_encode($_SESSION['csrf_token'] ?? '') ?>;
</script>

<?php if ($_SESSION['user_type']>49) { ?>
<script src="<?=$root?>plugins/ckeditor/ckeditor.js"></script>
<?php }?>
