@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-3"><span class="text-colorMahroon700">Discussion Board</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Deleted Threads</span></h6>

                    <div class="col-md-12 p-0 mb-4">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Deleted Threads</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active col-lg-1 col-md-2" id="list-All-list" data-toggle="list" href="#pg-all" role="tab" aria-controls="All">All</a>
                        {{-- <a class="list-group-item list-group-item-action col-lg-1 col-md-2" id="list-Search-list" data-toggle="list" href="#pg-search" role="tab" aria-controls="Search">Search</a>
                        <a class="list-group-item list-group-item-action font-familyAtlasGroteskWeb-Bold font-size12px text-right pr-0 text-ferozy" href="#">FILTER<i class="fas fa-angle-down text-colorMahroon700 ml-3"></i></a> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active horizontalScroll" id="pg-all" role="tabpanel" aria-labelledby="All">
                            <table class="table font-familyAtlasGroteskWeb-Medium contSuggTable">
                                <tbody>
                                    @foreach ($deletdThreads as $item)


                                    <tr class="border-bottom">
                                        <td class="">
                                            <p class="text-colorblue100 font-size13px">{!! $item->title !!}</p>
                                            <div class="media">
                                                <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background:  url({{ url('public/uploads/profile_images/')  . '/'. $item->profile_pic_url }}) no-repeat; background-size: cover;">
                                                </div>
                                                <div class="media-body align-self-center d-flex">
                                                    <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center mr-2">{!! $item->name !!}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">{!! $item->role !!}</span></p>
                                                    <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                                    <div class="align-self-center">
                                                        <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                                                        <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{!! date("M d, Y", strtotime($item->d_at)) !!}</span>
                                                    </div>
                                                    <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                                </div>
                                            </div>

                                        </td>

                                        <td class="text-center verticalalign" width="110">

                                                <p class="mb-0 font-size12px ">
                                                    {!! $item->board !!}
                                                </p>

                                        </td>



                                        <td class="text-center verticalalign" width="110">
                                            <a href="#" class="text-colorMahroon700 font-size12px">
                                                <p class="mb-0 ">
                                                    <i class="far fa-trash-alt"></i>&nbsp;&nbsp;
                                                     Deleted by
                                                </p>
                                            </a>
                                        </td>
                                        <td class="text-center verticalalign" width="160">
                                            <div class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2">
                                                <img src="{{ asset('images/icons/Icon-M.png') }}" alt=""><span class="ml-2 font-familyAtlasGroteskWeb-Light">{!! $item->deletby !!}</span>
                                            </div>
                                        </td>
                                        <td class="verticalalign dashboardDataTable text-right">
                                           <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v font-size2em"></i></a>
                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                    <div class="col pl-0 pr-0">
                                                       <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSureClose" onclick="showThrea({!! $item->id !!})"><i class="fas fa-user mr-2 font-size16px"></i> <span>Restore Thread</span></a>
                                                    </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                        {{-- <div class="tab-pane fade horizontalScroll" id="pg-search" role="tabpanel" aria-labelledby="Search">
                            <h6 class="mt-5 mb-5">Search Content Not Available</h6>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>

            <!-- Modal Are You Sure! -->
<div class="modal fade" id="areYouSureClose" tabindex="-1" role="dialog" aria-labelledby="areYouSureCloseTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want restore this thread?</p>
            </div>
            <form id="restoreThread" name="restoreThread">
                @csrf
                <input type="hidden" name="retore_ques_id" id="retore_ques_id">
            <div class="modal-footer">
                <p id="message_content" style="position: absolute; left:25px;"></p>
                <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                <button form="restoreThread" type="submit" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">YES <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
    </section>

    @include('include.footer')

@endsection

