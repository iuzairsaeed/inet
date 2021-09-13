@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    @auth
        <input id="auth_id" value="{{ Auth::user()->id }}" type="hidden">
        <input id="user_content_updated_list" value="{{ $user_content_updated_list }}" type="hidden">
        <?php $user_content_list = explode(",", $user_content_updated_list); ?>
    @endauth


    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-4 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <form class="textHover" id="search_val_form">
                                    <div class="field">
                                        <input type="text" id="search_val" name="search_val" class="field-input text-darkBlue">
                                        <label for="search_val" class="field-label">Search</label>
                                    </div>
                                </form>
                            </div>


                            <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                <div class="row no-gutters">
                                    <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                    <a id="view-thumbnail"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                    <a id="view-list"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                </div>

                            </div>

                            <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col mb-3">
                                        <select id="course_sort" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 bg-lightWhite100 p-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-5 col-md-6 mb-sm-4">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">CONTENT TYPE</p>
                                            <div class="form-inline font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px d-flex justify-content-between">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="content_type_video" id="video">
                                                        <label class="custom-control-label text-colorblue200 line-height2pot1" for="video">VIDEO</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mt-1">
                                                        <input type="checkbox" class="custom-control-input" value="content_type_article" id="article">
                                                        <label class="custom-control-label text-colorblue200 line-height2pot1" for="article">ARTICLE</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mt-1">
                                                        <input type="checkbox" class="custom-control-input" value="content_type_pdf" id="pdf">
                                                        <label class="custom-control-label text-colorblue200 line-height2pot1" for="pdf">PDF</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mt-1">
                                                        <input type="checkbox" class="custom-control-input" value="content_type_image" id="image">
                                                        <label class="custom-control-label text-colorblue200 line-height2pot1" for="image">IMAGE</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mt-1">
                                                        <input type="checkbox" class="custom-control-input" value="content_type_audio" id="audio">
                                                        <label class="custom-control-label text-colorblue200 line-height2pot1" for="audio">AUDIO</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-5 col-md-6">
                                            <p class="font-familyAtlasGroteskWeb-Bold text-grayDark mb-1">DIFFICULTY LEVEL</p>
                                            <select id="difficulty_level" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                                <option value="all">All Levels</option>

                                                @if ($difficulty_level)
                                                    @foreach ($difficulty_level as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                                <div class="row" id="content_result">

                                    @if ($contents)
                                        @foreach ($contents as $content)
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex bookmarkCheck">
                                                <div class="card col-12 p-0 border-radius0all">
                                                    <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                    <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image">
                                                    </a>
                                                    <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                        {{--<small class="float-left">{{ $content->downloaded_count }} Downloads</small>--}}
                                                        <small class="float-right">{{ $content->views_count }} Views</small>
                                                    </div>
                                                    <div class="card-body">

                                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                        </a>
                                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                        <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                        <div class="m-0 text-colorblue200 d-flex bookmark">
                                                            {{--<i class="fas fa-download"></i>--}}
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
                                                        <p class="text-colorblue200">{{ $content->authors }} <br> {{ $content->affiliation }}</p>
                                                        {{-- <p class="text-colorblue200"></p> --}}
                                                    </div>
                                                </div>
                                                <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2"></span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">{{ $content->categories }}</span></p>
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
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('include.footer')

@endsection
