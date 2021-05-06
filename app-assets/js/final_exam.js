 $(document).keydown(function (event) {
  if (event.keyCode == 123) { // Prevent F12
      swal("This method not allowed....!"); 
      return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) 
      { // Prevent Ctrl+Shift+I        
        swal("This method not allowed....!"); return false;
      } else if (event.metaKey && event.altKey && event.keyCode == 73) 
      { // Prevent Ctrl+Shift+I        
          swal("This method not allowed....!"); return false;
      } else if (event.ctrlKey && event.keyCode == 65) { 
      swal("This method not allowed....!"); 
      return false;
      }else if (event.ctrlKey && event.keyCode == 67) {
        swal("This method not allowed....!"); 
        return false;
       }else if (event.metaKey && event.keyCode == 65) {
        swal("This method not allowed....!"); 
        return false;
        }else if (event.metaKey && event.keyCode == 67) {
          swal("This method not allowed....!"); 
          return false;
        }else if (event.ctrlKey && event.keyCode == 85) {
          swal("This method not allowed....!"); 
          return false;
        }
        else if (event.metaKey && event.keyCode == 85) {
          swal("This method not allowed....!"); 
          return false;
        }
});
 // prevent right click
 $(document).bind("contextmenu",function(e){
  swal("This method not allowed....!");
  return false;
 });

$(document).ready(function() {

 /*get module id from url*/
  var url = window.location.href;
  var getLocation = function(url) {
      var location = document.createElement("a");
      location.href = url;
      return location;
  };
  var module_id = location.pathname.split('/').pop();
  /*end*/

  $("#instruction_btn").on('click', function(){
    if($('input:checkbox[name=conditions]').is(':checked')) 
    {
      var test_time = $(".testTime").html();

      $.ajax({
        url: site_url+'/student/result',
        type: 'POST', 
        data: {module_id:module_id},
        success: function(response){ 
            swal({
              title: "Best of Luck...!",
              text: "",
              icon: "success",
              showCancelButton: false,
              buttons: {
                  confirm: {
                      text: "Ok!",
                      name: "Final_exam",
                      visible: true,
                      closeModal: true
                  }
              }
            }).then(isConfirm => {
              if (isConfirm) {      
                $(".test_instruction").hide();
                $("#question_one").show();
                $("#question_two").hide();
                $(".test-info").show();
                $(".chapter-name").show();
                $(".test-status").show();
              }
            });
          }
        });

      /*Countdown timer for exam*/
        var time = test_time.split(' ');
        document.getElementById('countdown_timer').innerHTML = time[0] + ":" + 00;
        startTimer();

        function startTimer() {
          var presentTime = document.getElementById('countdown_timer').innerHTML;
          var timeArray = presentTime.split(/[:]+/);
          var m = timeArray[0];
          var s = checkSecond((timeArray[1] - 1));
          if(s==59){m=m-1}
          //if(m<0){alert('timer completed')}
          
          document.getElementById('countdown_timer').innerHTML = m + ":" + s;
          setTimeout(startTimer, 1000);
          if (m == 00 && s == 01) 
          {
            submitfunction();
          }
        }
        function checkSecond(sec) {
          if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
          if (sec < 0) {sec = "59"};
          return sec;
        }
    }else{
        swal("Please accept terms and conditions..!");
    }
  });

  $("#submit_ques").on('click', function(){

    var ques = $('#ques_no').html();
    var res =  ques.split(" ",2);
    
    if($('input:radio[name=answer]').is(':checked')) 
    {
      $('.loader-wrapper').show();
      var total_Ques = $('.totalQues').html();
      var selected_ans = $('input:radio[name=answer]:checked').val();
      var question_no = ++res[1];
      var questionID = $('#q_ID').val();
      $.ajax({
        url: site_url+'/student/finalExam',
        type: 'POST',
        data: {
                module_id   : module_id,
                question_no : question_no,
                selected_ans: selected_ans,
                questionID  : questionID
              },
        success: function (data) {
          // console.log(data);
          $('.loader-wrapper').hide();
          if (data == 0) 
          {
            $("#submit_exm").show();
            $("#submit_ques").hide();
          }else
            {
              $(".questions_row").html(data);
              $(".ques-count").html('Ques '+question_no+' of '+total_Ques+'');
              $("#attempt_ques").html("Attempted Questions : "+--res[1]+"");
            }
        }
      });
    }else{
      
      swal('Please attempt this question to proceed next..!');
    }
  });

  $('#submit_exm').on('click', function(){

    swal({
        title: "Great!",
        text: "You will be redirected on result...!",
        icon: "success",
        showCancelButton: false,
        buttons: {
            confirm: {
                text: "Yes, Submit it!",
                value: module_id,
                name: "submit_exam",
                visible: true,
                className: "",
                closeModal: false
            }
        }
      }).then(isConfirm => {
        if (isConfirm) {
         submitfunction();
        }
      });
  });

  function submitfunction() {
    $.ajax({
    url: site_url+'/student/exam_status',
    data: { module_id:module_id },
    type: 'POST', 
    success: function(data){
      console.log(data);
      window.location.replace(site_url+'/student/examResult/'+module_id);
    }});
  }
});