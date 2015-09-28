<?php
require "parts/header.php";
require_once "lib/includes.php";
$d = new Dumper();
$filters = (!empty($_GET['filter'])) ? explode(',', $_GET['filter']) : [];
$queries = $d->getQueriesRaw($filters);
?>
<!-- Small boxes (Stat box) -->
<div class="row">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">DNS Queries</h3>
            <div id="example1_filter" class="dataTables_filter pull-right" style="padding-right: 10px">
                <form method="GET">
                    <label>Filter: <input class="form-control" type="search" name="filter" placeholder="Separate by commas" /></label>
                </form>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">

            </div>
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                               aria-describedby="example2_info">
                            <tbody>

                            <?php foreach ($queries as $row): ?>
                                <tr role="row" class="odd">
                                    <?php foreach ($row as $item): ?>
                                        <td><?= $item ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <!-- ./col -->
</div><!-- /.row -->
<?php require "parts/footer.php"; ?>
