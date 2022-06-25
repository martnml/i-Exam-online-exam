var box = document.getElementById("box");
var down = false;

function toggleNotifi() {
  if (down) {
    box.style.height = "0px";
    box.style.opacity = 0;
    down = false;

    var get_count = "";

    $.post("../../fact.php", { get_count: get_count }, function (data) {
      var $data = data;

      if ($data != "0") $("#msg_count").html(data);
      else $("#msg_count").css("display", "none");
    });
  } else {
    box.style.height = "510px";
    box.style.opacity = 1;

    down = true;
  }
}
