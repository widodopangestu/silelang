<?php
$this->breadcrumbs = array(
    'Projects',
);

$this->menu = array(
    array('label' => 'Create Project', 'url' => array('create')),
    array('label' => 'Manage Project', 'url' => array('admin')),
);
?>

<h1>Dashboard</h1>
<div class="form">
    <?php echo CHtml::beginForm(); ?>
    <div class="row">
        Pilih Tahun
        <?php echo CHtml::dropDownList('tahun', $tahun, $this->getTahun()); ?>
        <?php echo CHtml::submitButton('Submit'); ?>
    </div> 
    <?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php
$j = 0;
for ($i = 1; $i <= 12; $i++) {
    $hasil = $this->getStartProjectByMonth($i, $tahun);
    $start_date[$j] = (int) $hasil['start_date_count'];
    $actual_start_date[$j] = (int) $hasil['actual_start_date_count'];
    $j++;
}
?>
<?php
$this->widget('ext.highcharts.HighchartsWidget', array(
    'id' => 'start_date',
    'options' => array(
        'chart' => array('defaultSeriesType' => 'line',),
        'title' => array('text' => 'seluruh proyek yang mulai bulan itu sama yang harusnya dimulai'),
        'legend' => array('enabled' => false),
        'xAxis' => array(
            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
            'title' => array(
                'text' => 'Bulan'
            )
        ),
        'yAxis' => array(
            'min' => 0,
            'max' => 100,
            'title' => array(
                'text' => 'Jumlah'
            ),
        ),
        'series' => array(
            array('name' => 'start_date', 'data' => $start_date),
            array('name' => 'actual_start_date', 'data' => $actual_start_date),
        ),
        'tooltip' => array('formatter' => 'js:function() {return "<b>"+ this.x +"</b><br/>"+"Jumlah : "+ this.y; }'),
        'plotOptions' => array('line' => (array(
        'allowPointSelect' => true,
        'showInLegend' => true,
        'cursor' => 'pointer',
            )
            )
        ),
        'credits' => array('enabled' => false),
    )
));
?>
<?php
$j = 0;
for ($i = 1; $i <= 12; $i++) {
    $hasil = $this->getEndProjectByMonth($i, $tahun);
    $end_date[$j] = (int) $hasil['end_date_count'];
    $actual_end_date[$j] = (int) $hasil['actual_end_date_count'];
    $j++;
}
?>

<?php
$this->widget('ext.highcharts.HighchartsWidget', array(
    'id' => 'end_date',
    'options' => array(
        'chart' => array('defaultSeriesType' => 'line',),
        'title' => array('text' => 'seluruh proyek yang selesai bulan itu sama yang harusnya selesai'),
        'legend' => array('enabled' => false),
        'xAxis' => array(
            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
            'title' => array(
                'text' => 'Bulan'
            )
        ),
        'yAxis' => array(
            'min' => 0,
            'max' => 100,
            'title' => array(
                'text' => 'Jumlah'
            ),
        ),
        'series' => array(
            array('name' => 'end_date', 'data' => $end_date),
            array('name' => 'actual_end_date', 'data' => $actual_end_date),
        ),
        'tooltip' => array('formatter' => 'js:function() {return "<b>"+ this.x +"</b><br/>"+"Jumlah : "+ this.y; }'),
        'plotOptions' => array('line' => (array(
        'allowPointSelect' => true,
        'showInLegend' => true,
        'cursor' => 'pointer',
            )
            )
        ),
        'credits' => array('enabled' => false),
    )
));
?>