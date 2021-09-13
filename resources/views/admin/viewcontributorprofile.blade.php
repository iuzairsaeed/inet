@extends('layouts.app') @section('title') INET ED Platform :: View Profile @endsection @section('content') @include('include.header')

<section class="bg-white">
    <div class="container">
        <div class="row">
            @foreach ($profile_data as $a)

            <div class="col-md-9 pt-5 pb-5 ">
                <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">View Profile</h3>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px">Keep your profile informative and up to date.</p>
                <div class="media mt-5 font-size14px">
                    <div class="thumbnailImg_WH1 thumbnailImg" style="background: url({{ url('/public/uploads/profile_images') . '/'. $a->profile_pic_url  }}) no-repeat; background-size: 100%;">
                    </div>
                    <div class="media-body">
                        <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 d-flex"><span class="align-self-center">{!! $a->name !!}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">{{ $a->role }}</span></h5>


                        <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular">{!! $a->about_me !!}</p>

                        <div class="mt-3">



                                @if (!Auth::guest())
                                <a href="#" class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px">{!! $a->email !!}</a>
                                @endif


                            <div class="mt-2">

                                {{-- <a href="#" class="text-colorblue200"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-colorblue200 ml-3 mr-3" ><i class="fab fa-youtube"></i></a>
                                <a href="#" class="text-colorblue200" ><i class="fas fa-globe"></i></a> --}}


                                @if ($a->twitter_url == "")
                                <a href="#" class="text-colorblue200"><i class="fab fa-twitter"></i></a>
                                @else
                                <a href="{{$a->twitter_url }}" class="text-colorblue200" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif

                                @if ($a->youtube_url == "")
                                <a href="#"class="text-colorblue200 ml-3 mr-3"><i class="fab fa-youtube"></i></a>
                                @else
                                <a href="{{$a->youtube_url }}"class="text-colorblue200 ml-3 mr-3"  target="_blank"><i class="fab fa-youtube"></i></a>
                                @endif


                                @if ($a->web_url == "")
                                <a href="#" class="text-colorblue200"><i class="fas fa-globe"></i></a>
                                @else
                                <a href="{{$a->web_url }}" class="text-colorblue200"  target="_blank"><i class="fas fa-globe"></i></a>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach




            <div class="col-md-12 p-0 mt-5 mb-5">
                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active col-lg-2 col-md-3" id="list-contributions-list" data-toggle="list" href="#pg-contributions" role="tab" aria-controls="Contributions">Contributions</a>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="pg-contributions" role="tabpanel" aria-labelledby="contributions">
                            <div class="row">
                               @foreach($contributions as $contr)

                                <div class="col-lg-3 col-md-6 mb-3 d-flex bookmarkCheck">
                                    <div class="card col-12 p-0 border-radius0all">
                                        <a href="{!! route('contentSection', ['content_id' => $contr->id]) !!}">
                                        <img class="card-img-top" src="{{ asset('/public/uploads/content/profile_images') . '/'.  $contr->image_url  }}" alt="image">
                                        </a>
                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Medium text-colorblue200">
                                            <small class="float-left">{!! $contr->difficulty_level !!}</small>
                                            {{-- <small class="float-right">26m</small> --}}
                                        </div>
                                        <div class="card-body">
                                            <a href="{!! route('contentSection', ['content_id' => $contr->id]) !!}">
                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">{!! $contr->title !!}</h6>
                                            </a>
                                            <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{!! $contr->name !!}</small></p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach



                            </div>
                        </div>

                        <div class="tab-pane fade" id="pg-threads" role="tabpanel" aria-labelledby="threads">
                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                        </div>

                        <div class="tab-pane fade" id="pg-answers" role="tabpanel" aria-labelledby="answers">
                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

@include('include.footer')

<!-- Modal ADD COMMENT -->

@endsection
