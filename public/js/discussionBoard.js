// =================================================================================================================================================================================================================================
// ============ ADD BOARD
// =================================================================================================================================================================================================================================
var base_url;
var c_user_name = $("#c_user_name").val();

var c_user_id = Number($("#c_user_id").val());
var c_role_id = Number($("#c_role_id").val());
var c_moderator = Number($("#c_moderator").val());

if (location.host == "127.0.0.1:8000") {
    base_url = "/";
} else {
    base_url = "/inetEDPlatform/";
}
$("#diss_board").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $("#board_title_err").html("");
    $("#board_category_err").html("");
    $("#board_privacy_err").html("");

    var boardtitle = $("#board_title").val();
    boardtitle = boardtitle.trim();

    if (boardtitle == "" || $("#board_cat_id").val() == "" || $("#board_privacy").val() == "") {
        if (boardtitle == "") {
            $("#board_title_err").html("Board title is required!");
        }

        if ($("#board_cat_id").val() == "") {
            $("#board_category_err").html("Board category is required!");
        }

        if ($("#board_privacy").val() == "") {
            $("#board_privacy_err").html("Board privacy is required!");
        }

        return;
    }

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                location.reload();
            } else {
                console.log(data.message)
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
});

function hasWhiteSpace(s) {
    return s.indexOf(' ') >= 0;
  }

$("#discussionBoardredirect").on("click", function () {
    location.href = location.origin + "/discussionBoard";
});

$("#diss_board_thread").submit(function (e) {
    e.preventDefault();

    var title = $("#title").val();
    var body = $("#body").val();

    console.log(body);




    if(typeof body === 'undefined') {
        body = "abcdefghijklmnopqrstuvwxyz";
     } else{
         body = body.trim();
     }

     title = title.trim();
     body = body.trim();


    if (title == "" || body == "" || body.search('&nbsp;') != -1) {
        // alert("if");

        if (title == "") {
            $("#error_title").html("Thread title required!");
            setTimeout(() => {
                $("#error_title").html("");
            }, 2000);
        }

        if (body == "" || body.search('&nbsp;') != -1) {
            $("#error_body").html("Thread description required!");
            setTimeout(() => {
                $("#error_body").html("");
            }, 2000);
        }
        return;
    } else {
        //  alert("else");


        var formData = new FormData(this);

        // let tags = $("#tags").val();

        // formData.append("tags", JSON.stringify(tags));

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.success) {
                    location.reload();
                }
            },
            error: function (err) {
                alert(err);
            },
        });
    }
});

// ================================================================================================
// NEWEST THREAD
// ================================================================================================
$(document).ready(function(){
    $('#post_result a').attr('target', '_blank');
 });

function change_thread_page(page) {
    threadPagination(page);
}

function threadPagination(page = 1) {
    const urlParams = new URLSearchParams(window.location.search);
    const board_id = urlParams.get('board_id');

    $.ajax({
        type: "POST",
        url: `${base_url}contentSuggestionPagination`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: JSON.stringify({
            page,
            board_id
        }),

        success: function (data) {

            $("#thread_result").html("");
            const {
                success,
                thread_active_page,
                thread_pages,
                thread_total,
                threads
            } = data
            if (threads.length) {
                for (i = 0; i < data.threads.length; i++) {
                   
                    if(threads[i].pinned && threads[i].role == 'Admin'){
                        var unpinned=`
                    <a onclick="unpinned_thread(${threads[i].id})">
                        <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                          <i class="fas fa-thumbtack mr-2" style="transform: rotate(180deg);"></i>
                           <span>Un Pin</span>
                       </div>
                     </a>`;
                    }else{
                        var unpinned=""; 
                    }
                    $("#thread_result").append(`
                        <tr class="border-bottom">
                            <td class="">
                                <p class="text-colorblue100 font-size12px"><a class="text-colorblue100 font-size16px" href="${base_url}thread/posts?board_id=${board_id}&thread_id=${threads[i].id}">${threads[i].title}</a></p>
                                <div class="media">
                                    <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/${threads[i].author_avatar }') no-repeat; background-size: cover;">
                                    </div>
                                    <div class="media-body align-self-center d-flex">
                                        <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center mr-2">${threads[i].author} </span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">${threads[i].role}</span></p>
                                        <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                        <div class="align-self-center">
                                            <span class="align-self-center"><img src="images/icons/pencil.png" alt="" width="20" class="mr-2"></span>
                                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">${format_date(threads[i].c_at)}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="verticalalign" width="10%">
                                <div class="text-center bg-lightWhite100 p-3 font-size14px">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">${threads[i].replies_count}</p>
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Replies</p>
                                    <i class="far fa-comments text-ferozy"></i>
                                </div>
                            </td>
                            <td class="verticalalign" width="10%">
                                <div class="text-center bg-lightWhite100 p-3 font-size14px">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">${threads[i].views_count}</p>
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Views</p>
                                    <i class="far fa-eye text-ferozy"></i>
                                </div>
                            </td>
                            <td class="text-center verticalalign">
                                <div style="display: ${(threads[i].pinned ? '' : 'none')}" class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2"><i class="fas fa-thumbtack mr-2"></i><span>Pinned</span></div>
                            </td>
                            <td class="text-center verticalalign">
                               ${unpinned}
                            </td>
                            <td class="verticalalign">
                                <div class="media text-right" style="display: ${(threads[i].l_reply_at ? '' : 'none')}">
                                    <div class="media-body align-self-center text-right">
                                        <div class="align-self-center">
                                            <span class="align-self-center"><img src="images/icons/pencil.png" alt="" width="20" class="mr-2"></span>
                                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">${(threads[i].l_reply_at != null ? format_date(threads[i].l_reply_at) : '')}</span>
                                        </div>
                                        <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center">${(threads[i].l_reply_user != null ? threads[i].l_reply_user : '')}</span> </p>
                                    </div>
                                    <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden ml-2 mr-0" style="background: url( 'https://ineted.org/public/uploads/profile_images/${threads[i].l_reply_user_avatar}') no-repeat; background-size: cover;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `)
                }
            }

            $("#thread_pagination").html("");
            if (thread_pages > 1) {
                const pagination_list = [
                    `<li class="page-item ${
                        thread_active_page == 1 ? " disabled" : ""
                }"><a class="page-link" onclick='change_thread_page(${
                    thread_active_page - 1
                })'>Previous</a></li>`,
                ];

                $("#thread_pagination").append(``);

                for (let i = 0; i < thread_pages; i++) {
                    pagination_list.push(
                        `<li class="page-item ${
                            thread_active_page == i + 1 ? " active disabled" : ""
                  }"><a class="page-link" onclick="change_thread_page(${i + 1})">${
                    i + 1
                  }</a></li>`
                    );
                }

                $("#thread_pagination").append(
                    pagination_list.join(" ") +
                    `<li class="page-item ${
                        thread_active_page == thread_pages ? " disabled" : ""
                  }"><a class="page-link" onclick='change_thread_page(${
                    thread_active_page + 1
                  })'>Next</a></li>`
                );
            }

        },

        error: function (err) {
            console.log(err);
        },
    });
}

// =================================================================================================================================================================================================================================
// ============ ADD POSTS
// =================================================================================================================================================================================================================================

function change_thread_post_page(page) {
    threadPostPagination(page);
}

// <div style="background-color: #E6E8EB; padding: 30px 47px; display: ${(thread_posts[i].repied_post_author ? 'block' : 'none')};" class="mb-4">
//     <h6 style="font-weight: bold; color: #7CA9A1">${thread_posts[i].repied_post_author}:</h6>
//     ${thread_posts[i].repied_post}
// </div>

function threadPostPagination(page = 1) {
    const urlParams = new URLSearchParams(window.location.search);
    const thread_id = urlParams.get('thread_id');

    $.ajax({
        type: "POST",
        url: `posts/pagination`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: JSON.stringify({
            page,
            thread_id
        }),

        success: function (data) {
            $("#post_result").html("");
            const {
                success,
                thread_posts_total,
                thread_posts_pages,
                thread_posts_active_page,
                thread_posts
            } = data

            if (thread_posts.length) {
                for (i = 0; i < thread_posts.length; i++) {

               //_body1 = thread_posts[i].body;
               const _body1 = thread_posts[i].body;
               const _body2 = JSON.stringify(_body1);
               const _body3 = _body2 .replace(/"/g, "\&quot;");
              let  _body = _body3.replace(/(\r\n|\n|\r)/gm, "<br>");
              //let  _body = _body3.match((/\r\n/) ? '<br>' : '');
             // var _body = _body3 .replace(/"/g, "\&quot;");
             // let _body = _body3 .replace(/(?:\r\n|\r|\n)/g, '<br>');
            _bodynew = _body1 .replace(/"/g, "\&quot;");
console.log(_bodynew);
                    $("#post_result").append(`
                        <div class="col-md-12 p-0" id="thread-post-${ thread_posts[i].id }">
                            <div class="row no-gutters">
                                <div class="col-lg-2 col-md-3 text-center mb-3">
                                    <div class="col text-center mb-3">
                                        <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('https://ineted.org/public/uploads/profile_images/${thread_posts[i].author_avatar}') no-repeat; background-size: cover;">
                                        </div>

                                        <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">${thread_posts[i].author}</p>
                                        <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">${thread_posts[i].author_role}</span>
                                    </div>
                                    <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px mb-1"><span class="opacity0point5">Joined:</span> ${format_date(thread_posts[i].author_joined)}</p>
                                    <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><span class="opacity0point5">Posts:</span> ${thread_posts[i].author_posts}</p>
                                    ${(thread_posts[i].rank_image ? `<img src="${base_url}images/icons/${thread_posts[i].rank_image}" width="80">` : '')}
                                </div>
                                <div class="col-lg-10 col-md-9 mb-3">
                                    <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                        <div class="col-md-12 p-4">
                                            <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                                <p class="mb-0 font-size13px align-self-center opacity0point5">${format_date(thread_posts[i].c_at)} at ${format_time(thread_posts[i].c_at)}</p>
                                                <span class="badge badge-secondary2 pl-3 pr-3 pt-2 pb-2 font-size13px num">#${(i==9) ? (thread_posts_active_page - 1 + (thread_posts_active_page * 10).toString()).slice(-2):(thread_posts_active_page - 1 + (i + 1).toString()).slice(-2)}</span>

                                                <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular dashboardDataTable" style="width: 1em;">
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu margin-top2em widthMin13rem border-radius0px right0 aPading translate3d0px1" aria-labelledby="listViewMenu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <div class="col pl-0 pr-0">
                                                                ${(c_role_id == 1 || c_moderator == 1 || thread_posts[i].user_id == c_user_id ? `<a class="dropdown-item font-size14px" onclick="edit_post('${thread_posts[i].id}', ${_body} )"><i class="far fa-edit mr-2"></i><span>Edit Post</span>
                                                                <input type="hidden" id="get_text${thread_posts[i].id}" value="${_bodynew}">
                                                                </a>`: '')}
                                                                ${(thread_posts[i].user_id != c_user_id ? `<a class="dropdown-item font-size14px" onclick="flag_post(${thread_posts[i].id})"><i class="fas fa-flag mr-2"></i> <span>Flag Post</span></a>`: '')}
                                                                ${(c_role_id == 1 || c_moderator == 1 ? `<a class="dropdown-item font-size14px" onclick="move_post(${thread_posts[i].id})"><i class="fas fa-arrows-alt mr-2"></i> <span>Move Post</span></a>`: '')}
                                                                ${(c_role_id == 1 || c_moderator == 1 || thread_posts[i].user_id == c_user_id ? `<a class="dropdown-item font-size14px" onclick="delete_post(${thread_posts[i].id})"><i class="far fa-trash-alt mr-2"></i> <span>Delete Post</span></a>`: '')}
                                                                ${(thread_posts[i].user_id != c_user_id && (c_role_id == 1 || c_moderator == 1) ? `<a class="dropdown-item font-size14px" onclick="ban_post_user(${thread_posts[i].user_id})" data-toggle="modal" data-target="#moadalBanUser"><i class="fas fa-user-slash mr-2"></i> <span>Ban User</span></a>`: '')}
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="p-4 post_body get_postVal${thread_posts[i].id} "> ${thread_posts[i].body} </div>
                                        </div>

                                        <div class="col-md-12 border-top p-4" style="background-color: #F7F8F9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div id="emojees-div-${thread_posts[i].id}" style="display:inline">
                                                        ${(thread_posts[i].thumbup_count ? '<i class="fas fa-thumbs-up colorBlue font-size18px"></i>' : '')}
                                                        ${(thread_posts[i].smiley_count ? '<span class="font-size16px">&#128518;</span>' : '')}
                                                        ${(thread_posts[i].info_count ? '<i class="fas fa-info-circle colorGreen font-size18px"></i>' : '')}
                                                        ${(thread_posts[i].agree_count ? '<i class="fas fa-check-circle text-success font-size18px cursorPointer"></i>' : '')}
                                                        ${(thread_posts[i].respectfully_disagree_count ? '<i class="fas fa-times-circle text-danger font-size18px cursorPointer"></i>' : '')}
                                                    </div>

                                                    <span id="emojees-div-count-${thread_posts[i].id}" class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">${(thread_posts[i].thumbup_count + thread_posts[i].smiley_count + thread_posts[i].info_count + thread_posts[i].agree_count + thread_posts[i].respectfully_disagree_count > 0 ? thread_posts[i].thumbup_count + thread_posts[i].smiley_count + thread_posts[i].info_count + thread_posts[i].agree_count + thread_posts[i].respectfully_disagree_count : '')}</span>
                                                </div>

                                                <div class="col-md-6 text-right align-self-center dashboardDataTable">
                                                    <div class="btn-group dropup">
                                                        <a href="#" class="dropdown-toggle text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                            <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                        </a>

                                                        <div class="dropdown-menu emojies animated fadeIn">
                                                            <div class="d-flex">
                                                                <i onclick="likepost(${thread_posts[i].id}, 'thumbup')" class="fas fa-thumbs-up colorBlue font-size32px cursorPointer align-self-center"></i>
                                                                <i onclick="likepost(${thread_posts[i].id}, 'info')" class="fas fa-info-circle colorGreen font-size38px cursorPointer align-self-center"></i>
                                                                <i onclick="likepost(${thread_posts[i].id}, 'agree')" class="fas fa-check-circle text-success font-size38px cursorPointer align-self-center"></i>
                                                                <i onclick="likepost(${thread_posts[i].id}, 'respectfully_disagree')" class="fas fa-times-circle text-danger font-size38px cursorPointer align-self-center"></i>
                                                                <i onclick="likepost(${thread_posts[i].id}, 'smiley')" class="fas fa-laugh-squint text-yellow font-size38px cursorPointer align-self-center"></i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <i onclick="repied_on_post(${thread_posts[i].id}, '${thread_posts[i].author}', \`${_body}\`)" class="fas fa-reply font-size18px text-colorblue100 ml-3 cursorPointer"></i>
                                                    <span onclick="repied_on_post(${thread_posts[i].id}, '${thread_posts[i].author}', \`${_body}\`)" class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1 cursorPointer">REPLY</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            }
            $('#post_result a').attr('target', '_blank');
            $("#post_pagination").html("");
            $("#post_pagination_1").html("");

            if (thread_posts_pages > 1) {
                const pagination_list = [
                    `<li class="page-item ${
                        thread_posts_active_page == 1 ? " disabled" : ""
                }"><a class="page-link" onclick='change_thread_post_page(${
                    thread_posts_active_page - 1
                })'><i class="fas fa-arrow-left"></i></a></li>`,
                ];

                $("#post_pagination").append(``);
                $("#post_pagination_1").append(``);

		var page_no = 0;
                for (let i = 0; i < thread_posts_pages; i++) {
                    pagination_list.push(
                        `<li class="page-item ${
                            thread_posts_active_page == i + 1 ? " active disabled" : ""
                  }"><a class="page-link" onclick="change_thread_post_page(${i + 1})">${
                    i + 1
                  }</a></li>`
                    );
		page_no = i + 1 ;
                }
		sessionStorage.setItem("page", 0);
		sessionStorage.setItem("page", page_no);
                $("#post_pagination").append(
                    pagination_list.join(" ") +
                    `<li class="page-item ${
                        thread_posts_active_page == thread_posts_pages ? " disabled" : ""
                  }"><a class="page-link" onclick='change_thread_post_page(${
                    thread_posts_active_page + 1
                  })'><i class="fas fa-arrow-right"></i></a></li>`
                );

                $("#post_pagination_1").append(
                    pagination_list.join(" ") +
                    `<li class="page-item ${
                        thread_posts_active_page == thread_posts_pages ? " disabled" : ""
                  }"><a class="page-link" onclick='change_thread_post_page(${
                    thread_posts_active_page + 1
                  })'><i class="fas fa-arrow-right"></i></a></li>`
                );
            }

        },

        error: function (err) {
            console.log(err);
        },
    });
}

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}

function format_date(date) {
    let dateI = new Date(date);
    let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

    let _ = `${months[dateI.getMonth()]} ${dateI.getDate()}, ${dateI.getFullYear()}`;
    return _;
}

function format_time(date) {
    let dateI = new Date(date);
    let h = (dateI.getHours() > 9) ? dateI.getHours() : '0' + dateI.getHours();
    let m = (dateI.getMinutes() > 9) ? dateI.getMinutes() : '0' + dateI.getMinutes();

    let _ = `${h}:${m}`;
    return _;
}

function format_time_with_apm(date) {
    let dateI = new Date(date);
    let hour = (dateI.getHours() > 9) ? dateI.getHours() : '0' + dateI.getHours();
    let minute = (dateI.getMinutes() > 9) ? dateI.getMinutes() : '0' + dateI.getMinutes();
    let sec = (dateI.getSeconds() > 9) ? dateI.getSeconds() : '0' + dateI.getSeconds();

    let timeString = `${hour}:${minute}:${sec}`;

    var hourEnd = timeString.indexOf(":");
    var H = +timeString.substr(0, hourEnd);
    var h = H % 12 || 12;
    var ampm = (H < 12 || H === 24) ? " AM" : " PM";
    _ = h + timeString.substr(hourEnd, 3) + ampm;

    return _;
}

// function likepost(post_id, like_type) {

//     // let emojees_div = $("#emojees_div").html();

//     $.ajax({
//         type: "POST",
//         url: `${base_url}likepost`,
//         dataType: "json",
//         contentType: "application/json",
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },

//         data: JSON.stringify({
//             post_id,
//             like_type
//         }),

//         success: function (data) {
//             const {
//                 post_id,
//                 success,
//                 like_types,
//                 likes_count
//             } = data;

//             if (success) {
//                 $("#emojees-div-count-" + post_id).html(likes_count.toString());

//                 let emojees_div = $("#emojees-div-" + post_id);
//                 emojees_div.html("");

//                 if (like_types.thumbup != "0") {
//                     emojees_div.append(`<i class="fas fa-thumbs-up colorBlue font-size18px"></i>`)
//                 }
//                 if (like_types.smiley != "0") {
//                     emojees_div.append(`<span class="font-size16px">&#128518;</span>`)
//                 }
//                 if (like_types.info != "0") {
//                     emojees_div.append(`<i class="fas fa-info-circle colorGreen font-size18px"></i>`)
//                 }
//                 if (like_types.agree != "0") {
//                     emojees_div.append(`<i class="fas fa-check-circle text-success font-size18px cursorPointer"></i>`)
//                 }
//                 if (like_types.respectfully_disagree != "0") {
//                     emojees_div.append(`<i class="fas fa-times-circle text-danger font-size18px cursorPointer"></i>`)
//                 }
//             }
//         },

//         error: function (err) {
//             console.log(err);
//         },
//     });

// }

function likepost(post_id, like_type) {

    // let emojees_div = $("#emojees_div").html();

    $.ajax({
        type: "POST",
        url: `${base_url}likepost`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            post_id,
            like_type
        }),

        success: function (data) {
            const {
                post_id,
                success,
                like_types,
                likes_count
            } = data;

            if (success) {

                let emojees_div = $("#emojees-div-" + post_id);
                emojees_div.html("");

                // code by javed
                if(data.message == 'Author could not '+data.like_type_p+' the post'){

                    switch(data.like_type_p) {
                      case 'thumbup':
                        emojees_div.html(`Author could not <i class="fas fa-thumbs-up colorBlue font-size18px"></i> the post`);
                        break;
                        case 'info':
                        emojees_div.html(`Author could not <i class="fas fa-info-circle colorGreen font-size18px"></i> the post`);
                        break;
                        case 'agree':
                        emojees_div.html(`Author could not <i class="fas fa-check-circle text-success font-size18px cursorPointer"></i> the post`);
                        break;
                        case 'respectfully_disagree':
                        emojees_div.html(`Author could not <i class="fas fa-times-circle text-danger font-size18px cursorPointer"></i> the post`);
                        break;
                        case 'smiley':
                        emojees_div.html(`Author could not <span class="font-size16px">&#128518;</span> the post`);
                        break;
                    }
                    return false;
                }

                if ( data.likes_count  == 0 ) {
                    $("#emojees-div-count-" + post_id).html('');
                    return false;
                }
                // end

                $("#emojees-div-count-" + post_id).html(likes_count.toString());

                if (like_types.thumbup != "0") {
                    emojees_div.append(`<i class="fas fa-thumbs-up colorBlue font-size18px"></i>`)
                }
                if (like_types.smiley != "0") {
                    emojees_div.append(`<span class="font-size16px">&#128518;</span>`)
                }
                if (like_types.info != "0") {
                    emojees_div.append(`<i class="fas fa-info-circle colorGreen font-size18px"></i>`)
                }
                if (like_types.agree != "0") {
                    emojees_div.append(`<i class="fas fa-check-circle text-success font-size18px cursorPointer"></i>`)
                }
                if (like_types.respectfully_disagree != "0") {
                    emojees_div.append(`<i class="fas fa-times-circle text-danger font-size18px cursorPointer"></i>`)
                }

            }
        },

        error: function (err) {
            console.log(err);
        },
    });

}

// function repied_on_post(post_id, author, body) {
//     location.href = location.pathname + location.search + '#reply_post';
//     $("#repied_on_post_id").val(post_id);
//     $("#post_id").val("");
//     //$("#summernote").summernote("focus");

//     tinymce.activeEditor.setContent(`
//     <div class="m-0" style="background-color: #E6E8EB; padding: 10px 10px 0px 10px;" class="mb-4">
//         <h6 class="m-0 p-0" style="font-weight: bold; color: #7CA9A1">${author}:</h6>
//         ${body}
//     </div>
//     <br>
// `);



//     // $("#summernote").summernote("code", `
//     //     <div class="m-0" style="background-color: #E6E8EB; padding: 10px 10px 0px 10px;" class="mb-4">
//     //         <h6 class="m-0 p-0" style="font-weight: bold; color: #7CA9A1">${author}:</h6>
//     //         ${body}
//     //     </div>
//     //     <br>
//     // `);
// }

function repied_on_post(post_id, author, body) {
    location.href = location.pathname + location.search + '#reply_post';
    $("#repied_on_post_id").val(post_id);
    $("#post_id").val("");
    var new_body = $(".get_postVal"+post_id).html();
    //$("#summernote").summernote("focus");

    tinymce.activeEditor.setContent(`
    <div class="m-0" style="background-color: #E6E8EB; padding: 10px 10px 0px 10px;" class="mb-4">
        <h6 class="m-0 p-0" style="font-weight: bold; color: #7CA9A1">${author}:</h6>
        ${new_body}
    </div>
    <br>
`);


    // $("#summernote").summernote("code", `
    //     <div class="m-0" style="background-color: #E6E8EB; padding: 10px 10px 0px 10px;" class="mb-4">
    //         <h6 class="m-0 p-0" style="font-weight: bold; color: #7CA9A1">${author}:</h6>
    //         ${body}
    //     </div>
    //     <br>
    // `);
}


var move_thread_to_board_id;

$(".board_tap").on("click", function () {
    $(".board_tap").css("background", '#f6f6f8');

    $(".board_tap_title").css("color", '#606C80');
    $(".board_tap_threads_count").css("color", '#606C80');
    $(".board_tap_threads").css("color", '#606C80');

    $(this).find(".board_tap_title").css("color", '#fff');
    $(this).find(".board_tap_threads_count").css("color", '#fff');
    $(this).find(".board_tap_threads").css("color", '#fff');

    $(this).css("background", '#7CA9A1');

    move_thread_to_board_id = $(this).find(".move_thread_board_id").val();

    $("#board_tap_btn").removeAttr("disabled");
});

$("#board_tap_btn").on("click", function () {

    let urlParams = new URLSearchParams(window.location.search);
    let thread_id = urlParams.get('thread_id');

    $.ajax({
        type: "POST",
        url: `${base_url}movethread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            board_id: move_thread_to_board_id,
            thread_id
        }),

        success: function (data) {
            location.reload();
        },

        error: function (err) {
            console.log(err);
        },
    })
});

function flag_thread(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}flagthread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })
}

function pinned_thread(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}pinnedthread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}

////// Unwatched Thread /////////

function unwatch_thread(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}unwatchthread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}


//////////////////////////////////bookmark thread ////////////////////////////////


function bookmark_thread(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}bookmarkthread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}






//////// Un flag thread //////////////

function unflag_thread(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}unflagthread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}



////////// Un flag thrad by admin ////////////////

function unflag_threadbyadmin(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}unflagthreadbyadmin`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}







//////// Un flag post  //////////////

function unflag_post(post_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}unflagpost`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            post_id,

        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}


//////// Un flag post  //////////////

function unflag_post_by_admin(post_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}unflagpostbyadmin`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            post_id,

        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}










function unpinned_thread(thread_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}unpinnedthread`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            thread_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);

                setTimeout(function(){ location.reload(); }, 2500);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}


function success_toastr(msg) {
    toastr.options = {
        progressBar: true,
        positionClass: "toast-top-right"
    };

    toastr.success(msg);
}

function error_toastr(msg) {
    toastr.options = {
        progressBar: true,
        positionClass: "toast-top-right"
    };

    toastr.error(msg);
}

// ================================================================================================
// FLAG THREAD
// ================================================================================================

function change_flag_thread_page(page) {
    flagThreadPagination(page);
}

function flagThreadPagination(page = 1) {
    const urlParams = new URLSearchParams(window.location.search);
    const board_id = urlParams.get('board_id');

    $.ajax({
        type: "POST",
        url: `${base_url}flagThreadPagination`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: JSON.stringify({
            page,
            board_id
        }),

        success: function (data) {

            $("#flag_thread_result").html("");
            const {
                success,
                flag_thread_active_page,
                flag_threads_pages,
                flag_threads_total,
                flag_threads
            } = data
            if (flag_threads.length) {
                for (i = 0; i < flag_threads.length; i++) {
                    $("#flag_thread_result").append(`
                        <tr class="border-bottom">
                            <td class="">
                                <p class="text-colorblue100 font-size13px"><a class="text-colorblue100 font-size13px" href="${base_url}thread/posts?board_id=${board_id}&thread_id=${flag_threads[i].id}">${flag_threads[i].title}</a></p>
                                <div class="media">
                                    <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/${flag_threads[i].author_avatar }') no-repeat; background-size: cover;">
                                    </div>
                                    <div class="media-body align-self-center d-flex">
                                        <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center mr-2">${flag_threads[i].author} </span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">${flag_threads[i].role}</span></p>
                                        <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                        <div class="align-self-center">
                                            <span class="align-self-center"><img src="images/icons/pencil.png" alt="" width="20" class="mr-2"></span>
                                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">${format_date(flag_threads[i].c_at)}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center verticalalign" width="110">
                                <a href="#" class="text-colorMahroon700 font-size12px">
                                    <p class="mb-0 "><i class="fas fa-flag mr-1"></i> Flaged by</p>
                                </a>
                            </td>
                            <td class="text-center verticalalign" width="160">
                                <div class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2">
                                ${(c_moderator == "1" ? '<img src="images/icons/Icon-M.png">' : '')}<span class="ml-2 font-familyAtlasGroteskWeb-Light">${c_user_name}</span>
                                </div>
                            </td>
                            <td class="verticalalign dashboardDataTable text-right">
                                <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    `)
                }
            }

            $("#flag_thread_pagination").html("");
            if (flag_threads_pages > 1) {
                const pagination_list = [`<li class="page-item ${flag_thread_active_page == 1 ? " disabled" : ""}"><a class="page-link" onclick='change_flag_thread_page(${flag_thread_active_page - 1})'>Previous</a></li>`];

                $("#flag_thread_pagination").append(``);

                for (let i = 0; i < flag_threads_pages; i++) {
                    pagination_list.push(`<li class="page-item ${flag_thread_active_page == i + 1 ? " active disabled" : ""}"><a class="page-link" onclick="change_flag_thread_page(${i + 1})">${i + 1}</a></li>`);
                }

                $("#flag_thread_pagination").append(pagination_list.join(" ") + `<li class="page-item ${flag_thread_active_page == flag_threads_pages ? " disabled" : ""}"><a class="page-link" onclick='change_flag_thread_page(${flag_thread_active_page + 1})'>Next</a></li>`);
            }

        },

        error: function (err) {
            console.log(err);
        },
    });
}

// ================================================================================================
// WATCHED THREAD
// ================================================================================================

function change_watched_thread_page(page) {
    watchedThreadPagination(page);
}

function watchedThreadPagination(page = 1) {
    const urlParams = new URLSearchParams(window.location.search);
    const board_id = urlParams.get('board_id');

    $.ajax({
        type: "POST",
        url: `${base_url}watchedThreadPagination`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: JSON.stringify({
            page,
            board_id
        }),

        success: function (data) {

            $("#watched_thread_result").html("");
            const {
                success,
                watched_thread_active_page,
                watched_threads_pages,
                watched_threads_total,
                watched_threads
            } = data
            if (watched_threads.length) {
                for (i = 0; i < watched_threads.length; i++) {
                    $("#watched_thread_result").append(`
                        <tr class="border-bottom">
                            <td class="">
                                <p class="text-colorblue100 font-size13px"><a class="text-colorblue100 font-size13px" href="${base_url}thread/posts?board_id=${board_id}&thread_id=${watched_threads[i].id}">${watched_threads[i].title}</a></p>
                                <div class="media">
                                    <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/${watched_threads[i].author_avatar }') no-repeat; background-size: cover;">
                                    </div>
                                    <div class="media-body align-self-center d-flex">
                                        <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center mr-2">${watched_threads[i].author} </span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">${watched_threads[i].role}</span></p>
                                        <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                        <div class="align-self-center">
                                            <span class="align-self-center"><img src="images/icons/pencil.png" alt="" width="20" class="mr-2"></span>
                                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">${format_date(watched_threads[i].c_at)}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `)
                }
            }

            $("#watched_thread_pagination").html("");
            if (watched_threads_pages > 1) {
                const pagination_list = [`<li class="page-item ${watched_thread_active_page == 1 ? " disabled" : ""}"><a class="page-link" onclick='change_watched_thread_page(${watched_thread_active_page - 1})'>Previous</a></li>`];

                $("#watched_thread_pagination").append(``);

                for (let i = 0; i < watched_threads_pages; i++) {
                    pagination_list.push(`<li class="page-item ${watched_thread_active_page == i + 1 ? " active disabled" : ""}"><a class="page-link" onclick="change_watched_thread_page(${i + 1})">${i + 1}</a></li>`);
                }

                $("#watched_thread_pagination").append(pagination_list.join(" ") + `<li class="page-item ${watched_thread_active_page == watched_threads_pages ? " disabled" : ""}"><a class="page-link" onclick='change_watched_thread_page(${watched_thread_active_page + 1})'>Next</a></li>`);
            }

        },

        error: function (err) {
            console.log(err);
        },
    });
}

// ================================================================================================
// YOUR POSTS
// ================================================================================================

function change_your_post_page(page) {
    yourPostPagination(page);
}

function yourPostPagination(page = 1) {
    const urlParams = new URLSearchParams(window.location.search);
    const board_id = urlParams.get('board_id');

    $.ajax({
        type: "POST",
        url: `${base_url}yourPostPagination`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: JSON.stringify({
            page,
            board_id
        }),

        success: function (data) {

            $("#your_posts_result").html("");
            const {
                success,
                your_posts_active_page,
                your_posts_pages,
                your_posts_total,
                your_posts
            } = data
            if (your_posts.length) {
                for (i = 0; i < your_posts.length; i++) {
                    $("#your_posts_result").append(`
                        <div class="col-md-12 border-bottom p-0 pt-4">
                            <div class="row no-gutters">
                                <div class="col-md-8 nb-3">
                                    <a class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-0 font-size14px" href="${base_url}thread/posts?board_id=${board_id}&thread_id=${your_posts[i].thread_id}">${your_posts[i].thread}</a>
                                </div>
                                <div class="col-md-4 text-right d-flex align-self-center font-familyAtlasGroteskWeb-Medium justify-content-end mb-3">
                                </div>

                                <div class="col-lg-2 col-md-3 text-center mb-3">
                                    <div class="col text-center mb-3">
                                        <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('https://ineted.org/public/uploads/profile_images/${your_posts[i].author_avatar}') no-repeat; background-size: cover;">
                                        </div>

                                        <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">${your_posts[i].author}</p>
                                        <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">${your_posts[i].role}</span>
                                    </div>

                                </div>

                                <div class="col-lg-10 col-md-9 mb-3">
                                    <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                        <div class="col-md-12 p-4">
                                            <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                                <div class="col-md-6 p-0 align-self-center ">
                                                    <p class="mb-0 font-size13pxopacity0point5">${format_date(your_posts[i].c_at)} at ${format_time(your_posts[i].c_at)}</p>
                                                </div>
                                                <div class="col-md-6 p-0 text-right">
                                                </div>
                                            </div>
                                            <p>${your_posts[i].body}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `)
                }
            }

            $("#your_post_page_pagination").html("");
            if (your_posts_pages > 1) {
                const pagination_list = [`<li class="page-item ${your_posts_active_page == 1 ? " disabled" : ""}"><a class="page-link" onclick='change_your_post_page(${your_posts_active_page - 1})'>Previous</a></li>`];

                $("#your_post_page_pagination").append(``);

                for (let i = 0; i < your_posts_pages; i++) {
                    pagination_list.push(`<li class="page-item ${your_posts_active_page == i + 1 ? " active disabled" : ""}"><a class="page-link" onclick="change_your_post_page(${i + 1})">${i + 1}</a></li>`);
                }

                $("#your_post_page_pagination").append(pagination_list.join(" ") + `<li class="page-item ${your_posts_active_page == your_posts_pages ? " disabled" : ""}"><a class="page-link" onclick='change_your_post_page(${your_posts_active_page + 1})'>Next</a></li>`);
            }

        },

        error: function (err) {
            console.log(err);
        },
    });
}


$("#deletethread").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                location.reload();
            }
        },
        error: function (err) {
            alert(err);
        },
    });
});

$("#closethread").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                location.reload();
            }
        },
        error: function (err) {
            alert(err);
        },
    });
});


$("#unclosethread").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                location.reload();
            }
        },
        error: function (err) {
            alert(err);
        },
    });
});

$("#diss_board_ban_user").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message);
            }
        },
        error: function (err) {
            alert(err);
        },
    });
});

function edit_post(post_id, post) {

    var post_text = $("#get_text"+post_id).val();
    var new_body = $(".get_postVal"+post_id).html();

        
    location.href = location.pathname + location.search + '#reply_post';
    $("#post_id").val(post_id);
    $("#repied_on_post_id").val("");
    let board_id = $("#board_id").val();
    let thread_id = $("#thread_id").val();

    tinyMCE.activeEditor.setContent(`
    <div class="m-0">
        ${new_body}
    </div>
    <br>
`);




   // $("#summernote").summernote("focus");
}

function flag_post(post_id) {
    $.ajax({
        type: "POST",
        url: `${base_url}flagpost`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        data: JSON.stringify({
            post_id
        }),

        success: function (data) {
            if (data.success) {
                success_toastr(data.message);
            } else {
                error_toastr(data.message);
            }
        },

        error: function (err) {
            console.log(err);
            error_toastr(err);
        },
    })

}

// ================================================================================================
// FLAG POSTS
// ================================================================================================

function change_flag_post_page(page) {
    flagPostPagination(page);
}

function flagPostPagination(page = 1) {
    const urlParams = new URLSearchParams(window.location.search);
    const board_id = urlParams.get('board_id');

    $.ajax({
        type: "POST",
        url: `${base_url}flagPostPagination`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: JSON.stringify({
            page,
            board_id
        }),

        success: function (data) {

            $("#flag_post_result").html("");
            const {
                success,
                flagged_posts_active_page,
                flagged_posts_pages,
                flagged_posts_total,
                flagged_posts
            } = data
            if (flagged_posts.length) {
                for (i = 0; i < flagged_posts.length; i++) {
                    $("#flag_post_result").append(`
                        <div class="col-md-12 border-bottom p-0 pt-4">
                            <div class="row no-gutters">
                                <div class="col-md-8 nb-3">
                                    <a class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-0 font-size14px" href="${base_url}thread/posts?board_id=${board_id}&thread_id=${flagged_posts[i].thread_id}">${flagged_posts[i].thread}</a>
                                </div>
                                <div class="col-md-4 text-right d-flex align-self-center font-familyAtlasGroteskWeb-Medium justify-content-end mb-3">
                                    <a href="#" class="text-colorMahroon700 font-size12px align-self-center">
                                        <p class="mb-0 "><i class="fas fa-flag mr-1"></i> Flaged by</p>
                                    </a>
                                    <div class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 ml-3">
                                        ${(c_moderator == "1" ? '<img src="images/icons/Icon-M.png">' : '')}<span class="ml-2 font-familyAtlasGroteskWeb-Light">${flagged_posts[i].flagged_by}</span>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-3 text-center mb-3">
                                    <div class="col text-center mb-3">
                                        <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('https://ineted.org/public/uploads/profile_images/${flagged_posts[i].author_avatar}') no-repeat; background-size: cover;">
                                        </div>

                                        <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">${flagged_posts[i].author}</p>
                                        <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">${flagged_posts[i].role}</span>
                                    </div>

                                </div>

                                <div class="col-lg-10 col-md-9 mb-3">
                                    <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                        <div class="col-md-12 p-4">
                                            <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                                <div class="col-md-6 p-0 align-self-center ">
                                                    <p class="mb-0 font-size13pxopacity0point5">${format_date(flagged_posts[i].c_at)} at ${format_time(flagged_posts[i].c_at)}</p>
                                                </div>
                                                <div class="col-md-6 p-0 text-right">
                                                    <a href="#" class="text-colorblue200 opacity0point5 ml-3 font-size16px"><i class="fas fa-ellipsis-h"></i></a>
                                                </div>
                                            </div>
                                            ${flagged_posts[i].body}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `)
                }
            }

            $("#flag_post_pagination").html("");
            if (flagged_posts_pages > 1) {
                const pagination_list = [`<li class="page-item ${flagged_posts_active_page == 1 ? " disabled" : ""}"><a class="page-link" onclick='change_flag_post_page(${flagged_posts_active_page - 1})'>Previous</a></li>`];

                $("#flag_post_pagination").append(``);

                for (let i = 0; i < flagged_posts_pages; i++) {
                    pagination_list.push(`<li class="page-item ${flagged_posts_active_page == i + 1 ? " active disabled" : ""}"><a class="page-link" onclick="change_flag_post_page(${i + 1})">${i + 1}</a></li>`);
                }

                $("#flag_post_pagination").append(pagination_list.join(" ") + `<li class="page-item ${flagged_posts_active_page == flagged_posts_pages ? " disabled" : ""}"><a class="page-link" onclick='change_flag_post_page(${flagged_posts_active_page + 1})'>Next</a></li>`);
            }

        },

        error: function (err) {
            console.log(err);
        },
    });
}

const move_post_details = {};

function move_post(post_id) {
    move_post_details['post_id'] = post_id;
    $('#moadalMovePost1').modal('show');
}

$(".move_post_tap").on("click", function () {
    $(".move_post_tap").css("background", '#f6f6f8');

    $(".move_post_tap_title").css("color", '#606C80');
    $(".move_post_tap_count").css("color", '#606C80');
    $(".move_post_tap_thread").css("color", '#606C80');

    $(this).find(".move_post_tap_title").css("color", '#fff');
    $(this).find(".move_post_tap_count").css("color", '#fff');
    $(this).find(".move_post_tap_thread").css("color", '#fff');

    $(this).css("background", '#7CA9A1');

    let board_id = $(this).find(".move_post_board_id").val();

    move_post_details['board_id'] = Number(board_id);

    $("#move_post_tap_btn").removeAttr("disabled");
});


function move_post_step_2() {

    $.ajax({
        type: "GET",
        url: `${base_url}getThreads/${move_post_details.board_id}`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {

            const {
                success,
                threads
            } = data;

            if (threads.length) {
                $('#moadalMovePost1').modal('hide');

                $("#move_post_threads").html("");
                for (let i = 0; i < threads.length; i++) {

                    $("#move_post_threads").append(`
                        <a class="d-block bg-lightWhite600 move_post2_tap">
                            <input type="hidden" class="move_post_thread_id" value="${threads[i].id}">

                            <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                        <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px move_post2_tap_title">${threads[i].title}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                        <div class="media">
                                            <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/${threads[i].author_avatar}') no-repeat; background-size: cover;">
                                            </div>
                                            <div class="media-body align-self-center d-flex">
                                                <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2 move_post2_tap_author">${threads[i].author}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `);
                }

                $('#moadalMovePost2').modal('show');

                $(".move_post2_tap").on("click", function () {
                    $(".move_post2_tap").css("background", '#f6f6f8');

                    $(".move_post2_tap_title").css("color", '#606C80');
                    $(".move_post2_tap_author").css("color", '#606C80');

                    $(this).find(".move_post2_tap_title").css("color", '#fff');
                    $(this).find(".move_post2_tap_author").css("color", '#fff');

                    $(this).css("background", '#7CA9A1');

                    let thread_id = $(this).find(".move_post_thread_id").val();

                    move_post_details['thread_id'] = Number(thread_id);

                    $("#move_post2_tap_btn").removeAttr("disabled");
                });


            } else {
                error_toastr("No threads!")
            }

        },

        error: function (err) {
            console.log(err);
        },
    });

};

$("#move_post2_tap_btn").on("click", function () {

    $.ajax({
        type: "POST",
        url: `${base_url}movepost`,
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(move_post_details),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            if (data.success) {
                location.reload();
            }
        },

        error: function (err) {
            console.log(err);
        },
    });

});

const delete_post_data = {};

function delete_post(post_id) {
    $('#areYouSurePostDeleteClose').modal('show');
    delete_post_data['post_id'] = post_id;
};

$("#delete_post_btn").on("click", function () {

    $.ajax({
        type: "POST",
        url: `${base_url}deletepost`,
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(delete_post_data),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            if (data.success) {
                location.reload();
            }
        },

        error: function (err) {
            console.log(err);
        },
    });

});

function ban_post_user(user_id) {
    $.ajax({
        type: "GET",
        url: `${base_url}banuserdetails/${user_id}`,
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            $("#ban_user_id").val(user_id)

            $("#ban_user_avatar").css({
                "background": `url('https://ineted.org/public/uploads/profile_images/${data.profile_pic_url}') no-repeat`,
                "background-size": "cover"
            });
            $("#ban_user_name").html(data.name)
            $("#ban_user_role").html(data.role)
            $("#ban_user_joined").text(format_date(data.created_at))
            $("#ban_user_posts").text(data.posts)

            $('#moadalBanUser').modal('show');
        },

        error: function (err) {
            console.log(err);
        },
    });

}

// ==================================================================================================================================================================================================
// CHAT SCREEN
// ==================================================================================================================================================================================================
var actuve_tread_for_msg;

$('#message_send_btn').click(function () {

    let msg = $(".emojionearea-editor").html();

    var emojiElt = $("#emojionearea").emojioneArea({autocomplete: false});
    var emojiEltText = emojiElt.data("emojioneArea").getText().trim();

    let thread_id = actuve_tread_for_msg;

    var attachImage = $("#attachImage").prop("files")[0];
    var attachFile = $("#attachFile").prop("files")[0];
    var form_data = new FormData();
    form_data.append("thread_id", thread_id)
    form_data.append("msg", msg)
    form_data.append("attachImage", attachImage)
    form_data.append("attachFile", attachFile)

    if (emojiEltText == "" || emojiEltText == null) {
        error_toastr("Please enter your message!");
        return;
    }

    $.ajax({
        type: "POST",
        processData: false, // important
        contentType: false, // important
        url: `${base_url}thread_messages_post`,
        dataType: "json",
        data: form_data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            if (data.success) {
                getThreadMsgs(thread_id)
            }
        },

        error: function (err) {
            console.log(err);
        },
    });

})

function chat_person_tab(thread_id, chat_user, chat_user_role, chat_user_avatar) {

    $(".user-thread-list").removeClass('active')
    $(".not-user-thread-list").removeClass('active')

    $("#user-thread-" + thread_id).addClass('active')
    $("#chat-footer").css("display", "block")
    actuve_tread_for_msg = thread_id

    $("#chat_user_details").html("");

    $("#chat_user_details").html(`
        <div class="col-md-8">
            <div class="media">
                <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/${chat_user_avatar}') no-repeat; background-size: cover;"></div>
                <div class="media-body align-self-center d-flex">
                    <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center d-flex"><span class="align-self-center mr-2">${chat_user}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">${chat_user_role}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-end">
            <a class="font-familyAtlasGroteskWeb-Regular font-size12px text-right pr-0 text-colorblue200 align-self-center" href="#"><i class="fas fa-circle text-ferozy mr-2 font-size10px"></i>Active Now</a>
        </div>
    `)

    getThreadMsgs(thread_id);
}

function getThreadMsgs(thread_id) {
    $.ajax({
        type: "GET",
        url: `${base_url}thread_messages/${thread_id}`,
        dataType: "json",
        contentType: "application/json",

        success: function (data) {
            $("#today_chats").html("");
            $("#yesterday_chats").html("");
            $("#previous_chats").html("");

            const {
                success,
                today_chats,
                yesterday_chats,
                previous_chats
            } = data;

            if (today_chats.length) {
                $("#today_chats").append(`
                    <hr>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size10px border-radius0all opacity0point5 mb-3">Today</button>
                    </div>
                `)

                for (let i = 0; i < today_chats.length; i++) {
                    let today_chat = today_chats[i];

                    if (today_chat.user_id == c_user_id) {
                        $("#today_chats").append(`
                            <div class="col mb-4 d-flex justify-content-end">
                                <div class="bg-colorFerozy p-3 font-familyAtlasGroteskWeb-Regular text-white font-size11px text-right arrowRight">
                                    <p class="mb-2 ">You <span class="opacity0point5">at ${format_time_with_apm(today_chat.c_at)}</span></p>
                                    <p class="mb-0">${today_chat.message}</p>
                                    ${(today_chat.attach_image ? `<img src="https://ineted.org/public/uploads/chat/images/${today_chat.attach_image}" class="img-thumbnail">` : '')}
                                    ${(today_chat.attach_file ? `<a target="_blank" class="text-white" href="https://ineted.org/public/uploads/chat/files/${today_chat.attach_file}"><i class="fas fa-paperclip text-white opacity0point5"></i> Attachment</a>` : '')}
                                </div>
                            </div>
                        `)
                    } else {
                        $("#today_chats").append(`
                            <div class="col mb-4 d-flex">
                                <div class="bg-lightWhite100 p-3 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size11px arrowLeft">
                                    <p class="mb-2 opacity0point5">at ${format_time_with_apm(today_chat.c_at)}</p>
                                    <p class="mb-0">${today_chat.message}</p>
                                    ${(today_chat.attach_image ? `<img src="https://ineted.org/public/uploads/chat/images/${today_chat.attach_image}" class="img-thumbnail">` : '')}
                                    ${(today_chat.attach_file ? `<a target="_blank" class="text-white" href="https://ineted.org/public/uploads/chat/files/${today_chat.attach_file}"><i class="fas fa-paperclip text-white opacity0point5"></i> Attachment</a>` : '')}
                                </div>
                                <div class="align-self-center mr-3 ml-3">
                                    <a href="#" class="text-ferozy"></i></a>
                                </div>
                            </div>
                        `)
                    }
                }
            }

            if (yesterday_chats.length) {
                $("#yesterday_chats").append(`
                    <hr>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size10px border-radius0all opacity0point5 mb-3">Yesterday</button>
                    </div>
                `)

                for (let i = 0; i < yesterday_chats.length; i++) {
                    let yesterday_chat = yesterday_chats[i];

                    if (yesterday_chat.user_id == c_user_id) {
                        $("#yesterday_chats").append(`
                            <div class="col mb-4 d-flex justify-content-end">
                                <div class="bg-colorFerozy p-3 font-familyAtlasGroteskWeb-Regular text-white font-size11px text-right arrowRight">
                                    <p class="mb-2 ">You <span class="opacity0point5">at ${format_time_with_apm(yesterday_chat.c_at)}</span></p>
                                    <p class="mb-0">${yesterday_chat.message}</p>
                                    ${(yesterday_chat.attach_image ? `<img src="https://ineted.org/public/uploads/chat/images/${yesterday_chat.attach_image}" class="img-thumbnail">` : '')}
                                    ${(yesterday_chat.attach_file ? `<a target="_blank" class="text-white" href="https://ineted.org/public/uploads/chat/files/${yesterday_chat.attach_file}"><i class="fas fa-paperclip text-white opacity0point5"></i> Attachment</a>` : '')}
                                </div>
                            </div>
                        `)
                    } else {
                        $("#yesterday_chats").append(`
                            <div class="col mb-4 d-flex">
                                <div class="bg-lightWhite100 p-3 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size11px arrowLeft">
                                    <p class="mb-2 opacity0point5">at ${format_time_with_apm(yesterday_chat.c_at)}</p>
                                    <p class="mb-0">${yesterday_chat.message}</p>
                                    ${(yesterday_chat.attach_image ? `<img src="https://ineted.org/public/uploads/chat/images/${yesterday_chat.attach_image}" class="img-thumbnail">` : '')}
                                    ${(yesterday_chat.attach_file ? `<a target="_blank" class="text-white" href="https://ineted.org/public/uploads/chat/files/${yesterday_chat.attach_file}"><i class="fas fa-paperclip text-white opacity0point5"></i> Attachment</a>` : '')}
                                </div>
                                <div class="align-self-center mr-3 ml-3">
                                    <a href="#" class="text-ferozy"></i></a>
                                </div>
                            </div>
                        `)
                    }
                }
            }

            if (previous_chats.length) {
                $("#previous_chats").append(`
                    <hr>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size10px border-radius0all opacity0point5 mb-3">Previous</button>
                    </div>
                `)

                for (let i = 0; i < previous_chats.length; i++) {
                    let previous_chat = previous_chats[i];

                    if (previous_chat.user_id == c_user_id) {
                        $("#previous_chats").append(`
                            <div class="col mb-4 d-flex justify-content-end">
                                <div class="bg-colorFerozy p-3 font-familyAtlasGroteskWeb-Regular text-white font-size11px text-right arrowRight">
                                    <p class="mb-2 ">You <span class="opacity0point5">at ${format_time_with_apm(previous_chat.c_at)}</span></p>
                                    <p class="mb-0">${previous_chat.message}</p>
                                    ${(previous_chat.attach_image ? `<img src="https://ineted.org/public/uploads/chat/images/${previous_chat.attach_image}" class="img-thumbnail">` : '')}
                                    ${(previous_chat.attach_file ? `<a target="_blank" class="text-white" href="https://ineted.org/public/uploads/chat/files/${previous_chat.attach_file}"><i class="fas fa-paperclip text-white opacity0point5"></i> Attachment</a>` : '')}
                                </div>
                            </div>
                        `)
                    } else {
                        $("#previous_chats").append(`
                            <div class="col mb-4 d-flex">
                                <div class="bg-lightWhite100 p-3 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size11px arrowLeft">
                                    <p class="mb-2 opacity0point5">at ${format_time_with_apm(previous_chat.c_at)}</p>
                                    <p class="mb-0">${previous_chat.message}</p>
                                    ${(previous_chat.attach_image ? `<img src="https://ineted.org/public/uploads/chat/images/${previous_chat.attach_image}" class="img-thumbnail">` : '')}
                                    ${(previous_chat.attach_file ? `<a target="_blank" class="text-white" href="https://ineted.org/public/uploads/chat/files/${previous_chat.attach_file}"><i class="fas fa-paperclip text-white opacity0point5"></i> Attachment</a>` : '')}
                                </div>
                                <div class="align-self-center mr-3 ml-3">
                                    <a href="#" class="text-ferozy"></i></a>
                                </div>
                            </div>
                        `)
                    }
                }
            }

            chatWindowScroll("#chat-window")
            resetChatInput();
        },

        error: function (err) {
            console.log(err);
        },
    });

}


function not_chat_person_tab(user_id, user_name, user_role, user_avatar) {

    $.ajax({
        type: "POST",
        url: `${base_url}create_new_thread`,
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
            user_id
        }),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            if (data.success) {

                $(".user-thread-list").removeClass('active')
                $(".not-user-thread-list").removeClass('active')

                $("#not-user-thread-" + user_id).addClass('active')
                $("#chat-footer").css("display", "block")
                actuve_tread_for_msg = data.thread_id


                $("#chat_user_details").html("");

                $("#chat_user_details").html(`
                    <div class="col-md-8">
                        <div class="media">
                            <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/${user_avatar}') no-repeat; background-size: cover;"></div>
                            <div class="media-body align-self-center d-flex">
                                <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center d-flex"><span class="align-self-center mr-2">${user_name}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">${user_role}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a class="font-familyAtlasGroteskWeb-Regular font-size12px text-right pr-0 text-colorblue200 align-self-center" href="#"><i class="fas fa-circle text-ferozy mr-2 font-size10px"></i>Active Now</a>
                    </div>
                `)

                getThreadMsgs(data.thread_id);
            }
        },

        error: function (err) {
            console.log(err);
        },
    });
}

$("#editPostBtn").on( 'click', function (e) {

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

	tinyMCE.triggerSave()
		
	var content = $("textarea[name=body]").val();
        var form_data = new FormData($("#editForm")[0]);
	
        $.ajax({
            type: "POST",
            url: "posts",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
        		tinyMCE.activeEditor.setContent('');
       		$(".get_postVal"+data.post_id).html(data.body);
		
		if(data.goto){
                	var num = (sessionStorage.getItem("page") == data.last_page ) ? data.last_page : data.last_page;
                	change_thread_post_page(num);
           	 }
		$("#post_pagination").html(data.page_html);
                console.log(data);
                // if(data=='Post successfully added!'){
                //     location.reload();
                // }
            },
            error: function (err) {
        
        		$("#post-form-err").html("Please enter your comments");
          	console.log(err);
            },
        });         
           
});

function chatWindowScroll(id) {
    $(id).stop().animate({
        scrollTop: $(id)[0].scrollHeight
    }, 1000);
}

function resetChatInput() {
    $(".emojionearea-editor").html("");
    $("#attachImage").val('');
    $("#attachFile").val('');
    $("#asset-selection").css("display", "none");
}

$("#attachImage").change(function () {
    $("#asset-selection").css("display", "block");
    readURL(this, '#asset-selection-image');
});

$("#attachFile").change(function () {
    $("#asset-selection").css("display", "block");
    readURL(this, '#asset-selection-attachment');
});


function readURL(input, output) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            if (output == '#asset-selection-image') {
                $(output).attr('src', e.target.result).slideDown();
            } else {
                $(output).attr('src', base_url + 'images/attachment.png').slideDown();
            }
        }

        reader.readAsDataURL(input.files[0]);
    }
}

