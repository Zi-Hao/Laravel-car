<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/2/7
 * Time: 20:33
 */
?>
<canvas id="doughnut1" width="200" height="400"></canvas>

<script>
    $(function () {
        var ctx = document.getElementById('doughnut1').getContext('2d');

        var config = {
            type: 'bar',
            data: {
                datasets: [{
                    data: [
                        {{ $complete['理论学习阶段'] }},
                        {{ $complete['科目一'] }},
                        {{ $complete['科目二'] }},
                        {{ $complete['科目三'] }},
                        {{ $complete['科目四'] }},
                        {{ $complete['取得驾照'] }}
                    ],
                    backgroundColor: [
                        'rgba(255,182,193)',
                        'rgba(135,206,250)',
                        'rgba(240,230,140)',
                        'rgba(64,224,208)',
                        'rgba(255,105,180)',
                        'rgba(152,251,152)'

                    ]
                }],
                labels: [
                    '理论学习阶段',
                    '科目一',
                    '科目二',
                    '科目三',
                    '科目四',
                    '取得驾照'
                ],

                borderWidth: 1,
            },



            options: {
                maintainAspectRatio: false,
                legend:{
                    display:false,// 隐藏图例
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true//Y轴从零开始
                        }
                    }]
                }
            }
        };


        new Chart(ctx, config);
    });
</script>
