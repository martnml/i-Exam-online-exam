$(document).ready(function () {
    var getstat = "";
    $.post("fact.php", { getstat: getstat }, function (data) {
        // console.log(data);
        var array = data.split(',');
        $("#student").html(array[1]);
        $("#teacher").html(array[2]);
        $("#exam").html(array[3]);
    });
});

 $(document).ready(function () {
    var getbranches = "";
    $.post("fact.php", { getbranches: getbranches }, function (data) {
        // console.log(data);
        var array = data.split(',');
        $("#faculty").html(array[1]);
        $("#departement").html(array[2]);
        $("#specility").html(array[3]);
    });

});

setInterval(function () {  $(document).ready(function () {
    var get_notif = "";
    $.post("fact.php", { get_notif: get_notif }, function (data) {
    $("#box").html(data);

    });
})
},1000);

// setInterval(function () { 
     $(document).ready(function () {
    var get_count = "";
    $.post("fact.php", { get_count: get_count }, function (data) {
       var $data=data;
         if($data!='0')  $("#msg_count").html(data);
        else $("#msg_count").css("display","none");
    });

})
// },1000);