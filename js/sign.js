//--------------------------------------sign up-------------------------------

$(document).ready(function () {
  $("form").submit(function (event) {
    if (($("#first_name1").val() != "")&&($("#first_name2").val() == "")) {
     

      var formData = {
        first_name: $("#first_name1").val(),
        last_name: $("#last_name1").val(),
        email: $("#email1").val(),
        mobile: $("#mobile1").val(),
        adress: $("#adress1").val(),
        password: $("#password1").val(),
        confirm_password: $("#confirm_password1").val(),
        spec1: $("#spec_1").val(),
        spec2: $("#spec_2").val(),
        spec3: $("#spec_3").val(),
      };

      $.ajax({
        type: "POST",
        url: "sign/signup-check-student.php",
        data: formData,
        dataType: "json",
        encode: true,
        success: function (data) {
          alert(data);
        },

        error: function (data) {
          alert("error ocuured , student page not working !");
        },
      });
      event.preventDefault();
    }
    //------------ teacher sign up-------------//
    else {
     

      var formData = {
        first_name: $("#first_name2").val(),
        last_name: $("#last_name2").val(),
        email: $("#email2").val(),
        mobile: $("#mobile2").val(),
        adress: $("#adress2").val(),
        password: $("#password2").val(),
        confirm_password: $("#confirm_password2").val(),
        spec1: $("#spec_1_1").val(),
        spec2: $("#spec_2_2").val(),
      };

      $.ajax({
        type: "POST",
        url: "sign/signup-check-teacher.php",
        data: formData,
        dataType: "json",
        encode: true,
        success: function (data) {
          alert(data);
        },

        error: function (data) {
          alert("error ocuured ,teacher page not working !");
        },
      });
      event.preventDefault();
    }
  });
});

//---------------------------------------------------------------------

function get_fact(value) {
  $.post("fact.php", { faculty: value }, function (data) {
    var result =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Departement</option>';
    $("#dep").html(result + data);
  });
}

function get_depart(value) {
  $.post("fact.php", { dep: value }, function (data) {
    var result_1 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1st Specility</option>';
    var result_2 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd Specility "optional"</option>';
    var result_3 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3nd Specility "optional"</option>';

    $("#spec_1").html(result_1 + data);
    $("#spec_2").html(result_2 + data);
    $("#spec_3").html(result_3 + data);
  });
}

function get_spec2(value) {
  $.post("fact.php", { spec1: value }, function (data) {
    var result_1 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd Specility "optional"</option>';

    $("#spec_2").html(result_1 + data);
  });







  
}

function get_spec3(value) {
  $.post("fact.php", { spec2: value }, function (data) {
    var result_1 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3nd Specility "optional"</option>';
     
    $("#spec_3").html(result_1 + data);
  });

  // var formData = {
  // spec2=value,
  // spec0=$("#spec_1").val()
  // };

  // $.ajax({
  //   type: "POST",
  //   url: "fact.php",
  //   data: formData,
  //   dataType: "json",
  //   encode: true,
  //   success: function (data) {
  //     var result_1 ='<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3nd Specility "optional"</option>';

  //     $("#spec_3").html(result_1 + data);

  //   },

  //   error: function (data) {
  //     alert("error ocuured  !");
  //   },
  // });



}

function get_depart_admin(value) {
  $.post("fact.php", { dep: value }, function (data) {
    var result_1 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1st Specility</option>';

    $("#spec_1").html(result_1 + data);
  });
}

//---------------------------------------teacher----------------------------
function get_fact_2(value) {
  $.post("fact.php", { faculty: value }, function (data) {
    var result =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Departement</option>';
    $("#dep_2").html(result + data);
  });
}

function get_depart_2(value) {
  $.post("fact.php", { dep: value }, function (data) {
    var result_1 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1st Specility</option>';
    var result_2 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd Specility "optional"</option>';
    var result_3 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3nd Specility "optional"</option>';

    $("#spec_1_1").html(result_1 + data);
    $("#spec_2_2").html(result_2 + data);
  });
}

function get_spec_2(value) {
  $.post("fact.php", { spec1: value }, function (data) {
    var result_1 =
      '<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd Specility "optional"</option>';

    $("#spec_2_2").html(result_1 + data);
  });
}
