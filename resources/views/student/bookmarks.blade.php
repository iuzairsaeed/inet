@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
    <style>
        .bookmarkCheckBox {
            border: 1px solid #dee2e6;
            border-radius: 100%;
            width: 3em;
            height: 3em;
            left: 0px;
        }
.bookmarkCheckBox2.custom-control-label::after {
    top: 0.6rem !important;
    left: 0.82rem !important;
    color: #5F6B7F;
}

        .bookmarkCheck .custom-control-label::after {
            top: 0.75rem ;
            left: 1rem ;
            color: #5F6B7F;

        }

        .bookmarkCheck .custom-control-label::before {
            top: 0.75rem !important;
            left: 1rem !important;
            content: "\F02E" !important;
            background-color: transparent !important;
            color: #5F6B7F;
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
                <div class="col-lg-7 col-md-6">
                    <h3 class="font-familyAtlasGroteskWeb-Bold text-black">My Bookmarks</h3>
                            <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_stu"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                            <a id="view-list_stu"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>                                        </div>
                                    </div>
                             <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4 ">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col mb-3">
                                        <select id='sort_student' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option value="new">Newest</option>
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 


                         </div>
                                <div class="row" id="content_with_thumbnail_student">
                    @if ($my_bookmarks)
                        @foreach ($my_bookmarks as $content)
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
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </div>
                                                        <div class="card-footer bg-transparent border-0 justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
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
                                                                    <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $content->id }}" onclick="location.reload()"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                        @endforeach
                    @endif


                                </div>
                                <div class="row" id="content_with_list_student" style="display: none;">
                    @if ($my_bookmarks)
                        @foreach ($my_bookmarks as $content)
                            <div class="media mt-4 font-size14px col-md-12">
                                <img class="mr-3" src="{{ asset('/public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150">
                                <div class="media-body font-familyAtlasGrotesk-Medium pt-2">
                                    <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Regular font-weight-normal font-size12px p-2 text-brown mb-2">{{ $content->views_count }} Views</span>
                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                        <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                    </a>
                                    <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                        <div class="row justify-content-between">
                                            <p class="text-colorblue200">
                                              <a href="search/all?query={!!$content->authors !!}"> {{ $content->authors }} </a> <br>
                                                <a href="search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }} </a>
                                            </p>
                                            <div class="col-md-4 mb-3 bookmarkCheck d-flex justify-content-between align-items-center"> 

                                            <p class="text-ferozy"><span class="mr-2 pl-3 pr-3 pt-3 pb-3"></span> </p>
                                                  <span class="font-familyAtlasGroteskWeb-Regular"></span>
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark{{ $content->id }}">
                                                            <label class="custom-control-label bookmarkCheckBox bookmarkCheckBox2" for="bookmark{{ $content->id }}" onclick="location.reload()"></label>
                                                        </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <p class="text-colorblue100 font-size10px">

                                        <span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                        {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                        <span class="mr-2">{{ $content->categories }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                                </div>
                            </div>
                 
                <nav class="col-lg-5 col-md-6 d-flex">
                    @include('include.discussionBoard')
                </nav>

                </div>
            </div>
        </div>
    </section>

    @include('include.footer')
@endsection
