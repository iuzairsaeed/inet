@extends('layouts.app')


@section('title') INET ED Platform :: Users @endsection

@section('content')

    <style>
        .width12em{width: 14em;}

    </style>

    @include('include.header')

    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-4">Users</h3>
                </div>

                <div class="col-md-12 mt-3 horizontalScroll">
                    <div class="dt-buttons mb-3 d-md-flex justify-content-between col-md-12 p-0 d-inline-block">
                                <div class="col-lg-4 col-md-6 d-md-flex p-0 customDropDownInnerPg">
                                    <span class="font-familyAtlasGroteskWeb-Regular font-size14px opacity0point5 align-self-center width12em mb-md-0 mb-2">Filter by group:</span>
                                        <select id="sort" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                            <option value="All">All</option>
                                            <option value="learner">learner</option>
                                            <option value="teacher">teacher</option>
                                        </select>
                                </div>
                    </div> 
                    <table id="usersDataTable" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium font-size13px dashboardDataTable" style="width:100%">
                        <thead class="text-colorblue200 font-size12px font-familyAtlasGroteskWeb-Black text-uppercase">
                        <tr>
                            <th>Username</th>
                            <th>Affiliation</th>
                            <th>Group</th>
                            <th>Contributions</th>
                            <th>Posts</th>
                            <th>Date registered</th>
                            <th>Last online </th>
                        </tr>
                        </thead>
                        <tbody id="list-of-users">
                           @foreach($userinfo as $rec)

                        <tr>
                            <td>{{ $rec->name }}</td>
                            <td>
                              @if($rec->affiliation == null)
                                   -
                              @else
                               {{ $rec->affiliation }}</td>
                             @endif
                            <td>
                             @if($rec->role_id == 2)
                                Learner
                             @else
                                Teacher
                             @endif
                            </td>
                            <td>{{ $rec->COUNT }}</td>
                            <td>{{ $rec->POST }}</td>
                            <td><span>{{date('Y/m/d', strtotime($rec->created_at))}}</span></td>
                            <td>
                                @if($rec->last_login == null)
                                <span>2021/05/15</span>
                                @else
                                <span>{{date('Y/m/d', strtotime($rec->last_login))}}</span>
                                @endif
                            </td>
                        </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    @include('include.footer')


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            newtable();


customButton();
          
        } );

        function customButton(){
            $("#usersDataTable_wrapper > .dt-buttons > button").addClass("btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar float-right mb-3");
            $("#usersDataTable_wrapper > .dt-buttons > button > span").addClass("pt-2 pb-2 pl-4 pr-4 mb-0 d-block");
            $("#usersDataTable_wrapper > .dt-buttons > button > span").append('<i class="fas fa-download ml-3 text-white"></i>');
            $("#usersDataTable_wrapper > .dt-buttons > button").append('<div class="btn-bar"></div>');
            $("#usersDataTable_wrapper > .dt-buttons > button").removeClass("dt-button buttons-csv buttons-html5");
        }

        function addDropDown() {
            $("#usersDataTable_wrapper > .dt-buttons").addClass("mb-3 d-md-flex justify-content-between col-md-12 p-0 d-inline-block");
            $("#usersDataTable_wrapper > .dt-buttons").prepend('<div class="col-lg-4 col-md-6 d-md-flex p-0 customDropDownInnerPg">\
                                    <span class="font-familyAtlasGroteskWeb-Regular font-size14px opacity0point5 align-self-center width12em mb-md-0 mb-2">Filter by group:</span>\
                                        <select id="sort" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">\
                                            <option value="All">All</option>\
                                            <option value="learner">learner</option>\
                                            <option value="teacher">teacher</option>\
                                        </select>\
                                    </div>');
        }


Date.prototype.toShortFormat = function() {
    var month_names = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec"
    ];

    var day = this.getDate();
    var month_index = this.getMonth();
    var year = this.getFullYear();
    if(month_index < 10)
    {
        var month_index = "0" + month_index;
    }
    if(day < 10){
        var day = "0" + day;
    }
    return "" +year+"/"+month_index+"/"+day;

   // return "" + year + " " + month_names[month_index] + ", " + day;
}



function userpgFilter() {
  const sort = $("#sort").val();
  // const cat_id = $("#cat_id").val();
  // const difficulty_level_id = $("#difficulty_level").val();

  const filter_data = {
    sort
  };

  console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}userspg/filter`,
    dataType: "json",
    contentType: "application/json",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: JSON.stringify(filter_data),
  
    success: function (data) {
      console.log("RECEIVED " + JSON.stringify(data));
      const {userinfoAppend} = data;
      var num1= 1;
      var num2= 2;

     
      //$("#list-of-users").dataTable().fnDestroy();
$("#usersDataTable").dataTable().fnDestroy();
 $("#list-of-users").html("");
   
    for (i = 0; i < userinfoAppend.length; i++) {
        var today = new Date(userinfoAppend[i]['created_at']);
        var today2 = new Date(userinfoAppend[i]['last_login']);

          if(userinfoAppend[i].role_id == num2){
            var append_role= `Learner`;
          }
          else{
            var append_role= `Teacher`;
          }

      if(userinfoAppend[i].affiliation == null){
               var affiliation = '-';
         }
      else{
          var affiliation = userinfoAppend[i].affiliation;
      }
    if(userinfoAppend[i]['last_login']== null){
        var newlogin = `2021/05/15`;
    }else{
        var newlogin = `${today2.toShortFormat()}`;
    }
$("#list-of-users").append(`
    
                        <tr>
                            <td>${userinfoAppend[i].name}</td>
                            <td>${affiliation}</td>
                            <td>
                            ${append_role}
                            </td>
                            <td>${userinfoAppend[i].COUNT}</td>
                            <td>${userinfoAppend[i].POST}</td>
                            <td>${today.toShortFormat()}</td>
                            <td>${newlogin}</td>
                        </tr>
`);




   
    }
      newtable();
customButton();
    },

    error: function (err) {
      console.log(err);
    },
  });
}

function newtable(){
$("#usersDataTable").DataTable({
                bPaginate: true,
                bLengthChange: false,
                bFilter: false,
                bInfo: false,
                bAutoWidth: false,
                sPaginationType: "full_numbers",
                iDisplayLength: 10,
                ordering: true,
                dom: "lBfrtip",
                buttons: [{
                    extend: 'csv',
                    text: 'Download CSV',
                }],
                language: {
                    searchPlaceholder: "Keyword search here",
                    search: "",
                },
            });

}


$("#sort").on("change", function () {
userpgFilter();
});

    </script>

@endsection