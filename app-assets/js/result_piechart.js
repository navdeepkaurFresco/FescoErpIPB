var correct_ans = $(".correct_ans").html();
var wrong_ans = $(".wrong_ans").html();
if (correct_ans == 0 || wrong_ans == 0) 
{
  var chart = c3.generate({
    data: {
        // iris data from R
        columns: [
            ['Wrong Answer', 100]
        ],
        type : 'pie'
    },
    legend: {
         show: false
    },
    size: {
        width: 320,
        height: 450
    },
    label: {
       format: function (value, ratio, id) {
          return d3.format('$')(value);
        }
  }
  });
}else
  {
    var chart = c3.generate({
    data: {
        // iris data from R
        columns: [
            ['Correct Answer', correct_ans],
            ['Wrong Answer', wrong_ans]
        ],
        type : 'pie'
    },
    legend: {
         show: false
    },
    size: {
        width: 320,
        height: 450
    },
    label: {
       format: function (value, ratio, id) {
          return d3.format('$')(value);
        }
  }
  });
  }
d3.select('#chart').insert('div', '.chart').attr('class', 'legend').selectAll('span')
 /* .data(['data1', 'data2'])
.enter().append('span')
  .attr('data-id', function (id) { return id; })
  .html(function (id) { return id; })
  .each(function (id) {
      d3.select(this).style('background-color', chart.color(id));
  })*/
  .on('mouseover', function (id) {
      chart.focus(id);
  })
  .on('mouseout', function (id) {
      chart.revert();
  })
  .on('click', function (id) {
      chart.toggle(id);
  });