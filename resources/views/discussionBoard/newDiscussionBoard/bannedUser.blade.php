@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-3"><span class="text-colorMahroon700">Discussion Board</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Banned Users</span></h6>

                    <div class="col-md-12 p-0 mb-4">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Banned Users</h3>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px" id="search" placeholder="Search Banned User">
                                    <i class="fas fa-search text-colorblue200 searchIcon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 font-size13px">
                    <table class="table table-striped table-bordered font-familyAtlasGroteskWeb-Black dashboardDataTable " style="width:100%">
                        <thead class="text-colorblue200 font-size13px bg-lightWhite300">
                        <tr>
                            <th>USER</th>
                            <th>BAN DATE</th>
                            <th>BAN REASON</th>
                            <th>BAN BY</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="font-familyAtlasGroteskWeb-Medium text-colorblue200">
                         @foreach ($banUsers as $item)


                        <tr>
                            <td width="250">
                                <div class="media">
                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden" style="background: url({{ url('public/uploads/profile_images/')  . '/'. $item->profile_pic_url }}) no-repeat; background-size: cover;">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 mb-2">{!! $item->name !!} </p>
                                        <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">{!! $item->role !!}</span>
                                    </div>
                                </div>
                            </td>
                            <td width="200" valign="middle">
                                {!! date('d M, Y', strtotime($item->ban_date)) !!}


                            </td>
                            <td width="350">
                                {!! $item->ban_reason !!}
                            </td>
                            <td width="200"><i class="fas fa-star text-ferozy mr-2"></i> {!! $item->banby !!}</td>
                            <td align="center">
                                <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                        <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                        <div class="col pl-0 pr-0">
                                           <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSureClose" onclick="showUser({!! $item->user_id !!})"><i class="fas fa-user mr-2 font-size16px"></i> <span>Unban User</span></a>
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
            </div>
        </div>

<!-- Modal Are You Sure! -->
<div class="modal fade" id="areYouSureClose" tabindex="-1" role="dialog" aria-labelledby="areYouSureCloseTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to unban this user?</p>
            </div>
            <form id="unbanUser" name="unbanUser">
                @csrf
                <input type="hidden" name="ban_userid" id="ban_userid">
                <div class="modal-footer">
                    <p id="message_content" style="position: absolute; left:25px;"></p>
                    <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                    <button form="unbanUser" type="submit" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
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

