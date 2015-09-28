<?php
require "parts/header.php";
require_once "lib/includes.php";
$d = new Dumper();
?>
<!-- Small boxes (Stat box) -->
<div class="row">

    <pre><?=$d->getQueriesRaw()?></pre>

    <!-- ./col -->
</div><!-- /.row -->
<?php require "parts/footer.php"; ?>
