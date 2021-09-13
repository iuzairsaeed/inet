@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
<style>
.icon-img {
    float: right;
    margin-top: -70px;
    position: relative;
}
.list-groupCusMain .list-group-item {
    text-align: center;
    width: 85px;
}
</style>
    @include('include.header')

    <input id="cat_id" value="{{ $cat->id }}" type="hidden">

    @auth
        <input id="auth_id" value="{{ Auth::user()->id }}" type="hidden">
        <input id="user_content_updated_list" value="{{ $user_content_updated_list }}" type="hidden">
        <?php $user_content_list = explode(",", $user_content_updated_list); ?>
    @endauth

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 d-flex">
                    <div class="col-md-12 bg-lightWhite100 pt-4 pb-4">
                        <div class="col p-0 text-colorblue200">
                            <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><a href="{{ route('searchCourses') }}">All Contents</a></p>
                            {{-- <p class="font-familyAtlasGroteskWeb-Regular font-size14px"><a href="{{ route('home') }}">Recommended Contents</a></p> --}}

                            <p class="border-bottom pb-1 opacity0point5 font-familyAtlasGroteskWeb-Medium font-size12px">Learn</p>
                        </div>

                        <div class="list-group mt-3 leftPanalList font-familyAtlasGroteskWeb-Medium font-size13px">
                            @if ($data['categories'])
                                @foreach ($data['categories'] as $category)
                                    <a href="{!! route('courses', ['category_id' => $category->id]) !!}" class="list-group-item list-group-item-action text-colorblue200 transitionall d-flex {{ $category->id == $cat->id ? 'active' : '' }}"><img class="mr-2" src="{{ asset('images/icons/' . $category->avatar) }}" alt="" width="25"> <span class="align-self-center">{!! $category->name !!}</span></a>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-8 pt-4 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                            <div class="col-md-12 border-bottom">
                                <h3 class="text-black font-familyAtlasGroteskWeb-Bold d-flex"><img class="mr-2" src="{{ asset('images/icons/' . $cat->avatar) }}" alt="" width="50"><span class="align-self-center">{!! $cat->name !!}</span></h3>
                                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">{!! $cat->description !!}</p>
                            </div>

                            <div class="col-md-12 border-bottom pt-3 pb-3 font-familyAtlasGroteskWeb-Medium">
                                <p class="text-grayDarkfont-size13px opacity0point5 mb-1">Related Topics</p>
                                <ul class="relatedTag">
                                    <li><button onclick="coursesTagButton(this)" class="btn btn-outline-customBtn1 font-size12px mt-2 border-radius0all opacity0point5 text-colorblue100 active" id="tag-button-All">All</button></li>

                                    @if ($tags)
                                        @foreach ($tags as $tag)
                                            <li><button onclick="coursesTagButton(this)" class="btn btn-outline-customBtn1 font-size12px mt-2 border-radius0all opacity0point5 text-colorblue100" id="tag-button-{{ $tag->name }}">{{ $tag->name }}</button></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                    <div class="col-md-12 mt-2">
                        <div class="col-md-12 list-groupCusMain p-0">
                        <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#pg-all" role="tab" aria-controls="All">All</a>
                            <a class="list-group-item list-group-item-action" id="list-course-list" data-toggle="list" href="#pg-course" role="tab" aria-controls="courses">Courses</a>
                            <a class="list-group-item list-group-item-action" id="list-contributors-bookmarks-list" data-toggle="list" href="#pg-syllabus" role="tab" aria-controls="Syllabus">Syllabus</a>
                            <a class="list-group-item list-group-item-action" id="list-contributor-history" data-toggle="list" href="#pg-exercises" role="tab" aria-controls="Exercises">Exercises</a>
                            <a class="list-group-item list-group-item-action" id="list-commented-history" data-toggle="list" href="#pg-data" role="tab" aria-controls="Data">Data</a>

                            <!-- <a class="list-group-item list-group-item-action" id="list-playlist-list" data-toggle="list" href="#pg-website" role="tab" aria-controls="Website">
                                Website</a> -->
                        </div>
                    </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pg-all" role="tabpanel" aria-labelledby="Content">
                            <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row justify-content-between">

                                        <div class="col-md-2">
                                <div class="row no-gutters" id="list-tab" role="tablist">
                                    <p style="padding-right: 50px;" class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">VIEW</p>
                                    
                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                
                                </div>
                            </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">FORMAT TYPE</p>
                                            <select id="content_formate_sort" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                 <option value="all">ALL</option>
                                                <option value="video">VIDEO</option>
                                                <option value="article">TEXT</option>
                                                <!-- <option value="pdf">PDF</option> -->
                                                <option value="image">IMAGE</option>
                                                <option value="audio">AUDIO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">All Levels</option>
                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">SORT BY</p>
                                    
                                        <select id="course_sort" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result">

                                    @if ($contents)
                                        @foreach ($contents as $content)
                                            <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
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
                                                    <!-- <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140"> -->              
                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                        <!-- <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p> -->  
                                                  </div>
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                        <div class="m-0 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Difficulty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label>
                                                           </div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div>  
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                            {{--<i class="fas fa-download"></i>--}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                          
                                                        </div>

                                                    </div>
                                                      @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                            <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.PNG') }}" width="25" class="mr-1"> Courses ( {{$content->coursecount}} items ) 
                                                           </h6>
                                                         </div>
                                                     @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div id="content_list_view" class="col-md-12 pt-4 pb-4" style="display: none">
                                @if ($contents)
                                    @foreach ($contents as $content)
                                        <div class="media mt-4 font-size14px">
                                            {{-- <img class="mr-3" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150"> --}}
                                            <div class="media-body font-familyAtlasGrotesk-Medium">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                </a>
                                                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                                    <div class="row justify-content-between">
                                                        <p class="text-colorblue200">
                                                   <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">{{ $content->authors }}</a><br><a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }}</a></p>
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                                     {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                                     <span class="mr-2">{!! $content->categories !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <nav aria-label="Page navigation">

                                    @if ($content_pages > 1)
                                        <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px" id="content_pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                            <?php
                                                for ($i=0; $i < $content_pages; $i++) {
                                                    $page = $i + 1;
                                                    $default_active = $page == 1 ? 'active disabled' : '';
                                                    echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_content_page($page)'>$page</a></li>";
                                                }
                                            ?>

                                            <li class="page-item"><a class="page-link" onclick='change_content_page(2)'>Next</a></li>
                                        </ul>
                                    @endif

                                </nav>
                            </div>
                            </div>

                        <div class="tab-pane fade" id="pg-course" role="tabpanel" aria-labelledby="Course">
                                                    <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row justify-content-between">

                                        <div class="col-md-2">
                                <div class="row no-gutters" id="list-tab" role="tablist">
                                    <p style="padding-right: 50px;" class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">VIEW</p>
                                    
                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                
                                </div>
                            </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">FORMAT TYPE</p>
                                            <select id="content_formate_sort1" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">ALL</option>
                                                <option value="video">VIDEO</option>
                                                <option value="article">TEXT</option>
                                                <!-- <option value="pdf">PDF</option> -->
                                                <option value="image">IMAGE</option>
                                                <option value="audio">AUDIO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level1" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">All Levels</option>
                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">SORT BY</p>
                                    
                                        <select id="course_sort1" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result1">

                                    @if ($courses_g)
                                        @foreach ($courses_g as $content)
                                            <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">

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
                                                    <!-- <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140"> -->              
                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                        <!-- <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p> -->
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                         <div class="m-0 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Diï¬€iculty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label>
                                                           </div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div> 
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                            {{--<i class="fas fa-download"></i>--}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                          
                                                        </div>
                                                    </div>
                                                      @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                            <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Courses ( {{$content->coursecount}} items ) 
                                                           </h6>
                                                         </div>
                                                     @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div id="content_list_view1" class="col-md-12 pt-4 pb-4" style="display: none">
                                @if ($courses_g)
                                    @foreach ($courses_g as $content)
                                        <div class="media mt-4 font-size14px">
                                            {{-- <img class="mr-3" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150"> --}}
                                            <div class="media-body font-familyAtlasGrotesk-Medium">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                </a>
                                                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                                    <div class="row justify-content-between">
                                                      <p class="text-colorblue200"><a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">{{ $content->authors }}</a> <br> <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }}</a></p>
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                                     {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                                     <span class="mr-2">{!! $content->categories !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <nav aria-label="Page navigation">

                                    @if ($course_pages > 1)
                                        <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px" id="content_pagination1">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                            <?php
                                                for ($i=0; $i < $course_pages; $i++) {
                                                    $page = $i + 1;
                                                    $default_active = $page == 1 ? 'active disabled' : '';
                                                    echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_content_page1($page)'>$page</a></li>";
                                                }
                                            ?>

                                            <li class="page-item"><a class="page-link" onclick='change_content_page1(2)'>Next</a></li>
                                        </ul>
                                    @endif

                                </nav>
                            </div>   
                            </div>

                  <div class="tab-pane fade show" id="pg-syllabus" role="tabpanel" aria-labelledby="Syllabus">
                                                <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row justify-content-between">

                                        <div class="col-md-2">
                                <div class="row no-gutters" id="list-tab" role="tablist">
                                    <p style="padding-right: 50px;" class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">VIEW</p>
                                    
                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                
                                </div>
                            </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">FORMAT TYPE</p>
                                            <select id="content_formate_sort2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">ALL</option>
                                                <option value="video">VIDEO</option>
                                                <option value="article">ARTICLE</option>
                                                <option value="pdf">PDF</option>
                                                <option value="image">IMAGE</option>
                                                <option value="audio">AUDIO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">All Levels</option>
                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">SORT BY</p>
                                    
                                        <select id="course_sort2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result2">

                                    @if ($syllabus_g)
                                        @foreach ($syllabus_g as $content)
                                            <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">

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
                                                    <!-- <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140"> -->              
                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                        <!-- <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p> -->
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                         <div class="m-0 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Diï¬€iculty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label>
                                                           </div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div>  
                                                        </div> 
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                            {{--<i class="fas fa-download"></i>--}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                          
                                                        </div>
                                                    </div>
                                                      @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                            <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Courses ( {{$content->coursecount}} items )  
                                                           </h6>
                                                         </div>
                                                     @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div id="content_list_view2" class="col-md-12 pt-4 pb-4" style="display: none">
                                @if ($syllabus_g)
                                    @foreach ($syllabus_g as $content)
                                        <div class="media mt-4 font-size14px">
                                            {{-- <img class="mr-3" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150"> --}}
                                            <div class="media-body font-familyAtlasGrotesk-Medium">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                </a>
                                                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                                    <div class="row justify-content-between">
                                                        <p class="text-colorblue200"><a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">{{ $content->authors }}</a> <br> <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }}</a></p>
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                                     {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                                     <span class="mr-2">{!! $content->categories !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <nav aria-label="Page navigation">

                                    @if ($Syllabus_pages > 1)
                                        <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px" id="content_pagination2">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                            <?php
                                                for ($i=0; $i < $Syllabus_pages; $i++) {
                                                    $page = $i + 1;
                                                    $default_active = $page == 1 ? 'active disabled' : '';
                                                    echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_content_page2($page)'>$page</a></li>";
                                                }
                                            ?>

                                            <li class="page-item"><a class="page-link" onclick='change_content_page2(2)'>Next</a></li>
                                        </ul>
                                    @endif

                                </nav>
                            </div>
                            </div>

                <div class="tab-pane fade show" id="pg-exercises" role="tabpanel" aria-labelledby="Exercises">
                                                <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row justify-content-between">

                                        <div class="col-md-2">
                                <div class="row no-gutters" id="list-tab" role="tablist">
                                    <p style="padding-right: 50px;" class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">VIEW</p>
                                    
                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                
                                </div>
                            </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">FORMAT TYPE</p>
                                            <select id="content_formate_sort3" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">ALL</option>
                                                <option value="video">VIDEO</option>
                                                <option value="article">TEXT</option>
                                                <!-- <option value="pdf">PDF</option> -->
                                                <option value="image">IMAGE</option>
                                                <option value="audio">AUDIO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level3" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">All Levels</option>
                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">SORT BY</p>
                                    
                                        <select id="course_sort3" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result3">

                                    @if ($exercise_g)
                                        @foreach ($exercise_g as $content)
                                            <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">

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
                                                    <!-- <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140"> -->              
                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                        <!-- <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p> -->
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                         <div class="m-0 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Diï¬€iculty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label>
                                                           </div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div> 
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                            {{--<i class="fas fa-download"></i>--}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                          
                                                        </div>
                                                    </div>
                                                      @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                            <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Courses ( {{$content->coursecount}} items )  
                                                           </h6>
                                                         </div>
                                                     @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div id="content_list_view3" class="col-md-12 pt-4 pb-4" style="display: none">
                                @if ($exercise_g)
                                    @foreach ($exercise_g as $content)
                                        <div class="media mt-4 font-size14px">
                                            {{-- <img class="mr-3" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150"> --}}
                                            <div class="media-body font-familyAtlasGrotesk-Medium">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                </a>
                                                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                                    <div class="row justify-content-between">
                                                        <p class="text-colorblue200"><a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">{{ $content->authors }}</a> <br> <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }}</a></p>
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                                     {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                                     <span class="mr-2">{!! $content->categories !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <nav aria-label="Page navigation">

                                    @if ($Exercise_pages > 1)
                                        <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px" id="content_pagination3">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                            <?php
                                                for ($i=0; $i < $Exercise_pages; $i++) {
                                                    $page = $i + 1;
                                                    $default_active = $page == 1 ? 'active disabled' : '';
                                                    echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_content_page3($page)'>$page</a></li>";
                                                }
                                            ?>

                                            <li class="page-item"><a class="page-link" onclick='change_content_page3(2)'>Next</a></li>
                                        </ul>
                                    @endif

                                </nav>
                            </div>
                            </div>

                                            <div class="tab-pane fade show" id="pg-data" role="tabpanel" aria-labelledby="Data">
                                                <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row justify-content-between">

                                        <div class="col-md-2">
                                <div class="row no-gutters" id="list-tab" role="tablist">
                                    <p style="padding-right: 50px;" class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">VIEW</p>
                                    
                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                
                                </div>
                            </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">FORMAT TYPE</p>
                                            <select id="content_formate_sort4" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">ALL</option>
                                                <option value="video">VIDEO</option>
                                                <option value="article">TEXT</option>
                                                <!-- <option value="pdf">PDF</option> -->
                                                <option value="image">IMAGE</option>
                                                <option value="audio">AUDIO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level4" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">All Levels</option>
                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">SORT BY</p>
                                    
                                        <select id="course_sort4" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result4">

                                    @if ($data_g)
                                        @foreach ($data_g as $content)
                                            <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">

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
                                                    <!-- <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140"> -->              
                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        </a>
                                                        <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">
                                                         <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        </a>
                                                        <!-- <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p> -->
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                         <div class="m-0 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Diï¬€iculty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label>
                                                           </div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div> 
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                            {{--<i class="fas fa-download"></i>--}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                          
                                                        </div>
                                                    </div>
                                                      @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                            <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Courses ( {{$content->coursecount}} items )  
                                                           </h6>
                                                         </div>
                                                     @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div id="content_list_view4" class="col-md-12 pt-4 pb-4" style="display: none">
                                @if ($data_g)
                                    @foreach ($data_g as $content)
                                        <div class="media mt-4 font-size14px">
                                            {{-- <img class="mr-3" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150"> --}}
                                            <div class="media-body font-familyAtlasGrotesk-Medium">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                </a>
                                                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                                    <div class="row justify-content-between">
                                                        <p class="text-colorblue200"><a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->authors !!}">{{ $content->authors }}</a> <br> <a href="http://pro.celeritas-solutions.com/inetEDPlatform/search/all?query={!!$content->affiliation !!}">{{ $content->affiliation }}</a></p>
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                                     {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                                     <span class="mr-2">{!! $content->categories !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <nav aria-label="Page navigation">

                                    @if ($Data_pages > 1)
                                        <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px" id="content_pagination4">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                            <?php
                                                for ($i=0; $i < $Data_pages; $i++) {
                                                    $page = $i + 1;
                                                    $default_active = $page == 1 ? 'active disabled' : '';
                                                    echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_content_page4($page)'>$page</a></li>";
                                                }
                                            ?>

                                            <li class="page-item"><a class="page-link" onclick='change_content_page4(2)'>Next</a></li>
                                        </ul>
                                    @endif

                                </nav>
                            </div>
                            </div>

              <div class="tab-pane fade show" id="pg-website" role="tabpanel" aria-labelledby="Website">
                                                <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row justify-content-between">

                                        <div class="col-md-2">
                                <div class="row no-gutters" id="list-tab" role="tablist">
                                    <p style="padding-right: 50px;" class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">VIEW</p>
                                    
                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                
                                </div>
                            </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">FORMAT TYPE</p>
                                            <select id="content_formate_sort5" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">ALL</option>
                                                <option value="video">VIDEO</option>
                                                <option value="article">TEXT</option>
                                                <!-- <option value="pdf">PDF</option> -->
                                                <option value="image">IMAGE</option>
                                                <option value="audio">AUDIO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level5" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                                <option value="all">All Levels</option>
                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">SORT BY</p>
                                    
                                        <select id="course_sort5" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue pl-2">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result5">

                                    @if ($website_g)
                                        @foreach ($website_g as $content)
                                            <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">

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
                                                    <!-- <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image" width="100%" height="140"> -->              

                                                    </a>
                                                    <div style="border-bottom: 2px solid #b1b1b1 !important; padding-bottom: 8px !important;" class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right"><span style="padding-right: 8px;" class="fas fa-eye"></span>{{ $content->views_count }}</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        <!-- <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p> -->
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                         <div class="m-0 text-colorblue200 bookmark float-left">
                                                          <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size10px mb-0">Diï¬€iculty</p>
                                                           <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="1" {{ ($content->difficulty_level == 'Beginner') ? 'checked="checked"' : '' }}>
                                                            </label>
                                                           </div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="2" {{ ($content->difficulty_level == 'Introductory') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline" >
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="3" {{ ($content->difficulty_level == 'Intermediate') ? 'checked="checked"' : '' }}>
                                                            </label></div>
                                                         <div style="margin-right: -0.25rem;" class="form-check form-check-inline">
                                                           <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="return false;" value="4" {{ ($content->difficulty_level == 'Advanced') ? 'checked="checked"' : '' }}>
                                                            </label></div> 
                                                        </div>
                                                        <div class="mt-3 text-colorblue200 d-flex bookmark float-right">
                                                            {{--<i class="fas fa-download"></i>--}}
                                                            @auth
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                            @endauth
                                                          
                                                        </div>
                                                    </div>
                                                      @if($content->scope_type=='course')
                                                         <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                            <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Courses ( {{$content->coursecount}} items )  
                                                           </h6>
                                                         </div>
                                                     @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div id="content_list_view5" class="col-md-12 pt-4 pb-4" style="display: none">
                                @if ($website_g)
                                    @foreach ($website_g as $content)
                                        <div class="media mt-4 font-size14px">
                                            {{-- <img class="mr-3" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="placeholder image" width="150"> --}}
                                            <div class="media-body font-familyAtlasGrotesk-Medium">
                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                </a>
                                                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                                    <div class="row justify-content-between">
                                                        <p class="text-colorblue200">{{ $content->authors }} <br> {{ $content->affiliation }}</p>
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                                     {{-- <span class="mr-2">{{ $content->duration }}</span> <i class="fas fa-circle font-size6px mr-2"></i>  --}}
                                                     <span class="mr-2">{!! $content->categories !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <nav aria-label="Page navigation">

                                    @if ($Website_pages > 1)
                                        <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px" id="content_pagination5">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                            <?php
                                                for ($i=0; $i < $Website_pages; $i++) {
                                                    $page = $i + 1;
                                                    $default_active = $page == 1 ? 'active disabled' : '';
                                                    echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_content_page5($page)'>$page</a></li>";
                                                }
                                            ?>

                                            <li class="page-item"><a class="page-link" onclick='change_content_page5(2)'>Next</a></li>
                                        </ul>
                                    @endif

                                </nav>
                            </div>
                            </div>

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
