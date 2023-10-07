$(function () {
  $("#job_title").bind("input", function () {
    document.getElementById("job_title_error").innerHTML = "";
  });

  //$('#gender').bind('input', function()  { document.getElementById('gender_error').innerHTML = ""; });

  $("#job").on("submit", function (e) {
    e.preventDefault();

    var r = 0;

    if ($("#job_title").val() == "") {
      $("#job_title_error").html("Required*");
      r = 1;
    }

    //if($("input:radio[name='gender']").is(":checked")) { }  else { $('#gender_error').html('Required*'); r = 1;   }

    if (r == 1) {
      return;
    }
    //addLoading();

    $.ajax({
      url: "assets/ajax/add_client_job_post.php",
      type: "POST",
      data: new FormData(this),
      contentType: false, // The content type used when sending data to the server.
      cache: false, // To unable request pages to be cached
      processData: false,
      success: function (data) {
        //hideLoading();
        //alert('Lead Has Been Added Successfully');
        window.location.href = "jobs.php";
      },
    });
  });
});
