<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/2/5
 * Time: 20:41
 */
?>
<canvas id="doughnut" width="200" height="200"></canvas>
<script>
    $(function () {
        var ctx = document.getElementById('doughnut').getContext('2d');

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        {{ $sex['男'] }},
                        {{ $sex['女'] }}
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ]
                }],
                labels: [
                    '男',
                    '女',
                ]
            },
            options: {
                maintainAspectRatio: false,
            }
        };

        new Chart(ctx, config);
    });
</script>
