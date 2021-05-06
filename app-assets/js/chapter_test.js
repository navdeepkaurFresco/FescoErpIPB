/*$(document).keydown(function (event) {
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
});*/
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
  // alert(location);
  var chapter_id = location.pathname.split('/').pop();
  // var chapterID = chapter_id;
  
  /*end*/

  $("#instruction_btn").on('click', function(){
    if($('input:checkbox[name=conditions]').is(':checked')) 
    {
      // alert(chapterID);
      $.ajax({
        url: site_url+'/student/examAttempt',
        type: 'POST', 
        data: {chapterID:chapter_id},
        success: function(response){ 

          var splitedString = response.split(',');
          var data = splitedString[1];
          var TotaltestAttempts = splitedString[0];

          if(data > 0)
          {
            var leftedattepmts = TotaltestAttempts-data;
            var leftattepmts = '';

            if(leftedattepmts==0)
            {
              leftattepmts = "This is your Last chance, So try your best..!";
            }
            if(leftedattepmts==1)
            {
              leftattepmts = "You have only "+leftedattepmts+ " attempt left for this Exam.";
            }
            if(leftedattepmts>1)
            {
              leftattepmts = "You have only "+leftedattepmts+ " attempts left for this Exam.";
            }

            swal({
                  title: "Be Carefull...!",
                  text: leftattepmts,
                  icon: "info",
                  showCancelButton: true,
                  buttons: {
                      confirm: {
                          text: "Ok!",
                          value: chapter_id,
                          name: "Chapter_exam",
                          visible: true,
                          className: "",
                          closeModal: false
                      }
                  }
                }).then(isConfirm => {
                  if (isConfirm) { 
                    swal("Great!", "Best of Luck...!", "success");      
                    $(".test_instruction").hide();
                    $("#question_one").show();
                    $("#question_two").hide();
                    $(".test-info").show();
                    $(".chapter-name").show();
                    $(".test-status").show();
                  }
                });
          }else{
                swal({
                  title: "Oops!",
                  text: "You exceed Maximum Attempts for this Exam..!",
                  icon: "error",
                  showCancelButton: true,
                  buttons: {
                      confirm: {
                          text: "Ok!",
                          value: chapter_id,
                          name: "Chapter_exam",
                          visible: true,
                          className: "btn-warning",
                          closeModal: false
                      }
                  }
                }).then(isConfirm => {
                  if (isConfirm) {
                        window.close();
                  }
                });
              }
            }
          });

      /*Countdown timer for exam*/
        var test_time = $(".testTime").html();
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

  $("#ques_btn").on('click', function(){

    var ques = $('#ques_no').html();
    var res =  ques.split(" ",2);
    
    if($('input:radio[name=answer]').is(':checked')) 
    {
      $('.loader-wrapper').show();
      var total_Ques = $('.totalQues').html();
      var selected_ans = $('input:radio[name=answer]:checked').val();
      var question_no = ++res[1];
      // var chapterID = $('#chapterID').val();
      // var chapterID = chapter_id;
      var questionID = $('#questionID').val();
      $.ajax({
        url: site_url+'/student/examQuestions',
        type: 'POST',
        data: {
                chapterID   : chapter_id,
                question_no : question_no,
                selected_ans: selected_ans,
                questionID  : questionID
              },
        success: function (data) {
          $('.loader-wrapper').hide();
          // console.log(data);
          if (data == 0) 
          {
            $("#submit_ques_btn").show();
            $("#ques_btn").hide();
          }else
            {
              $(".questions_row").html(data);
              $(".ques-count").html('Ques '+question_no+' of '+total_Ques+'');
              $("#attempt_ques").html("Attempted Questions : "+--res[1]+"");
              // $("#pre_ques_btn").show();
            }
        }
      });
    }else{
      
      swal('Please attempt this question to proceed next..!');
    }
  });

  $('#submit_ques_btn').on('click', function(){
    // var chapterID = $('#chapterID').val();
    // var chapterID = chapter_id;

    swal({
        title: "Great!",
        text: "You will be redirected on result...!",
        icon: "success",
        showCancelButton: false,
        buttons: {
            confirm: {
                text: "Yes, Submit it!",
                value: chapter_id,
                name: "delete_chapter",
                visible: true,
                className: "",
                closeModal: false
            }
        }
      }).then(isConfirm => {
        if (isConfirm) {
          window.location.replace(site_url+'/student/chapterExamResult');
          /*$.ajax({
            url: site_url+'/student/chapterExamResult',
            data: { chapterID:chapterID },
            type: 'POST',
            success: function(data){}});*/
        }
      });
  });

  function submitfunction() {
    window.location.replace(site_url+'/student/chapterExamResult');
  }
});
