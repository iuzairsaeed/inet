@extends('layouts.app')

@section('title') INET ED Platform :: Search @endsection

@section('content')
<style>
.icon-img {
    float: right;
    margin-top: -70px;
    position: relative;
}
</style>
@include('include.header')

    @auth
        <input id="auth_id" value="{{ Auth::user()->id }}" type="hidden">
        <input id="user_content_updated_list" value="{{ $user_content_updated_list }}" type="hidden">
        <?php $user_content_list = explode(",", $user_content_updated_list); ?>
    @endauth

    @if(isset($matchUser[0]->name))

    <section class="bg-white pt-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Authors</h1>
                </div>

                    @if ($users)
                        @foreach ($users as $user)
                        <div class="col-lg-3 col-md-4 mb-3 d-flex">
                            <div class="card col-md-12 p-0 border-radius0px">
                                <div class="col text-center pb-4 pt-4">
                                    <a class="d-inline-block"  href="{!! route('discBoardprofile', ['u_id' => $user->id]) !!}" style="cursor: pointer;">
                                        <div class="thumbnailImg_WH3 thumbnailImg mr-0" style="background: url({{ asset('public/uploads/profile_images/' . $user->avatar) }}) no-repeat; background-size: cover; cursor:pointer"></div>
                                    </a>
                                    <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">{{ $user->name }}</h5>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">{{ $user->role }}</span>
                                </div>
                            </div>
                        </div>
                       @endforeach
                    @endif

            </div>
        </div>
    </section>

    @endif

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   <h1>Content</h1>       
                </div>
                <div class="col-md-12 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                                    
                                        <select id='content_sort_search' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option value="new">Newest</option>
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                        </select>

                            <div id="content_thumbnail_view" class="col-md-12 pb-4">
                                <div class="row" id="content_result">
                                    @if ($contents)
                                        @foreach ($contents as $content)
                                         @if($content->content_privacy==1)
                                           @auth

                                           @if (Auth::user()->role_id != 2)


                                           <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck">
                                            <div class="card col-12 p-0 border-radius0all">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                <!--<img class="card-img-top" width="253" height="163" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image">-->
                                             @if($content->image_url=='placeholder.png')
                                                @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Imageimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Videoimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Pdfimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Articleimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Audioimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/courseimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType==NULL  && $content->scope_type=='content')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/default3.png') }}" alt="image" width="100%" height="140">
                                                   @endif

                                                 @else
                                                   @if($content->content_group=='Quiz')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/quizimg.jpg') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/featuredimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/syllabusimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif

                                                   @if($content->content_group=='Exercise')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/exercireimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif

                                                   @if($content->content_group=='Data')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/dataimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/websiteimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                @endif

                                             @else
                                               <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140">
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
                                                    {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small> --}}
                                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                </div>
                                                <div class="card-body">
                                                    <!--<p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p>-->
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                    </a>
                                                    <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                     <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                    </a>
                                                    <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                     <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                    </a>
                                                </div>
                                                @if($content->scope_type=='course')
                                                  <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                    <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Course ({{$content->count}} items)
                                                    </h6>
                                                  </div>
                                                @endif
                                                <div class="card-footer bg-transparent border-0 justify-content-between">
                                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                    <!--<div class="m-0 text-colorblue200 d-flex bookmark">-->
                                                       <div class="m-0 pt-2 text-colorblue200 bookmark float-left">
                                                          <!--<p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>-->
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
                                                        {{-- <i class="fas fa-download"></i> --}}
                                                        @auth
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                        </div>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                           @endif


                                        @endauth

                                            @else
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                   <!-- <img class="card-img-top" width="253" height="163" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image"> -->
                                             @if($content->image_url=='placeholder.png')
                                                @if($content->content_group==NULL)
                                                   @if($content->formatType=='Image')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Imageimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Video')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Videoimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Pdf')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Pdfimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Article')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Articleimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType=='Audio')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/Audioimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->scope_type=='course')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/courseimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->formatType==NULL  && $content->scope_type=='content')
                                                      <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/default3.png') }}" alt="image" width="100%" height="140">
                                                   @endif

                                                 @else
                                                   @if($content->content_group=='Quiz')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/quizimg.jpg') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->content_group=='Featured')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/featuredimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->content_group=='Syllabus')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/syllabusimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif

                                                   @if($content->content_group=='Exercise')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/exercireimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif

                                                   @if($content->content_group=='Data')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/dataimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                   @if($content->content_group=='Website')
                                                     <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/websiteimg.png') }}" alt="image" width="100%" height="140">
                                                   @endif
                                                @endif

                                             @else
                                               <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140">
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
                                                        {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small> --}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">
                                                        <!--<p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p>-->
                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                    </div>
                                                       @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                           <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Course ({{$content->count}} items)
                                                           </h6>
                                                        </div>
                                                      @endif
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                        <!--<div class="m-0 text-colorblue200 d-flex bookmark">-->
                                                        <div class="m-0 pt-2 text-colorblue200 bookmark float-left">
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
                                                            {{-- <i class="fas fa-download"></i> --}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           @endif





                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@include('include.footer')
@endsection

@section('script')

<script type="text/javascript">

$("#content_sort_search").on("change", function () {
  contentPgFiltersearchNew();
});

function contentPgFiltersearchNew() {
  const sort = $("#content_sort_search").val();
var url_string = window.location.href; 
var url = new URL(url_string);
var query = url.searchParams.get("query");
console.log(query);
  const filter_data = {
    sort,
     query
  };

  console.log("SEND " + JSON.stringify(filter_data));

  $.ajax({
    type: "POST",
    url: `${base_url}contentsearchsort/filter`,
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
      var statusnum2=2;
      bk_icon_path="images/bookicon.png";
      if (location.host == "127.0.0.1:8000") {
        images_path = "/uploads/content/profile_images/";
      } else {
        images_path = "/inetEDPlatform/public/uploads/content/profile_images/";
      }
      $("#content_result").html("");

   
            if (content.length) {
        for (i = 0; i < content.length; i++) {
            let bookmarkBtn = auth_id ?
           `<div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
           onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark-${content[i].id}">
           <label class="custom-control-label bookmarkCheckBox" for="bookmark-${content[i].id}"></label></div>` 
           : "";
           let bookmarkBtnlist = auth_id;
           if(bookmarkBtnlist = auth_id){
                 var append_privacy_list=  `
                                         <div class="custom-control custom-checkbox mr-sm-2"><input ${userContentList.includes(content[i].id.toString()) ? "checked" : ""} 
                                          onclick="bookmark(this)" value=${JSON.stringify([content[i].id,Number(auth_id)])} type="checkbox" class="custom-control-input" id="bookmark${content[i].id}">
                                         <label class="custom-control-label bookmarkCheckBox" for="bookmark${content[i].id}"></label></div>` 
         
           }
           if(content[i].scope_type==str){
                var scope=  ` <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                   <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="http://pro.celeritas-solutions.com/inetEDPlatform/images/bookicon.png" width="25" class="mr-1"> Course (${content[i].count} items)
                                    </h6>
                             </div>`;
            }else{
                var scope= ``;

             }

         if(content[i].image_url!='placeholder.png'){
            if(content[i].content_group==null){
                  if(content[i].formatType=='Image'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${images_path + 'icon-1.png'}"> `;}
                  if(content[i].formatType=='Video'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${images_path + 'icon-2.png'}"> `;}
                  if(content[i].formatType=='Pdf'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${images_path + 'icon-3.png'}"> `;}
                  if(content[i].formatType=='Article'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${images_path + 'icon-4.png'}"> `;}
                  if(content[i].formatType=='Audio'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${images_path + 'icon-5.png'}"> `;}
                  if(content[i].scope_type=='course'){
                    new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                    <img class="icon-img" src="${images_path + 'icon-6.png'}"> `;}
            }
            else{
              if(content[i].content_group=='Quiz'){
                new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                <img class="icon-img" src="${images_path + 'icon-7.png'}"> `;}
                if(content[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${images_path + 'icon-8.png'}"> `;}
                if(content[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${images_path + 'icon-9.png'}"> `;}
                if(content[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${images_path + 'icon-10.png'}"> `;}
                if(content[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${images_path + 'icon-11.png'}"> `;}
                if(content[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${images_path + content[i].image_url}" alt="image" width="100%" height="140">
                  <img class="icon-img" src="${images_path + 'icon-12.png'}"> `;}

             }

          }else
            {  
            if(content[i].content_group==null){
                if(content[i].formatType=='Image'){
                new_image=`<img class="card-img-top" src="${images_path + 'Imageimg.png'}" alt="image" width="100%" height="140">`;}
                if(content[i].formatType=='Video'){
                new_image=`<img class="card-img-top" src="${images_path + 'Videoimg.png'}" alt="image" width="100%" height="140">`;}
                if(content[i].formatType=='Pdf'){
                new_image=`<img class="card-img-top" src="${images_path + 'Pdfimg.png'}" alt="image" width="100%" height="140">`;}
                if(content[i].formatType=='Article'){
                new_image=`<img class="card-img-top" src="${images_path + 'Articleimg.png'}" alt="image" width="100%" height="140">`;}
                if(content[i].formatType=='Audio'){
                new_image=`<img class="card-img-top" src="${images_path + 'Audioimg.png'}" alt="image" width="100%" height="140">`;}
                if(content[i].scope_type=='course'){
                new_image=`<img class="card-img-top" src="${images_path + 'courseimg.png'}" alt="image" width="100%" height="140">`;}
                if(content[i].formatType==null && content[i].scope_type=='content'){
                 new_image=`<img class="card-img-top" src="${images_path + 'default3.png'}" alt="image" width="100%" height="140">`;}
            }else{  
                  if(content[i].content_group=='Quiz'){
                  new_image=`<img class="card-img-top" src="${images_path + 'quizimg.jpg'}" alt="image" width="100%" height="140">`;}
                  if(content[i].content_group=='Featured'){
                  new_image=`<img class="card-img-top" src="${images_path + 'featuredimg.png'}" alt="image" width="100%" height="140">`;}
                  if(content[i].content_group=='Syllabus'){
                  new_image=`<img class="card-img-top" src="${images_path + 'syllabusimg.png'}" alt="image" width="100%" height="140">`;}
                  if(content[i].content_group=='Exercise'){
                  new_image=`<img class="card-img-top" src="${images_path + 'exercireimg.png'}" alt="image" width="100%" height="140">`;}
                  if(content[i].content_group=='Data'){
                  new_image=`<img class="card-img-top" src="${images_path + 'dataimg.png'}" alt="image" width="100%" height="140">`;}
                  if(content[i].content_group=='Website'){
                  new_image=`<img class="card-img-top" src="${images_path + 'websiteimg.png'}" alt="image" width="100%" height="140">`;}
            }
         } 
            if (bookmarkBtn != statusnum2){
                var auth2= `             <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck">
                                            <div class="card col-12 p-0 border-radius0all">
                                                <a href="${base_url}content/view/${content[i].id}">
                                                ${new_image}
                                                </a>
                                                <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                    {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small> --}}
                                                    <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small>
                                                </div>
                                                <div class="card-body">
                                                    <a href="${base_url}content/view/${content[i].id}">
                                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                                                    </a>
                                                    <a href="${base_url}search/all?query=${content[i].authors}">
                                                     <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors}</small></p>
                                                    </a>
                                                    <a href="${base_url}search/all?query=${content[i].affiliation}">
                                                     <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
                                                    </a>
                                                </div>
                                                     ${scope}
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
                                                           ${append_privacy_list}
                                                        {{-- <i class="fas fa-download"></i> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                 `;
            }
            if(content[i].content_privacy==statusnum){
                 var append_auth= `
                        ${auth2}
                  
                    `;
                 
            }
           else{

                    var append_auth=`
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                <a href="${base_url}content/view/${content[i].id}">
                                                ${new_image}
                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small> --}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>${content[i].views_count}</small>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="${base_url}content/view/${content[i].id}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">${content[i].title}</h6>
                                                        </a>
                                                    <a href="${base_url}search/all?query=${content[i].authors}">
                                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].authors}</small></p>
                                                    </a>
                                                    <a href="${base_url}search/all?query=${content[i].affiliation}">
                                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">${content[i].affiliation}</small></p>
                                                    </a>
                                                    </div>
                                                      ${scope}
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
                                                             ${append_privacy_list}
                                                            {{-- <i class="fas fa-download"></i> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                    `;
                 }



    $("#content_result").append(`

    ${append_auth}
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

