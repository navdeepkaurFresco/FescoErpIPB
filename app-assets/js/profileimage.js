function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#newImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#update_profile_image").change(function(){
    readURL(this);
});
$("#reset_image").click(function(){
    var actualImage_src = $('#profileImage').attr('src');

    $('#newImage').attr('src', actualImage_src);
});