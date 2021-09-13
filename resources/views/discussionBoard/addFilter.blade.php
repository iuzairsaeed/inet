@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex">
                    <div class="col-md-12 bg-lightWhite100 pt-4 pb-4">
                        <div class="list-group leftPanalList font-familyAtlasGroteskWeb-Regular font-size13px text-colorblue200">
                            <a href="#" class="list-group-item list-group-item-action active text-colorblue200 transitionall">Top Questions</a>
                            <a href="#" class="list-group-item list-group-item-action text-colorblue200 transitionall">Top Tags</a>
                            <p class="paddingcus1 opacity0point5 mb-0 pb-0">Main</p>
                            <a href="#" class="list-group-item list-group-item-action text-colorblue200 transitionall">Your Questions</a>
                            <a href="#" class="list-group-item list-group-item-action text-colorblue200 transitionall">Your Answers</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 pt-4 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                    <div class="col-md-12 p-0 font-size12px border-bottom">
                        <h6 class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">What does lorem ipsum means? and how it can be used in dummy text we put here.</h6>
                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 border-bottom pt-3 pb-3">
                            <div class="media">
                                <span class="align-self-center">Posted 1min ago</span>
                                <span class="align-self-center mr-3 ml-3">|</span>
                                <img class="mr-3 align-self-center" src="{{ asset('images/icons/img1.png') }}" alt="placeholder image" width="30">
                                <div class="media-body">
                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size13px">Laura Dan </h6>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-2 pr-2 pt-1 pb-1 font-size12px">Student</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pt-3 ">
                            <div class="row">
                                <div class="col-md-2 text-center text-colorblue100 opacity0point5 font-size14px mb-3">
                                    <h1 class="mb-0 line-height0"><i class="fas fa-caret-up"></i></h1>
                                    <h5 class="font-familyAtlasGroteskWeb-Medium mb-0">0</h5>
                                    <h1 class="line-height0"><i class="fas fa-caret-down"></i></h1>

                                    <p class="font-familyAtlasGroteskWeb-Regular mb-0 text-center text-colorblue100 font-size12px"><i class="far fa-eye mr-2"></i>
                                        <br> 2.7k Views</p>
                                </div>
                                <div class="col-md-10 mb-3 font-familyAtlasGroteskWeb-Light">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                                    <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
                                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.</p>
                                    <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5">Economic Thought</button>
                                    <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5">Tag 2</button>
                                    <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5">Policy</button>
                                    <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5">Tag 3</button>

                                    <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Bold pt-4">
                                        <a href="#" class="text-uppercase mr-3 text-colorblue200">Edit</a>
                                        <a href="#" class="text-uppercase text-colorMahroon700">delete</a>
                                        <span class="text-ferozy pr-3 pb-2 font-familyAtlasGroteskWeb-Bold font-size12px float-right"><span>SHARE</span> <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-0">
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-5">
                            <label for="FormControlTextarea1" class="mt-4">Your Answer</label>
                            <textarea class="form-control classy-editor" id="FormControlTextarea1" placeholder="Comment here" rows="6" cols="260"></textarea>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
        });

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
@endsection