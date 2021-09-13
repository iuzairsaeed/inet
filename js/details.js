

function showUser(id){
    $("#ban_userid").val(id);
}

$(function () {
   $("#unbanUser").on("submit", function (e) {
       e.preventDefault();
       var user_id = $("#ban_userid").val();
      $.ajax({
           type: "PUT",
           url: base_url+"unbanuser/"+user_id,
           data: $("#unbanUser").serialize(),
           success: function (reponse) {

                console.log(reponse);

                if (reponse.success) {
                    $("#message_content").html(
                      `<small style="color: green;">${reponse.message}</small>`
                    );
                    location.reload();
                  } else {
                    $("#message_content").html(
                      `<small style="color: red;">${reponse.message}</small>`
                    );
                  }


           },
           error: function (data) {
               console.log('Error:', data);
           }
       });

   });
});

function showThrea(id) {
    $("#retore_ques_id").val(id);
}


$(function () {
    $("#restoreThread").on("submit", function (e) {
        e.preventDefault();
        var retore_ques_id = $("#retore_ques_id").val();
       $.ajax({
            type: "PUT",
            url: base_url+"restoreques/"+retore_ques_id,
            data: $("#restoreThread").serialize(),
            success: function (reponse) {

                 console.log(reponse);

                 if (reponse.success) {
                     $("#message_content").html(
                       `<small style="color: green;">${reponse.message}</small>`
                     );
                     location.reload();
                   } else {
                     $("#message_content").html(
                       `<small style="color: red;">${reponse.message}</small>`
                     );
                   }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
 });

function showUnmake(id){
    $("#unmake_userid").val(id);
}

$(function () {
    $("#unmakecontributor").on("submit", function (e) {
        e.preventDefault();
        var unmake_userid = $("#unmake_userid").val();
       $.ajax({
            type: "PUT",
            url: base_url+"unmakecontributor/"+unmake_userid,
            data: $("#unmakecontributor").serialize(),
            success: function (reponse) {

                 console.log(reponse);

                 if (reponse.success) {
                     $("#message_content").html(
                       `<small style="color: green;">${reponse.message}</small>`
                     );
                     location.reload();
                   } else {
                     $("#message_content").html(
                       `<small style="color: red;">${reponse.message}</small>`
                     );
                   }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
 });



function showmake(id){
    $("#make_userid").val(id);
}


$(function () {
    $("#makecontributor").on("submit", function (e) {
        e.preventDefault();
        var make_userid = $("#make_userid").val();
       $.ajax({
            type: "PUT",
            url: base_url+"makecontributor/"+make_userid,
            data: $("#makecontributor").serialize(),
            success: function (reponse) {

                 console.log(reponse);

                 if (reponse.success) {
                     $("#message_content").html(
                       `<small style="color: green;">${reponse.message}</small>`
                     );
                     location.reload();
                   } else {
                     $("#message_content").html(
                       `<small style="color: red;">${reponse.message}</small>`
                     );
                   }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });
 });



 function showAssign(id){
    $("#asign_rankid").val(id);
}

$(function () {
    $("#assignrank").on("submit", function (e) {
        e.preventDefault();

        let rank = $("#rank_id").val();

        var formData = new FormData(this);



      if(!rank)
      {
        $("#message_content").html(`<small style="color: red;">Please choose a rank.</small>`);
        setTimeout(function(){ $("#message_content").html(""); }, 1500);
          return;
      }
      else{
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (reponse) {

                 console.log(reponse);

                 if (reponse.success) {
                     $("#message_content").html(
                       `<small style="color: green;">${reponse.message}</small>`
                     );
                     setTimeout(function(){
                         $('#moadalAssignRank').modal('hide');
                         $("#message_content").html("");
                         document.getElementById("assignrank").reset();
                         }, 1500);

                   } else {
                     $("#message_content").html(
                       `<small style="color: red;">${reponse.message}</small>`
                     );
                     setTimeout(function(){ $("#message_content").html(""); }, 1500);

                   }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });



      }

    });


 });



