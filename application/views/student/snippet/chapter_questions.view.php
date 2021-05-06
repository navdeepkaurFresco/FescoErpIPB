<?php if (!empty($chapter_questions)) { ?>
<p class="w3-large" style="margin-bottom:25px;"><h4 style="margin-bottom:2.0rem;"><b id="ques_no">Ques <?php echo $chapter_questions_no; ?></b>: <?php  echo $chapter_questions['question_title']; ?></h4></p>
<input type="hidden" name="chapterID" id="chapterID" value="<?php  echo $chapter_questions['chapter_id']; ?>">
<input type="hidden" name="questionID" id="questionID" value="<?php  echo $chapter_questions['id']; ?>">
<div class="radio">
  <label>
    <input type="radio" name="answer" id="first_ans" value="1"> <?php  echo $chapter_questions['option1']; ?>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="answer" id="second_ans" value="2"> <?php  echo $chapter_questions['option2']; ?>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="answer" id="third_ans" value="3"> <?php  echo $chapter_questions['option3']; ?>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="answer" id="fourth_ans" value="4"> <?php  echo $chapter_questions['option4']; ?>
  </label>
</div>
<?php }?>