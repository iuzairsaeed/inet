
@extends('layouts.app')


@section('title') INET ED Platform :: Add @endsection

@section('content')
    <style>
        .bookmarkCheckBox {
            border: 1px solid #dee2e6;
            border-radius: 100%;
            width: 3em;
            height: 3em;
            left: 0px;
        }

        .bookmarkCheck .custom-control-label::after {
            top: 0.75rem !important;
            left: 1rem !important;
            color: #5F6B7F;

        }

        .bookmarkCheck .custom-control-label::before {
            top: 0.75rem !important;
            left: 1rem !important;
            content: "\F02E" !important;
            background-color: transparent !important;
            color: #5F6B7F;
        }

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
.icon-img {
    float: right;
    margin-top: -70px;
    position: relative;
}

    </style>

    @auth
        <input id="auth_id" value="{{ Auth::user()->id }}" type="hidden">
        <input id="user_content_updated_list" value="{{ $user_content_updated_list }}" type="hidden">
        <?php $user_content_list = explode(",", $user_content_updated_list); ?>
    @endauth

    @include('include.header')
    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 p-0">
                    <div class="col-md-12">
                        <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-4">Add</h3>
                    </div>

                    <div class="col-md-12 list-groupCusMain mb-2">
                        <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active col-lg-2 col-md-3" id="list-home-list" data-toggle="list" href="#pg-content" role="tab" aria-controls="Content">Content</a>
                            <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-course-list" data-toggle="list" href="#pg-course" role="tab" aria-controls="Courses">Courses</a>
                            <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-contributors-bookmarks-list" data-toggle="list" href="#pg-bookmarks" role="tab" aria-controls="Bookmarks">Bookmarks</a>
                            <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-contributor-history" data-toggle="list" href="#pg-history" role="tab" aria-controls="History">History</a>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pg-content" role="tabpanel" aria-labelledby="content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3 d-flex">
                                        <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                            <div class="row h-100">
                                                <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                    <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddNewCourse"><i class="fas fa-plus text-white"></i></button>
                                                    <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">ADD NEW CONTENT</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="mb-4">

                                <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_t"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                            <a id="view-list_t"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>                                        </div>
                                    </div>
                                    <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4 ">
                                        <div class="row">
                                            <div class="col text-right align-self-center">
                                                <p class="opacity0point5 mb-3">Sort By</p>
                                            </div>

                                            <div class="col mb-3">
                                                <select id='content_sort_admin2' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                                          <option value="new">Newest</option>
                                                          <option value="popular">Most Viewed/Popular</option>
                                                          <option value="alpha">Alphabetically</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row" id="content_with_thumbnail">
                                    @if ($my_content)
                                        @foreach ($my_content as $content)
                                            @if ($content->status == 1)
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
                                                    <div class="card col-12 p-0 border-radius0all">
                                                        <a href="content/view/{!!$content->id !!}">
                                             @if($content->image_url=='placeholder.png')
                                                @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Imageimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Videoimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Pdfimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Articleimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Audioimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/courseimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType==NULL  && $content->scope_type=='content')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/default3.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                 @else
                                                   @if($content->content_group=='Quiz')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/quizimg.jpg') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/featuredimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/syllabusimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Exercise')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/exercireimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Data')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/dataimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/websiteimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                @endif

                                             @else
                                               <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="253" height="163">
                                               @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-1.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-2.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-3.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-4.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-5.png') }}"> 
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-6.png') }}"> 
                                                   @endif 
                                               @else
                                                   @if($content->content_group=='Quiz')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-7.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-8.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-9.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Exercise')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-10.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Data')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-11.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-12.png') }}"> 
                                                   @endif 
                                               @endif
 

                                             @endif
                                                        </a>

                                                        <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                                                            <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                            </div>
                                                        <div class="card-body">

                                                            <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                            <a href="search/all?query={!!$content->authors !!}">
                                                             <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            </a>
                                                            <a href="search/all?query={!!$content->affiliation !!}">
                                                             <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            </a>
                                                           <!-- <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>-->
                                                        </div>
                                                        <div class="card-footer bg-transparent border-0 justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                            <!-- <div class="m-0 text-colorblue200 d-flex bookmark"> -->
                                                         <div class="m-0 pt-5 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div>  
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                                <div class="custom-control text-center custom-checkbox mr-sm-2">
                                                                    @if($content->content_privacy == 0)
                                                                        <div class="mb-2">Public</div>
                                                                    @else
                                                                        <div class="mb-2">Restricted</div>
                                                                    @endif
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
                                                    <div class="card col-12 p-0 opacity0point5 border-radius0all">
                                                     <a href="content/view/{!!$content->id !!}">
                                             @if($content->image_url=='placeholder.png')
                                                @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Imageimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Videoimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Pdfimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Articleimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Audioimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/courseimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType==NULL  && $content->scope_type=='content')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/default3.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                 @else
                                                   @if($content->content_group=='Quiz')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/quizimg.jpg') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/featuredimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/syllabusimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Exercise')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/exercireimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Data')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/dataimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/websiteimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                @endif

                                             @else
                                               <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="253" height="163">
                                               @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-1.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-2.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-3.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-4.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-5.png') }}"> 
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-6.png') }}"> 
                                                   @endif 
                                               @else
                                                   @if($content->content_group=='Quiz')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-7.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-8.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-9.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Exercise')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-10.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Data')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-11.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-12.png') }}"> 
                                                   @endif 
                                               @endif
 

                                             @endif
                                                    </a>

                                                        <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                                                            <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                        </div>
                                                        <div class="card-body">

                                                             <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                            <a href="search/all?query={!!$content->authors !!}">
                                                             <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            </a>
                                                            <a href="search/all?query={!!$content->affiliation !!}">
                                                             <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            </a>
                                                            <!--<p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>-->
                                                        </div>
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>
                                                        <div class="card-footer bg-transparent border-0 justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                            <!-- <div class="m-0 text-colorblue200 d-flex bookmark"> -->
                                                         <div class="m-0 pt-5 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div>  
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                                <div class="custom-control text-center custom-checkbox mr-sm-2">
                                                                    @if($content->content_privacy == 0)
                                                                        <div class="mb-2">Public</div>
                                                                    @else
                                                                        <div class="mb-2">Restricted</div>
                                                                    @endif
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                            </div>

                                    <div class="row" id="content_with_list" style="display: none;">
                                    @if ($my_content)
                                        @foreach ($my_content as $content)
                                            @if ($content->status == 1)
                                            <div class="col-md-8 mb-3">
                                                <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <img class="align-self-start mr-3" src="http://pro.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$content->image_url}}" alt="" width="180">
                                                        </a>
                                                    <div class="media-body">
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">{{ $content->views_count }} Views</span>
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">{{ $content->title }}</h6>
                                                        </a>
                                                       <a href="search/all?query={!!$content->authors !!}">
                                                        <p>{{ $content->authors }}</p>
                                                       </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                           <a href="search/all?query={!!$content->affiliation !!}">
                                                            <span class="mr-2">{{ $content->affiliation }}</span>
                                                           </a>
                                                            <i class="fas fa-circle font-size6px mr-2"></i>
                                                            <span class="mr-2">{{ $content->difficulty_level }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
                                             @if($content->content_privacy == 0)
                                                  <span class="font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"> </span>

                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark{{ $content->id }}"></label>
                                                        </div>
                                                 @else
                                                  <span class="badge badge-secondary font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-2 pb-2"><i class="fas fa-graduation-cap font-size18px"></i> Restricted</span>
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark{{ $content->id }}"></label>
                                                        </div>

                                               @endif
                                            </div>
                                             @else
                                            <div class="col-md-8 mb-3">
                                                <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <img class="align-self-start mr-3" src="http://stage1.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$content->image_url}}" alt="" width="180">
                                                        </a>
                                                    <div class="media-body">
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">{{ $content->views_count }} Views</span>
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">{{ $content->title }}</h6>
                                                        </a>
                                                       <a href="search/all?query={!!$content->authors !!}">
                                                        <p>{{ $content->authors }}</p>
                                                       </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                       <a href="search/all?query={!!$content->affiliation !!}">
                                                            <span class="mr-2">{{ $content->affiliation }}</span>
                                                       </a>
                                                            <i class="fas fa-circle font-size6px mr-2"></i>
                                                            <span class="mr-2">{{ $content->difficulty_level }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
                                             @if($content->content_privacy == 0)
                                              
                                                     {{--   <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                        </div>
                                                 @else
                                                  <span class="badge badge-secondary font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"><i class="fas fa-graduation-cap font-size18px"></i> Restricted</span>
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                        </div> --}}

                                               @endif
                                            </div>

                                           @endif
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
          <div class="tab-pane fade" id="pg-course" role="tabpanel" aria-labelledby="Content">
                                <div class="row">


                                    <div class="col-lg-6 col-md-12 mb-3 d-flex">
                                        <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                            <div class="row h-100">
                                                <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                    <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddNewCourse1"><i class="fas fa-plus text-white"></i></button>
                                                    <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">CREATE NEW COURSE</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                 </div>
                                <hr class="mb-4">

                          <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_co">
                                                <i id="viewIcon3" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor2(3)"></i>
                                            </a>
                                            <a id="view-list_co">
                                                <i id="viewIcon4" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor2(4)"></i>
                                            </a>
                                        </div>
                                    </div>
                             <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4 ">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col mb-3">
                                        <select id='course_sort_admin' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option value="new">Newest</option>
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                         </div>

                                <div class="row" id="content_with_thumbnail_course">
                                    @if ($my_course)
                                        @foreach ($my_course as $content)

                                            @if ($content->status == 1)
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
                                                    <div class="card col-12 p-0 border-radius0all">
                                                    <a href="content/view/{!!$content->id !!}">
                                             @if($content->image_url=='placeholder.png')
                                                @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Imageimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Videoimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Pdfimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Articleimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Audioimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/courseimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType==NULL  && $content->scope_type=='content')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/default3.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                 @else
                                                   @if($content->content_group=='Quiz')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/quizimg.jpg') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/featuredimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/syllabusimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Exercise')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/exercireimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Data')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/dataimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/websiteimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                @endif

                                             @else
                                               <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="253" height="163">
                                               @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-1.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-2.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-3.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-4.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-5.png') }}"> 
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-6.png') }}"> 
                                                   @endif 
                                               @else
                                                   @if($content->content_group=='Quiz')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-7.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-8.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-9.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Exercise')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-10.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Data')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-11.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-12.png') }}"> 
                                                   @endif 
                                               @endif
 

                                             @endif
                                                        </a>

                                                        <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">
                                                                    <div class="col-sm-6 p-0">
                                                                    @if($content->content_privacy == 0 && $content->scope_type=='course')
                                                                    <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Public</div>
                                                                    @else
                                                                    <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Restricted</div>
                                                                    @endif
                                                                    </div>

                                                            <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 pt-2 text-right"><small><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small></div>
                                                            </div>
                                                        <div class="card-body" style="flex:0;min-height: auto;">

                                                        <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                        <a href="search/all?query={!!$content->authors !!}">
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                       <a href="search/all?query={!!$content->affiliation !!}">
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                       </a>
                                                           <!-- <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>-->
                                                        </div>

                                                        <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                        <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Course ({{$content->count}} items) </h6></div>


                                                        <div class="card-footer bg-transparent border-0 justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                            <!-- <div class="m-0 text-colorblue200 d-flex bookmark"> -->
                                                        <div class="m-0 pt-3 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div>  
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
                                                    <div class="card col-12 p-0 opacity0point5 border-radius0all">
                                                     <a href="coursecontent/view/{!!$content->id !!}">
                                             @if($content->image_url=='placeholder.png')
                                                @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Imageimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Videoimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Pdfimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Articleimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Audioimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/courseimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->formatType==NULL  && $content->scope_type=='content')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/default3.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                 @else
                                                   @if($content->content_group=='Quiz')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/quizimg.jpg') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/featuredimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/syllabusimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Exercise')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/exercireimg.png') }}" alt="image" width="253" height="163">
                                                   @endif

                                                   @if($content->content_group=='Data')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/dataimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/websiteimg.png') }}" alt="image" width="253" height="163">
                                                   @endif
                                                @endif

                                             @else
                                               <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="253" height="163">
                                               @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-1.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-2.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-3.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-4.png') }}"> 
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-5.png') }}"> 
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-6.png') }}"> 
                                                   @endif 
                                               @else
                                                   @if($content->content_group=='Quiz')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-7.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-8.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                       <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-9.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Exercise')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-10.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Data')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-11.png') }}"> 
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                      <img class="icon-img" src="{{ asset('public/uploads/content/profile_images/icon-12.png') }}"> 
                                                   @endif 
                                               @endif
 

                                             @endif
                                                    </a>

                                                        <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">

                                                        <div class="col-sm-6 p-0">
                                                        @if($content->content_privacy == 0 && $content->scope_type=='course')
                                                        <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Public</div>
                                                        @else
                                                        <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Restricted</div>
                                                        @endif
                                                        </div>


                                                            <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 pt-2 text-right">
                                                            <small class=""><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small></div>
                                                        </div>
                                                        <div class="card-body">

                                                        <a href="coursecontent/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                        <a href="search/all?query={!!$content->authors !!}">
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="search/all?query={!!$content->affiliation !!}">
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                           <!-- <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>-->
                                                        </div>

                                                        <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                        <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Course ({{$content->count}} items) </h6></div>

                                                        @if ($content->status == 0)
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>
                                                        @endif

                                                        <div class="card-footer bg-transparent border-0  justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                            <!-- <div class="m-0 text-colorblue200 d-flex bookmark"> -->
                                                        <div class="m-0 pt-3 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div>  
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>

                                <!--List View course --->
                                <div class="row" id="content_with_list_course" style="display: none;">
                                    @if ($my_course)
                                        @foreach ($my_course as $content)
                                            @if ($content->status == 1 )
                                            <div class="col-md-8 mb-3">
                                                <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <img class="align-self-start mr-3" src="http://stage1.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$content->image_url}}" alt="" width="180">
                                                        </a>
                                                    <div class="media-body">
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">{{ $content->views_count }} Views</span>
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="search/all?query={!!$content->authors !!}">
                                                         <p>{{ $content->authors }}</p>
                                                        </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                        <a href="search/all?query={!!$content->affiliation !!}">
                                                            <span class="mr-2">{{ $content->affiliation }}</span>
                                                        </a>
                                                            <i class="fas fa-circle font-size6px mr-2"></i>
                                                            <span class="mr-2">{{ $content->difficulty_level }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
                                             @if($content->content_privacy == 0)
                                                 <span class="font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"> </span>
                                                     <div class="custom-control custom-checkbox mr-sm-2">

                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark{{ $content->id }}"></label>
                                                        </div>
                                                 @else
                                                  <span class="badge badge-secondary font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-2 pb-2"><i class="fas fa-graduation-cap font-size18px"></i> Restricted</span>
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark{{ $content->id }}"></label>
                                                        </div> 
                                               @endif
                                            </div>
                                            @else

                                            <div class="col-md-8 mb-3">
                                                <div class="media font-familyAtlasGroteskWeb-Regular font-size12px">
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <img class="align-self-start mr-3" src="http://stage1.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$content->image_url}}" alt="" width="180">
                                                        </a>
                                                    <div class="media-body">
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">{{ $content->views_count }} Views</span>
                                                        <a href="content/view/{!!$content->id !!}">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Bold">{{ $content->title }}</h6>
                                                        </a>
                                                        <p>{{ $content->authors }}</p>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                            <span class="mr-2">{{ $content->affiliation }}</span>
                                                            <i class="fas fa-circle font-size6px mr-2"></i>
                                                            <span class="mr-2">{{ $content->difficulty_level }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 
                                             @if($content->content_privacy == 0)
                                              
                                                 <span class="font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"> </span>
                                                     <div class="custom-control custom-checkbox mr-sm-2">

                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}"></label>
                                                        </div>
                                                 @else
                                                  <span class="badge badge-secondary font-familyAtlasGroteskWeb-Regular pl-3 pr-3 pt-3 pb-3"><i class="fas fa-graduation-cap font-size18px"></i> Restricted</span>
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox" for="bookmark{{ $content->id }}"></label>
                                                        </div> 
                                               @endif
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>

         </div>
                            <div class="tab-pane fade" id="pg-bookmarks" role="tabpanel" aria-labelledby="bookmarks">
                            <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_bkm">
                                                <i id="viewIcon5" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor3(5)"></i>
                                            </a>
                                            <a id="view-list_bkm">
                                                <i id="viewIcon6" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor3(6)"></i>
                                            </a>
                                        </div>
                                    </div>
                             <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4 ">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col mb-3">
                                        <select id='bookmark_sort_admin' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option value="new">Newest</option>
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 


                         </div>
                                <div class="row" id="content_with_thumbnail_admin">
                                </div>
                                <div class="row" id="content_with_list_admin" style="display: none;">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pg-history" role="tabpanel" aria-labelledby="history">
                            <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_hist">
                                                <i id="viewIcon7" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor4(7)"></i>
                                            </a>
                                            <a id="view-list_hist">
                                                <i id="viewIcon8" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor4(8)"></i>
                                            </a>
                                        </div>
                                    </div>
                             <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4 ">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col mb-3">
                                        <select id='history_sort_admin' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option value="new">Newest</option>
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 


                         </div>
                                <div class="row" id="content_with_thumbnail_history">
                                </div>
                                <div class="row" id="content_with_list_history" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="col-lg-5 col-md-6 d-flex">
                    @include('include.discussionBoard')
                </nav>
            </div>
        </div>
    </section>
    @include('include.footer')

    <!-- CONTENT -->
    <div class="modal fade p-0" id="moadalAddNewCourse" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="form-container modal-content border-radius0px">
                <form id="add_content_form_with_detail" action="{{ route('contentAddWithDetail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont2">Add New Content</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="lds-dual-ring" style="display:none"></div>

                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title2" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your content  a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title2" name="content_title2" placeholder="Content Name">
                                    <small id="content_title2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the content</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="author" name="author" placeholder="Enter Author">
                                    <small id="author_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="affiliation2" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Mention the name of the institution or affiliation</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="affiliation2" name="affiliation2" placeholder="Enter Affiliation">

                                    <small id="content_affiliation2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription2" class="mb-0 text-colorblue100">Description</label>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Content description is what your students will see.</p>
                                        <p class="text-colorblue200 font-size12px mb-0"><span id="count1"></span><span> </span></p>
                                    </div>

                                    <textarea class="form-control" name="content_discription2" id="content_discription2"></textarea>
                                    <small id="content_discription2_err" style="color: red"></small>
                                </div>





                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level2" name="difficulty_level2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if ($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}">{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level2_err" style="color: red"></small>
                                </div>




                            </div>
                            <div class="col-md-5">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain customFileMain1">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add thumbnail</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                    <div class="custom-file">
                                        <input accept="image/*" type="file" id="content_image2" name="content_image2" class="custom-file-input col-md-12 p-0 getVal2">
                                        <img id="blah" src="{{ asset('images/upload12.jpg') }}" alt="" width="100%" height="160" style="margin-top: -70px;">
                                         <label style="font-size: 40px; height: 32px;" class="custom-file-label col-md-12 d-flex align-items-center justify-content-between" for="content_image2"></label>
                                         <script>
                                          content_image2.onchange = evt => {
                                          const [file] = content_image2.files
                                          if (file) {
                                           blah.src = URL.createObjectURL(file)
                                            }
                                          }
                                        </script>
                                    </div>
                                </div>
                                   <!--  <div class="custom-file">
                                        <input id="content_image2" name="content_image2" type="file" class="custom-file-input col-md-12 p-0 getVal2" onchange="getVal2()">
                                        <div id="saveFileVal2" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="content_image2">Upload</label>
                                    </div> -->

                                    <small id="content_avatar2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories2" name="selectpickerCategories2" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Categories">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--<i class="fas fa-angle-down position-absolute marginDArrow"></i>--}}
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i><div>
                                    <small id="content_categories2_err" style="color: red"></small></div>

                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags to promote your content.</p>
                                    <select id="selectpickerTags2" name="selectpickerTags2" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        {{-- @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif--}}
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2-1"></i>
                                    <small id="content_tags2_err" style="color: red"></small>

                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 font-size14px">
                                    <label for="gender" class="font-familyAtlasGrotesk-Medium d-block">Select Restrictions</label>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="0" type="radio" id="option11" name="privacy_content" class="custom-control-input align-self-center" checked>
                                        <label class="custom-control-label" for="option11">Generally accessible</label>
                                    </div>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="1" type="radio" id="option22" name="privacy_content" class="custom-control-input">
                                        <label class="custom-control-label" for="option22">Restrict access to teachers only</label>
                                    </div>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="type" class="mb-0 text-colorblue100">Select Type</label>
                                    <select name="type" id="type" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="Video">Video</option>
                                        <option value="Pdf">Pdf</option>
                                        <option value="Article">Article</option>
                                        <option value="Image">Image</option>
                                        <option value="Audio">Audio</option>
                                    </select>
                                    <small id="type_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="embeded_url" class="text-colorblue100">Embed URL</label>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="embeded_url" name="embeded_url" placeholder="https://example.com">
                                    <small id="embeded_url_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="text-colorblue100">Add Asset</label>
                                    <div class="custom-file">
                                        <input id="asset" name="asset" type="file" class="custom-file-input col-md-4 p-0 getVal3" onchange="getVal3()">
                                        <div id="saveFileVal3" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg3">Upload</label>
                                    </div>
                                    <small id="asset_err" style="color: red"></small>
                                </div>


                            </div>
                            <div class="col-md-12">
                                <div id="description_div" class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="description" class="text-colorblue100">Article Text</label>
                                    <p class="float-right text-colorblue200 font-size12px mt-1"><span></span><span> </span></p>
                                    <textarea class="form-control" name="description" id="description" rows="6" cols="260"></textarea>
                                    <small id="description_div_err" style="color: red"></small>
                                </div>
                            </div>
                        </div>
                        <div class="reminder-text">By submitting materials, you confirm you are not violating others’ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the <a href="{{ route('termsConditions')}}" target="_blank">Terms of Service </a>.</div>

                    </div>
                    <div class="modal-footer box-shadow" style=" justify-content: flex-start;">
                        <!-- <p id="final_content2_msg" style="text-align: center; width: 80%;"></p> -->

                        <div class="alert alert-warning fade show alert-dismissible text-dark pt-0 pb-0 pr-3 pl-0 border-radius2em overflow-hidden font-size13px" role="alert" style="background:#fff5eb;float: left;">
                        <div class="text-warning p-2 mr-2" style="background:#ffecd8;display: inline-block;"><i class="fas fa-lightbulb mr-2"></i>Tips</div>
                        You can use “TAB” key to scroll through form.</div>
                        <div class="text-right col-sm-6 p-0">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add <i class="ml-3 fas fa-plus"></i><i class="ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


  <div class="modal fade p-0" id="moadalAddNewCourse1" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse1" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <form id="add_content_form" action="{{ route('contentAdd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont">Create New Course</h6>
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
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title" name="content_title" placeholder="Course Name">
                                    <small id="content_title_err3" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="Author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the course.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="Author" name="Author" placeholder="Enter Author Name">
                                    <small id="author3" style="color: red"></small>
                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="institution_or_source" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of institution or source of course.</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="institution_or_source" name="institution_or_source" placeholder="Institution / Source">
                                    <small id="content_affiliation_err3" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription" class="mb-0 text-colorblue100">Description</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Course description is what your students will see.</p>
                                    <p class="float-right font-size14px">
                                     <span id="count"></span><span> </span></p>
                                    <textarea class="form-control" name="content_discription" id="content_discription"></textarea>
                                     <!-- <textarea class="form-control" onkeyup="charcountupdate1(this.value)" name="content_discription" id="content_discription"></textarea> -->

                                     <small id="content_discription_err3" style="color: red"></small>                                    
                                </div>




                                {{--
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                      <input type="radio" name="privacy_content_01" id="option1" value="0" autocomplete="off" checked> Public
                                    </label>
                                    <label class="btn btn-secondary">
                                      <input type="radio" name="privacy_content_01" id="option2" value="1" autocomplete="off"> Private
                                    </label>
                                </div>
                                --}}
                            </div>
                            <div class="col-md-6">



                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain customFileMain1">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add thumbnail image for your course.</p>
                                     <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                    <div class="custom-file">
                                        <input accept="image/*" type="file" id="content_image" name="content_image" class="custom-file-input col-md-12 p-0 getVal2">
                                        <img id="blah1" src="{{ asset('images/upload12.jpg') }}" alt="" width="100%" height="160" style="margin-top: -70px;">
                                         <label style="font-size: 40px; height: 32px;" class="custom-file-label col-md-12 d-flex align-items-center justify-content-between" for="content_image"></label>
                                         <script>
                                          content_image.onchange = evt => {
                                          const [file] = content_image.files
                                          if (file) {
                                           blah1.src = URL.createObjectURL(file)
                                            }
                                          }
                                        </script>
                                    </div>
                                </div>
                                    <!-- <div class="custom-file">
                                        <input id="content_image" name="content_image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div> -->

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level" name="difficulty_level_c" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if ($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}">{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level_err3" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any 7 fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories" name="selectpickerCategories" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Select Category">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i><div> 

                                    <small id="content_categories_err" style="color: red"></small></div>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Upto 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add sub-fields tags to filter-topic.</p>
                                    <select id="selectpickerTags" name="selectpickerTags" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2"></i>
                                    <small id="content_tags_err" style="color: red;margin: 0.5em 0em 0em 1.2em !important;" class="textError position-absolute"></small>

                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mt-4 pt-2 mb-3 customDropDownInnerPg">
                                    <label for="Restriction" class="mb-0 text-colorblue100">Select Restriction</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose restriction of your content.</p>
                                    <select id="Restriction" name="privacy_content_01" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="0" selected>Generally Accessible (Default)</option>
                                        <!-- <option value="0">Generally Accessible (Default)</option> -->
                                        <option value="1">Restrict access to teachers only</option>

                                    </select>
                                    <small id="restriction_err" style="color: red" class="textError position-absolute"> </small>
                                </div>
<!--
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image" name="content_image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div> -->

                                {{-- <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="duration" class="mb-0 text-colorblue100">Duration</label>
                                    <input autocomplete="off" id="duration" name="duration" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" placeholder="e.g 00 mint">
                                    <small id="content_duration_err" style="color: red"></small>
                                </div> --}}
                            </div>
                        </div>

                           <p class="w-100 text-center text-colorblue200 font-familyAtlasGroteskWeb-Light ml-auto mr-auto max-width690px font-size14px"><strong>Note:</strong> To add content items to course, select desired content and click “Add to Course”</p>
                           <p class="w-100 text-center text-colorblue200 font-familyAtlasGroteskWeb-Light ml-auto mr-auto max-width690px font-size14px"><strong>Note:</strong> Courses created by users are for private use and accessible only through profile dashboard. If you wish to make your course a public course to featured on the general site, please submit to admin for approval when completed</p>

                    </div>
                    <div class="modal-footer box-shadow" style=" justify-content: flex-start;">
                        <!-- <p id="final_content_msg" style="text-align: center; width: 80%;"></p> -->
                        <div class="alert alert-warning fade show alert-dismissible text-dark pt-0 pb-0 pr-3 pl-0 border-radius2em overflow-hidden font-size13px" role="alert" style="background:#fff5eb;float: left;">
                        <div class="text-warning p-2 mr-2" style="background:#ffecd8;display: inline-block;"><i class="fas fa-lightbulb mr-2"></i>Tips</div>
                        You can use “TAB” key to scroll through form.</div>
                        <!-- <button type="submit" class="btn btn-customBtn6 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Cancel </span>
                            <div class="btn-bar"></div>
                        </button> -->
                        <div class="text-right col-sm-6 p-0">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add<i class="ml-3 fas fa-plus"></i> <i class="ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
    <style>
        .reminder-text {

          font-size: 13px;

          width: 100%;
          max-width: 575px;
          left: 179px;
          color: #606C80;
        }
      </style>
@endsection
@section('script')

  <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
            $(".editor").attr('data-placeholder', 'Description');
        });

 tinymce.init({
      selector: '#content_discription2',
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

$("#course_sort_admin").on("change", function () {
  coursesPgFilteradmin();
});

function coursesPgFilteradmin() {
  const sort = $("#course_sort_admin").val();
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
            <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 pt-2 text-right">
            <small class=""><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small></div>
             `;
          }
          else{
            var append_privacy= `
            <div class="col-sm-6 p-0">
             <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Restricted</div>
            </div> 
            <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 pt-2 text-right">
            <small class=""><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small></div>

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
        var course_privacy=`
    <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
        <div class="card col-12 p-0 border-radius0all">
            <a href="${base_url}content/view/${content[i].id}">
               ${new_image}
            </a>
               <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">
                 ${append_privacy}
               </div>
            <div class="card-body">

                <a href="${base_url}content/view/${content[i].id}">
                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                </a>
                <a href="search/all?query=${content[i].authors}">
                 <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors }</small></p>
                </a>
                <a href="search/all?query=${content[i].affiliation}">
                 <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
                </a>
            </div>
               <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                   <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${bk_icon_path}" width="25" class="mr-1"> Course (${content[i].count} items) </h6>
              </div>
        
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
                                                      <a href="search/all?query=${content[i].authors}">
                                                        <p>${content[i].authors }</p>
                                                      </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium"> 
                                                         <a href="search/all?query=${content[i].affiliation}">
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
                                             </div>    `;

      }
      else{
        var course_privacy= `
        <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
               <div class="card col-12 p-0 opacity0point5 border-radius0all">
                   <a href="${base_url}content/view/${content[i].id}">
                      ${new_image}
                  </a>
                       <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">
                            ${append_privacy}
                       </div>
                      <div class="card-body">
                           <a href="${base_url}content/view/${content[i].id}">
                              <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                          </a>
                          <a href="search/all?query=${content[i].authors}">
                           <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors}</small></p>
                          </a>
                          <a href="search/all?query=${content[i].affiliation}">
                           <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
                          </a>
                      </div>
                          <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                             <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="${bk_icon_path}" width="25" class="mr-1"> Course (${content[i].count} items) </h6>
                          </div>
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
                                                       <a href="search/all?query=${content[i].authors}">
                                                        <p>${content[i].authors }</p>
                                                       </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                         <a href="search/all?query=${content[i].affiliation}">
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


//content sorting//

$("#content_sort_admin2").on("change", function () {
  contentPgFilteradmin2();
});

function contentPgFilteradmin2() {
  const sort = $("#content_sort_admin2").val();
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
                         var privacy_status =  content[i].content_privacy;
                         if(privacy_status==0){ privacy_text="Public" }
                         else {privacy_text="Restricted "}
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
               <a href="search/all?query=${content[i].authors}">
                <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors }</small></p>
               </a>
               <a href="search/all?query=${content[i].affiliation}">
                <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
               </a>
            </div>
                <div class="text-right pr-4">${privacy_text}</div>
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
                                                      <a href="search/all?query=${content[i].authors}">
                                                        <p>${content[i].authors }</p>
                                                      </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                           <a href="search/all?query=${content[i].affiliation}">
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
                <a href="search/all?query=${content[i].authors}">
                 <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors }</small></p>
                </a>
                <a href="search/all?query=${content[i].affiliation}">
                 <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation} </small></p>
                </a>
            </div>
                <div class="text-right pr-4">${privacy_text}</div>
            <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>
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
                                                      <a href="search/all?query=${content[i].authors}">
                                                        <p>${content[i].authors }</p>
                                                      </a>
                                                        <p class="text-colorblue100 font-size10px mb-0 font-familyAtlasGroteskWeb-Medium">
                                                         <a href="search/all?query=${content[i].affiliation}">
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
                                             </div>    `;
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

    </script>


@endsection