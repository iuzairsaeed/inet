$(document).ready(function(){
   //$('#moadalAddNewCourse').modal("show");
    placeholderSelectCategory();

});

$(window).load(function() {
    $("#country, #con-country").change(function(){
        $('.selectpicker').selectpicker('refresh');
    });
});

function getVal() {
    var getVal=$(".getVal").val();
    var str = getVal;
    var n = str.lastIndexOf('\n');
    var result = str.substring(n + 13);
    $("#saveFileVal").html(result);

}

function getVal2() {
    var getVal2=$(".getVal2").val();
    var str = getVal2;
    var n = str.lastIndexOf('\n');
    var result2 = str.substring(n + 13);
    $("#saveFileVal2").html(result2);

}

function getVal3() {
    var getVal3=$(".getVal3").val();
    var str = getVal3;
    var n = str.lastIndexOf('\n');
    var result3 = str.substring(n + 13);
    $("#saveFileVal3").html(result3);

}

function removeAdd_required() {
    $('.rmAddRequired').removeAttr('required');
    setTimeout(function () {
        $('.rmAddRequired').attr("required", true);
    }, 10);
}

function textcapitalize() {
    $(".editor").addClass('textcapitalize');
}


$(document).on('keydown', function(e){
    if(e.keyCode === 8){
        $(".editor").removeClass('textcapitalize');
    }
});



function placeholderSelectCategory() {
    $(".addPlaceholder").select2({
        placeholder: "Select Category",
        allowClear: true,
    });
}



// POPUPS
function movePostStep2() {
    $('#moadalMovePost1').modal("hide");
    setTimeout(function () {
        $('#moadalMovePost2').modal("show");
    }, 400);
}

function movePostStep1() {
    $('#moadalMovePost2').modal("hide");
    setTimeout(function () {
        $('#moadalMovePost1').modal("show");
    }, 400);
}

function signUpOpen() {
    $("#TermsAndConditions").css('display', 'none');
    $("#signUp").css('display', 'block');
}


function termsAndConditionOpen() {
    $("#TermsAndConditions").css('display', 'block');
    $("#signUp").css('display', 'none');
}












// VIEWLIST CHANGE COLOR
function chnageColor(getID) {

   // alert(getID);
    for (i=1; i<=2; i++){
        $("#viewIcon"+i).removeClass('text-ferozy')
    }
    $("#viewIcon"+getID).addClass('text-ferozy')
}

function chnageColor2(getID) {

     for (i=3; i<=4; i++){
         $("#viewIcon"+i).removeClass('text-ferozy')
     }
     $("#viewIcon"+getID).addClass('text-ferozy')

     if(getID == 4 ) {
        $("#content_with_thumbnail_course").fadeOut();
        $("#content_with_list_course").fadeIn();

     }
     else{
        $("#content_with_list_course").fadeOut();
        $("#content_with_thumbnail_course").fadeIn();



     }
 }

 function chnageColor3(getID) {

    for (i=5; i<=6; i++){
        $("#viewIcon"+i).removeClass('text-ferozy')
    }
    $("#viewIcon"+getID).addClass('text-ferozy')

    if(getID == 6 ) {
       $("#content_with_thumbnail_admin").fadeOut();
       $("#content_with_list_admin").fadeIn();

    }
    else{
       $("#content_with_list_admin").fadeOut();
       $("#content_with_thumbnail_admin").fadeIn();



    }
}
function chnageColor4(getID) {

    for (i=7; i<=8; i++){
        $("#viewIcon"+i).removeClass('text-ferozy')
    }
    $("#viewIcon"+getID).addClass('text-ferozy')

    if(getID == 8 ) {
       $("#content_with_thumbnail_history").fadeOut();
       $("#content_with_list_history").fadeIn();

    }
    else{
       $("#content_with_list_history").fadeOut();
       $("#content_with_thumbnail_history").fadeIn();



    }
}



