$(document).ready(function () {
  dashBoardlistView();

  if (localStorage.getItem("tagBtn")) {
    tagBtn = localStorage.getItem("tagBtn");
    coursesPgFilter();

    $(".relatedTag button").removeClass("active");
    $(`#tag-button-${tagBtn}`).addClass("active");

    localStorage.clear();
  }
});

$(window).load(function () {});

function table1() {
  $("#dashboardDataTable1").DataTable({
    bPaginate: true,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    sPaginationType: "full_numbers",
    iDisplayLength: 10,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });
}

function table2() {
  $("#dashboardDataTable2").DataTable({
    bPaginate: true,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    sPaginationType: "full_numbers",
    iDisplayLength: 10,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });
}

function table3() {
  $("#dashboardDataTable3").DataTable({
    bPaginate: true,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    sPaginationType: "full_numbers",
    iDisplayLength: 10,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });
}

function dashBoardlistView() {
  $("#dashboardDataTable1").DataTable({
    bPaginate: true,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    sPaginationType: "full_numbers",
    iDisplayLength: 10,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });

  $("#dashboardDataTable2").DataTable({
    bPaginate: true,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    sPaginationType: "full_numbers",
    iDisplayLength: 10,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });

  $("#dashboardDataTable3").DataTable({
    bPaginate: true,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    sPaginationType: "full_numbers",
    iDisplayLength: 10,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });

  $("#dashboardDataTable4").DataTable({
    bPaginate: false,
    bLengthChange: false,
    bFilter: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
    dom: "lBfrtip",
    buttons: ["excel"],
    language: {
      searchPlaceholder: "Keyword search here",
      search: "",
    },
  });
}

// =================================================================================================================================================================================================================================
// ==================================================================================== ABDUL RAFEY WORK START =====================================================================================================================
// =================================================================================================================================================================================================================================

// =================================================================================================================================================================================================================================
// ============ PROFILE PAGE
// =================================================================================================================================================================================================================================

$("#profile_update_form").submit(function (e) {
  e.preventDefault();

  var profile_discription_c = tinyMCE.get('profile_discription_c').getContent();;

  console.log(profile_discription_c);

  $("#profile_discription").val(profile_discription_c);
 var tags = $("#selectpickerTags2").select2("val");
  console.log(tags);
  var categories = $("#selectpickerCategories2").select2("val");
  console.log(categories);

  var formData = new FormData(this);
  formData.append("tags", JSON.stringify(tags));
  formData.append("categories", categories);

  $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      if (data.success) {
        $("#display_result").html(
          `<p style="color: green">${data.message}</p>`
        );
        location.reload();
      } else {
        $("#display_result").html(`<p style="color: red">${data.message}</p>`);
      }
    },

    error: function (err) {
      $("#display_result").html(`<p style="color: red">${err}</p>`);
    },
  });
});

// =================================================================================================================================================================================================================================
// ============ DISCUSSION PAGE
// =================================================================================================================================================================================================================================

var base_url;

if (location.host == "127.0.0.1:8000") {
  base_url = "/";
} else {
  base_url = "/inetEDPlatform/";
}

$("#discussions_ask_question").submit(function (e) {
  e.preventDefault();

  const formData = {
    ques_id: $("#discussion_id").val(),
    ques_title: $("#ques_title").val(),
    ques_body: $("#ques_body").val(),
    ques_tags: JSON.stringify($("#ques_tags").val()),
  };

  $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(formData),
    success: function (data) {
      console.log(data);
      location.reload();
    },

    error: function (err) {
      console.log(err);
    },
  });
});

var act_votes_count = Number($("#votes_count").html());
let discussion_id = $("#discussion_id").val();
let user_id = $("#user_id").val();

$("#vote_up").click(function () {
  let votes_count = Number($("#votes_count").html());

  if (
    act_votes_count == votes_count &&
    !localStorage.getItem(`voted_${discussion_id}_${user_id}`)
  ) {
    $("#votes_count").html(votes_count + 1);
    voteing(votes_count + 1, discussion_id, user_id);
  }
});

$("#vote_down").click(function () {
  let votes_count = Number($("#votes_count").html());

  if (
    act_votes_count == votes_count &&
    !localStorage.getItem(`voted_${discussion_id}_${user_id}`)
  ) {
    $("#votes_count").html(votes_count - 1);
    voteing(votes_count - 1, discussion_id, user_id);
  }
});

function voteing(vote, discussion_id, user_id) {
  $.ajax({
    type: "POST",
    url: `${base_url}discussion/vote/${discussion_id}`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify({ vote }),
    success: function (data) {
      localStorage.setItem(
        `voted_${data.discussion_id}_${user_id}`,
        data.discussion_id
      );
    },

    error: function (err) {
      console.log(err);
    },
  });
}

$("#delete_discussion").click(function () {
  if (confirm("Are you sure you want to delete")) {
    $.ajax({
      type: "GET",
      url: `${base_url}discussion/delete/${discussion_id}`,
      dataType: "json",
      contentType: "application/json",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: function (data) {
        console.log(data);
      },

      error: function (err) {
        console.log(err);
      },
    });
  }
});

function tagbutton(ref) {
  const urlParams = new URLSearchParams(window.location.search);
  const page = 1;
  const tag = urlParams.get("tag");
  const main = urlParams.get("main") ? urlParams.get("main") : "TopViews";
  const new_tag = ref.innerHTML;
  const pathname = "/discussions";

  var host_name;

  if (location.host == "127.0.0.1:8000") {
    host_name = "";
  } else {
    host_name = "/";
  }

  let active_tab = $("#list-tab .active").html();

  switch (active_tab) {
    case "Newest":
      if (tag != new_tag) {
        location.href =
          host_name + pathname + `?newest_page=1&tag=${new_tag}&main=${main}`;
      }
      break;
    case "Active":
      if (tag != new_tag) {
        location.href =
          host_name + pathname + `?active_page=1&tag=${new_tag}&main=${main}`;
      }
      break;
    case "Featured":
      if (tag != new_tag) {
        location.href =
          host_name + pathname + `?featured_page=1&tag=${new_tag}&main=${main}`;
      }
      break;
    case "Unanswered":
      if (tag != new_tag) {
        location.href =
          host_name +
          pathname +
          `?unanswered_page=1&tag=${new_tag}&main=${main}`;
      }
      break;
    case "Frequent":
      if (tag != new_tag) {
        location.href =
          host_name + pathname + `?frequent_page=1&tag=${new_tag}&main=${main}`;
      }
      break;
    default:
      location.href =
        host_name + pathname + `?newest_page=1&tag=${new_tag}&main=${main}`;
      break;
  }
}

function mainButton(ref) {
  const urlParams = new URLSearchParams(window.location.search);
  const tag = urlParams.get("tag") ? urlParams.get("tag") : "All";
  const main = urlParams.get("main") ? urlParams.get("main") : "TopViews";
  const active_tab = $("#list-tab .active").html();
  const active_main_btn = ref.innerHTML;
  const pathname = "/discussions";

  var host_name;

  if (location.host == "127.0.0.1:8000") {
    host_name = "";
  } else {
    host_name = "/";
  }

  var query = "";

  switch (active_tab) {
    case "Newest":
      query += `?newest_page=1&tag=${tag}`;
      break;
    case "Active":
      query += `?active_page=1&tag=${tag}`;
      break;
    case "Featured":
      query += `?featured_page=1&tag=${tag}`;
      break;
    case "Unanswered":
      query += `?unanswered_page=1&tag=${tag}`;
      break;
    case "Frequent":
      query += `?frequent_page=1&tag=${tag}`;
      break;
    default:
      query += `?newest_page=1&tag=${tag}`;
      break;
  }

  if (query != "") {
    query += `&main=${active_main_btn.replace(/\s/g, "")}`;
  } else {
    query += `?main=${active_main_btn.replace(/\s/g, "")}`;
  }

  location.href = host_name + pathname + query;
}

// =================================================================================================================================================================================================================================
// ============ STUDENT COURSES AND SEARCH/COURSE PAGE
// =================================================================================================================================================================================================================================

var _video = false,
  _article = false,
  _pdf = false,
  _image = false,
  _audio = false,
  tagBtn = "",
  searchQuery = "",
  auth_id = $("#auth_id").val(),
  userContentList = "";

$("#view-thumbnail").click(function () {
  $("#content_list_view").fadeOut();
  $("#content_thumbnail_view").fadeIn();
});

$("#view-list").click(function () {
  $("#content_thumbnail_view").fadeOut();
  $("#content_list_view").fadeIn();
});

try {
  userContentList = $("#user_content_updated_list").val().split(",");
} catch (err) {
  console.log(err);
}

$("#course_sort").on("change", function () {
  coursesPgFilter();
});

$("#content_formate_sort").on("change", function () {
  coursesPgFilter();
});




// $("#difficulty_level").select2({
//   placeholder: "Nothing Selected",
//   multiple: true,
//   allowClear: true,
// });

$("#difficulty_level").on("change", async function (e) {

  var difficulty_level = $("#difficulty_level").val();

  var difficulty_level_current_id;

  await $("#difficulty_level").on("select2:select", function (e) {
    var data = e.params.data;
    difficulty_level_current_id = data.id;
  });

  if (difficulty_level && difficulty_level.length > 1 && difficulty_level[0] == "all" && difficulty_level_current_id != "all") {
    let _difficulty_level = difficulty_level.slice(1);
    $('#difficulty_level').val(_difficulty_level).trigger('change');
  } else if (difficulty_level && difficulty_level_current_id == "all") {
    $('#difficulty_level').val(['all']).trigger('change');
    setTimeout(() => {
      coursesPgFilter();
    }, 300);
  } else if (difficulty_level && difficulty_level[0] != "all" && difficulty_level_current_id != "all") {
    setTimeout(() => {
      coursesPgFilter();
    }, 300);
  }
});

$("#course_sort1").on("change", function () {
  coursesPgFilter1();
});

$("#content_formate_sort1").on("change", function () {
  coursesPgFilter1();
});




// $("#difficulty_level").select2({
//   placeholder: "Nothing Selected",
//   multiple: true,
//   allowClear: true,
// });

$("#difficulty_level1").on("change", async function (e) {

  var difficulty_level = $("#difficulty_level1").val();

  var difficulty_level_current_id;

  await $("#difficulty_level1").on("select2:select", function (e) {
    var data = e.params.data;
    difficulty_level_current_id = data.id;
  });

  if (difficulty_level && difficulty_level.length > 1 && difficulty_level[0] == "all" && difficulty_level_current_id != "all") {
    let _difficulty_level = difficulty_level.slice(1);
    $('#difficulty_level').val(_difficulty_level).trigger('change');
  } else if (difficulty_level && difficulty_level_current_id == "all") {
    $('#difficulty_level').val(['all']).trigger('change');
    setTimeout(() => {
      coursesPgFilter1();
    }, 300);
  } else if (difficulty_level && difficulty_level[0] != "all" && difficulty_level_current_id != "all") {
    setTimeout(() => {
      coursesPgFilter1();
    }, 300);
  }
});

$("#course_sort2").on("change", function () {
  coursesPgFilter2();
});

$("#content_formate_sort2").on("change", function () {
  coursesPgFilter2();
});




// $("#difficulty_level").select2({
//   placeholder: "Nothing Selected",
//   multiple: true,
//   allowClear: true,
// });

$("#difficulty_level2").on("change", async function (e) {

  var difficulty_level = $("#difficulty_level2").val();

  var difficulty_level_current_id;

  await $("#difficulty_level2").on("select2:select", function (e) {
    var data = e.params.data;
    difficulty_level_current_id = data.id;
  });

  if (difficulty_level && difficulty_level.length > 1 && difficulty_level[0] == "all" && difficulty_level_current_id != "all") {
    let _difficulty_level = difficulty_level.slice(1);
    $('#difficulty_level').val(_difficulty_level).trigger('change');
  } else if (difficulty_level && difficulty_level_current_id == "all") {
    $('#difficulty_level').val(['all']).trigger('change');
    setTimeout(() => {
      coursesPgFilter2();
    }, 300);
  } else if (difficulty_level && difficulty_level[0] != "all" && difficulty_level_current_id != "all") {
    setTimeout(() => {
      coursesPgFilter2();
    }, 300);
  }
});

$("#course_sort3").on("change", function () {
  coursesPgFilter3();
});

$("#content_formate_sort3").on("change", function () {
  coursesPgFilter3();
});




// $("#difficulty_level").select2({
//   placeholder: "Nothing Selected",
//   multiple: true,
//   allowClear: true,
// });

$("#difficulty_level3").on("change", async function (e) {

  var difficulty_level = $("#difficulty_level3").val();

  var difficulty_level_current_id;

  await $("#difficulty_level3").on("select2:select", function (e) {
    var data = e.params.data;
    difficulty_level_current_id = data.id;
  });

  if (difficulty_level && difficulty_level.length > 1 && difficulty_level[0] == "all" && difficulty_level_current_id != "all") {
    let _difficulty_level = difficulty_level.slice(1);
    $('#difficulty_level').val(_difficulty_level).trigger('change');
  } else if (difficulty_level && difficulty_level_current_id == "all") {
    $('#difficulty_level').val(['all']).trigger('change');
    setTimeout(() => {
      coursesPgFilter3();
    }, 300);
  } else if (difficulty_level && difficulty_level[0] != "all" && difficulty_level_current_id != "all") {
    setTimeout(() => {
      coursesPgFilter3();
    }, 300);
  }
});

$("#course_sort4").on("change", function () {
  coursesPgFilter4();
});

$("#content_formate_sort4").on("change", function () {
  coursesPgFilter4();
});




// $("#difficulty_level").select2({
//   placeholder: "Nothing Selected",
//   multiple: true,
//   allowClear: true,
// });

$("#difficulty_level4").on("change", async function (e) {

  var difficulty_level = $("#difficulty_level4").val();

  var difficulty_level_current_id;

  await $("#difficulty_level4").on("select2:select", function (e) {
    var data = e.params.data;
    difficulty_level_current_id = data.id;
  });

  if (difficulty_level && difficulty_level.length > 1 && difficulty_level[0] == "all" && difficulty_level_current_id != "all") {
    let _difficulty_level = difficulty_level.slice(1);
    $('#difficulty_level').val(_difficulty_level).trigger('change');
  } else if (difficulty_level && difficulty_level_current_id == "all") {
    $('#difficulty_level').val(['all']).trigger('change');
    setTimeout(() => {
      coursesPgFilter4();
    }, 300);
  } else if (difficulty_level && difficulty_level[0] != "all" && difficulty_level_current_id != "all") {
    setTimeout(() => {
      coursesPgFilter4();
    }, 300);
  }
});

$("#course_sort5").on("change", function () {
  coursesPgFilter5();
});

$("#content_formate_sort5").on("change", function () {
  coursesPgFilter5();
});




// $("#difficulty_level").select2({
//   placeholder: "Nothing Selected",
//   multiple: true,
//   allowClear: true,
// });

$("#difficulty_level5").on("change", async function (e) {

  var difficulty_level = $("#difficulty_level5").val();

  var difficulty_level_current_id;

  await $("#difficulty_level5").on("select2:select", function (e) {
    var data = e.params.data;
    difficulty_level_current_id = data.id;
  });

  if (difficulty_level && difficulty_level.length > 1 && difficulty_level[0] == "all" && difficulty_level_current_id != "all") {
    let _difficulty_level = difficulty_level.slice(1);
    $('#difficulty_level').val(_difficulty_level).trigger('change');
  } else if (difficulty_level && difficulty_level_current_id == "all") {
    $('#difficulty_level').val(['all']).trigger('change');
    setTimeout(() => {
      coursesPgFilter5();
    }, 300);
  } else if (difficulty_level && difficulty_level[0] != "all" && difficulty_level_current_id != "all") {
    setTimeout(() => {
      coursesPgFilter5();
    }, 300);
  }
});

$("input[type='checkbox']").change(function () {
  var checkbox = $(this),
    value = checkbox.val();

  if (value == "content_type_video" && checkbox.is(":checked")) {
    _video = true;
    coursesPgFilter();
  } else if (value == "content_type_video" && !checkbox.is(":checked")) {
    _video = false;
    coursesPgFilter();
  }

  if (value == "content_type_article" && checkbox.is(":checked")) {
    _article = true;
    coursesPgFilter();
  } else if (value == "content_type_article" && !checkbox.is(":checked")) {
    _article = false;
    coursesPgFilter();
  }

  if (value == "content_type_pdf" && checkbox.is(":checked")) {
    _pdf = true;
    coursesPgFilter();
  } else if (value == "content_type_pdf" && !checkbox.is(":checked")) {
    _pdf = false;
    coursesPgFilter();
  }

  if (value == "content_type_image" && checkbox.is(":checked")) {
    _image = true;
    coursesPgFilter();
  } else if (value == "content_type_image" && !checkbox.is(":checked")) {
    _image = false;
    coursesPgFilter();
  }

  if (value == "content_type_audio" && checkbox.is(":checked")) {
    _audio = true;
    coursesPgFilter();
  } else if (value == "content_type_audio" && !checkbox.is(":checked")) {
    _audio = false;
    coursesPgFilter();
  }
});

function change_content_page(page) {
  coursesPgFilter(page);
}
function change_content_page1(page) {
  coursesPgFilter1(page);
}
function change_content_page2(page) {
  coursesPgFilter2(page);
}
function change_content_page3(page) {
  coursesPgFilter3(page);
}
function change_content_page4(page) {
  coursesPgFilter4(page);
}
function change_content_page5(page) {
  coursesPgFilter5(page);
}

function coursesPgFilter(page = 1) {
  const sort = $("#course_sort").val();
  const cat_id = $("#cat_id").val();
  const difficulty_level_id = $("#difficulty_level").val();
  const content_formate_sort = $("#content_formate_sort").val();

  const filter_data = {
    sort,
    cat_id,
    difficulty_level_id,
    page,
    _video,
    _article,
    _pdf,
    _image,
    _audio,
    tagBtn,
    searchQuery,
    content_formate_sort,
  };

  // console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}courses/filter`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      // console.log("RECEIVED " + JSON.stringify(data));

      const { contents, content_pages, course_pages, content_active_page } = data;
      var images_path;

      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/public/uploads/content/profile_images/";
      }
courseimg_path="/images/";
      const div_class =
        cat_id && cat_id != ""
          ? "col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck"
          : "col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck";

      $("#content_result").html("");
      $("#content_list_view").html("");

      if (contents.length) {
        for (i = 0; i < contents.length; i++) {
          let bookmarkBtn = auth_id ? `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(contents[i].id.toString()) ? "checked" : ""} onclick="bookmark(this)" value=${JSON.stringify([contents[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${contents[i].id}"><label class="custom-control-label" for="bookmark-${contents[i].id}"></label></div>` : "";
          if(contents[i].scope_type=='course'){course_count_New=`
          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${`${base_url}` + courseimg_path + 'bookicon.png'}" width="25" class="mr-1"> Courses ( ${contents[i].coursecount} items ) 
            </h6>
          </div>`;}else{course_count_New= "" ;
}
         if(contents[i].image_url!='placeholder.png'){
            if(contents[i].content_group==null){
                  if(contents[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-1.png'}"> `;}
                  if(contents[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-2.png'}"> `;}
                  if(contents[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-3.png'}"> `;}
                  if(contents[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-4.png'}"> `;}
                  if(contents[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-5.png'}"> `;}
                  if(contents[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(contents[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${`${base_url}` +images_path + 'icon-7.png'}"> `;}
                if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-8.png'}"> `;}
                if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-9.png'}"> `;}
                if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-10.png'}"> `;}
                if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-11.png'}"> `;}
                if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(contents[i].content_group==null){
                if(contents[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType==null && contents[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(contents[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         }        
          $("#content_list_view").append(`
                <div class="media mt-4 font-size14px">
                    <div class="media-body font-familyAtlasGrotesk-Medium">
                        <a href="${base_url}content/section/${contents[i].id}">
                            <h6 class="mt-0 text-colorblue100 mb-0">${contents[i].title}</h6>
                        </a>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                            <div class="row justify-content-between">
                                <p class="text-colorblue200"><a href="${base_url}search/all?query=${contents[i].authors}">${contents[i].authors}</a> <br> <a href="${base_url}search/all?query=${contents[i].affiliation}">${contents[i].affiliation}</a> </p>
                            </div>
                        </div>
                        <p class="text-colorblue100 font-size10px"><span class="mr-2">${contents[i].difficulty_level}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">${contents[i].categories}</span></p>
                    </div>
                </div>
            `);

          $("#content_result").append(`
                        <div class="${div_class}">
                            <div class="card col-12 p-0 border-radius0all">
                            <a href="${base_url}content/section/${
            contents[i].id
          }">
                              ${new_image}
                            </a>
                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${
                                      contents[i].views_count
                                    }</small>
                                </div>
                                <div class="card-body">

                                    <a href="${base_url}content/section/${
            contents[i].id
          }">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${
                                          contents[i].title
                                        }</h6>
                                    </a>
                                <a href="${base_url}search/all?query=${contents[i].authors}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                      contents[i].authors
                                    }</small></p>
                                </a>
                                <a href="${base_url}search/all?query=${contents[i].affiliation}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                        contents[i].affiliation
                                      }</small></p>
                                </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                  <div class="m-0 text-colorblue200 bookmark float-left">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                     <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(contents[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                      </label>
                                     </div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(contents[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(contents[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(contents[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                      </label></div>  
                                  </div>
                                  <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                        ${bookmarkBtn}
                                    </div>
                                </div>
                                  ${course_count_New}

                            </div>
                        </div>
                    `);
        }
      }

      $("#content_pagination").html("");
      if (content_pages > 1) {
        const pagination_list = [
          `<li class="page-item ${
            content_active_page == 1 ? " disabled" : ""
          }"><a class="page-link" onclick='change_content_page(${
            content_active_page - 1
          })'>Previous</a></li>`,
        ];

        $("#content_pagination").append(``);

        for (let i = 0; i < content_pages; i++) {
          pagination_list.push(
            `<li class="page-item ${
              content_active_page == i + 1 ? " active disabled" : ""
            }"><a class="page-link" onclick="change_content_page(${i + 1})">${
              i + 1
            }</a></li>`
          );
        }

        $("#content_pagination").append(
          pagination_list.join(" ") +
            `<li class="page-item ${
              content_active_page == content_pages ? " disabled" : ""
            }"><a class="page-link" onclick='change_content_page(${
              content_active_page + 1
            })'>Next</a></li>`
        );
      }
    },

    error: function (err) {
      console.log(err);
    },
  });
}
function coursesPgFilter1(page = 1) {
  const sort = $("#course_sort1").val();
  const cat_id = $("#cat_id").val();
  const difficulty_level_id = $("#difficulty_level1").val();
  const content_formate_sort = $("#content_formate_sort1").val();

  const filter_data = {
    sort,
    cat_id,
    difficulty_level_id,
    page,
    _video,
    _article,
    _pdf,
    _image,
    _audio,
    tagBtn,
    searchQuery,
    content_formate_sort,
  };

  // console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}courses/filter1`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      // console.log("RECEIVED " + JSON.stringify(data));

      const { contents, course_pages, content_active_page } = data;
      var images_path;

      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/public/uploads/content/profile_images/";
      }
courseimg_path="/images/";

      const div_class =
        cat_id && cat_id != ""
          ? "col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck"
          : "col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck";

      $("#content_result1").html("");
      $("#content_list_view1").html("");

      if (contents.length) {
        for (i = 0; i < contents.length; i++) {
          let bookmarkBtn = auth_id ? `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(contents[i].id.toString()) ? "checked" : ""} onclick="bookmark(this)" value=${JSON.stringify([contents[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${contents[i].id}"><label class="custom-control-label" for="bookmark-${contents[i].id}"></label></div>` : "";
          if(contents[i].scope_type=='course'){course_count_New=`
          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${`${base_url}` + courseimg_path + 'bookicon.png'}" width="25" class="mr-1"> Courses ( ${contents[i].coursecount} items ) 
            </h6>
          </div>`;}else{course_count_New= "" ;
}
         if(contents[i].image_url!='placeholder.png'){
            if(contents[i].content_group==null){
                  if(contents[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-1.png'}"> `;}
                  if(contents[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-2.png'}"> `;}
                  if(contents[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-3.png'}"> `;}
                  if(contents[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-4.png'}"> `;}
                  if(contents[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-5.png'}"> `;}
                  if(contents[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(contents[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${`${base_url}` +images_path + 'icon-7.png'}"> `;}
                if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-8.png'}"> `;}
                if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-9.png'}"> `;}
                if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-10.png'}"> `;}
                if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-11.png'}"> `;}
                if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(contents[i].content_group==null){
                if(contents[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType==null && contents[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(contents[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         }      
          $("#content_list_view1").append(`
                <div class="media mt-4 font-size14px">
                    <div class="media-body font-familyAtlasGrotesk-Medium">
                        <a href="${base_url}content/section/${contents[i].id}">
                            <h6 class="mt-0 text-colorblue100 mb-0">${contents[i].title}</h6>
                        </a>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                            <div class="row justify-content-between">
                                <p class="text-colorblue200"><a href="${base_url}search/all?query=${contents[i].authors}">${contents[i].authors}</a> <br> <a href="${base_url}search/all?query=${contents[i].affiliation}">${contents[i].affiliation}</a> </p>
                            </div>
                        </div>
                        <p class="text-colorblue100 font-size10px"><span class="mr-2">${contents[i].difficulty_level}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">${contents[i].categories}</span></p>
                    </div>
                </div>
            `);

          $("#content_result1").append(`
                        <div class="${div_class}">
                            <div class="card col-12 p-0 border-radius0all">
                            <a href="${base_url}content/section/${
            contents[i].id
          }">
                              ${new_image}
                            </a>
                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${
                                      contents[i].views_count
                                    }</small>
                                </div>
                                <div class="card-body">

                                    <a href="${base_url}content/section/${
            contents[i].id
          }">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${
                                          contents[i].title
                                        }</h6>
                                    </a>
                                 <a href="${base_url}search/all?query=${contents[i].authors}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                      contents[i].authors
                                    }</small></p>
                                 </a>
                                 <a href="${base_url}search/all?query=${contents[i].affiliation}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                        contents[i].affiliation
                                      }</small></p>
                                 </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                  <div class="m-0 text-colorblue200 bookmark float-left">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                     <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(contents[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                      </label>
                                     </div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(contents[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(contents[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(contents[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                      </label></div>  
                                  </div>
                                  <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                        ${bookmarkBtn}
                                    </div>
                                </div>
                                  ${course_count_New}
                            </div>
                        </div>
                    `);
        }
      }
      $("#content_pagination1").html("");
      if (course_pages > 1) {
        const pagination_list = [
          `<li class="page-item ${
            content_active_page == 1 ? " disabled" : ""
          }"><a class="page-link" onclick='change_content_page1(${
            content_active_page - 1
          })'>Previous</a></li>`,
        ];

        $("#content_pagination1").append(``);

        for (let i = 0; i < course_pages; i++) {
          pagination_list.push(
            `<li class="page-item ${
              content_active_page == i + 1 ? " active disabled" : ""
            }"><a class="page-link" onclick="change_content_page1(${i + 1})">${
              i + 1
            }</a></li>`
          );
        }

        $("#content_pagination1").append(
          pagination_list.join(" ") +
            `<li class="page-item ${
              content_active_page == course_pages ? " disabled" : ""
            }"><a class="page-link" onclick='change_content_page1(${
              content_active_page + 1
            })'>Next</a></li>`
        );
      }
  
    },

    error: function (err) {
      console.log(err);
    },
  });
}

function coursesPgFilter2(page = 1) {
  const sort = $("#course_sort2").val();
  const cat_id = $("#cat_id").val();
  const difficulty_level_id = $("#difficulty_level2").val();
  const content_formate_sort = $("#content_formate_sort2").val();

  const filter_data = {
    sort,
    cat_id,
    difficulty_level_id,
    page,
    _video,
    _article,
    _pdf,
    _image,
    _audio,
    tagBtn,
    searchQuery,
    content_formate_sort,
  };

  // console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}courses/filter2`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      // console.log("RECEIVED " + JSON.stringify(data));

      const { contents, Syllabus_pages, content_active_page } = data;
      var images_path;

      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/public/uploads/content/profile_images/";
      }
courseimg_path="/images/";

      const div_class =
        cat_id && cat_id != ""
          ? "col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck"
          : "col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck";

      $("#content_result2").html("");
      $("#content_list_view2").html("");

      if (contents.length) {
        for (i = 0; i < contents.length; i++) {
          let bookmarkBtn = auth_id ? `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(contents[i].id.toString()) ? "checked" : ""} onclick="bookmark(this)" value=${JSON.stringify([contents[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${contents[i].id}"><label class="custom-control-label" for="bookmark-${contents[i].id}"></label></div>` : "";
          if(contents[i].scope_type=='course'){course_count_New=`
          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${`${base_url}` + courseimg_path + 'bookicon.png'}" width="25" class="mr-1"> Courses ( ${contents[i].coursecount} items ) 
            </h6>
          </div>`;}else{course_count_New= "" ;
}
         if(contents[i].image_url!='placeholder.png'){
            if(contents[i].content_group==null){
                  if(contents[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-1.png'}"> `;}
                  if(contents[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-2.png'}"> `;}
                  if(contents[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-3.png'}"> `;}
                  if(contents[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-4.png'}"> `;}
                  if(contents[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-5.png'}"> `;}
                  if(contents[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(contents[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${`${base_url}` +images_path + 'icon-7.png'}"> `;}
                if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-8.png'}"> `;}
                if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-9.png'}"> `;}
                if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-10.png'}"> `;}
                if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-11.png'}"> `;}
                if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(contents[i].content_group==null){
                if(contents[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType==null && contents[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(contents[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         }           
          $("#content_list_view2").append(`
                <div class="media mt-4 font-size14px">
                    <div class="media-body font-familyAtlasGrotesk-Medium">
                        <a href="${base_url}content/section/${contents[i].id}">
                            <h6 class="mt-0 text-colorblue100 mb-0">${contents[i].title}</h6>
                        </a>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                            <div class="row justify-content-between">
                                <p class="text-colorblue200"><a href="${base_url}search/all?query=${contents[i].authors}">${contents[i].authors}</a> <br> <a href="${base_url}search/all?query=${contents[i].affiliation}">${contents[i].affiliation}</a> </p>
                            </div>
                        </div>
                        <p class="text-colorblue100 font-size10px"><span class="mr-2">${contents[i].difficulty_level}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">${contents[i].categories}</span></p>
                    </div>
                </div>
            `);

          $("#content_result2").append(`
                        <div class="${div_class}">
                            <div class="card col-12 p-0 border-radius0all">
                            <a href="${base_url}content/section/${
            contents[i].id
          }">
                              ${new_image}
                            </a>
                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${
                                      contents[i].views_count
                                    }</small>
                                </div>
                                <div class="card-body">

                                    <a href="${base_url}content/section/${
            contents[i].id
          }">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${
                                          contents[i].title
                                        }</h6>
                                    </a>
                                   <a href="${base_url}search/all?query=${contents[i].authors}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                      contents[i].authors
                                    }</small></p>
                                   </a>
                                   <a href="${base_url}search/all?query=${contents[i].authors}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                        contents[i].affiliation
                                      }</small></p>
                                   </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                  <div class="m-0 text-colorblue200 bookmark float-left">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                     <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(contents[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                      </label>
                                     </div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(contents[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(contents[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(contents[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                      </label></div>  
                                  </div>
                                  <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                        ${bookmarkBtn}
                                    </div>
                                </div>
                                  ${course_count_New}
                            </div>
                        </div>
                    `);
        }
      }
      $("#content_pagination2").html("");
      if (Syllabus_pages > 1) {
        const pagination_list = [
          `<li class="page-item ${
            content_active_page == 1 ? " disabled" : ""
          }"><a class="page-link" onclick='change_content_page2(${
            content_active_page - 1
          })'>Previous</a></li>`,
        ];

        $("#content_pagination2").append(``);

        for (let i = 0; i < Syllabus_pages; i++) {
          pagination_list.push(
            `<li class="page-item ${
              content_active_page == i + 1 ? " active disabled" : ""
            }"><a class="page-link" onclick="change_content_page2(${i + 1})">${
              i + 1
            }</a></li>`
          );
        }

        $("#content_pagination2").append(
          pagination_list.join(" ") +
            `<li class="page-item ${
              content_active_page == Syllabus_pages ? " disabled" : ""
            }"><a class="page-link" onclick='change_content_page2(${
              content_active_page + 1
            })'>Next</a></li>`
        );
      }
  
    },

    error: function (err) {
      console.log(err);
    },
  });
}

function coursesPgFilter3(page = 1) {
  const sort = $("#course_sort3").val();
  const cat_id = $("#cat_id").val();
  const difficulty_level_id = $("#difficulty_level3").val();
  const content_formate_sort = $("#content_formate_sort3").val();

  const filter_data = {
    sort,
    cat_id,
    difficulty_level_id,
    page,
    _video,
    _article,
    _pdf,
    _image,
    _audio,
    tagBtn,
    searchQuery,
    content_formate_sort,
  };

  // console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}courses/filter3`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      // console.log("RECEIVED " + JSON.stringify(data));

      const { contents, Exercise_pages, content_active_page } = data;
      var images_path;

      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/public/uploads/content/profile_images/";
      }
courseimg_path="/images/";

      const div_class =
        cat_id && cat_id != ""
          ? "col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck"
          : "col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck";

      $("#content_result3").html("");
      $("#content_list_view3").html("");

      if (contents.length) {
        for (i = 0; i < contents.length; i++) {
          let bookmarkBtn = auth_id ? `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(contents[i].id.toString()) ? "checked" : ""} onclick="bookmark(this)" value=${JSON.stringify([contents[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${contents[i].id}"><label class="custom-control-label" for="bookmark-${contents[i].id}"></label></div>` : "";
          if(contents[i].scope_type=='course'){course_count_New=`
          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${`${base_url}` + courseimg_path + 'bookicon.png'}" width="25" class="mr-1"> Courses ( ${contents[i].coursecount} items ) 
            </h6>
          </div>`;}else{course_count_New= "" ;
}
         if(contents[i].image_url!='placeholder.png'){
            if(contents[i].content_group==null){
                  if(contents[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-1.png'}"> `;}
                  if(contents[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-2.png'}"> `;}
                  if(contents[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-3.png'}"> `;}
                  if(contents[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-4.png'}"> `;}
                  if(contents[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-5.png'}"> `;}
                  if(contents[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(contents[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${`${base_url}` +images_path + 'icon-7.png'}"> `;}
                if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-8.png'}"> `;}
                if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-9.png'}"> `;}
                if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-10.png'}"> `;}
                if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-11.png'}"> `;}
                if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(contents[i].content_group==null){
                if(contents[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType==null && contents[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(contents[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         }        
          $("#content_list_view3").append(`
                <div class="media mt-4 font-size14px">
                    <div class="media-body font-familyAtlasGrotesk-Medium">
                        <a href="${base_url}content/section/${contents[i].id}">
                            <h6 class="mt-0 text-colorblue100 mb-0">${contents[i].title}</h6>
                        </a>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                            <div class="row justify-content-between">
                                <p class="text-colorblue200"><a href="${base_url}search/all?query=${contents[i].authors}">${contents[i].authors}</a> <br> <a href="${base_url}search/all?query=${contents[i].affiliation}">${contents[i].affiliation}</a> </p>
                            </div>
                        </div>
                        <p class="text-colorblue100 font-size10px"><span class="mr-2">${contents[i].difficulty_level}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">${contents[i].categories}</span></p>
                    </div>
                </div>
            `);

          $("#content_result3").append(`
                        <div class="${div_class}">
                            <div class="card col-12 p-0 border-radius0all">
                            <a href="${base_url}content/section/${
            contents[i].id
          }">
                              ${new_image}
                            </a>
                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${
                                      contents[i].views_count
                                    }</small>
                                </div>
                                <div class="card-body">

                                    <a href="${base_url}content/section/${
            contents[i].id
          }">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${
                                          contents[i].title
                                        }</h6>
                                    </a>
                                   <a href="${base_url}search/all?query=${contents[i].authors}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                      contents[i].authors
                                    }</small></p>
                                   </a>
                                   <a href="${base_url}search/all?query=${contents[i].affiliation}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                        contents[i].affiliation
                                      }</small></p>
                                   </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                  <div class="m-0 text-colorblue200 bookmark float-left">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                     <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(contents[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                      </label>
                                     </div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(contents[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(contents[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(contents[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                      </label></div>  
                                  </div>
                                  <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                        ${bookmarkBtn}
                                    </div>
                                </div>
                                  ${course_count_New}
                            </div>
                        </div>
                    `);
        }
      }
      $("#content_pagination3").html("");
      if (Exercise_pages > 1) {
        const pagination_list = [
          `<li class="page-item ${
            content_active_page == 1 ? " disabled" : ""
          }"><a class="page-link" onclick='change_content_page3(${
            content_active_page - 1
          })'>Previous</a></li>`,
        ];

        $("#content_pagination3").append(``);

        for (let i = 0; i < Exercise_pages; i++) {
          pagination_list.push(
            `<li class="page-item ${
              content_active_page == i + 1 ? " active disabled" : ""
            }"><a class="page-link" onclick="change_content_page3(${i + 1})">${
              i + 1
            }</a></li>`
          );
        }

        $("#content_pagination3").append(
          pagination_list.join(" ") +
            `<li class="page-item ${
              content_active_page == Exercise_pages ? " disabled" : ""
            }"><a class="page-link" onclick='change_content_page3(${
              content_active_page + 1
            })'>Next</a></li>`
        );
      }
  
    },

    error: function (err) {
      console.log(err);
    },
  });
}

function coursesPgFilter4(page = 1) {
  const sort = $("#course_sort4").val();
  const cat_id = $("#cat_id").val();
  const difficulty_level_id = $("#difficulty_level4").val();
  const content_formate_sort = $("#content_formate_sort4").val();

  const filter_data = {
    sort,
    cat_id,
    difficulty_level_id,
    page,
    _video,
    _article,
    _pdf,
    _image,
    _audio,
    tagBtn,
    searchQuery,
    content_formate_sort,
  };

  // console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}courses/filter4`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      // console.log("RECEIVED " + JSON.stringify(data));

      const { contents, Data_pages, content_active_page } = data;
      var images_path;

      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/public/uploads/content/profile_images/";
      }
courseimg_path="/images/";
      const div_class =
        cat_id && cat_id != ""
          ? "col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck"
          : "col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck";

      $("#content_result4").html("");
      $("#content_list_view4").html("");

      if (contents.length) {
        for (i = 0; i < contents.length; i++) {
          let bookmarkBtn = auth_id ? `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(contents[i].id.toString()) ? "checked" : ""} onclick="bookmark(this)" value=${JSON.stringify([contents[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${contents[i].id}"><label class="custom-control-label" for="bookmark-${contents[i].id}"></label></div>` : "";
          if(contents[i].scope_type=='course'){course_count_New=`
          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${`${base_url}` + courseimg_path + 'bookicon.png'}" width="25" class="mr-1"> Courses ( ${contents[i].coursecount} items ) 
            </h6>
          </div>`;}else{course_count_New= "" ;
}
         if(contents[i].image_url!='placeholder.png'){
            if(contents[i].content_group==null){
                  if(contents[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-1.png'}"> `;}
                  if(contents[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-2.png'}"> `;}
                  if(contents[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-3.png'}"> `;}
                  if(contents[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-4.png'}"> `;}
                  if(contents[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-5.png'}"> `;}
                  if(contents[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(contents[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${`${base_url}` +images_path + 'icon-7.png'}"> `;}
                if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-8.png'}"> `;}
                if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-9.png'}"> `;}
                if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-10.png'}"> `;}
                if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-11.png'}"> `;}
                if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(contents[i].content_group==null){
                if(contents[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType==null && contents[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(contents[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         }          
          $("#content_list_view4").append(`
                <div class="media mt-4 font-size14px">
                    <div class="media-body font-familyAtlasGrotesk-Medium">
                        <a href="${base_url}content/section/${contents[i].id}">
                            <h6 class="mt-0 text-colorblue100 mb-0">${contents[i].title}</h6>
                        </a>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                            <div class="row justify-content-between">
                                <p class="text-colorblue200"><a href="${base_url}search/all?query=${contents[i].authors}">${contents[i].authors}</a> <br><a href="${base_url}search/all?query=${contents[i].affiliation}"> ${contents[i].affiliation}</a> </p>
                            </div>
                        </div>
                        <p class="text-colorblue100 font-size10px"><span class="mr-2">${contents[i].difficulty_level}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">${contents[i].categories}</span></p>
                    </div>
                </div>
            `);

          $("#content_result4").append(`
                        <div class="${div_class}">
                            <div class="card col-12 p-0 border-radius0all">
                            <a href="${base_url}content/section/${
            contents[i].id
          }">
                              ${new_image}
                            </a>
                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${
                                      contents[i].views_count
                                    }</small>
                                </div>
                                <div class="card-body">

                                    <a href="${base_url}content/section/${
            contents[i].id
          }">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${
                                          contents[i].title
                                        }</h6>
                                    </a>
                                  <a href="${base_url}search/all?query=${contents[i].authors}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                      contents[i].authors
                                    }</small></p>
                                  </a>
                                  <a href="${base_url}search/all?query=${contents[i].affiliation}">
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                        contents[i].affiliation
                                      }</small></p>
                                  </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                  <div class="m-0 text-colorblue200 bookmark float-left">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                     <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(contents[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                      </label>
                                     </div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(contents[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(contents[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(contents[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                      </label></div>  
                                  </div>
                                  <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                        ${bookmarkBtn}
                                    </div>
                                </div>
                                  ${course_count_New}
                            </div>
                        </div>
                    `);
        }
      }
      $("#content_pagination4").html("");
      if (Data_pages > 1) {
        const pagination_list = [
          `<li class="page-item ${
            content_active_page == 1 ? " disabled" : ""
          }"><a class="page-link" onclick='change_content_page4(${
            content_active_page - 1
          })'>Previous</a></li>`,
        ];

        $("#content_pagination4").append(``);

        for (let i = 0; i < Data_pages; i++) {
          pagination_list.push(
            `<li class="page-item ${
              content_active_page == i + 1 ? " active disabled" : ""
            }"><a class="page-link" onclick="change_content_page4(${i + 1})">${
              i + 1
            }</a></li>`
          );
        }

        $("#content_pagination4").append(
          pagination_list.join(" ") +
            `<li class="page-item ${
              content_active_page == Data_pages ? " disabled" : ""
            }"><a class="page-link" onclick='change_content_page4(${
              content_active_page + 1
            })'>Next</a></li>`
        );
      }
  
    },

    error: function (err) {
      console.log(err);
    },
  });
}

function coursesPgFilter5(page = 1) {
  const sort = $("#course_sort5").val();
  const cat_id = $("#cat_id").val();
  const difficulty_level_id = $("#difficulty_level5").val();
  const content_formate_sort = $("#content_formate_sort5").val();

  const filter_data = {
    sort,
    cat_id,
    difficulty_level_id,
    page,
    _video,
    _article,
    _pdf,
    _image,
    _audio,
    tagBtn,
    searchQuery,
    content_formate_sort,
  };

  // console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}courses/filter5`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      // console.log("RECEIVED " + JSON.stringify(data));

      const { contents, Website_pages, content_active_page } = data;
      var images_path;

      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/public/uploads/content/profile_images/";
      }
courseimg_path="/images/";
      const div_class =
        cat_id && cat_id != ""
          ? "col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck"
          : "col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck";

      $("#content_result5").html("");
      $("#content_list_view5").html("");

      if (contents.length) {
        for (i = 0; i < contents.length; i++) {
          let bookmarkBtn = auth_id ? `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(contents[i].id.toString()) ? "checked" : ""} onclick="bookmark(this)" value=${JSON.stringify([contents[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${contents[i].id}"><label class="custom-control-label" for="bookmark-${contents[i].id}"></label></div>` : "";
          if(contents[i].scope_type=='course'){course_count_New=`
          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${`${base_url}` + courseimg_path + 'bookicon.png'}" width="25" class="mr-1"> Courses ( ${contents[i].coursecount} items ) 
            </h6>
          </div>`;}else{course_count_New= "" ;
}
         if(contents[i].image_url!='placeholder.png'){
            if(contents[i].content_group==null){
                  if(contents[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-1.png'}"> `;}
                  if(contents[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-2.png'}"> `;}
                  if(contents[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-3.png'}"> `;}
                  if(contents[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-4.png'}"> `;}
                  if(contents[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-5.png'}"> `;}
                  if(contents[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${`${base_url}` +images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(contents[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${`${base_url}` +images_path + 'icon-7.png'}"> `;}
                if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-8.png'}"> `;}
                if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-9.png'}"> `;}
                if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-10.png'}"> `;}
                if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-11.png'}"> `;}
                if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + contents[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${`${base_url}` +images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(contents[i].content_group==null){
                if(contents[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(contents[i].formatType==null && contents[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(contents[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(contents[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${`${base_url}` +images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         }         
          $("#content_list_view5").append(`
                <div class="media mt-4 font-size14px">
                    <div class="media-body font-familyAtlasGrotesk-Medium">
                        <a href="${base_url}content/section/${contents[i].id}">
                            <h6 class="mt-0 text-colorblue100 mb-0">${contents[i].title}</h6>
                        </a>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                            <div class="row justify-content-between">
                                <p class="text-colorblue200">${contents[i].authors} <br> ${contents[i].affiliation} </p>
                            </div>
                        </div>
                        <p class="text-colorblue100 font-size10px"><span class="mr-2">${contents[i].difficulty_level}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">${contents[i].categories}</span></p>
                    </div>
                </div>
            `);

          $("#content_result5").append(`
                        <div class="${div_class}">
                            <div class="card col-12 p-0 border-radius0all">
                            <a href="${base_url}content/section/${
            contents[i].id
          }">
                              ${new_image}
                            </a>
                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${
                                      contents[i].views_count
                                    }</small>
                                </div>
                                <div class="card-body">

                                    <a href="${base_url}content/section/${
            contents[i].id
          }">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${
                                          contents[i].title
                                        }</h6>
                                    </a>
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                      contents[i].authors
                                    }</small></p>
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${
                                        contents[i].affiliation
                                      }</small></p>
                                </div>
                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                  <div class="m-0 text-colorblue200 bookmark float-left">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                     <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(contents[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                      </label>
                                     </div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(contents[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                      <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(contents[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                      </label></div>
                                   <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                     <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(contents[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                      </label></div>  
                                  </div>
                                  <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                        ${bookmarkBtn}
                                    </div>
                                </div>
                                  ${course_count_New}
                            </div>
                        </div>
                    `);
        }
      }
      $("#content_pagination5").html("");
      if (Website_pages > 1) {
        const pagination_list = [
          `<li class="page-item ${
            content_active_page == 1 ? " disabled" : ""
          }"><a class="page-link" onclick='change_content_page5(${
            content_active_page - 1
          })'>Previous</a></li>`,
        ];

        $("#content_pagination5").append(``);

        for (let i = 0; i < Website_pages; i++) {
          pagination_list.push(
            `<li class="page-item ${
              content_active_page == i + 1 ? " active disabled" : ""
            }"><a class="page-link" onclick="change_content_page5(${i + 1})">${
              i + 1
            }</a></li>`
          );
        }

        $("#content_pagination5").append(
          pagination_list.join(" ") +
            `<li class="page-item ${
              content_active_page == Website_pages ? " disabled" : ""
            }"><a class="page-link" onclick='change_content_page5(${
              content_active_page + 1
            })'>Next</a></li>`
        );
      }
  
    },

    error: function (err) {
      console.log(err);
    },
  });
}


function coursesTagButton(ref) {

  let checkPage = window.location.pathname.split('/').length;

  if (checkPage == 5) {
    let categories = $("#content_categories_ids").val();
    let firstCategory = categories.split(",")[1];

    // let referrer =  document.referrer;
    // let category = referrer.split('/')[referrer.split('/').length - 1];

    localStorage.setItem("tagBtn", ref.innerHTML)
    window.location.href = `${base_url}courses/${firstCategory}`;

  } else {
    $(".relatedTag button").removeClass("active");
    ref.classList.add("active");

    tagBtn = ref.innerHTML;

    coursesPgFilter();
  }
}

$("#search_val_form").submit(function (e) {
  e.preventDefault();
  console.log("object");
  let val = $("#search_val").val();

  if (val.length > 3) {
    searchQuery = val;
  } else {
    searchQuery = "";
  }

  coursesPgFilter();
});

function bookmark(ref) {
  const values = JSON.parse(ref.value);

  const formData = {
    content_id: values[0],
    user_id: values[1],
    bookmark: ref.checked,
  };

  $.ajax({
    type: "POST",
    url: `${base_url}courses/bookmarked`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(formData),
    success: function (data) {
      const { user_content_updated_list } = data;
      if (user_content_updated_list) {
        userContentList = user_content_updated_list.split(",");
      } else {
        userContentList = "";
      }
    },

    error: function (err) {
      console.log(err);
    },
  });
}

// =================================================================================================================================================================================================================================
// ============ STUDENT COURSE DETAILS PAGE
// =================================================================================================================================================================================================================================

function tracking_content(ref, content_id, section, step) {
  const view = ref.getAttribute("aria-expanded");

  if (view == "false") {
    const formData = { content_id, section, step };

    $.ajax({
      type: "POST",
      url: `${base_url}content/tracking`,
      dataType: "json",
      contentType: "application/json",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      data: JSON.stringify(formData),
      success: function (data) {
        // console.log(data);
      },

      error: function (err) {
        console.log(err);
      },
    });
  }
}

// =================================================================================================================================================================================================================================
// ============ CONTENT PAGE
// =================================================================================================================================================================================================================================

$("#selectpickerCategories").select2();
selectpickerTagsInitialized();

$("#selectpickerCategories").on("change", function (e) {
  let categories = $("#selectpickerCategories").select2("val");

  if (categories) {
    $.ajax({
      type: "GET",
      url: `${base_url}tags/${categories.join(",")}`,
      success: function (data) {
        $("#selectpickerTags").html("");
        const { cat_id, tags } = data;
        if (tags.length) {
          $("#selectpickerTags").select2("destroy").select2();

          for (let i = 0; i < tags.length; i++) {
            $("#selectpickerTags").append(`<option>${tags[i].name}</option>`);
          }

          selectpickerTagsInitialized();
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  } else {
    $("#selectpickerTags").html("");
    $("#selectpickerTags").select2("destroy").select2();
    selectpickerTagsInitialized();
  }
});

function selectpickerTagsInitialized() {
  $("#selectpickerTags").select2({
    maximumSelectionLength: 3,
    placeholder: "Select tags",
    allowClear: true,
  });
}

// $("#add_content_form").submit(function (e) {
//   e.preventDefault();

//   let content_title = $("#content_title").val();
//   let content_discription = $("#content_discription").val();
//   let affiliation = $("#affiliation").val();
//   let difficulty_level = $("#difficulty_level").val();
//   let content_image = $("#content_image").prop("files")[0];
//   // let duration = $("#duration").val();
//   let tags = $("#selectpickerTags").select2("val");
//   let categories = $("#selectpickerCategories").select2("val");

//   $("#content_title_err").html("");
//   $("#content_discription_err").html("");
//   $("#content_affiliation_err").html("");
//   $("#content_difficulty_level_err").html("");
//   $("#content_avatar_err").html("");
//   //$("#content_duration_err").html("");
//   $("#content_categories_err").html("");
//   $("#content_tags_err").html("");
//   $("#final_content_msg").html("");
//   if (
//     content_title == "" ||
//     content_discription == "" ||
//     affiliation == "" ||
//     !difficulty_level ||
//     // !content_image ||
//     !categories ||
//     !tags
//   ) {
//     if (content_title == "") {
//       $("#content_title_err").html("Content title required!");
//     }

//     if (content_discription == "") {
//       $("#content_discription_err").html("Content description required!");
//     }

//     if (affiliation == "") {
//       $("#content_affiliation_err").html("Content affiliation required!");
//     }

//     if (!difficulty_level) {
//       $("#content_difficulty_level_err").html(
//         "Content difficulty level required!"
//       );
//     }

//     // if (!content_image) {
//     //   $("#content_avatar_err").html("Content avatar required!");
//     // }

//     // if (duration == "") {
//     //     $("#content_duration_err").html("Content duration required!");
//     // }

//     if (!categories) {
//       $("#content_categories_err").html("Content categories required!");
//     }

//     if (!tags) {
//       $("#content_tags_err").html("Content tags required!");
//     }
//     return;
//   }

//   var formData = new FormData(this);

//   formData.append("tags", JSON.stringify(tags));
//   formData.append("categories", categories);

//   $.ajax({
//     type: "POST",
//     url: $(this).attr("action"),
//     data: formData,
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function (data) {
//       if (data.success) {
//         $("#final_content_msg").html(
//           `<span style='color: green;'>${data.message}</span>`
//         );

//         setTimeout(() => {
//           window.location.href = `${base_url}create/content/${data.content_id}`;
//         }, 500);
//       } else {
//         $("#final_content_msg").html(
//           `<span style='color: red;'>${data.message}</span>`
//         );
//       }
//       console.log(data);
//     },

//     error: function (err) {
//       $("#final_content_msg").html(`<span style='color: red;'>${err}</span>`);
//       console.log(err);
//     },
//   });
// });


$("#add_content_form").submit(function (e) {
    e.preventDefault();

    tinyMCE.triggerSave();

    let content_title = $("#content_title").val();
    let content_discription = $("#content_discription").val();
    let affiliation = $("#institution_or_source").val();
    let difficulty_level = $("#difficulty_level").val();
    let author = $("#Author").val();
    let content_image = $("#content_image").prop("files")[0];
    // let duration = $("#duration").val();
    let tags = $("#selectpickerTags").select2("val");
    let categories = $("#selectpickerCategories").select2("val");
    // let restriction = $("#Restriction").val();

    $("#content_title_err3").html("");
    $("#content_discription_err3").html("");
    $("#content_affiliation_err3").html("");
    $("#content_difficulty_level_err3").html("");
    $("#content_avatar_err").html("");
    //$("#content_duration_err").html("");
    $("#content_categories_err").html("");
    $("#restriction_err").html("");
    $("#content_tags_err").html("");
    $("#final_content_msg").html("");
    if (
      content_title == "" ||
      content_discription == "" ||
      affiliation == "" ||
      !difficulty_level ||
      author == "" ||
      // !content_image ||
      !categories ||
      // !restriction ||
      !tags
    ) {
      if (content_title == "") {
        $("#content_title_err3").html("Course title required!");
      }

      if (content_discription == "") {
        $("#content_discription_err3").html("Course description required!");
      }

      if (affiliation == "") {
        $("#content_affiliation_err3").html("Course affiliation required!");
      }

      if (!difficulty_level) {
        $("#content_difficulty_level_err3").html(
          "Course difficulty level required!"
        );
      }
      if (author == "") {
        $("#author3").html("Course Author required!");
      }

      // if (!content_image) {
      //   $("#content_avatar_err").html("Content avatar required!");
      // }

      // if (duration == "") {
      //     $("#content_duration_err").html("Content duration required!");
      // }

      if (!categories) {
        $("#content_categories_err").html("Course categories required!");
      }
      // if (!restriction) {
      //   $("#restriction_err").html("Course categories required!");
      // }

      if (!tags) {
        $("#content_tags_err").html("Course tags required!");
      }
      return;
    }

    var formData = new FormData(this);

    formData.append("tags", JSON.stringify(tags));
    formData.append("categories", categories);

    $.ajax({
      type: "POST",
      url: $(this).attr("action"),
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.success) {
          $("#final_content_msg").html(
            `<span style='color: green;'>${data.message}</span>`
          );

          setTimeout(() => {
            // window.location.replace("/home");
             window.location.href = `${base_url}coursecontent/view/${data.content_id}`;
          }, 500);
        } else {
          $("#final_content_msg").html(
            `<span style='color: red;'>${data.message}</span>`
          );
        }
        console.log(data);
      },

      error: function (err) {
        $("#final_content_msg").html(`<span style='color: red;'>${err}</span>`);
        console.log(err);
      },
    });
  });

$("#add-section").click(function () {
  let content_id = $("#content_id").val();

  const filter_data = {
    content_id,
  };

  add_content_details_form_submitting();

  $.ajax({
    type: "POST",
    url: `${base_url}content/addsection`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
    success: function (data) {
      add_content_details_form_submitted();

      if (data.success) {
        $("#message").html(
          `<small style="color: green;">${data.message}</small>`
        );

        setTimeout(() => {
          location.reload();
        }, 1000);
      } else {
        $("#message").html(
          `<small style="color: red;">${data.message}</small>`
        );
      }
    },

    error: function (err) {
      add_content_details_form_submitted();

      console.log(err);
    },
  });
});

$("#content_step_form").submit(function (e) {
  e.preventDefault();
  var formData = new FormData(this);

  $("#message_content").html("");

  if (!$("#type").val() || $("#type").val() == "") {
    $("#message_content").html(
      `<small style="color: red;">Please select type</small>`
    );
    return;
  }

  add_content_details_form_submitting();

  $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      add_content_details_form_submitted();

      if (data.success) {
        $("#message_content").html(
          `<small style="color: green;">${data.message}</small>`
        );
        location.reload();
      } else {
        $("#message_content").html(
          `<small style="color: red;">${data.message}</small>`
        );
      }
    },
    error: function (err) {
      add_content_details_form_submitted();
      $("#message_content").html(
        `<small style="color: red;">${
          JSON.parse(err.responseText).message
        }</small>`
      );
    },
  });
});

$("#type").on("change", function (e) {
  let type = e.target.value;

  switch (type) {
    case "Video":
      $("#description_div").slideUp();
      // $("#duration").removeAttr("disabled");
      $("#embeded_url").removeAttr("disabled");
      $("#asset").removeAttr("disabled");
      break;
    case "Pdf":
      $("#description_div").slideUp();
      //  $("#duration").attr("disabled", "disabled");
      $("#embeded_url").attr("disabled", "disabled");

      $("#asset").removeAttr("disabled");
      break;
    case "Article":
      $("#asset").attr("disabled", "disabled");
      // $("#duration").attr("disabled", "disabled");
      $("#embeded_url").attr("disabled", "disabled");

      $("#description_div").slideDown();
      break;
    case "Image":
      $("#description_div").slideUp();
      //  $("#duration").attr("disabled", "disabled");
      $("#embeded_url").attr("disabled", "disabled");

      $("#asset").removeAttr("disabled");
      break;
    case "Audio":
      $("#description_div").slideUp();
      $("#embeded_url").attr("disabled", "disabled");
      // $("#duration").removeAttr("disabled");

      $("#asset").removeAttr("disabled");
      break;
  }
});

$("#embeded_url").on("input", function (e) {
  if (e.target.value.length) {
    $("#asset").attr("disabled", "disabled");
  } else {
    $("#asset").removeAttr("disabled");
  }
});

$("#asset").change(function () {
  $("#embeded_url").attr("disabled", "disabled");

  var filename = $("#asset").val();
  if (filename.substring(3, 11) == "fakepath") {
    filename = filename.substring(12);
    console.log(filename);
  }
});

function add_content_details_form_submitting() {
  $(".form-container *").attr("disabled", "disabled").off("click");
  $(".form-container").css("filter", "blur(3px)");
  $(".lds-dual-ring").show();
}

function add_content_details_form_submitted() {
  $(".form-container *").removeAttr("disabled").on("click");
  $(".form-container").css("filter", "none");
  $(".lds-dual-ring").hide();
  $("#type").select2();
}

$("#search-everything-form").submit(function (e) {
  e.preventDefault();
  let url = $(this).attr("action");
  let query = $("#search-everything-query").val();
  location.href = url + "?query=" + query;
});

// =================================================================================================================================================================================================================================
// ============ CONTENT PAGE WITH SINGLE STEP
// =================================================================================================================================================================================================================================
$("#selectpickerCategories2").select2();
selectpickerTagsInitialized2();

$("#selectpickerCategories2").on("change", function (e) {
  let categories = $("#selectpickerCategories2").select2("val");

  if (categories) {
    $.ajax({
      type: "GET",
      url: `${base_url}tags/${categories.join(",")}`,
      success: function (data) {
        $("#selectpickerTags2").html("");
        const { cat_id, tags } = data;
        if (tags.length) {
          $("#selectpickerTags2").select2("destroy").select2();

          for (let i = 0; i < tags.length; i++) {
            $("#selectpickerTags2").append(`<option>${tags[i].name}</option>`);
          }

          selectpickerTagsInitialized2();
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  } else {
    $("#selectpickerTags2").html("");
    $("#selectpickerTags2").select2("destroy").select2();
    selectpickerTagsInitialized2();
  }
});

function selectpickerTagsInitialized2() {
  $("#selectpickerTags2").select2({
    maximumSelectionLength: 3,
    placeholder: "Select tags",
    allowClear: true,
  });
}

$("#add_content_form_with_detail").submit(function (e) {
  e.preventDefault();
    tinyMCE.triggerSave();
  var content_title = $("#content_title2").val();
  var content_discription = $("#content_discription2").val();
  var affiliation = $("#affiliation2").val();
  var author = $("#author").val();
  var difficulty_level = $("#difficulty_level2").val();
  var tags = $("#selectpickerTags2").select2("val");
  var categories = $("#selectpickerCategories2").select2("val");


  content_title = content_title.trim();
  author = author.trim();
  content_discription = content_discription.trim();
  affiliation = affiliation.trim();


  $("#content_title2_err").html("");
  $("#content_discription2_err").html("");
  $("#content_affiliation2_err").html("");
  $("#content_difficulty_level2_err").html("");
  $("#content_avatar2_err").html("");
  $("#content_categories2_err").html("");
  $("#content_tags2_err").html("");
  $("#final_content2_msg").html("");
  $("#author").html("");

  if (
    content_title == "" ||
    content_discription == "" ||
    affiliation == "" ||
    author == "" ||
    !difficulty_level ||
    !categories ||
    !tags
  ) {
    if (content_title == "") {
      $("#content_title2_err").html("Content title required!");
    }

    if (content_discription == "") {
      $("#content_discription2_err").html("Content description required!");
    }

    if (affiliation == "") {
      $("#content_affiliation2_err").html("Content affiliation required!");
    }

    if (author == "") {
        $("#author_err").html("Author required!");
      }

    if (!difficulty_level) {
      $("#content_difficulty_level2_err").html(
        "Content difficulty level required!"
      );
    }

    if (!categories) {
      $("#content_categories2_err").html("Content categories required!");
    }

    if (!tags) {
      $("#content_tags2_err").html("Content tags required!");
    }
    return;
  }

  var formData = new FormData(this);

  formData.append("tags", JSON.stringify(tags));
  formData.append("categories", categories);

  add_content_form_with_detail_form_submitting();

  $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      add_content_form_with_detail_form_submitted();

      if (data.success) {
        $("#final_content2_msg").html(
          `<span style='color: green;'>${data.message}</span>`
        );

        setTimeout(() => {
          // window.location.replace("/home");
           window.location.href = `/inetEDPlatform/home`;
           //  window.location.href = `${base_url}create/content/${data.content_id}`;
        }, 500);
      } else {
        $("#final_content2_msg").html(
          `<span style='color: red;'>${data.message}</span>`
        );
      }
      console.log(data);
    },

    error: function (err) {
      add_content_form_with_detail_form_submitted();

      $("#final_content2_msg").html(`<span style='color: red;'>${err}</span>`);
      console.log(err);
    },
  });
});

function add_content_form_with_detail_form_submitting() {
  $(".form-container *").attr("disabled", "disabled").off("click");
  $(".form-container").css("filter", "blur(3px)");
  $(".lds-dual-ring").show();
}

function add_content_form_with_detail_form_submitted() {
  $(".form-container *").removeAttr("disabled").on("click");
  $(".form-container").css("filter", "none");
  $(".lds-dual-ring").hide();
  // $("#type").select2();
}

$("#course_sort_new").on("change", function () {
  coursesPgFilternew();
});

function coursesPgFilternew() {
  const sort = $("#course_sort_new").val();
  // const cat_id = $("#cat_id").val();
  // const difficulty_level_id = $("#difficulty_level").val();

  const filter_data = {
    sort
  };

  console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}coursesdashboard/filter`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
  
    success: function (data) {
      console.log("RECEIVED " + JSON.stringify(data));
      const {content} = data;
      var images_path;
      var str='course';
      var numcourse= 0;
      var statusnum=1;
      bk_icon_path="images/bookicon.png";
      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/inetEDPlatform/public/uploads/content/profile_images/";
      }
      $("#content_with_thumbnail_course").html("");
      $("#content_with_list_course").html("");
   
      if (content.length) {
        for (i = 0; i < content.length; i++) {
          let bookmarkBtn = auth_id ?
           `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
           onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${content[i].id}">
           <label class="custom-control-label bookmarkCheckBox" for="bookmark-${content[i].id}"></label></div>` 
           : "";
           let bookmarkBtnlist = auth_id;
           if(bookmarkBtnlist = auth_id){
               if(content[i].content_privacy == numcourse){
                 var append_privacy_list=  `<span class="font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"> </span>
                                         <div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
                                          onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark${content[i].id}">
                                         <label class="custom-control-label bookmarkCheckBox" for="bookmark${content[i].id}"></label></div>` 
               }else{
                var append_privacy_list=   `<span class="badge badge-secondary font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-2 pb-2"><i class="fas fa-graduation-cap font-size18px"></i> Restricted</span>
                                          <div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
                                            onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark${content[i].id}">
                                           <label class="custom-control-label bookmarkCheckBox" for="bookmark${content[i].id}"></label></div>` 

               }
           }
          if(content[i].content_privacy == numcourse && content[i].scope_type==str){
            var append_privacy= `
            <div class="col-sm-6 p-0">
             <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium"> Public </div>
            </div>
             `;
          }
          else{
            var append_privacy= `
            <div class="col-sm-6 p-0">
             <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Restricted</div>
            </div> 
             `;
            
            }
          if (content[i].status == numcourse){
          var awaitappro = `<span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>`;
          }else{
            var awaitappro = `<span></span>`;
          }

            if(content[i].image_url!='placeholder.png'){
            if(content[i].content_group==null){
                  if(content[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-1.png'}"> `;}
                  if(content[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-2.png'}"> `;}
                  if(content[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-3.png'}"> `;}
                  if(content[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-4.png'}"> `;}
                  if(content[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-5.png'}"> `;}
                  if(content[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(content[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                <img class="icon-img" src="${images_path + 'icon-7.png'}"> `;}
                if(content[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-8.png'}"> `;}
                if(content[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-9.png'}"> `;}
                if(content[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-10.png'}"> `;}
                if(content[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-11.png'}"> `;}
                if(content[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(content[i].content_group==null){
                if(content[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${images_path + 'Imageimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${images_path + 'Videoimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${images_path + 'Pdfimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${images_path + 'Articleimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${images_path + 'Audioimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${images_path + 'courseimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType==null && content[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${images_path + 'default3.png'}" alt="image" width="253" height="163">`;}
            }else{  
                  if(content[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${images_path + 'quizimg.jpg'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${images_path + 'featuredimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${images_path + 'syllabusimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${images_path + 'exercireimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${images_path + 'dataimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${images_path + 'websiteimg.png'}" alt="image" width="253" height="163">`;}
            }
         }   


      if(content[i].status == statusnum){
        var course_privacy=`
    <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
        <div class="card col-12 p-0 border-radius0all">
            <a href="${base_url}content/view/${content[i].id}">
               ${new_image}
            </a>
               <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">
                 ${append_privacy}
                      <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 p-2 text-right">
                          <small class="float-right">${content[i].views_count} Views</small>
                      </div>

               </div>
            <div class="card-body">

                <a href="${base_url}content/view/${content[i].id}">
                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                </a>
                <a href="${base_url}search/all?query=${content[i].authors}">
                 <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors }</small></p>
                </a>
                <a href="${base_url}search/all?query=${content[i].affiliation}">
                 <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
                </a>
            </div>
               <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                   <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${bk_icon_path}" width="25" class="mr-1"> Course (${content[i].count} items) </h6>
              </div>
        
              <div class="card-footer bg-transparent border-0 justify-content-between">
                <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                    <div class="m-0 pt-2 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(content[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(content[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(content[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(content[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                                            </label></div>  
                                                     </div>
                                   <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                          ${bookmarkBtn}
                </div>
              </div>
        </div>
    </div>`;

    var course_privacy_list=`
                                             <div class="col-md-8 mb-3">
                                                <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                                                        <a href="content/view/${content[i].id}">
                                                        <img class="align-self-start mr-3" src="http://stage1.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/${content[i].image_url}" alt="" width="180">
                                                        </a>
                                                    <div class="media-body">
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">${content[i].views_count} Views</span>
                                                        <a href="content/view/${content[i].id}">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">${content[i].title}</h6>
                                                        </a>
                                                      <a href="${base_url}search/all?query=${content[i].authors}">
                                                        <p>${content[i].authors }</p>
                                                      </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                         <a href="${base_url}search/all?query=${content[i].affiliation}">
                                                            <span class="mr-2">${content[i].affiliation}</span>
                                                         </a>
                                                            <i class="fas fa-circle font-size6px mr-2"></i>
                                                            <span class="mr-2">${content[i].difficulty_level}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
                                               ${append_privacy_list}
                                             </div>   
    `;

      }
      else{
        var course_privacy= `
        <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
               <div class="card col-12 p-0 opacity0point5 border-radius0all">
                   <a href="${base_url}content/view/${content[i].id}">
                        ${new_image}
                  </a>
                       <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 lpb-0 pt-2 d-flex flex-wrap">
                            ${append_privacy}
                         <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 p-2 text-right">
                          <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small>
                         </div>

                       </div>
                      <div class="card-body">
                           <a href="${base_url}content/view/${content[i].id}">
                              <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                          </a>
                          <a href="${base_url}search/all?query=${content[i].authors}">
                           <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors}</small></p>
                          </a>
                          <a href="${base_url}search/all?query=${content[i].affiliation}">
                           <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
                          </a>
                      </div>
                          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${bk_icon_path}" width="25" class="mr-1"> Course (${content[i].count} items) </h6>
                          </div>
                             ${awaitappro}
                      <div class="card-footer bg-transparent border-0 justify-content-between">
                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                    <div class="m-0 pt-2 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(content[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(content[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(content[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(content[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                                            </label></div>  
                                                     </div>
                                     <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                         ${bookmarkBtn}
                          </div>
                      </div>
                </div>
         </div>`;

          var course_privacy_list=`
                                             <div class="col-md-8 mb-3">
                                                <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                                                        <a href="content/view/${content[i].id}">
                                                        <img class="align-self-start mr-3" src="http://stage1.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/${content[i].image_url}" alt="" width="180">
                                                        </a>
                                                    <div class="media-body">
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">${content[i].views_count} Views</span>
                                                        <a href="content/view/${content[i].id}">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">${content[i].title}</h6>
                                                        </a>
                                                      <a href="${base_url}search/all?query=${content[i].authors}">
                                                        <p>${content[i].authors }</p>
                                                      </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                         <a href="${base_url}search/all?query=${content[i].affiliation}">
                                                            <span class="mr-2">${content[i].affiliation}</span>
                                                         </a>
                                                            <i class="fas fa-circle font-size6px mr-2"></i>
                                                            <span class="mr-2">${content[i].difficulty_level}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
                                               ${append_privacy_list}
                                             </div>                         
          `;
      }

      $("#content_with_thumbnail_course").append(`
    
      ${course_privacy}
`);
    $("#content_with_list_course").append(`

    ${course_privacy_list}

  `);



   
    }
  }
      
    },

    error: function (err) {
      console.log(err);
    },
  });
}
   
$("#content_sort_new").on("change", function () {
  contentPgFilternew();
});

function contentPgFilternew() {
  const sort = $("#content_sort_new").val();
  // const cat_id = $("#cat_id").val();
  // const difficulty_level_id = $("#difficulty_level").val();

  const filter_data = {
    sort
  };

  console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}contentdashboard/filter`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
  
    success: function (data) {
      console.log("RECEIVED " + JSON.stringify(data));
      const {content} = data;
      var images_path;
      var str='content';
      var numcourse= 0;
      var statusnum=1;
      bk_icon_path="images/bookicon.png";
      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/inetEDPlatform/public/uploads/content/profile_images/";
      }
      $("#content_with_thumbnail").html("");
      $("#content_with_list").html("");
   
      if (content.length) {
        for (i = 0; i < content.length; i++) {
          let bookmarkBtn = auth_id ?
           `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
           onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${content[i].id}">
           <label class="custom-control-label bookmarkCheckBox" for="bookmark-${content[i].id}"></label></div>` 
           : "";
           let bookmarkBtnlist = auth_id;
           if(bookmarkBtnlist = auth_id){
               if(content[i].content_privacy == numcourse){
                 var append_privacy_list=  `<span class="font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"> </span>
                                         <div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
                                          onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark${content[i].id}">
                                         <label class="custom-control-label bookmarkCheckBox" for="bookmark${content[i].id}"></label></div>` 
               }else{
                var append_privacy_list=   `<span class="badge badge-secondary font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-2 pb-2"><i class="fas fa-graduation-cap font-size18px"></i> Restricted</span>
                                          <div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
                                            onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark${content[i].id}">
                                           <label class="custom-control-label bookmarkCheckBox" for="bookmark${content[i].id}"></label></div>` 

               }
           }

          if(content[i].content_privacy == numcourse && content[i].scope_type==str){
            var append_privacy= `
            <div class="text-right pr-3">Public</div>
             `;
          }
          else{
            var append_privacy= `
            <div class="text-right pr-3">Restricted</div>
             `;
            
            }
            if(content[i].image_url!='placeholder.png'){
            if(content[i].content_group==null){
                  if(content[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-1.png'}"> `;}
                  if(content[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-2.png'}"> `;}
                  if(content[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-3.png'}"> `;}
                  if(content[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-4.png'}"> `;}
                  if(content[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-5.png'}"> `;}
                  if(content[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                    <img class="icon-img" src="${images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(content[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                <img class="icon-img" src="${images_path + 'icon-7.png'}"> `;}
                if(content[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-8.png'}"> `;}
                if(content[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-9.png'}"> `;}
                if(content[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-10.png'}"> `;}
                if(content[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-11.png'}"> `;}
                if(content[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="253" height="163">
                  <img class="icon-img" src="${images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(content[i].content_group==null){
                if(content[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${images_path + 'Imageimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${images_path + 'Videoimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${images_path + 'Pdfimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${images_path + 'Articleimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${images_path + 'Audioimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${images_path + 'courseimg.png'}" alt="image" width="253" height="163">`;}
                if(content[i].formatType==null && content[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${images_path + 'default3.png'}" alt="image" width="253" height="163">`;}
            }else{  
                  if(content[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${images_path + 'quizimg.jpg'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${images_path + 'featuredimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${images_path + 'syllabusimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${images_path + 'exercireimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${images_path + 'dataimg.png'}" alt="image" width="253" height="163">`;}
                  if(content[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${images_path + 'websiteimg.png'}" alt="image" width="253" height="163">`;}
            }
         }   

      if(content[i].status == statusnum){
        var content_privacy=`
        <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
        <div class="card col-12 p-0 border-radius0all">
            <a href="${base_url}content/view/${content[i].id}">
                   ${new_image}
            </a>

            <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small>
                </div>
            <div class="card-body">

                <a href="${base_url}content/view/${content[i].id}">
                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                </a>
               <a href="${base_url}search/all?query=${content[i].authors}">
                <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors }</small></p>
               </a>
               <a href="${base_url}search/all?query=${content[i].affiliation}">
                <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
               </a>
            </div>
                ${append_privacy}
            <div class="card-footer bg-transparent border-0 justify-content-between">
                <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                <div class="m-0 pt-3 text-colorblue200 bookmark float-left">
                                   <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                   <label class="form-check-label">
                                   <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(content[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                  </label></div>
                                <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(content[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                  </label></div>
                                <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                  <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(content[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                  </label></div>
                               <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                 <label class="form-check-label">
                                   <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(content[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                </label></div>  
                               </div>
                          <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                             ${bookmarkBtn}
                </div>
            </div>
        </div>
    </div>`;

    var content_privacy_list=`
 <div class="col-md-8 mb-3">
    <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
            <a href="content/view/${content[i].id}">
            <img class="align-self-start mr-3" src="http://pro.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/${content[i].image_url}" alt="" width="180">
            </a>
        <div class="media-body">
            <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">${content[i].views_count} Views</span>
            <a href="content/view/${content[i].id}">
            <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">${content[i].title}</h6>
            </a>
            <a href="${base_url}search/all?query=${content[i].authors}">
             <p>${content[i].authors }</p>
            </a>
            <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
               <a href="${base_url}search/all?query=${content[i].affiliation}">
                 <span class="mr-2">${content[i].affiliation}</span>
               </a>
                <i class="fas fa-circle font-size6px mr-2"></i>
                <span class="mr-2">${content[i].difficulty_level}</span>
            </p>
        </div>
    </div>
</div>
  <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
   ${append_privacy_list}
 </div> 
    `;

      }
      else{
        var content_privacy= `
        <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
        <div class="card col-12 p-0 opacity0point5 border-radius0all">
        <a href="${base_url}content/view/${content[i].id}">
                   ${new_image}
        </a>

            <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small>
            </div>
            <div class="card-body">

                <a href="${base_url}content/view/${content[i].id}">
                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                </a>
            <a href="${base_url}search/all?query=${content[i].authors}">
                <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors }</small></p>
            </a>
            <a href="${base_url}search/all?query=${content[i].affiliation}">
                <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation} </small></p>
            </a>
            </div>
                ${append_privacy}
            <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>
            <div class="card-footer bg-transparent border-0 justify-content-between">
                <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                <div class="m-0 pt-3 text-colorblue200 bookmark float-left">
                                   <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                   <label class="form-check-label">
                                   <input type="checkbox" class="form-check-input" onclick="return false;" value="1" ${(content[i].difficulty_level == 'Beginner') ? 'checked="checked"' : ''}>
                                  </label></div>
                                <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" onclick="return false;" value="2" ${(content[i].difficulty_level  == 'Introductory') ? 'checked="checked"' : ''}>
                                  </label></div>
                                <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                  <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" onclick="return false;" value="3" ${(content[i].difficulty_level  == 'Intermediate') ? 'checked="checked"' : ''}>
                                  </label></div>
                               <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                 <label class="form-check-label">
                                   <input type="checkbox" class="form-check-input" onclick="return false;" value="4" ${(content[i].difficulty_level  == 'Advanced') ? 'checked="checked"' : ''}>
                                </label></div>  
                               </div>
                          <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                           ${bookmarkBtn}
                </div>
            </div>
        </div>
    </div>`;

          var content_privacy_list=`
          <div class="col-md-8 mb-3">
          <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                  <a href="content/view/${content[i].id}">
                  <img class="align-self-start mr-3" src="http://pro.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/${content[i].image_url}" alt="" width="180">
                  </a>
              <div class="media-body">
                  <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">${content[i].views_count} Views</span>
                  <a href="content/view/${content[i].id}">
                  <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">${content[i].title}</h6>
                  </a>
                  <a href="${base_url}search/all?query=${content[i].authors}">
                   <p>${content[i].authors }</p>
                  </a>
                  <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                   <a href="${base_url}search/all?query=${content[i].affiliation}">
                      <span class="mr-2">${content[i].affiliation}</span>
                   </a>
                      <i class="fas fa-circle font-size6px mr-2"></i>
                      <span class="mr-2">${content[i].difficulty_level}</span>
                  </p>
              </div>
          </div>
      </div>
        <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
         ${append_privacy_list}
       </div>                        
          `;
      }

      $("#content_with_thumbnail").append(`
    
      ${content_privacy}
`);
    $("#content_with_list").append(`

    ${content_privacy_list}

  `);



   
    }
  }
      
    },

    error: function (err) {
      console.log(err);
    },
  });
}
// =================================================================================================================================================================================================================================
// ==================================================================================== ABDUL RAFEY WORK END =======================================================================================================================
// =================================================================================================================================================================================================================================
