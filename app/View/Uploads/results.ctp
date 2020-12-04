
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Results</h3>
                </div>
                <div class="box-body no-padding"  style="height: 300px;">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 50%">Measure</th>
                            <th>Value</th>
                            <!-- <th>View</th> -->
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Total deliveries</td>
                            <td><span class="badge bg-teal"><?= $total ?></span></td>
                            <!-- <td>
                                 <div class="progress xs">
                                    <div class="progress-bar progress-bar-yellow" style="width: <?= $probTotal*100 ?>%"></div>
                                </div>
                            </td> -->
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Observed C-Section Rate</td>
                            <td><span class="badge bg-aqua"><?= number_format((float) $totalCsection/$total*100, 2, '.', ''); ?>%</span></td>
                            <!-- <td>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-aqua" style="width: <?= $totalCsection/$total*100 ?>%"></div>
                                </div>
                            </td>
 -->                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Expected C-Section Rate</td>
                            <td><span class="badge bg-yellow"> <?= number_format((float)$probTotal*100 , 2, '.', ''); ?> %</span></td>
                            <!-- <td>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-yellow" style="width: <?= $probTotal*100 ?>%"></div>
                                </div>
                            </td> -->
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Uncertcinty range</td>
                            <td><span class="badge bg-green"><?= number_format((float)$downRange*100 , 2, '.', ''); ?> % - <?= number_format((float)$upRange*100 , 2, '.', ''); ?>  %</span></td>
                            <!-- <td>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-success" style="width: <?= $downRange*100 ?>%"></div>
                                </div>
                            </td> -->
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>CS Standartized ratio</td>
                            <td><span class="badge bg-purple"><?= number_format((float) ($totalCsection/$total)/$probTotal, 2, '.', ''); ?></span></td>
                           <!--  <td>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-success" style="width: <?= $downRange*100 ?>%"></div>
                                </div>
                            </td> -->
                        </tr>
                    </tbody></table>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">ROC Curve</h3>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div>
                <div class="box-footer text-black">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="clearfix">
                                <label class="pull-left">Area Under the ROC Curve::&nbsp </label><p>
                                <label><?= number_format((float) $area, 2, '.', ''); ?></label>
                            </div>
                        </div> 
                    </div>                                                                     
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Model Chart</h3>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="model-chart" style="height: 300px; position: relative;" data-model="<?= implode(",",$Modelo) ?>"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
    var arrayModelo = $("#model-chart").data("model").split(",");
    var donutData = [
        {label: "Model 1.0", data: arrayModelo[0], color: "#3c8dbc"},
        {label: "Model 1.1", data: arrayModelo[1], color: "#0073b7"},
        {label: "Model 1.2", data: arrayModelo[2], color: "#00c0ef"},
        {label: "Model 1.3", data: arrayModelo[3], color: "#0000cc"},
        {label: "No Matches", data: arrayModelo[4], color: "#3366CC"}
    ];

    $.plot("#model-chart", donutData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                innerRadius: 0.45,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }

            }
        },
        legend: {
            show: false
        }
    });
    
    var areaData = [<?php echo $stringROC ?>];
    var diagonal = [[0,0], [1,1]];

    var dataSet = [
        { data: areaData, color: "#0077FF" },
        { data: diagonal, color: "#DE000F" },
    ];

    $.plot("#revenue-chart", dataSet, {
        grid: {
            borderWidth: 0
        },
        // series: {
        //     shadowSize: 0, // Drawing is faster without shadows
        //     color: "#00c0ef",
        //     curvedLines: {
        //         active: true
        //     }
        // },
        lines: {
            fill: true //Converts the line chart to area chart
        },
        yaxis: {
            axisLabel: "Sensitivity",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            show: true,
            min: 0,
            max: 1
        },
        xaxis: {
            axisLabel: "1 - Specificity",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            show: true,
            min: 0,
            max: 1
        }
    });


    function labelFormatter(label, series) {
    return "<div style='font-size:12px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
            + label
            + "<br/>"
            + Math.round(series.percent) + "%</div>";
    }

</script>