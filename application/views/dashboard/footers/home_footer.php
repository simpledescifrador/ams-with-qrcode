<!-- Chart JS -->
<script src="<?php echo base_url() ;?>assets/vendor/chartjs/js/Chart.bundle.min.js"></script>

<script src="<?php echo base_url() ;?>assets/js/dashboard/home.js"></script>
<script>
$(document).ready(function() {

    $('.display-option').on('click', '.btn', toggleOne);
    function toggleOne() {
      var toggle_class = 'active'
        , $that = $(this);
      $that.parent().find('.btn').removeClass(toggle_class);
      $that.addClass(toggle_class);
    }

    window.chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)'
    };

    function getDaysLabels(num){
        var dateLabels = [];
        for(i = 0; i < num; i++) {
            dateLabels.push(moment().subtract(i, 'days').format("YYYY-MM-DD"));
        }
        return dateLabels.reverse();
    }
    //get the line chart canvas
    var ctx = $("#attendance-chartcanvas");
    
    //line chart data
    var data = {
      labels: getDaysLabels(10),
      datasets: [
        {
          label: "Late",
          data: <?php echo $late; ?>,
          backgroundColor: window.chartColors.orange,
          borderColor: window.chartColors.orange,
          fill: false
        },
        {
          label: "Absent",
          data: <?php echo $absent; ?>,
          backgroundColor: window.chartColors.purple,
          borderColor: window.chartColors.purple,
          fill: false
        }
      ]
    };
    
    
    var options = {
        responsive: true,
        title : {
            display : true,
            position : "top",
            text : "Total of Late and Absents",
            fontSize : 18,
            fontColor : "#111"
        },
        legend : {
            display : true,
            position : "bottom"
        },
          tooltips: {
              mode: 'index',
              intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
        scales: {
            xAxes: [{
              type: "time",
              time: {
                unit: 'day',
                unitStepSize: 1,
                round: 'day',
                tooltipFormat: "MMM-DD",
              }
            }],
            yAxes: [{
              gridLines: {
                color: "black",
                borderDash: [2, 5],
              },
              scaleLabel: {
                display: false
              },
              ticks: {
                max: 10,
                min: 0,
                stepSize: 2
            }
            }]
          }
    };
    
    //create Chart class object
    var myChart = new Chart(ctx, {
      type: "line",
      data: data,
      options: options
    });
  
});

</script>