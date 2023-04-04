<?php
foreach ($alerts as $key => $alert) {
    foreach ($alert as $message) {
?>

        <div class="alert alert__<?php echo $key; ?>"><?php echo $message ?></div>

<?php
    }
}
?>

<!-- Just 1 foreach and impole(): -->
<!-- <?php
        foreach ($alerts as $key => $alert) {
            $message = implode("<br>", $alert);
        ?>

    <div class="alert alert__<?php echo $key; ?>"><?php echo $message ?></div>

<?php
        }
?> -->