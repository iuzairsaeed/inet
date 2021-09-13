@extends('layouts.app')


@section('title') INET ED Platform :: FAQs @endsection

@section('content')
    @include('include.header')


    <input type="hidden" id="content_categories_ids" value="{{ $content->category_ids }}">
    <style>
    .bookmarkCheck .custom-control-label::before {
            position: absolute;
            top: 0rem;
            left: -0.3rem;
            display: block;
            width: 1rem;
            height: 1rem;
            pointer-events: none;
            content: "\F02E" !important;
            background-color: transparent;
            border: #adb5bd solid 0px;
            font-family: "Font Awesome 5 Free";
            color: #7ca9a1;
          }

    .bookmarkCheck .custom-control-label::after {
        position: absolute;
        top: -0.15rem;
        left: -0.3rem;
        display: block;
        width: 1rem;
        height: 1rem;
        content: "";
        background: no-repeat 50%/50% 50%;
        color: #7ca9a1;
    }



.bookmarkCheck .custom-control-label::after {
    top: 0rem !important;
}

    .transformMenu{transform: translate3d(6px, -18px, 0px) !important;}

    .borderRound {
        border: 1px solid;
        border-radius: 100%;
        padding: 0.7em;
    }

        .font-size19px{font-size: 19px;}

        .customFileMain1 .custom-file-label::after {
            background-color: #ffffff00 !important;
            width: 100% !important;
            height: 32px !important;
            padding-top: 0px !important;
        }

        .customFileMain1 .custom-file-label {
            background-color: #ffffff00 !important;
            border: 1px solid #ffffff00 !important;
        }
    </style>
    <script>
          var ids = document.getElementById('content_categories_ids').value;

    </script>

    <?php
        // content inserted tags
        $cTags = json_decode($content->tags,true);
        $cCategoryIds = array_filter(explode(',', $content->category_ids));
        $content_type = json_decode($content->content_type,true);
    ?>

    <header class="bg-bannerContent pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 bg-white">
                        <div class="row">
                            <div class="col-md-8 pt-5 pb-5">
                                <h2 class="font-familyAtlasGroteskWeb-Bold text-black">{{ $content->title }}</h2>
                                <div class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size12px mb-2">
                                    <span>Author:</span> <span><a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">{{$content->authors }}</a></span> | <span>Source:</span> <span> <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }}</a></span>
                                </div>
                                <p>{!! $content->description !!}</p>
                                <div class="row">
                                    <div class="col-md-7 font-size11px">
                                        <div class="row">
                                            <div class="col border-right mb-3">
                                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-0">Level</p>
                                                <p class="font-familyAtlasGroteskWeb-Medium text-colorNew mb-0">{{ $content->difficulty_level }}</p>
                                            </div>
                                            <div class="col border-right mb-3">
                                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-0">Field</p>
                                                <?php
                                                $myString = $content->category_ids;
                                                $myString = trim( $myString,",");
                                                $myArray = explode(',', $myString);

                                                $myString2 = $content->categories;
                                                $myString2 = trim( $myString2,",");
                                                $myArray2 = explode(',', $myString2);

                                                $a = $myArray;
                                                $b =  $myArray2;
                                                $c = array_combine($a, $b);

                                                foreach ($c as $key => $item) {
                                                    echo "<a href='http://pro.celeritas-solutions.com/inetEDPlatform/courses/$key'><p class='font-familyAtlasGroteskWeb-Medium text-colorNew mb-0'>".$item."</p></a>";
                                                }
                                                ?>
                                            </div>
                                            <div class="col mb-3">
                                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-0">Posted</p>
                                                <p class="font-familyAtlasGroteskWeb-Medium text-colorNew mb-0">{{ date('M d, Y', strtotime($content->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-5">

                                        @if(Auth::check())
                                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                                                @if ($content->content_privacy == 1)
                                                <button type="button" class="btn btn-customBtn6 font-familyAtlasGroteskWeb-Regular font-size12px text-colorMahroon700 mr-3 mb-3"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Restricted</button>
                                                @endif
                                            @endif
                                        @endif

                                        @if($content->scope_type == 'course')
                                        <button type="button" class="btn btn-customBtn4 font-familyAtlasGroteskWeb-Regular font-size12px mb-3"><i class="fas fa-book-open"></i> Course ({{$courseCount}} items)</button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <div class="row">
                                    @if(Auth::check())
                                    <div class="col-md-5 align-self-center bookmarkCheck">
                                        <div class="custom-control custom-checkbox mr-sm-2 m-auto">
                                            <?php
                                                $authId = isset(Auth::user()->id) ?  '[' . $content->id . ',' . Auth::user()->id . ']'  :'';


                                            ?>


                                            @if (isset($content->bookmark))

                                            <input {{ ($content->bookmark==1) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ $authId }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                            <label class="custom-control-label" for="bookmark-{{ $content->id }}"><span class="ml-3">Bookmark</span></label>

                                            @endif







                                        </div>
                                    </div>
                                    @endif

                                    @if(Auth::check())
                                    {{--Add to Course DropDown--}}
                                    {{-- <div class="col-md-7 border-left text-right">
                                        <a href="#" class="text-colorblue200" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-book borderRound mr-2"></i>
                                            <span class="font-familyAtlasGroteskWeb-Regular font-size14px">Add to Course</span>
                                            <i class="fas fa-angle-down ml-2"></i>
                                        </a>
                                        <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                    <div class="col pl-0 pr-0">

                                                        @foreach($playLists as $playList)
                                                        <a class="dropdown-item font-size14px conent-add-playlist"  data-id="{{$playList->id}}" >
                                                            <span>{{$playList->name}}</span><i class="fas fa-plus-circle float-right font-size19px"></i>
                                                        </a>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> --}}


                                    <div class="col-md-7 border-left text-right">
                                    @if($content -> status==2)
                                         <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#wouldyoulikesubmit">
                                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">SUBMIT COURSE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal">
                                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">SUBMITTED<i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                        </button>

                                        @endif


                                       <!--  <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Add to Course
                                        </a>

                                        <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                            <li class="nav-item dropdown">
                                                {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                                <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                    <div class="col pl-0 pr-0">
                                                        @foreach($playLists as $playList)
                                                        <a class="dropdown-item font-size14px conent-add-playlist" data-id="{{$playList->id}}" href="#">
                                                           <span>{{$playList->name}}</span> <i class="fa fa-plus mr-2"></i>
                                                        </a>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </li>
                                        </ul> -->

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Comment ZA--}}
                {{--<div class="col-md-8">
                    --}}{{-- <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Bookmarks</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">{{ $content->title }}</span></h6> --}}{{--
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">{{ $content->title }}</h2>
                    <div class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px mb-2">
                        <span>Author:</span> <span>{{$content->authors }}</span> | <span>Source:</span> <span> {{ $content->affiliation }}</span>
                    </div>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size14px">{{ $content->description }}</p>
                    <p class="text-colorblue100 font-size12px mb-0">
                        <span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                        <?php
                            $myString = $content->category_ids;
                            $myString = trim( $myString,",");
                            $myArray = explode(',', $myString);

                            $myString2 = $content->categories;
                            $myString2 = trim( $myString2,",");
                            $myArray2 = explode(',', $myString2);

                            $a = $myArray;
                            $b =  $myArray2;
                            $c = array_combine($a, $b);

                                foreach ($c as $key => $item) {
                                    echo "<a href='http://pro.celeritas-solutions.com/inetEDPlatform/courses/$key'><span class='mr-2'>".$item."</span></a>";
                                }
                        ?>
                        <span class="mr-2 opacity0point5">|</span>
                        <span class="mr-2 opacity0point5">Posted on : {{ date('M d, Y', strtotime($content->created_at)) }}</span></p>
                </div>--}}
                {{--@auth
                    --}}{{-- @if ($content->bookmark)
                        <div class="col-md-3 align-self-center text-right mt-3 mt-md-0">
                            <span class="mr-2 text-ferozy">Bookmarked</span>
                            <button disabled class="btn btn-customBtn2 border-radius2em"><i class="fas fa-bookmark text-white"></i></button>
                        </div>
                    @endif --}}{{--







                    <div class="col-md-2 m-0 text-colorblue200 d-flex bookmark bookmarkCheck">
                        --}}{{-- <i class="fas fa-download"></i> --}}{{--
                        <div class="custom-control custom-checkbox mr-sm-2 m-auto">
                            <input {{ ($content->bookmark) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                            <label class="custom-control-label" for="bookmark-{{ $content->id }}"><span class="ml-3">Bookmark</span></label>

                        </div>
                    </div>
                    @if (Auth::user()->role_id == 1)
                    <div class="col-md-2">
                        <div class="custom-control custom-checkbox mr-sm-2 m-auto">
                            <button class="btn btn-primary bg-colorFerozy mt-4" style="color:#fff;" data-toggle="modal" data-target="#moadalarchive">Archive</button>
                        </div>
                    </div>
                    @endif


                @endauth--}}
            </div>
        </div>
    </header>
    <section class="bg-white pt-5 pb-5 font-familyAtlasGroteskWeb-Regular font-size14px">
        <div class="container">
            <div id="alertsBox" class="alert alert-success border-radius0px font-familyAtlasGroteskWeb-Medium font-size13px boxPos" role="alert" style="display: none;"></div>
            <div class="row no-gutters">
                <div class="col-md-12 border-bottom align-self-center mb-4">
                    <div class="row">
                        <div class="col-md-6 pt-2 pb-2">
                            <span class="border-bottom3px text-ferozy pr-3 pb-2">Content</span>
                            <input type="text" id="linkshare" style="position: absolute;left: -999em;" aria-hidden="true">




                        </div>

                        <div class="col-md-6 text-right">
                            <span class="text-ferozy pr-3 pb-2 font-familyAtlasGroteskWeb-Bold font-size12px" onclick="Copy()"><span style="cursor:pointer">SHARE</span>
                                <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i>
                            </span>



                          @auth


                            @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v text-colorblue200 font-size18px"></i></a>

                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                <li class="nav-item dropdown">
                                    {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                        <div class="col pl-0 pr-0">
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" @if($content->scope_type == 'course') data-target="#moadalEditCoursem" @else data-target="#moadalAddNewCourse" @endif  onclick=""><i class="far fa-edit mr-2"></i> <span>Edit</span></a>
                                            <a class="dropdown-item font-size14px delete-main-content" data-id="{{$content->id}}" href="#" data-toggle="modal" onclick=""><i class="far fa-trash-alt mr-2"></i> <span>Delete</span></a>
                                            @if(Auth::user()->role_id == 1)
                                            <a class="dropdown-item font-size14px" href="#" course_id="" data-toggle="modal" data-target="#moadalChangeGroup" onclick="showApproved3({{ $content->id}})"><i class="fas fa-layer-group mr-2"></i> <span>Change Group</span></a>  
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endif

                            @endauth
                        </div>
                    </div>


                </div>

                <div class="col-md-12 mb-4">


            <div class="w-100 bg-colorFerozy p-4 text-center mt-3 mb-3 font-familyAtlasGrotesk-Medium text-white font-size12px">
                    <p>Note: To add content items to course, select desired content and click â€œAdd to Courseâ€.</p>
                    <p class="m-auto max-width690px">Note: Courses created by users are for private use and accessible only through profile dashboard. If you wish to make your course a
public course to featured on the general site, please submit to admin for approval when completed."</p>

            </div>
<!-- ///////////////////////////////////////////////////////////SAMRA WORK////////////////////////////////////////////////////////////////////////////////////// -->



<table id="sortable" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size13px">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Difficulty Level</th>
                                    <th>Type</th>
                                    {{-- <th>Duration</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                    <!-- <th></th> -->
                                </tr>
                                </thead>
                                <tbody class="ui-sortable row_position">

                                    @foreach($playLists2 as $rec)

                                    <tr id="{{$rec->mainID}}" class="ui-sortable-handle" >
                                        <td width="150">
                                            <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                                <div class="thumbnailImg_WH2 overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images')  . '/'. $rec->image_url }}) no-repeat; background-size: 100% 100%;">

                                                </div>

                                            </a>
                                        </td>
                                        <td width="200" valign="middle">
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}" class="text-colorblue200">
                                            <h6 class="mt-0 font-size1em">{{ $rec->title}}</h6>
                                           </a>
                                            <p class="text-colorblue200 mb-0">{{ $rec->authors}} <br> </p>
                                            <p class="text-colorblue200 mb-0">{{ $rec->affiliation}}</p>
                                        </td>
                                        <td width="150">{{ date('d M, Y', strtotime($rec->created_at)) }}</td>
                                        <td width="200">{{ $rec->difficulty_level}}</td>
                                        <td width="200">{{ $rec->scope_type}}</td>

                                        @if($rec->status==0)
                                        <td width="150"><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>
                                        @else
                                           <td width="150"> <span class="badge badge-customBtn5 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-ferozy">Approved</span></td>
                                            @endif

                                        <td width="150">
                                                @auth
                                                @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                                                    <a class="font-familyAtlasGroteskWeb-Bold font-size10px text-colorMahroon700 ml-2 course_delete-mod" href="#" @auth data-contentId="{{$rec->mainID}}" data-toggle="modal" @endauth>DELETE</a>
                                                @endif
                                                @endauth



                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
</table>


<!-- ///////////////////////////////////////////////////////////SAMRA WORK END////////////////////////////////////////////////////////////////////////////////////// -->



                    <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">

                        @if ($content->section_count)
                            <?php for ($i=0; $i < $content->section_count; $i++) {  ?>
                               {{-- / <h6>Section {{ $i + 1 }}</h6>/ --}}

                                @if ($content_details && count($content_details))
                                    @foreach ($content_details as $step)

                                        @if($step->section == ($i + 1))
                                            @if($step->type == "Video")
                                                <div class="col-12 border mb-4 p-0 bg-white">
                                                    <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                        <div class="col-md-6 d-flex">
                                                            <img src="{{ asset('images/icons/videoIcon.png') }}" alt="" height="30">
                                                            <div class="align-self-center ml-3">
                                                                <p class="mb-0">{{ $step->title }}</p>
                                                                <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-3 align-self-center">
                                                            @if ($step->duration)
                                                            <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                            @endif
                                                        </div> --}}
                                                        <div class="col-md-6 text-right align-self-center">
                                                            <a @auth onclick="tracking_content(this, {{ $step->content_id }}, {{ $step->section }}, {{ $step->steps }})" @endauth href="#" class="border-radius0all w-100 text-left p-0 pt-3 pb-3 font-familyAtlasGroteskWeb-Bold font-size10px collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="true" aria-controls="collapse-{{ $step->id }}">
                                                                <span class="mr-2">VIEW</span>

                                                                {{--<i class="fa text-ferozy ml-3 font-size14px align-self-center"></i>--}}
                                                            </a>

                                                            @auth



                                                            @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                                                            <span>|</span>
                                                            <a href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="font-familyAtlasGroteskWeb-Bold font-size10px text-colorMahroon700 ml-2">Edit</a>
                                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                                <li class="nav-item dropdown">
                                                                    {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                                        <div class="col pl-0 pr-0">
                                                                            <a class="dropdown-item font-size14px edit-mod" href="#"  @auth data-contentId="{{$step->id}}"  data-toggle="modal" data-target="#moadalAddNewCont" @endauth><i class="far fa-edit mr-2"></i> <span>Edit</span></a>
                                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" onclick=""><i class="far fa-trash-alt mr-2"></i> <span>Delete</span></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                            @endauth
                                                        </div>
                                                    </div>

                                                    <div id="collapse-{{ $step->id }}" class="collapse pt-3 collapsed collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="col-md-12 p-0 d-flex">
                                                            @if ($step->asset)
                                                                <video class="w-100" controls>
                                                                    <source src="{{ asset('public/uploads/content/videos/' . $step->asset) }}" type="video/mp4">
                                                                </video>
                                                            @else
                                                                <iframe width="1280" height="720" src="{{ $step->embeded_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($step->type == "Pdf")
                                                <div class="col-12 border mb-4 p-0 bg-white">
                                                    <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                        <div class="col-md-6 d-flex">
                                                            <h1 class="mb-0"><i class="far fa-file-pdf"></i></h1>
                                                            <div class="align-self-center ml-3">
                                                                <p class="mb-0">{{ $step->title }}</p>
                                                                <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                            </div>

                                                        </div>
                                                        {{-- <div class="col-md-3 align-self-center">
                                                            @if ($step->duration)
                                                            <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                            @endif
                                                        </div> --}}
                                                        <div class="col-md-6 text-right align-self-center">
                                                            <a @auth onclick="tracking_content(this, {{ $step->content_id }}, {{ $step->section }}, {{ $step->steps }})" @endauth href="#" class="border-radius0all w-100 text-left p-0 pt-3 pb-3 font-familyAtlasGroteskWeb-Bold font-size10px collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="true" aria-controls="collapse-{{ $step->id }}">
                                                                <span class="mr-2">VIEW</span>

                                                                {{--<i class="fa text-ferozy ml-3 font-size14px align-self-center"></i>--}}
                                                            </a>
                                                            @auth
                                                            @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                                                            <span>|</span>
                                                            <a href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="font-familyAtlasGroteskWeb-Bold font-size10px text-colorMahroon700 ml-2">Edit</a>
                                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                                <li class="nav-item dropdown">
                                                                    {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                                        <div class="col pl-0 pr-0">
                                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" onclick=""><i class="far fa-trash-alt mr-2"></i> <span>Delete</span></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                            @endauth



                                                        </div>
                                                    </div>

                                                    <div id="collapse-{{ $step->id }}" class="collapse pt-3 collapsed collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="col-md-12 p-0 d-flex">
                                                            <object data="{{ asset('public/uploads/content/pdf/' . $step->asset) }}" name="pdfviewer" width="100%" height="600"></object>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($step->type == "Article")
                                                <div class="col-12 border mb-4 p-0 bg-white">
                                                    <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                        <div class="col-md-6 d-flex">
                                                            <h1 class="mb-0"><i class="far fa-file-alt"></i></h1>
                                                            <div class="align-self-center ml-3">
                                                                <p class="mb-0">{{ $step->title }}</p>
                                                                <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                            </div>

                                                        </div>
                                                        {{-- <div class="col-md-3 align-self-center">
                                                            @if ($step->duration)
                                                            <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                            @endif
                                                        </div> --}}
                                                        <div class="col-md-6 text-right align-self-center">
                                                            <a @auth onclick="tracking_content(this, {{ $step->content_id }}, {{ $step->section }}, {{ $step->steps }})" @endauth href="#" class="border-radius0all w-100 text-left p-0 pt-3 pb-3 font-familyAtlasGroteskWeb-Bold font-size10px" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="true" aria-controls="collapse-{{ $step->id }}">
                                                                <span class="mr-2">VIEW</span>

                                                                {{--<i class="fa text-ferozy ml-3 font-size14px align-self-center"></i>--}}
                                                            </a>
                                                            @auth
                                                            @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                                                            <span>|</span>
                                                            <a href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="font-familyAtlasGroteskWeb-Bold font-size10px text-colorMahroon700 ml-2">Edit</a>
                                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                                <li class="nav-item dropdown">
                                                                    {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                                        <div class="col pl-0 pr-0">
                                                                            <a class="dropdown-item font-size14px edit-mod" href="#"  @auth data-contentId="{{$step->id}}"  data-toggle="modal" data-target="#moadalAddNewCont" @endauth><i class="far fa-edit mr-2"></i> <span>Edit</span></a>
                                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" onclick=""><i class="far fa-trash-alt mr-2"></i> <span>Delete</span></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                            @endauth

                                                        </div>
                                                    </div>

                                                    <div id="collapse-{{ $step->id }}" class="collapse pt-3 collapsed collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="col-md-12 font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                            {!! $step->description !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($step->type == "Image")
                                                <div class="col-12 border mb-4 p-0 bg-white">
                                                    <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                        <div class="col-md-6 d-flex">
                                                            <img src="" alt="" height="30">
                                                            <div class="align-self-center ml-3">
                                                                <p class="mb-0">{{ $step->title }}</p>
                                                                <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                            </div>

                                                        </div>
                                                        {{-- <div class="col-md-3 align-self-center">
                                                            @if ($step->duration)
                                                            <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                            @endif
                                                        </div> --}}
                                                        <div class="col-md-6 text-right align-self-center">
                                                            <a @auth onclick="tracking_content(this, {{ $step->content_id }}, {{ $step->section }}, {{ $step->steps }})" @endauth href="#" class="border-radius0all w-100 text-left p-0 pt-3 pb-3 font-familyAtlasGroteskWeb-Bold font-size10px collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="false" aria-controls="collapse-{{ $step->id }}">
                                                                <span class="mr-2">VIEW</span>

                                                                {{--<i class="fa text-ferozy ml-3 font-size14px align-self-center"></i>--}}
                                                            </a>

                                                           @auth
                                                            @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                                                            <span>|</span>
                                                            <a href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="font-familyAtlasGroteskWeb-Bold font-size10px text-colorMahroon700 ml-2">Edit</a>
                                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                                <li class="nav-item dropdown">
                                                                    {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                                        <div class="col pl-0 pr-0">
                                                                            <a class="dropdown-item font-size14px edit-mod" href="#"  @auth data-contentId="{{$step->id}}"  data-toggle="modal" data-target="#moadalAddNewCont" @endauth><i class="far fa-edit mr-2"></i> <span>Edit</span></a>
                                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" onclick=""><i class="far fa-trash-alt mr-2"></i> <span>Delete</span></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                            @endauth

                                                        </div>
                                                    </div>

                                                    <div id="collapse-{{ $step->id }}" class="collapse pt-3 collapsed collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="col-md-12 p-0 d-flex">
                                                            <img class="w-100" src="{{ asset('public/uploads/content/images/' . $step->asset) }}">
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif($step->type == "Audio")
                                                <div class="col-12 border mb-4 p-0 bg-white">
                                                    <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                        <div class="col-md-6 d-flex">
                                                            <img src="" alt="" height="30">
                                                            <div class="align-self-center ml-3">
                                                                <p class="mb-0">{{ $step->title }}</p>
                                                                <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                            </div>

                                                        </div>
                                                        {{-- <div class="col-md-3 align-self-center">
                                                            @if ($step->duration)
                                                            <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                            @endif
                                                        </div> --}}
                                                        <div class="col-md-6 text-right align-self-center">
                                                            <a @auth onclick="tracking_content(this, {{ $step->content_id }}, {{ $step->section }}, {{ $step->steps }})" @endauth href="#" class="border-radius0all w-100 text-left p-0 pt-3 pb-3 font-familyAtlasGroteskWeb-Bold font-size10px collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="true" aria-controls="collapse-{{ $step->id }}">
                                                                <span class="mr-2">VIEW</span>

                                                                {{--<i class="fa text-ferozy ml-3 font-size14px align-self-center"></i>--}}
                                                            </a>

                                                            @auth
                                                            @if(Auth::user()->role_id == 1 || Auth::user()->id == $content->user_id)
                                                            <span>|</span>
                                                            <a href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="font-familyAtlasGroteskWeb-Bold font-size10px text-colorMahroon700 ml-2">Edit</a>
                                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                                <li class="nav-item dropdown">
                                                                    {{--<a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>--}}
                                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading transformMenu" aria-labelledby="listViewMenu">
                                                                        <div class="col pl-0 pr-0">
                                                                            <a class="dropdown-item font-size14px edit-mod" href="#"  @auth data-contentId="{{$step->id}}"  data-toggle="modal" data-target="#moadalAddNewCont" @endauth><i class="far fa-edit mr-2"></i> <span>Edit</span></a>
                                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" onclick=""><i class="far fa-trash-alt mr-2"></i> <span>Delete</span></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            @endif

                                                            @endauth

                                                        </div>
                                                    </div>


                                                     <div id="collapse-{{ $step->id }}" class="collapse pt-3 collapsed collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="col-md-12 text-center">
                                                            <audio controls>
                                                                <source src="{{ asset('public/uploads/content/audios/' . $step->asset) }}">
                                                            </audio>
                                                        </div>

                                                    </div>
                                                </div>

                                            @endif
                                        @endif
                                    @endforeach
                                @endif

                            <?php } ?>
                        @endif

                    </div>
                </div>

                <div class="col-md-12 border-top pt-4 pb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="font-familyFreightTextProMedium-Italic text-black">Contributor</h6>
                            <div class="media mt-2">
                                {{-- <div onclick="showPro('{{$content->user_id}}')" class="thumbnailImg_WH3 thumbnailImg mr-0" style="background: url({{ asset('public/uploads/profile_images') . '/'. $content->author_profile_pic_url }}) no-repeat; background-size: cover;"></div> --}}

                               <a href="{!! route('discBoardprofile', ['u_id' => $content->user_id]) !!}">
                                <div class="thumbnailImg_WH3 thumbnailImg mr-0" style="background: url({{ asset('public/uploads/profile_images') . '/'. $content->author_profile_pic_url }}) no-repeat; background-size: cover; cursor:pointer;"></div>
                               </a>

                                <div class="media-body align-self-center ml-1">
                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100">{{ $content->author }} </h6>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2 font-size12px">{{ $content->author_role }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-0 float-right">
                                <h6 class="font-familyFreightTextProMedium-Italic text-black">Tags:</h6>
                                <?php
                                    $tags = json_decode($content->tags, true);
                                    if (count($tags)) {
                                        foreach ($tags as $tag) {
                                            echo "<button onclick='coursesTagButton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                        }
                                    }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="modal fade" id="moadalarchive" tabindex="-1" role="dialog" aria-labelledby="moadalarchiveTitle" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="ArchiveContent" name="ArchiveContent">
                    @csrf
                    {{ method_field('PUT')}}
                <input type="hidden" id="contentarchive_id" name="contentarchive_id" value="{{ $content->id }}">
                <div class="modal-content border-radius0px">
                    <div class="modal-body text-center p-5">
                        <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size14px">Are you sure you want to archive this content.</p>
                        <small id="successerror" class="text-center"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">No</span>
                            <div class="btn-bar"></div>
                        </button>
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Yes</span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Add content modal -->
    <div class="modal fade p-0" id="moadalAddNewCourse" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="form-container modal-content border-radius0px">
                <form id="edit_content_form_with_detail" action="{{ route('contentEditWithDetail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont2">Edit Content</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="content_id" value="{{$content->id}}">
                    <input type="hidden" name="content_detail_id" value="{{isset($content_details[0]->id) ? $content_details[0]->id:''}}">
                    <div class="modal-body p-4">

                        <div class="lds-dual-ring" style="display:none"></div>

                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title_up" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your content  a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title_up" name="content_title" value="{{$content->title}}" placeholder="Content Name">
                                    <small id="content_title2_err_up" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="author_up" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the content</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="author_up" name="author" value="{{$content->authors}}" placeholder="Enter Author">
                                    <small id="author_err_up" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="affiliation_up" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Mention the name of the institution or affiliation</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="affiliation_up" name="affiliation" value="{{$content->affiliation}}" placeholder="Enter Affiliation">

                                    <small id="content_affiliation2_err_up" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription_up" class="mb-0 text-colorblue100">Description</label>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Content description is what your students will see.</p>
                                        <p class="text-colorblue200 font-size12px mb-0"><span id="count_up">0</span><span> / 160</span></p>
                                    </div>

                                    <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" onkeyup="charcountupdate2(this.value)" name="content_discription2" id="content_discription_up" placeholder="Content Description" rows="6" cols="260">{{$content->description}}</textarea>
                                    <small id="content_discription2_err_up" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel_up" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level_up" name="difficulty_level" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}" {{$content->difficulty_level_id == $difficulty_level->id ? 'selected':''}}>{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level2_err_up" style="color: red"></small>
                                </div>



                            </div>
                            <div class="col-md-5">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg_up" class="mb-0 text-colorblue100">Add thumbnail</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image_up" name="content_image_thumb" type="file" class="custom-file-input col-md-12 p-0 getVal2" onchange="getVal2()">
                                        <div id="saveFileVal_up" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="content_image_up">Upload</label>
                                    </div>

                                    <small id="content_avatar2_err_up" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent_up" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories_up" name="categories[]" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Categories">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}" {{in_array($category->id,$cCategoryIds) ? 'selected': ''}}>{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--<i class="fas fa-angle-down position-absolute marginDArrow"></i>--}}
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                                    <small id="content_categories2_err_up" style="color: red"></small>
                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag_up" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags to promote your content.</p>

                                    <select id="selectpickerTags_up" name="tags[]" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        @if ($allTags)
                                            @foreach ($allTags as $allTag)
                                                <option value="{{$allTag->name}}" {{in_array($allTag->name,$cTags) ? 'selected':''}}>{{ $allTag->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>Edit


                                    <i class="fas fa-angle-down position-absolute marginDArrow2-1"></i>
                                    <small id="content_tags2_err_up" style="color: red"></small>

                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 font-size14px">
                                    <label for="gender" class="font-familyAtlasGrotesk-Medium d-block">Select Restrictions</label>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="0" type="radio" id="option_up" name="privacy_content" class="custom-control-input align-self-center" {{$content->content_privacy == 0 ? 'checked':''}} >
                                        <label class="custom-control-label" for="option_up">Generally accessible</label>
                                    </div>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="1" type="radio" id="option_up11" name="privacy_content" class="custom-control-input" {{$content->content_privacy == 1 ? 'checked':''}} >
                                        <label class="custom-control-label" for="option_up11">Restrict access to teachers only</label>
                                    </div>
                                </div>




                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="type_up" class="mb-0 text-colorblue100">Select Type</label>
                                    <select name="type" id="type_up" class="selectpicker content_type border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="Video" {{$content_type[0] == 'Video' ? 'selected':''}}>Video</option>
                                        <option value="Pdf" {{$content_type[0] == 'Pdf' ? 'selected':''}}>Pdf</option>
                                        <option value="Article" {{$content_type[0] == 'Article' ? 'selected':''}}>Article</option>
                                        <option value="Image" {{$content_type[0] == 'Image' ? 'selected':''}}>Image</option>
                                        <option value="Audio" {{$content_type[0] == 'Audio' ? 'selected':''}}>Audio</option>
                                    </select>
                                    <small id="type_err_up" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="embeded_url_up" class="text-colorblue100">Embed URL</label>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="embeded_url_up" name="embeded_url" value="{!! isset($content_details[0]->embeded_url) ? $content_details[0]->embeded_url:'' !!}" placeholder="https://example.com">
                                    <small id="embeded_url_err_up" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="text-colorblue100">Add Asset</label>
                                    <div class="custom-file">
                                        <input id="asset_up" name="asset" type="file" class="custom-file-input col-md-4 p-0 getVal3" onchange="getVal3()">
                                        <div id="saveFileVal_up" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg_up">Upload</label>
                                    </div>
                                    <small id="asset_err_up" style="color: red"></small>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div id="description_div_up" class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="description_up" class="text-colorblue100">Article Text</label>
                                    <p class="float-right text-colorblue200 font-size12px mt-1"><span id="count2">0</span><span> / 160</span></p>
                                    <textarea class="form-control classy-editor" name="description" id="description_up" onkeyup="charcountupdate3(this.value)" rows="6" cols="260">{!! isset($content_details[0]->description) ? $content_details[0]->description:'' !!}</textarea>
                                    <small id="description_div_up" style="color: red"></small>
                                </div>
                            </div>
                        </div>
                        <div class="reminder-text">By submitting materials, you confirm you are not violating othersâ€™ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the <a href="{{url('termsConditions')}}" target="_blank">Terms of Service. </a></div>

                    </div>
                    <div class="col-md-12 box-shadow p-4">
                        <div class="row">
                            <div class="col-md-7 align-self-center">
                                <div class="col-md-12 border-radius2em overflow-hidden" style="background-color: #fff5ea;">
                                    <div class="row">
                                        <div class="col-2 font-familyAtlasGroteskWeb-Medium p-2 text-center font-size13px" style="background-color: #ffecd7; color: #ff9c33;"><i class="far fa-lightbulb mr-2"></i>Tip</div>
                                        <div class="col font-familyAtlasGroteskWeb-Medium p-2 font-size11px align-self-center text-center">You can use TAB key to scroll through form.</div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-5 text-right">
                                <div class="row">
                                    <div class="col">
                                        <p id="final_course_msg" style="text-align: center;" class="mb-0"></p>
                                    </div>
                                    <div class="col align-self-center">
                                    <button type="submit" class="btn btn-customBtn6 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">CANCEL</span>
                                        <div class="btn-bar"></div>
                                    </button>
                                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Update <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!-- course content modal -->
    <div class="modal fade p-0" id="moadalEditCoursem" tabindex="-1" role="dialog" aria-labelledby="moadalEditCoursem" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <form id="edit_course_content_form_new" action="{{ route('mainContentUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="content_id" value="{{$content->id}}">
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalEditCoursemCont">Edit  Course</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your course a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title" name="content_title" value="{{$content->title}}" placeholder="Content Name">
                                    <small id="content_title_err4" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="Author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the course.</p>

                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="Author" name="author" value="{{$content->authors}}" placeholder="Enter Author Name">
                                    <small id="author" style="color: red"></small>
                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="institution_or_source" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of institution or source of course.</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" value="{{$content->affiliation}}" id="institution_or_source" name="institution_or_source" placeholder="Institution / Source">

                                    <small id="content_affiliation_err4" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription" class="mb-0 text-colorblue100">Description</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Course description is what your students will see.</p>
                                    <p class="float-right font-size14px">
                                        <span id="count"></span><span> </span></p>
                                     <!-- <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" onkeyup="charcountupdate1(this.value)" name="content_discription" id="content_discription" placeholder="Content Description" rows="6" cols="260">{{$content->description}}</textarea> -->
                                    <textarea class="form-control" name="content_discription" id="content_discription">{!! $content->description !!}</textarea>
                                    <small id="content_discription_err4" style="color: red"></small>
                                </div>


                            </div>
                            <div class="col-md-6">

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain customFileMain1">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add thumbnail image for your course.</p>
                                <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                    <div class="custom-file">
                                        <input id="content_image" name="content_image" accept="image/*" type="file" class="custom-file-input col-md-12 p-0 getVal2">
                                        <img id="blah" src="{{ asset('images/upload12.jpg') }}" alt="" width="100%" height="160" style="margin-top: -70px;">
                                         <label style="font-size: 40px; height: 32px;" class="custom-file-label col-md-12 d-flex align-items-center justify-content-between" for="content_image"></label>
                                         <script>
                                          content_image.onchange = evt => {
                                          const [file] = content_image.files
                                          if (file) {
                                           blah.src = URL.createObjectURL(file)
                                            }
                                          }
                                        </script>
                                    </div>
                                </div>
                                    <small id="content_avatar_err4" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level" name="difficulty_level_c" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}" {{$content->difficulty_level_id == $difficulty_level->id ? 'selected':''}}>{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level_err4" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any 7 fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories" name="categories[]" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Select Category">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}" {{in_array($category->id,$cCategoryIds) ? 'selected': ''}}>{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i><div>
                                    <small id="content_categories_err4" style="color: red"></small></div>
                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="Restriction" class="mb-0 text-colorblue100">Select Restriction</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose restriction of your course.</p>
                                    <select id="Restriction" name="privacy_content_01" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Generally accessible</option>
                                        <option value="0" {{$content->content_privacy == 0 ? 'selected':''}}>Generally accessible</option>
                                        <option value="1" {{$content->content_privacy == 1 ? 'selected':''}}>Restrict access to teachers only</option>

                                    </select>
                                    <small id="content_difficulty_level_err4" style="color: red"></small>
                                </div>

                                <!-- <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image" name="content_image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div> -->
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add sub-fields tags to filter-topic.</p>
                                    <select id="selectpickerTags" name="tags[]" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        @if ($allTags)
                                            @foreach ($allTags as $allTag)
                                                <option value="{{$allTag->name}}" {{in_array($allTag->name,$cTags) ? 'selected':''}}>{{ $allTag->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2"></i>
                                    <small id="content_tags_err4" style="color: red;margin: 0.5em 0em 0em 1.2em !important;" class="textError position-absolute"></small>

                                </div>

                            </div>
                        </div>
                        <p class="w-100 text-center text-colorblue200 font-familyAtlasGroteskWeb-Light ml-auto mr-auto max-width690px font-size14px"><strong>Note:</strong> To add content items to course, select desired content and click â€œAdd to Courseâ€</p>
                           <p class="w-100 text-center text-colorblue200 font-familyAtlasGroteskWeb-Light ml-auto mr-auto max-width690px font-size14px"><strong>Note:</strong> Courses created by users are for private use and accessible only through profile dashboard. If you wish to make your course a public course to featured on the general site, please submit to admin for approval when completed</p>

                    </div>
                    <div class="modal-footer box-shadow" style=" justify-content: flex-start;">
                        <!-- <p id="final_content_msg4" style="text-align: center; width: 80%;"></p> -->
                            <!-- <button type="submit" class="btn btn-customBtn6 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                                <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">CANCEL</span>
                                <div class="btn-bar"></div>
                            </button> -->
                            <div class="alert alert-warning fade show alert-dismissible text-dark pt-0 pb-0 pr-3 pl-0 border-radius2em overflow-hidden font-size13px" role="alert" style="background:#fff5eb;float: left;">
                        <div class="text-warning p-2 mr-2" style="background:#ffecd8;display: inline-block;"><i class="fas fa-lightbulb mr-2"></i>Tips</div>
                        You can use â€œTABâ€ key to scroll through form.</div>

                        <div class="text-right col-sm-6 p-0">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Update <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Would you like to submit your course as a public course? -->
    <div class="modal fade p-0" id="wouldyoulikesubmit" tabindex="-1" role="dialog" aria-labelledby="wouldyoulikesubmit" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-body p-5">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="font-familyAtlasGroteskWeb-Medium text-colorblue100">Would you like to submit your course?</h6>
                            <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px mb-0">The course will be available for public to view. You can change restriction whenever you want!</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer box-shadow">
                    <button type="submit" class="btn btn-customBtn6 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">CANCEL</span>
                        <div class="btn-bar"></div>
                    </button>
                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar submitcourse" data-dismiss="modal">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">SUBMIT <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>

        </div>
    </div>

    @include('include.footer')

    <!-- Modal ADD COMMENT -->
    <div class="modal fade p-0" id="moadalAddNewCont" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCont" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered p-md-0 p-3" role="document" style="max-width: 800px;">
            <div class="modal-content border-radius0px">
                <div class="modal-header">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-ferozy font-size0point8" id="moadalAddNewContTitle">Edit  CONTENT</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700 mt-n4" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-3 pb-3">

                    <div class="lds-dual-ring" style="display:none"></div>

                    <div class="form-container">

                        <form id="content_step_form1" action="{{ route('contentUploadEdit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="content__detail_id" name="content__detail_id" value="">

                            <!-- <h6 class="font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5 font-size1em mb-2">Add</h6> -->

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="title" class="mb-0 text-colorblue200">Title</label>
                                <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="title" name="title" placeholder="Enter Title">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Select Type</label>
                                    <select class="selectpicker picker-trigger border font-familyFreightTextProLight-Regular text-darkBlue" id="type" name="type" title="Select Type">
                                        <option value="Video">Video</option>
                                        <option value="Pdf">Pdf</option>
                                        <option value="Article">Article</option>
                                        <option value="Image">Image</option>
                                        <option value="Audio">Audio</option>
                                    </select>

                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="embeded_url" class="mb-0 text-colorblue200">Embed URL</label>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="embeded_url" name="embeded_url" placeholder="https://example.com">
                                </div>

                                <div class="form-group col-md-6 font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Asset</label>
                                    <div class="custom-file">
                                        <input id="asset" name="asset" type="file" class="custom-file-input col-md-4 p-0">
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>
                                </div>
                            </div>

                            <div id="description_div" class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="description" class="mb-0 text-colorblue200">Description</label>
                                <p class="float-right">0 / 160</p>
                                <textarea class="form-control classy-editor" name="description" id="descriptionD" rows="6" cols="260"></textarea>
                            </div>



                            <p style="text-align: center;" id="message_content"></p>

                            <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar float-right">
                                <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Update
                                    <!-- <i class="fas fa-plus ml-3 text-colorMahroon100"></i> -->
                                </span>
                                <div class="btn-bar"></div>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade p-0" id="moadalChangeGroup" tabindex="-1" role="dialog" aria-labelledby="moadalChangeGroup" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered p-md-0 p-3" role="document" style="max-width: 380px;">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalChangeGroupTitle">Change Group</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="AddGroupnew">
                @csrf
                <div class="modal-body p-4 customDropDownInnerPg">
                  <input type="hidden" id="contentid3" name="contentid3">
		<div class="form-group">
		   <label for="FormControlTextarea1" class="" >Select Group</label>
                    <select id='addGroup' name='group' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option selected value="">Select Group</option>
                                            <option value="None">None</option>
                                            <option value="Syllabus">Syllabus</option>
                                            <option value="Exercise">Exercise</option>
                                            <option value="Data">Data</option>
                                            <option value="Featured">Featured</option>
                                            <option value="Website">Website</option>

                                        </select>
                                        <small id="content_group_err" style="color: red" class="textError position-absolute"></small>
                        		</div>

                </div>
                <div class="modal-footer box-shadow">
                    {{-- <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">OK <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>--}}
                    <button id="nonbut" type="submit" onclick = "location.reload()"  class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Submit</span>
                    </button>
                </div>
             
            </div>
            </form>
        </div>
    </div>
@endsection



@section('script')
    <!-- <script src="{{ asset('js/dragInDrop.min.js') }}"></script>
    <script src="{{ asset('js/dragInDropCustom.js') }}"></script> -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">

    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">

    $(document).ready(function() {
        $("#description_up").ClassyEdit();
    });
     // charcountupdate1("{{$content->description}}");
    $('.course_delete-mod').click(function() {
         var contentId = $(this).attr('data-contentId');
         $.ajax({
            type: "get",
            url: '{{route("mainCourseDelete")}}',
            data: {contentId:contentId},
            success: function (data) {
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
            },
          });

    });
     // course edit
  $('#edit_course_content_form_new').submit(function(e) {
        e.preventDefault();
    tinyMCE.triggerSave();

  let content_title = $("#content_title").val();
  let content_discription = $("#content_discription").val();
  let affiliation = $("#institution_or_source").val();
  let difficulty_level = $("#difficulty_level").val();
  let author = $("#Author").val();
  let content_image = $("#content_image").prop("files")[0];
  // let duration = $("#duration").val();
  let tags = $("#selectpickerTags").val();;
  let categories = $("#selectpickerCategories").val();
  // let restriction = $("#Restriction").val();

  $("#content_title_err4").html("");
  $("#content_discription_err4").html("");
  $("#content_affiliation_err4").html("");
  $("#content_difficulty_level_err4").html("");
  $("#content_avatar_err4").html("");
  //$("#content_duration_err").html("");
  $("#content_categories_err4").html("");
  $("#restriction_err4").html("");
  $("#content_tags_err4").html("");
  $("#final_content_msg4").html("");
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
      $("#content_title_err4").html("Course title required!");
    }

    if (content_discription == "") {
      $("#content_discription_err4").html("Course description required!");
    }

    if (affiliation == "") {
      $("#content_affiliation_err4").html("Course affiliation required!");
    }

    if (!difficulty_level) {
      $("#content_difficulty_level_err4").html(
        "Content difficulty level required!"
      );
    }
    if (author == "") {
      $("#author").html("Course Author required!");
    }

    // if (!content_image) {
    //   $("#content_avatar_err").html("Content avatar required!");
    // }

    // if (duration == "") {
    //     $("#content_duration_err").html("Content duration required!");
    // }

    if (!categories) {
      $("#content_categories_err4").html("Course categories required!");
    }
    // if (!restriction) {
    //   $("#restriction_err").html("Course categories required!");
    // }

    if (!tags) {
      $("#content_tags_err4").html("Course tags required!");
    }
    return;
  }

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

          // $("#message_content").html(
          //   `<small style="color: red;">${
          //     JSON.parse(err.responseText).message
          //   }</small>`
          // );
        },
      });

    });

 
  tinymce.init({
      selector: "textarea",
      plugins: 'mentions a11ychecker advcode casechange formatpainter  autolink lists checklist media mediaembed pageembed permanentpen  table preview  tinycomments tinymcespellchecker fullscreen anchor   image code imagetools emoticons link ',
      toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | link image | print  media fullpage | forecolor backcolor emoticons | code ',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
	  file_picker_types: 'file image media',
      mentions_selector: '.mymention',
  mentions_fetch: mentions_fetch,
  mentions_menu_hover: mentions_menu_hover,
  mentions_menu_complete: mentions_menu_complete,
  mentions_select: mentions_select,
  mentions_item_type: 'profile',
	  convert_urls: false,
	    /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
    });

//     $(function() {
//     $("#sortable tbody").sortable({
//       cursor: "move",
//       placeholder: "sortable-placeholder",
//       helper: function(e, tr)
//       {
//         var $originals = tr.children();
//         var $helper = tr.clone();

//         $helper.children().each(function(index)
//         {

//         $(this).width($originals.eq(index).width());
//         });

//         var selectedData = new Array();
//             $('.sortable').each(function() {
//                 selectedData.push($(this).attr("id"));
//             });
//             updateOrder(selectedData);
//             return $helper;
//       }
//     }).disableSelection();
//   });

//   function updateOrder(data) {
//       console.log(data);
//         $.ajax({
//             type:'get',
//             url:'{{route("contentOrderList")}}',

//             data:{position:data},
//             success:function(){
//                 // alert('your change successfully saved');
//             },
//             error: function (err) {
//         },
//         })
//     }

$( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        console.log(data);
        $.ajax({
            url:'{{route("contentOrderList")}}',
            type:'get',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }
    // single content edit open popup and append value in form
    $('.edit-mod').click(function() {
        var contentId = $(this).attr('data-contentId');
        $("#content__detail_id").val(contentId);

        $.ajax({
            type: "get",
            url: '{{route("contentById")}}',
            data: {contentId:contentId},
            success: function (data) {

                var content = data[0];
                $("#title").val(content.title);
                $(".classy-editor").text(content.description);
                $("#embeded_url").val(content.embeded_url);

                var type = content.type;
                var embeded_url = content.embeded_url;

                $('select[name=type]').val(type);
                $('.selectpicker').selectpicker('refresh');
                $(".selectpicker").trigger("change");
            },

            error: function (err) {
            },
          });
    });


    // delete content by id
    $('.delete-mod').click(function() {
         var contentId = $(this).attr('data-contentId');
         $.ajax({
            type: "get",
            url: '{{route("contentUploadDelete")}}',
            data: {contentId:contentId},
            success: function (data) {
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
            },
          });

    });


    // single content edit
    $('#content_step_form1').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        console.log(formData);

        $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {

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

          // $("#message_content").html(
          //   `<small style="color: red;">${
          //     JSON.parse(err.responseText).message
          //   }</small>`
          // );
        },
      });

    });

 



    // content edit
    $('#edit_content_form_with_detail').submit(function(e) {
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

        },
      });

    });




$(document).ready(function(){
     $(".content_type").trigger("change");
});

$(".content_type").on("change", function (e) {
  let type = e.target.value;

  switch (type) {
    case "Video":
      $("#description_div_up").slideUp();
      // $("#duration").removeAttr("disabled");
      $("#embeded_url_up").removeAttr("disabled");
      $("#asset_up").removeAttr("disabled");
      break;
    case "Pdf":
      $("#description_div_up").slideUp();
      //  $("#duration").attr("disabled", "disabled");
      $("#embeded_url_up").attr("disabled", "disabled");

      $("#asset_up").removeAttr("disabled");
      break;
    case "Article":
      $("#asset_up").attr("disabled", "disabled");
      // $("#duration").attr("disabled", "disabled");
      $("#embeded_url_up").attr("disabled", "disabled");

      $("#description_div_up").slideDown();
      break;
    case "Image":
      $("#description_div_up").slideUp();
      //  $("#duration").attr("disabled", "disabled");
      $("#embeded_url_up").attr("disabled", "disabled");

      $("#asset").removeAttr("disabled");
      break;
    case "Audio":
      $("#description_div_up").slideUp();
      $("#embeded_url_up").attr("disabled", "disabled");
      // $("#duration").removeAttr("disabled");

      $("#asset_up").removeAttr("disabled");
      break;
  }
});


$(".delete-main-content").on("click", function (e) {

    if (confirm('Are you sure you want to delete this?')) {
        var formData  = new FormData();
        formData.append('contentId',$(this).data('id'));
        $.ajax({
            type: "POST",
            url: '{{ route("mainContentDelete") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
              if (data.success) {
                $("#final_course_msg").html(
                  `<small style="color: green;">${data.message}</small>`
                );
                window.location.href = '{{url("/home")}}';
              } else {
                $("#final_course_msg").html(
                  `<small style="color: red;">${data.message}</small>`
                );
              }
            },
            error: function (err) {
            },
          });

    }
});



$(".conent-add-playlist").on("click", function (e) {

    // if (confirm('Are you sure you want to add this?')) {
        var formData  = new FormData();
        formData.append('playlist_id',$(this).data('id'));
        formData.append('source_id','{{ collect(request()->segments())->last() }}');
        $.ajax({
            type: "POST",
            url: '{{ route("user.playlist.store") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                alert('This content added successfully to Playlist');

            },
            error: function (err) {
            },
          });

    // }
});

$(".submitcourse").on("click", function (e) {

// if (confirm('Are you sure you want to add this?')) {

//    var course_id= $(this).data('course_id');
   var course_id  = '{{ collect(request()->segments())->last() }}';
//    console.log(content_id);
//    console.log(course_id);


    // return false;
    $.ajax({
        type: "GET",
        url: '{{ route("SubmitCourse") }}',
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        data: {course_id:course_id},
        // cache: false,
        // contentType: false,
        // processData: false,
        success: function (data) {

            if(data.status == 1){
                alert('This course suubmitted successfully');
                window.location.href = '{{url("/home")}}';
            }
           else{ 
               alert('This course submitted successfully');
               location.reload();

        }
        },
        error: function (err) {
        },
      });

// }
});

    $("#addGroup").on("change", function () {
    addGroupname();
   });
function showApproved3(id){
     $("#contentid3").val(id);
}
   function addGroupname(id) {
    
   // var course_id= $(this).data('course_id');
     var contentid = $("#contentid3").val();    
console.log(contentid);
     const group = $("#addGroup").val();

 
     $.ajax({
       type: "POST",
       url: `${base_url}add_group`,
       headers: {
         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
       },
       data: {group:group,course_id:contentid},
       success: function () {
       },
   
       error: function (err) {
         console.log(err);
       },
     });
    }  

    $('#addGroup').on('change', function () {
    $('#nonbut').prop('disabled', !$(this).val());
}).trigger('change');


$("#selectpickerTags").select2({
    maximumSelectionLength: 3,
    placeholder: "Select tags",
    allowClear: true,
  });

$("#selectpickerTags_up").select2({
    maximumSelectionLength: 3,
    placeholder: "Select tags",
    allowClear: true,
  });

    $('#accordion a').attr('target', function() {
    if(this.host == location.host) return '_self'
    else return '_blank'
    });

          $( 'a[href^="http://"]' ).attr( 'target','_blank' )
       $( 'a[href^="https://"]' ).attr( 'target','_blank' )
    </script>
@endsection
