// $(function () {
//     setInterval(function () {



//         var getbranches = "";


//         $.post("fact.php", { getbranches: getbranches }, function (data) {

//             var array = data.split(',');
//             $("#faculty").html(array[1]);
//             $("#departement").html(array[2]);
//             $("#specility").html(array[3]);




//         });

//     }, 1000);
// });


$(document).ready(function () {


    var getbranches = "";

    $.post("fact.php", { getbranches: getbranches }, function (data) {
        console.log(data);

        var array = data.split(',');


        $("#faculty").html(array[1]);
        $("#departement").html(array[2]);
        $("#specility").html(array[3]);




    });


});

