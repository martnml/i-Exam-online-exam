//------------------------------delete faculty-------------------------------

function delete_fact(id) {
  if (confirm("Are you sure you want to delete this Faculty ?")) {
    $.post("fact.php", { delete_fact: id }, function () {
      window.location.reload(true);
    });
  } else {
    return false;
  }
}

//-------------------------------delete departement ----------------------------

function delete_depart(id) {
  if (confirm("Are you sure you want to delete this Departement ?")) {
    $.post("fact.php", { delete_depart: id }, function () {
      window.location.reload(true);
    });
  } else {
    return false;
  }
}
//---------------------delete specility ---------------------------------
function delete_spec(id) {
  if (confirm("Are you sure you want to delete this Specility ?")) {
    $.post("fact.php", { delete_spec: id }, function (data) {
      // window.location.reload(true);
      alert(data);
    });
  } else {
    return false;
  }
}

function delete_notif(id) {
  if (confirm("Are you sure you want to delete this notification ?")) {
    
    $.post("fact.php", { delete_notif: id }, function (data) {
      alert(data);
    });


  } else {
    return false;
  }
}

$('#send').click(function (event) {
  // var respond = $("#respond").val();
  // var title = $("#title").val();

  // $.post("fact.php", { send_msg: respond }, function (data) {
  //   // window.location.reload(true);
  //   alert(data);
  // });

  var formData = {
    respond: $("#respond").val(),
    title: $("#title").val(),
  };

  $.ajax({
    type: "POST",
    url: "fact.php",
    data: formData,
    dataType: "json",
    encode: true,
    success: function (data) {
      alert(data);
    },

    error: function (data) {
      alert("error ocuured !");
    },
  });
  event.preventDefault();
});

//-----------------------------------ADD faculty ---------------------------------//

function insert_fact() {
  var fact_name = $("#insert_faculty").val();

  if (confirm("Are you sure you want to Add a faculty ?")) {
    $.post("fact.php", { insert_fact: fact_name }, function () {
      window.location.reload(true);
    });
  } else {
    return false;
  }
}

//-------------------------------ADD Departement------------------------
function insert_depart(id) {
  var formData = {
    depart_name: $("#insert_depart").val(),
    id_faculty: id,
  };

  if (confirm("Are you sure you want to Add a new departement ?")) {
    // $.post("fact.php", { insert_depart: formData}, function () {
    //   window.location.reload(true);

    // });

    $.ajax({
      type: "POST",
      url: "fact.php",
      data: formData,

      encode: true,
      success: function (data) {
        window.location.reload(true);
      },

      error: function (data) {
        alert("error ocuured ,page not working !");
      },
    });
  } else {
    return false;
  }
}

//----------------------------------------------------------------

function insert_spec(id) {
  var formData = {
    spec_name: $("#insert_spec").val(),
    spec_opt: $("#insert_opt").val(),
    id_depart: id,
  };

  if (confirm("Are you sure you want to Add a new specility ?")) {
    // $.post("fact.php", { insert_depart: formData}, function () {
    //   window.location.reload(true);

    // });

    $.ajax({
      type: "POST",
      url: "fact.php",
      data: formData,

      encode: true,
      success: function (data) {
        window.location.reload(true);
      },

      error: function (data) {
        alert("error ocuured ,page not working !");
      },
    });
  } else {
    return false;
  }
}
