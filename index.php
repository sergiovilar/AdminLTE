<?php
require "parts/header.php";
require_once "lib/includes.php";
$d = new Dumper();
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <?="<h3>".number_format($d->getAds())."</h3>"?>
                <p>Ads Blocked Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-hand"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <?="<h3>".number_format($d->getQueries())."</h3>"?>
                <p>DNS Queries Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-earth"></i>
            </div>
            <a href="queries.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <?php
                $percent = ($d->getAds() / $d->getQueries() * 100);
                $formatted_number = number_format($percent, 2, '.', '');
                echo "<h3>$formatted_number<sup style=\"font-size: 20px\">%</sup></h3>";
                ?>
                <p>Of Today's Traffic Is Ads</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <?php
                $formatted_number = number_format($d->getDomainAmount());
                echo "<h3><sup style=\"font-size: 30px\">$formatted_number</sup></h3>";
                ?>
                <p>Domains Being Blocked</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-list"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div><!-- /.row -->
<?php require "parts/footer.php"; ?>
