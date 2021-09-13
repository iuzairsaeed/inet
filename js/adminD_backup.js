
$(document).on('focusin', (e) => {
    if ($(e.target).closest('.tox-form').length) {
        e.stopImmediatePropagation();
   }
});

$(document).ready(function(){
    $('#course_view_content a').attr('target', '_blank');
 });


function Copy()
{
    var shareURL = window.location.href;
    $("#linkshare").val(shareURL);
    var copyText = document.getElementById("linkshare");
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    /* Copy the text inside the text field */
    document.execCommand("copy");
    /* Alert the copied text */
    successAlert("The link is ready to be pasted.");

}

function charcountupdate(str) {
	var lng = str.length;
    document.getElementById("charcount").innerHTML = lng;
}


function charcountupdate1(str) {
	var lng = str.length;
    document.getElementById("count").innerHTML = lng;
}

function charcountupdate2(str) {
	var lng = str.length;
    document.getElementById("count1").innerHTML = lng;
}


function charcountupdate3(str) {
	var lng = str.length;
    document.getElementById("count2").innerHTML = lng;
}

function charcountupdate4(){
    var counter=$(".editor").html();
    var lng = counter.length;
    console.log(lng);
    document.getElementById("count2").innerHTML = lng;
}


$('#content_title,#content_discription,#title,#ques_title,#profile_discription,#profile_image,#FormControlTextarea1').on('keydown', function(event) {
    if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
       var $t = $(this);
       event.preventDefault();
       var char = String.fromCharCode(event.keyCode);
       $t.val(char + $t.val().slice(this.selectionEnd));
       this.setSelectionRange(1,1);
    }
});

$('textarea').on('keydown', function(event) {
    if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
       var $t = $(this);
       event.preventDefault();
       var char = String.fromCharCode(event.keyCode);
       $t.val(char + $t.val().slice(this.selectionEnd));
       this.setSelectionRange(1,1);
    }
});


function txtchnage(txtSign) {
    $("#textSignUp").html(txtSign)
}

function region(){
$('.selectpicker').selectpicker('refresh');
}


function loaderOpen() {
    $("#loader").fadeIn();
}

function loaderClose() {
    $("#loader").fadeOut();
}

function successAlert(txt) {
    $("#alertsBox").fadeIn();
    $("#alertsBox").addClass('alert-success');
    $("#alertsBox").removeClass('alert-danger');
    $("#alertsBox").html(txt);
    setTimeout(function () {
        $("#alertsBox").fadeOut();
    }, 2000)
}

function dangerAlert(txt) {
    $("#alertsBox").fadeIn();
    $("#alertsBox").addClass('alert-danger');
    $("#alertsBox").removeClass('alert-success');
    $("#alertsBox").html(txt);
    setTimeout(function () {
        $("#alertsBox").fadeOut();
    }, 2000)
}

var base_url;

if (location.host == "127.0.0.1:8000") {
  base_url = "/";
} else {
  base_url = "/";
}
Date.prototype.toShortFormat = function() {
    var month_names = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ];

    var day = this.getDate();
    var month_index = this.getMonth();
    var year = this.getFullYear();

    return "" + day + " " + month_names[month_index] + ", " + year;
}

function getRecivedContent(){


    $.ajax({
        type: "GET",
        url: base_url +"recievedcontent",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {

            response=data;
            console.log(response);
            $("#dashboardDataTable1").dataTable().fnDestroy();
            $('#list-of-recived-content').html("");
            for (let index = 0; index < response.length; index++) {
               var today = new Date(response[index]['created_at']);
                document.getElementById("list-of-recived-content").innerHTML +='<tr>\
                <td width="150" class="sorting_1">\
                   <a href="'+base_url+'content/view/'+response[index]['id']+'"><img src="'+contenturl+'/'+ response[index]['image_url']+'" alt="" width="150">\
                   </a>\
                </td>\
                <td width="200" valign="middle">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                   <h6 class="mt-0 font-size1em">'+response[index]['title']+'</h6>\
                </a>\
                        <p class="text-colorblue200">'+response[index]['authors']+'</p>\
                        <p class="text-colorblue200">'+response[index]['affiliation']+'</p>\
                </td>\
                <td>'+today.toShortFormat()+'</td>\
                <td>'+response[index]['difficulty_level']+'</td>\
                <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>\
                <td align="center">\
                    <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">\
                        <li class="nav-item dropdown">\
                            <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>\
                            <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">\
                                <div class="col pl-0 pr-0">\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment" onclick="showData('+response[index]['id']+')"><i class="far fa-comment-alt mr-2" ></i> <span>Add Comment</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalApproved"   onclick="showApproved('+response[index]['id']+')"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"  onclick="showData2('+response[index]['id']+')"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>\
                                </div>\
                            </div>\
                        </li>\
                    </ul>\
                </td>\
                </tr>';
            }
            table1();
            // $("#tableLoader").fadeOut("slow");
        },
        error: function (data) {
            console.log('Error:', data);
            //$("#tableLoader").fadeOut("slow");
        }
    });


}


function historyContent(){

    $.ajax({
        type: "GET",
        url: base_url+"historycontent",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {

            response=data;
            console.log(response);
            $("#dashboardDataTable3").dataTable().fnDestroy();
            $('#list-of-history-content').html("");
            for (let index = 0; index < response.length; index++) {
               var today = new Date(response[index]['created_at']);
                document.getElementById("list-of-history-content").innerHTML +='<tr>\
                <td width="150" class="sorting_1">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                <img src="'+contenturl+'/'+ response[index]['image_url']+'" alt="" width="150"></td>\
                </a>\
                <td width="200" valign="middle">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                    <h6 class="mt-0 font-size1em">'+response[index]['title']+'</h6>\
                </a>\
                    <p class="text-colorblue200">'+response[index]['authors']+'</p>\
                    <p class="text-colorblue200">'+response[index]['affiliation']+'</p>\
                </td>\
                <td >'+today.toShortFormat()+'</td>\
                <td >'+response[index]['difficulty_level']+'</td>\
                <td><span class="badge badge-customBtn5 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-ferozy">Approved</span></td>\
                </tr>';
            }
            table3();
            // $("#tableLoader").fadeOut("slow");
        },
        error: function (data) {
            console.log('Error:', data);
            $("#tableLoader").fadeOut("slow");
        }
    });


}

function contributors(){

    $('#list-contributors').html("");

    $.ajax({
        type: "GET",
        url: base_url+"listofcontributors",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {

            response=data;
            console.log(response);


          //  $("#listView").dataTable().fnDestroy();

            for (let index = 0; index < response.length; index++) {

            document.getElementById("list-contributors").innerHTML +='<div class="col-lg-3 col-md-4 mb-3 d-flex">\
            <div class="card col-md-12 p-0 border-radius0px">\
                <div class="col text-center pb-4 pt-4">\
                <a class="d-inline-block" onclick="showPro('+response[index]['id']+')" style="cursor: pointer;">\
                <div class="thumbnailImg_WH3 thumbnailImg mr-0" style="background: url('+flagsUrl+'/'+ response[index]['profile_pic_url']+') no-repeat; background-size: cover;"></div>\
                </a>\
                    <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">'+response[index]['name']+'</h5>\
                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">'+response[index]['role']+'</span>\
                </div>\
                <div class="card-footer bg-transparent border-top text-center font-familyAtlasGroteskWeb-Regular font-size12px d-flex p-0 text-center justify-content-between hoverBot">\
                    <a class="pt-3 pb-3 border-right"onclick="approve('+response[index]['id']+')"><i class="far fa-user"></i> <span class="d-block">Pending for approval</span></a>\
                </div>\
            </div>\
        </div>';



            }
            // listView();
            // $("#tableLoader").fadeOut("slow");
        },
        error: function (data) {
            console.log('Error:', data);

        }
    });


}



function approve(id){
    $("#contri_id").val(id);
    $("#moadalApprovedcontributor").modal();
}

$(function () {
    $("#approvedContri").on("submit", function (e) {
        e.preventDefault();
        var contri_id = $("#contri_id").val();
       $.ajax({
            type: "PUT",
            url: base_url+"approvedContri/"+contri_id,
            data: $("#approvedContri").serialize(),
            success: function (reponse) {

                 console.log(reponse);
                 $("#moadalApprovedcontributor").modal('hide');
                 contributors();


            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
});





function showPro(id) {
   // alert(id);
    $.ajax({
    type: "GET",
    url: base_url+"profile/"+id,
    dataType: "json",
    contentType: "application/json",
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (data) {
            console.log(data);
            id2=data[0]['id'];
        setTimeout(() => {
            window.location.href = `${base_url}admin/viewcontributorprofile/`+id2;
        }, 2000);
    },
    error: function (data) {
        console.log('Error:', data);

    }
});

}



function underReview(){

    $.ajax({
        type: "GET",
        url: base_url+"underreview",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            response=data;
            console.log(response);
           // $("#dashboardDataTable1").dataTable().fnDestroy();
            $('#list-of-under-review').html("");
            for (let index = 0; index < response.length; index++) {
               var today = new Date(response[index]['created_at']);
                document.getElementById("list-of-under-review").innerHTML +='<tr>\
               <td width="150" class="sorting_1">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                <img src="'+contenturl+'/'+ response[index]['image_url']+'" alt="" width="150"></td>\
                </a>\
                <td width="200" valign="middle">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                    <h6 class="mt-0 font-size1em">'+response[index]['title']+'</h6>\
                </a>\
                    <p class="text-colorblue200">'+response[index]['authors']+'</p>\
                    <p class="text-colorblue200">'+response[index]['affiliation']+'</p>\
                </td>\
                <td>'+today.toShortFormat()+'</td>\
                <td>'+response[index]['difficulty_level']+'</td>\
                <td>'+response[index]['tagged']+'</td>\
                <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>\
                <td align="center">\
                    <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">\
                        <li class="nav-item dropdown">\
                            <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>\
                            <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">\
                                <div class="col pl-0 pr-0">\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment" onclick="showData('+response[index]['id']+')"><i class="far fa-comment-alt mr-2" ></i> <span>Add Comment</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalApproved"   onclick="showApproved('+response[index]['id']+')"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"  onclick="showData2('+response[index]['id']+')"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>\
                                </div>\
                            </div>\
                        </li>\
                    </ul>\
                </td>\
                </tr>';
            }
          //  table1();
        },
        error: function (data) {
            console.log('Error:', data);

        }
    });


}







function showData(id){

   $.ajax({
        type: "get",
        url: base_url+"singlecontent/show/" + id,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            console.log(data);
            $("#title_content").html(data[0]['title']);
            $("#name_author").html(data[0]['name']);
            $("#diff_level").html(data[0]['difficulty_level']);
           // $("#duration").html(data[0]['duration']);
            $("#content_cate").html(data[0]['title']);
            $("#contentid").val(data[0]['id']);
        },
        error: function (data) {
            console.log('Error:', data);

        }
    });
}


function showData2(id){

    $('input:checked').removeAttr('checked');

    $.ajax({
         type: "get",
         url: base_url+"singlecontent/show/" + id,
         dataType: "json",
         contentType: "application/json",
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
         success: function (data) {
             console.log(data);
             $("#content_title3").html(data[0]['title']);
             $("#author_name2").html(data[0]['name']);
             $("#diff_level2").html(data[0]['difficulty_level']);
            /// $("#duration2").html(data[0]['duration']);
             $("#content_cate2").html(data[0]['title']);
             $("#contentid3").val(data[0]['id']);

         },
         error: function (data) {
             console.log('Error:', data);

         }
     });
 }





// Add Comment on content
$(function () {
    $("#AddCommentForm").on("submit", function (e) {
        e.preventDefault();
        var FormControlTextarea1 = $("#FormControlTextarea1").val();
        var contentid = $("#contentid").val();


    if(FormControlTextarea1 != "") {

        $.ajax({
            type: "post",
            url: base_url+"addcoment",
            data: $("#AddCommentForm").serialize(),
            success: function (reponse) {
                $("#FormControlTextarea1").val("");
                 console.log(reponse);
                 $("#moadalAddComment").modal('hide');



            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }

    else
    {
         alert("Please fill in all fields!");

    }
});
});



// TAG ANOTHER ADMIN
$(function () {
    $("#tagAdmin").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"tagadmin",
            data: $("#tagAdmin").serialize(),
            success: function (reponse) {
                $("#FormControlTextarea1").val("");
                 console.log(reponse);
                 $("#moadalChooseAdmin").modal('hide');


            },
            error: function (data) {
                console.log('Error:', data);
            }
        });


});
});





function showApproved(id){
     $("#contentid2").val(id);
}

$(function () {
    $("#ApprovedContent").on("submit", function (e) {
        e.preventDefault();
        var contentid = $("#contentid2").val();
       $.ajax({
            type: "PUT",
            url: base_url+"approvedcontent/"+contentid,
            data: $("#ApprovedContent").serialize(),
            success: function (reponse) {

                 console.log(reponse);
                 $("#moadalApproved").modal('hide');


            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
});


function contributosbookmarks(){
    var privacy_text = "";

    $('#contributors-bookmarks').html("");
    $.ajax({
        type: "GET",
        url: base_url+"contributorsbookmarks",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            response=data;
            console.log(response);


            for (let index = 0; index < response.length; index++) {
               var privacy_status =  response[index]['content_privacy'];
               if(privacy_status==0){ privacy_text="Public" }
               else {privacy_text="Restricted "}
               var today = new Date(response[index]['created_at']);
                document.getElementById("contributors-bookmarks").innerHTML +='<div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">\
                <div class="card col-12 p-0 border-radius0all">\
                <a href="'+base_url+'content/section/'+response[index]['id']+'"><img class="card-img-top" src="'+contenturl+'/'+ response[index]['image_url']+'" alt="image"></a>\
                    <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">\
                        <small class="float-right">'+response[index]['views_count']+' Views</small>\
                    </div>\
                    <div class="card-body">\
                        <a href="'+base_url+'content/section/'+response[index]['id']+'"><h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">'+response[index]['title']+'</h6></a>\
                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['authors']+'</small></p>\
                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['affiliation']+'</small></p>\
                        <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">'+response[index]['difficulty_level']+'</small></p>\
                    </div>\
                    <div class="text-right pr-3">'+privacy_text+'</div>\
                   <div>\
            </div>';

        }


        },
        error: function (data) {
            console.log('Error:', data);

        }
    });

}


function contributorshistory()
{
    var privacy_text = "";
    $("#contributors-history").html("");


    $.ajax({
        type: "GET",
        url: base_url+"contributorshistory",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            response=data;
            console.log(response);

            for (let index = 0; index < response.length; index++) {

                let comments = [];
                if (response[index]['comment']) {
                    let comments_arr = response[index]['comment'].split(',');

                    comments_arr.forEach(item => {
                        comments.push(`<li>${item}</li>`)
                    });
                }

                var privacy_status =  response[index]['content_privacy'];
                if(privacy_status==0){ privacy_text="Public" }
                else {privacy_text="Restricted "}

              document.getElementById("contributors-history").innerHTML +='<div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">\
                <div class="card col-12 p-0 border-radius0all">\
                <a href="'+base_url+'content/section/'+response[index]['id']+'"><img class="card-img-top" src="'+contenturl+'/'+ response[index]['image_url']+'" alt="image"></a>\
                    <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">\
                        <small class="float-right">'+response[index]['views_count']+' Views</small>\
                    </div>\
                    <div class="card-body">\
                        <a href="'+base_url+'content/section/'+response[index]['id']+'"><h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">'+response[index]['title']+'</h6></a>\
                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['authors']+'</small></p>\
                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['affiliation']+'</small></p>\
                        <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">'+response[index]['difficulty_level']+'</small></p>\
                        <ul>'+((comments.length) ? comments.join(" ") : '')+'</ul>\
                    </div>\
                    <div class="text-right pr-3">'+privacy_text+'</div>\
                   <div>\
            </div>';
            }

        },
        error: function (data) {
            console.log('Error:', data);

        }
    });

}



function commentshistory()
{
    $("#commented-history-list").html("");

    $.ajax({
        type: "GET",
        url: base_url+"commentshistory",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            response=data;
            console.log(response);

            for (let index = 0; index < response.length; index++) {

                let comments = [];
                if (response[index]['comment']) {
                    let comments_arr = response[index]['comment'].split(',');

                    comments_arr.forEach(item => {
                        comments.push(`<li>${item}</li>`)
                    });
                }

                if(response[index]['comment']){
                    document.getElementById("commented-history-list").innerHTML +='<div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">\
                        <div class="card col-12 p-0 border-radius0all">\
                        <a href="'+base_url+'content/section/'+response[index]['id']+'"><img class="card-img-top" src="'+contenturl+'/'+ response[index]['image_url']+'" alt="image"></a>\
                            <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">\
                               <small class="float-right">'+response[index]['views_count']+' Views</small>\
                            </div>\
                            <div class="card-body">\
                                <a href="'+base_url+'content/section/'+response[index]['id']+'"><h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">'+response[index]['title']+'</h6></a>\
                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['authors']+'</small></p>\
                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['affiliation']+'</small></p>\
                                <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">'+response[index]['difficulty_level']+'</small></p>\
                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#modalviewcomment" onclick="showCommentsdata('+response[index]['id']+')"><i class="far fa-comment-alt mr-2" ></i> <span>View Comment</span></a>\
                            </div>\
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">\
                            </div>\
                        <div>\
                    </div>';
                    }
             }

        },
        error: function (data) {
            console.log('Error:', data);

        }
    });

}



function admincomments()
{
    $("#list-comments").html("");

    $.ajax({
        type: "GET",
        url: base_url+"admincomments",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            response=data;
            console.log(response);

            for (let index = 0; index < response.length; index++) {

                let comments = [];
                if (response[index]['comment']) {
                    let comments_arr = response[index]['comment'].split(',');

                    comments_arr.forEach(item => {
                        comments.push(`<li>${item}</li>`)
                    });
                }

                if(response[index]['comment']){
                    document.getElementById("list-comments").innerHTML +='<div class="col-lg-3 col-md-12 mb-3 d-flex bookmarkCheck">\
                        <div class="card col-12 p-0 border-radius0all">\
                        <a href="'+base_url+'content/view/'+response[index]['id']+'"><img class="card-img-top" src="'+contenturl+'/'+ response[index]['image_url']+'" alt="image"></a>\
                            <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">\
                               <small class="float-right">'+response[index]['views_count']+' Views</small>\
                            </div>\
                            <div class="card-body">\
                                <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-2">'+response[index]['difficulty_level']+'</p>\
                                <a href="'+base_url+'content/view/'+response[index]['id']+'"><h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">'+response[index]['title']+'</h6></a>\
                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['name']+'</small></p>\
                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">'+response[index]['affiliation']+'</small></p>\
                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#modalviewcomment" onclick="showCommentsdata('+response[index]['id']+')"><i class="far fa-comment-alt mr-2" ></i> <span>View Comment</span></a>\
                            </div>\
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">\
                            </div>\
                        <div>\
                    </div>';
                    }
             }

         },
        error: function (data) {
            console.log('Error:', data);

        }
    });

}




function showCommentsdata(id){

    $.ajax({
         type: "get",
         url: base_url+"singlecontent/comments/" + id,
         dataType: "json",
         contentType: "application/json",
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
         success: function (data) {
             console.log(data);
             path_comm = contenturl +'/'+ data[0]['image_url']+'/';
             document.getElementById("view_img_comment").src = path_comm;
             $("#view_title_content").html(data[0]['title']);
             $("#view_name_author").html(data[0]['name']);
             $("#view_diff_level").html(data[0]['difficulty_level']);
             let comments = [];
             if (data[0]['comment']) {
                 let comments_arr = data[0]['comment'].split(',');
                 comments_arr.forEach(item => {
                     comments.push(`<li>${item}</li>`)
                 });
             }

             document.getElementById("view_comments_of_admin").innerHTML = '<ul>'+((comments.length) ? comments.join(" ") : '')+'</ul>';

        },
         error: function (data) {
             console.log('Error:', data);

         }
     });
 }








$("#list-comments-list").on("click", function(){
    admincomments();
});


$("#list-home-list").on("click", function(){
    getRecivedContent();
});

$("#list-profile-list").on("click", function(){
    underReview();
});

$("#list-history-list").on("click", function(){
    historyContent();
});

$("#list-contributors-list").on("click", function(){
    contributors();
});


$("#list-contributors-bookmarks-list").on("click", function(){
    contributosbookmarks();
});


$("#list-contributor-history").on("click", function(){
    contributorshistory();
});

$("#list-commented-history").on("click", function(){
    commentshistory();
});



$("#search-for-every").click(function() {
    $("#search-everything-form").submit();
  });



//////////////////////////// ARCHIVE CONTENT /////////////////////////////

$(function () {
    $("#ArchiveContent").on("submit", function (e) {
        e.preventDefault();
        var contentid = $("#contentarchive_id").val();
       $.ajax({
            type: "PUT",
            url: base_url+"archivecontent/"+contentid,
            data: $("#ArchiveContent").serialize(),
            success: function (reponse) {
                console.log(reponse);

                $("#successerror").html("Content archive successfully.")
                $("#successerror").css("color","green");

                 if(reponse == "success"){
                 setTimeout(() => {
                    $("#moadalarchive").modal('hide');
                    $("#successerror").hide();
                    window.location.replace("/home");
                 }, 3000);
                }
                else
                {
                    $("#successerror").html("Unable to proceed, try again.");
                    $("#successerror").css("color","red");
                }



            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
});

/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                              Filter works
///////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

function recived_content_sort(){
   var content_type_Sort =  $("#recive_sort option:selected").val();
   console.log(content_type_Sort);
   if(content_type_Sort == "newest"){
        newest_sort();
   }
   else{
       alphabetic_sort();
   }
}

function newest_sort(){
    $.ajax({
        type: "GET",
        url: base_url +"showContentnewest",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {

            response=data;
            console.log(response);
            $("#dashboardDataTable1").dataTable().fnDestroy();
            $('#list-of-recived-content').html("");
            for (let index = 0; index < response.length; index++) {
               var today = new Date(response[index]['created_at']);
                document.getElementById("list-of-recived-content").innerHTML +='<tr>\
                <td width="150" class="sorting_1">\
                   <a href="'+base_url+'content/view/'+response[index]['id']+'"><img src="'+contenturl+'/'+ response[index]['image_url']+'" alt="" width="150">\
                   </a>\
                </td>\
                <td width="200" valign="middle">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                   <h6 class="mt-0 font-size1em">'+response[index]['title']+'</h6>\
                </a>\
                        <p class="text-colorblue200">'+response[index]['authors']+'</p>\
                        <p class="text-colorblue200">'+response[index]['affiliation']+'</p>\
                </td>\
                <td>'+today.toShortFormat()+'</td>\
                <td>'+response[index]['difficulty_level']+'</td>\
                <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>\
                <td align="center">\
                    <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">\
                        <li class="nav-item dropdown">\
                            <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>\
                            <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">\
                                <div class="col pl-0 pr-0">\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment" onclick="showData('+response[index]['id']+')"><i class="far fa-comment-alt mr-2" ></i> <span>Add Comment</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalApproved"   onclick="showApproved('+response[index]['id']+')"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"  onclick="showData2('+response[index]['id']+')"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>\
                                </div>\
                            </div>\
                        </li>\
                    </ul>\
                </td>\
                </tr>';
            }
            table1();
            // $("#tableLoader").fadeOut("slow");
        },
        error: function (data) {
            console.log('Error:', data);
            //$("#tableLoader").fadeOut("slow");
        }
    });

}




function alphabetic_sort(){
    $.ajax({
        type: "GET",
        url: base_url +"recievedcontentalpha",
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {

            response=data;
            console.log(response);
            $("#dashboardDataTable1").dataTable().fnDestroy();
            $('#list-of-recived-content').html("");
            for (let index = 0; index < response.length; index++) {
               var today = new Date(response[index]['created_at']);
                document.getElementById("list-of-recived-content").innerHTML +='<tr>\
                <td width="150" class="sorting_1">\
                   <a href="'+base_url+'content/view/'+response[index]['id']+'"><img src="'+contenturl+'/'+ response[index]['image_url']+'" alt="" width="150">\
                   </a>\
                </td>\
                <td width="200" valign="middle">\
                <a href="'+base_url+'content/view/'+response[index]['id']+'">\
                   <h6 class="mt-0 font-size1em">'+response[index]['title']+'</h6>\
                </a>\
                        <p class="text-colorblue200">'+response[index]['authors']+'</p>\
                        <p class="text-colorblue200">'+response[index]['affiliation']+'</p>\
                </td>\
                <td>'+today.toShortFormat()+'</td>\
                <td>'+response[index]['difficulty_level']+'</td>\
                <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>\
                <td align="center">\
                    <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">\
                        <li class="nav-item dropdown">\
                            <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>\
                            <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">\
                                <div class="col pl-0 pr-0">\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment" onclick="showData('+response[index]['id']+')"><i class="far fa-comment-alt mr-2" ></i> <span>Add Comment</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalApproved"   onclick="showApproved('+response[index]['id']+')"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>\
                                    <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"  onclick="showData2('+response[index]['id']+')"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>\
                                </div>\
                            </div>\
                        </li>\
                    </ul>\
                </td>\
                </tr>';
            }
            table1();
            // $("#tableLoader").fadeOut("slow");
        },
        error: function (data) {
            console.log('Error:', data);
            //$("#tableLoader").fadeOut("slow");
        }
    });

}

/*///////////////////////////////////////////////////////////////////////////////////////////////////////////
                                            TEACHER DASHBOARD
////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

$("#view-thumbnail_t").click(function () {
  $("#content_with_list").fadeOut();
  $("#content_with_thumbnail").fadeIn();
});

$("#view-list_t").click(function () {
  $("#content_with_list").fadeIn();
  $("#content_with_thumbnail").fadeOut();
});
//////////Book Marks /////////


// $("#view-thumbnail_t_B").click(function () {
//     $("#contributors-bookmarks_list").fadeOut();
//     $("#contributors-bookmarks").fadeIn();
//     alert();
//   });

//   $("#view-list_t_B").click(function () {
//     $("#contributors-bookmarks_list").fadeIn();
//     $("#contributors-bookmarks").fadeOut();
//     alert();
//   });
















