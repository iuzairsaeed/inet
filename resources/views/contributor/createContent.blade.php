@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <style>
        .dropdown-toggle {
            padding: 5px !important;
        }

        .toolbar {
            width: 100%;
        }
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid black;
            border-color: black transparent black transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>

    <?php
            // function getYoutubeEmbedUrl($url){
            //     $urlParts   = explode('/', $url);
            //     $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
            //     return 'https://www.youtube.com/embed/' . $vidid[0] ;
            // }




     ?>

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 d-flex height45em">
                    <div class="col-md-12 bg-lightWhite100 pt-4 pb-4">
                        <div class="col border-bottom pb-4 p-0">
                            <h6 class="text-black font-familyAtlasGrotesk-Bold d-flex"><span>{{ $content->title }}</span><i class="fas fa-angle-down text-colorMahroon600 align-self-center ml-2"></i></h6>
                            <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px">{{ $content->categories }}</p>
                        </div>

                        <div class="list-group mt-3 leftPanalList font-familyAtlasGroteskWeb-Regular font-size13px">
                            <a href="#" class="list-group-item list-group-item-action active text-colorblue200 transitionall">Add content</a>
                            {{-- <a href="#" class="list-group-item list-group-item-action text-colorblue200 transitionall">Settings</a> --}}
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-8 pt-4 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                    <div class="col p-0">
                        <h6 class="text-colorMahroon700 d-flex"><i class="fas fa-angle-left text-colorMahroon700 align-self-center mr-2"></i><span><a style="color: #842A45; text-decoration: none;" href="{{ route('home') }}">Dashboard</a></span></h6>
                    </div>
                    <div class="col-md-12 p-0">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0 d-flex"><span>Add content</span> <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 ml-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i></span></h3>
                                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">You can add content items for approval by an INET ED. Administrator. Simply click on the Add Content button below and keep adding items until you are done. Hit "Submit" when you are ready to send your submission to the INET ED. Admin Team!</p>
                            </div>
                            <div class="col-md-4 text-right mb-3">
                                {{--<button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">ADD CONTENT <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                    <div class="btn-bar"></div>
                                </button>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-0 home-dnd">
                        @if ($content->section_count)
                            <?php for ($i=0; $i < $content->section_count; $i++) {  ?>
                                <h6>Section {{ $i + 1 }}</h6>

                                @if ($content_detils)
                                    @foreach ($content_detils as $step)

                                        @if($step->section == ($i + 1))
                                            @if($step->type == "Video")

                                                <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">
                                                    <div class="col-12 border mb-4 home-dnd-item cursormove bg-white p-0" >
                                                        <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                            <div class="col-md-6 d-flex">
                                                                <i class="fas fa-align-justify align-self-center mr-3 opacity0point5 "></i>
                                                                <img src="{{ asset('images/icons/videoIcon.png') }}" alt="" height="30">
                                                                <div class="align-self-center ml-3">
                                                                    <p class="mb-0">{{ $step->title }}</p>
                                                                    <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 align-self-center">
                                                                {{-- @if ($step->duration)
                                                                    <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                                @endif --}}
                                                            </div>
                                                            <div class="col-md-3 text-right align-self-center">
                                                                <a href="#" class="border-radius0all w-100  text-left p-0 pt-3 pb-3 font-familyAtlasGrotesk-Medium collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="false" aria-controls="collapse-{{ $step->id }}">
                                                                <span>View</span>
                                                                <i class="fa text-ferozy ml-3"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div id="collapse-{{ $step->id }}" class="collapse pt-3" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="col-md-12 p-0 d-flex">
                                                                @if ($step->asset)
                                                                    <video class="w-100" controls>
                                                                        <source src="{{ asset('public/uploads/content/videos/' . $step->asset) }}" type="video/mp4">
                                                                    </video>
                                                                @else


                                                                    <iframe width="1280" height="480" src="{{$step->embeded_url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif($step->type == "Pdf")

                                                <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">
                                                    <div class="col-12 border mb-4 home-dnd-item cursormove bg-white p-0" >
                                                        <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                            <div class="col-md-6 d-flex">
                                                                <i class="fas fa-align-justify align-self-center mr-3 opacity0point5 "></i>
                                                                <h1 class="mb-0"><i class="far fa-file-pdf"></i></h1>
                                                                <div class="align-self-center ml-3">
                                                                    <p class="mb-0">{{ $step->title }}</p>
                                                                    <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 align-self-center">
                                                                {{-- @if ($step->duration)
                                                                    <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                                @endif --}}
                                                            </div>
                                                            <div class="col-md-3 text-right align-self-center">
                                                                <a href="#" class="border-radius0all w-100  text-left p-0 pt-3 pb-3 font-familyAtlasGrotesk-Medium collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="false" aria-controls="collapse-{{ $step->id }}">
                                                                <span>View</span>
                                                                <i class="fa text-ferozy ml-3"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div id="collapse-{{ $step->id }}" class="collapse pt-3" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="col-md-12">
                                                                <object data="{{ asset('public/uploads/content/pdf/' . $step->asset) }}" name="pdfviewer" width="100%" height="600"></object>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif($step->type == "Article")

                                                <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">
                                                    <div class="col-12 border mb-4 home-dnd-item cursormove bg-white p-0" >
                                                        <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                            <div class="col-md-6 d-flex">
                                                                <i class="fas fa-align-justify align-self-center mr-3 opacity0point5 "></i>
                                                                <h1 class="mb-0"><i class="far fa-file-alt"></i></h1>
                                                                <div class="align-self-center ml-3">
                                                                    <p class="mb-0">{{ $step->title }}</p>
                                                                    <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 align-self-center">
                                                                {{-- @if ($step->duration)
                                                                    <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                                @endif --}}
                                                            </div>
                                                            <div class="col-md-3 text-right align-self-center">
                                                                <a href="#" class="border-radius0all w-100  text-left p-0 pt-3 pb-3 font-familyAtlasGrotesk-Medium collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="false" aria-controls="collapse-{{ $step->id }}">
                                                                    <span>View</span>
                                                                    <i class="fa text-ferozy ml-3"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div id="collapse-{{ $step->id }}" class="collapse pt-3" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="col-md-12">
                                                                {!! $step->description !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif($step->type == "Image")

                                                <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">
                                                    <div class="col-12 border mb-4 home-dnd-item cursormove bg-white p-0" >
                                                        <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                            <div class="col-md-6 d-flex">
                                                                <i class="fas fa-align-justify align-self-center mr-3 opacity0point5 "></i>
                                                                <img src="{{ asset('images/icons/videoIcon.png') }}" alt="" height="30">
                                                                <div class="align-self-center ml-3">
                                                                    <p class="mb-0">{{ $step->title }}</p>
                                                                    <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 align-self-center">
                                                                {{-- @if ($step->duration)
                                                                    <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> {{ $step->duration }}</span>
                                                                @endif --}}
                                                            </div>
                                                            <div class="col-md-3 text-right align-self-center">
                                                                <a href="#" class="border-radius0all w-100  text-left p-0 pt-3 pb-3 font-familyAtlasGrotesk-Medium collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="false" aria-controls="collapse-{{ $step->id }}">
                                                                <span>View</span>
                                                                <i class="fa text-ferozy ml-3"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div id="collapse-{{ $step->id }}" class="collapse pt-3" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="col-md-12">
                                                                <img class="w-100" src="{{ asset('public/uploads/content/images/' . $step->asset) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif($step->type == "Audio")

                                                <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">
                                                    <div class="col-12 border mb-4 home-dnd-item cursormove bg-white p-0" >
                                                        <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                                            <div class="col-md-6 d-flex">
                                                                <i class="fas fa-align-justify align-self-center mr-3 opacity0point5 "></i>
                                                                <img src="{{ asset('images/icons/videoIcon.png') }}" alt="" height="30">
                                                                <div class="align-self-center ml-3">
                                                                    <p class="mb-0">{{ $step->title }}</p>
                                                                    <p class="mb-0 font-size10px opacity0point5">{{ strtoupper($step->type) }}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 align-self-center">
                                                                {{-- @if ($step->duration)
                                                                    <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i></span>
                                                                @endif --}}
                                                            </div>
                                                            <div class="col-md-3 text-right align-self-center">
                                                                <a href="#" class="border-radius0all w-100  text-left p-0 pt-3 pb-3 font-familyAtlasGrotesk-Medium collapsed" data-toggle="collapse" data-target="#collapse-{{ $step->id }}" aria-expanded="false" aria-controls="collapse-{{ $step->id }}">
                                                                <span>View</span>
                                                                <i class="fa text-ferozy ml-3"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div id="collapse-{{ $step->id }}" class="collapse pt-3" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="col-md-12 text-center">
                                                                <audio controls>
                                                                    <source src="{{ asset('public/uploads/content/audios/' . $step->asset) }}">
                                                                </audio>

                                                                {{-- <div class="text-center pb-3">
                                                                    <audio id="player-{{ $step->id }}" src="{{ asset('public/uploads/content/audios/' . $step->asset) }}"></audio>
                                                                    <button onclick="document.getElementById('player-{{ $step->id }}').play()">Play</button>
                                                                    <button onclick="document.getElementById('player-{{ $step->id }}').pause()">Pause</button>
                                                                    <button onclick="document.getElementById('player-{{ $step->id }}').volume += 0.1">Vol +</button>
                                                                    <button onclick="document.getElementById('player-{{ $step->id }}').volume -= 0.1">Vol -</button>
                                                                </div> --}}
                                                            </div>
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

                    <div class="col-md-12 mb-3 p-0">
                        <div class="col-md-12 borderDotted text-center font-size12px d-flex justify-content-center cursorPointer text-center pt-3 pb-3" data-toggle="modal" data-target="#moadalAddNewCont">
                            <p class="font-familyAtlasGroteskWeb-Bold text-ferozy mb-0">ADD NEW CONTENT</p>
                            <i class="fas fa-plus text-colorMahroon700 align-self-center ml-3"></i>
                       </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('include.footer')

    <!-- Modal ADD COMMENT -->
    <div class="modal fade p-0" id="moadalAddNewCont" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCont" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered p-md-0 p-3" role="document" style="max-width: 800px;">
            <div class="modal-content border-radius0px">
                <div class="modal-header">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-ferozy font-size0point8" id="moadalAddNewContTitle">ADD NEW CONTENT</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700 mt-n4" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-3 pb-3">

                    <div class="lds-dual-ring" style="display:none"></div>

                    <div class="form-container">
                        <h6 class="font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5 font-size1em mb-0">Group</h6>
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mt-3 customFileMainDropDown">
                            <div class="custom-file">
                                <input type="text" class="custom-file-input col-md-4 p-0" id="uploadfile1">
                                <label class="custom-file-label font-familyFreightTextProLight-Regular font-size14px col-md-12 text-colorblue200 d-flex" for="uploadfile1"><i class="far fa-clone mr-2 align-self-center"></i> <span>Section</span> <span id="add-section" class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size12px align-self-center col p-0 text-right">ADD</span></label>
                            </div>
                            <p style="text-align: center;" id="message"></p>
                        </div>
                        <form id="content_step_form" action="{{ route('contentUpload') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="content_id" name="content_id"value="{{ $content->id }}">
                            <input type="hidden" id="current_section" name="current_section"value="{{ $content->section_count }}">

                            <h6 class="font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5 font-size1em mb-2">Add</h6>

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="title" class="mb-0 text-colorblue200">Title</label>
                                <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="title" name="title" placeholder="Enter Title">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Select Type</label>
                                    <select class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue" id="type" name="type" title="Select Type">
                                        <option value="Video">Video</option>
                                        <option value="Pdf">Pdf</option>
                                        <option value="Article">Article</option>
                                        <option value="Image">Image</option>
                                        <option value="Audio">Audio</option>
                                    </select>
                                    {{--<select name="type" id="type" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue" title="Select Type">--}}
                                        {{--<option value="Video">Video</option>--}}
                                        {{--<option value="Pdf">Pdf</option>--}}
                                        {{--<option value="Article">Article</option>--}}
                                        {{--<option value="Image">Image</option>--}}
                                        {{--<option value="Audio">Audio</option>--}}
                                    {{--</select>--}}
                                </div>
{{--
                                <div class="form-group col-md-6 font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="duration" class="mb-0 text-colorblue200">Duration</label>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="duration" name="duration" placeholder="Enter Duration">
                                </div> --}}
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
                                <textarea class="form-control classy-editor" name="description" id="description" rows="6" cols="260"></textarea>
                            </div>

                            {{--<div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mt-3 customFileMainDropDown">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input col-md-4 p-0" id="content_section_article">
                                    <label class="custom-file-label font-familyFreightTextProLight-Regular font-size14px col-md-12 text-colorblue200 d-flex" for="content_section_article"><i class="far fa-file-alt mr-2 align-self-center"></i> <span>Article</span> <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size12px align-self-center col p-0 text-right">ADD</span></label>
                                </div>
                            </div>
                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mt-3 customFileMainDropDown">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input col-md-4 p-0" id="content_section_pdf">
                                    <label class="custom-file-label font-familyFreightTextProLight-Regular font-size14px col-md-12 text-colorblue200 d-flex" for="content_section_pdf"><i class="far fa-file-pdf mr-2 align-self-center"></i> <span>PDF</span> <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size12px align-self-center col p-0 text-right">ADD</span></label>
                                </div>
                            </div>
                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mt-3 customFileMainDropDown">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input col-md-4 p-0" id="content_section_image">
                                    <label class="custom-file-label font-familyFreightTextProLight-Regular font-size14px col-md-12 text-colorblue200 d-flex" for="content_section_image"><i class="far fa-file-image mr-2 align-self-center"></i> <span>Image</span> <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size12px align-self-center col p-0 text-right">ADD</span></label>
                                </div>
                            </div>--}}

                            <p style="text-align: center;" id="message_content"></p>

                            <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar float-right">
                                <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">ADD <i class="fas fa-plus ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
@endsection

@section('script')
    <!-- <script src="{{ asset('js/dragInDrop.min.js') }}"></script>
    <script src="{{ asset('js/dragInDropCustom.js') }}"></script> -->
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">

    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
        });
    </script>
@endsection
