<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>
<script src="<?=Yii::$app->request->BaseUrl?>/js/Chart.js"></script>
<script>
var optionsPie = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke : true,

    //String - The colour of each segment stroke
    segmentStrokeColor : "#fff",

    //Number - The width of each segment stroke
    segmentStrokeWidth : 2,

    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout : 0, // This is 0 for Pie charts

    //Number - Amount of animation steps
    animationSteps : 100,

    //String - Animation easing effect
    animationEasing : "easeOutBounce",

    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate : true,

    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale : false,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

};
var optionsBar = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero : true,

    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,

    //String - Colour of the grid scaleShowGridLines
    scaleGridLineColor : "rgba(0,0,0,.05)",

    //Number - Width of the grid lines
    scaleGridLineWidth : 1,

    //Boolean - If there is a stroke on each bar
    barShowStroke : true,

    //Number - Pixel width of the bar stroke
    barStrokeWidth : 2,

    //Number - Spacing between each of the X value sets
    barValueSpacing : 5,

    //Number - Spacing between data sets within X values
    barDatasetSpacing : 1,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

};
</script>
<div class="wrapper2 clearfix">
    <?php echo Html::tag('div','Статистика', ['id'=>'page_name']);
    $this->title = "Статистика"?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('menu_left', ['current' => 'statistics', 'model' => $model]);
        ?>
    </div>
    <div style="position:relative; width: 73%; float:left;">
        <?php

            for($i = 0; $i < $model->getCourses()->count(); $i++)
            {
                echo Html::beginTag('div', ['class' => 'panel panel-default']);
                echo Html::tag('div', Html::tag('span', $model->getCourses()->all()[$i]->name, ['class' => 'panel-title', 'style' => 'float:left; width:80%;']), ['class' => 'panel-heading clearfix']);
                echo Html::beginTag('div', ['class' => 'panel-body']);
                echo "<div class='col-lg-12' style='padding-bottom:5px;'>";
                echo "Всего подписок: ".$model->getCourses()->all()[$i]->getSubscriptions()->count()."<br>";
                echo "Одобрено подписок: ".$model->getCourses()->all()[$i]->getSubscriptions()->where(['active' => 1])->count()."<br>";
                echo "</div>";
                $lessons = $model->getCourses()->all()[$i]->getLessons()->all();
                $lesson_counter = 0;
                $avg_mark = array();
                $avg_tryNumber = array();
                $count_students = array();
                $results = array();
                $count_2 = array();
                $count_3 = array();
                $count_4 = array();
                $count_5 = array();
                $not_passed = array();
                $passed = array();
                $graph_avg_marks = false;

                foreach ($lessons as $lesson)
                {
                    $avg_mark[$lesson_counter] = 0;
                    $avg_tryNumber[$lesson_counter] = 0;
                    $count_students[$lesson_counter] = 0;
                    $results[$lesson_counter] = $lesson->getResults()->where(['approved'=>1])->all();
                    $count_2[$lesson_counter] = 0;
                    $count_3[$lesson_counter] = 0;
                    $count_4[$lesson_counter] = 0;
                    $count_5[$lesson_counter] = 0;
                    foreach ($results[$lesson_counter] as $result)
                    {
                        $avg_mark[$lesson_counter] = ($avg_mark[$lesson_counter] * $count_students[$lesson_counter] + $result->points) / ($count_students[$lesson_counter] + 1);
                        $avg_tryNumber[$lesson_counter] = ($avg_tryNumber[$lesson_counter] * $count_students[$lesson_counter] + $result->tryNumber) / ($count_students[$lesson_counter] + 1);
                        if ($result->points >= 90)
                            $count_5[$lesson_counter]++;
                        else if ($result->points >= 75)
                            $count_4[$lesson_counter]++;
                        else if ($result->points >= 60)
                            $count_3[$lesson_counter]++;
                        else 
                            $count_2[$lesson_counter]++;
                        $count_students[$lesson_counter]++;
                        
                    }
                    $not_passed[$lesson_counter] = $lesson->getResults()->where(['passed'=>0])->count();
                    if (count($results[$lesson_counter])>0)
                    {
                        $graph_avg_marks = true;
                        $passed[$lesson_counter] = $count_3[$lesson_counter]+$count_4[$lesson_counter]+$count_5[$lesson_counter];
                        $lesson_passed=false;
                        if ($passed[$lesson_counter] > $count_students[$lesson_counter]/2)
                            $lesson_passed = true;
                        echo "<div class='col-lg-12' style='border-top:1px solid #ccc; border-bottom:1px solid #ccc;'>";
                        echo "<h4><b>Лекция \"".$lesson->name."\"</b> <small>".(($lesson_passed)?"(пройдена)":"(не пройдена)")."</small></h4>";
                        echo "<div class='col-lg-6 panel-body'><h5 style='font-size:15px;'><b>Общая статистика</b></h5>";
                        
                        //echo  "Ср.оценка: {$avg_mark[$lesson_counter]}<br>";
                        echo  "Ср.кол-во попыток: {$avg_tryNumber[$lesson_counter]}<br>";
                        echo  "Успешно прошли тест: {$passed[$lesson_counter]} <small>студента(ов)</small><br>";
                        echo  "Не прошли тест: {$not_passed[$lesson_counter]} <small>студента(ов)</small><br>";
                        echo "</div>";
                        ?>
                        <div class='col-lg-6 panel-body'><div class='col-lg-12'><h5 style='font-size:15px; padding-bottom:0px;'><b>Статистика оценок</b></h5></div><div class='col-lg-12'><canvas id="myChart<?=$lesson_counter?>" width="100" height="100"></canvas></div></div></div>
                        <script>
                            var ctx<?=$lesson_counter?> = document.getElementById("myChart<?=$lesson_counter?>").getContext("2d");
                            var data<?=$lesson_counter?> = [
                                {
                                    value: <?=$count_2[$lesson_counter]?>,
                                    color:"#F7464A",
                                    highlight: "#FF5A5E",
                                    label: "Двоек"
                                },
                                {
                                    value: <?=$count_3[$lesson_counter]?>,
                                    color: "#46BFBD",
                                    highlight: "#5AD3D1",
                                    label: "Троек"
                                },
                                {
                                    value: <?=$count_4[$lesson_counter]?>,
                                    color: "#FDB45C",
                                    highlight: "#FFC870",
                                    label: "Четверок"
                                },
                                {
                                    value: <?=$count_5[$lesson_counter]?>,
                                    color: "#64BD28",
                                    highlight: "#64BD28",
                                    label: "Пятерок"
                                }
                            ];

                            var myPieChart<?=$lesson_counter?> = new Chart(ctx<?=$lesson_counter?>).Pie(data<?=$lesson_counter?>,optionsPie);
                        </script>
                        <?php
                    }

                    $lesson_counter++;
                }
                if ($graph_avg_marks)
                {
                ?>
                <div class='col-lg-12'>
                <h5 style='font-size:16px; padding-bottom: 10px;'><b>Средние оценки по лекциям</b></h5>
                <div class='col-lg-12'><canvas id="myChartBar<?=$i?>" width="650" height="400"></canvas></div><br>
                </div>
                <script>
                    var ctxBar<?=$i?> = document.getElementById("myChartBar<?=$i?>").getContext("2d");
                    var dataBar<?=$i?> = {
                        labels: [<?php for($j = 0; $j<count($lessons)-1;$j++) {echo '"Урок №'.$lessons[$j]->lessonNumber.'", ';} echo '"Урок №'.$lessons[count($lessons)-1]->lessonNumber.'"';?>],
                        datasets: [
                            {
                                label: "Средние оценки для лекций",
                                fillColor: "rgba(151,187,205,0.5)",
                                strokeColor: "rgba(151,187,205,0.8)",
                                highlightFill: "rgba(151,187,205,0.75)",
                                highlightStroke: "rgba(151,187,205,1)",
                                data: [<?php for($j = 0; $j<count($avg_mark)-1;$j++) {echo $avg_mark[$j].', ';} echo $avg_mark[count($lessons)-1];?>]
                            }
                        ]
                    };

                    var myChartBar<?=$i?> = new Chart(ctxBar<?=$i?>).Bar(dataBar<?=$i?>,optionsBar);
                </script>
                <?php
                }
                echo Html::endTag('div');
                echo Html::endTag('div');
            }
        ?>
    </div>
</div>
