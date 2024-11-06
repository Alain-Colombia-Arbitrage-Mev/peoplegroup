@extends('fonts.layouts.master')
@section('style')
    <style>
        .icon svg.svg-inline--fa {
            width:  45px;
            height:  45px;
        }
    </style>
@endsection
@section('content')
    <!-- suitable business area start -->
    <section class="suitable-business-area suitable-business-bg" id="about">
        <div class="container">
            <div class="row">
                <div class="left-content">
                    <div class="section-title text-center">
                        <h2>About Us</h2>
                        <h4>Know About Us, Get Us</h4>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="left-content">
                        <div class="content">
                            <p>{!! $general->about_text !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="right-img">
                        <img src="{{asset('assets/images/about_image/'.$general->image)}}" alt="suitable business images">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- suitable business area end -->

    <!-- our service area start -->
    <section class="our-service-area" id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="section-title">
                        <div class="icon">
                            <img src="{{asset('assets/images/fontend_logo/icon.png')}}" alt="icon">
                        </div>
                        <a href="#"><h3>Our Services</h3></a>
                        <p>We help create retirement income strategies for people in or nearing retirement so their retirement income lasts
                            as long as they do.</p>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                @php
                    $c = 0;
                @endphp
                @foreach($service as $data)
                    @php
                        if ($c == 0){
                        echo '<div class="row">';
                        }
                    @endphp
                    <div class="col-md-4 col-sm-6">
                        <div class="single-service-box">
                            <div class="icon">
                                <i class="fa {{$data->icon}}"></i>
                            </div>
                            <div class="content">
                                <a href="#"><h4>{{$data->title}}</h4></a>
                                <p style="font-size: 12px">{!! $data->description !!}</p>
                            </div>
                        </div>
                    </div>
                    @php
                        $c++;
                            if ($c == 3){
                            echo '</div>';
                            $c = 0;
                            }
                    @endphp
                @endforeach
            </div>
        </div>
    </section>
    <!-- our service area end -->
    <!-- counter area start -->
    <div class="counter-area counter-bg" id="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 text-center">
                    <div class="single-counter-box">
                        <div class="icon">
                            <i style="color: white" class="far fa-user"></i>
                        </div>
                        <div class="content">
                            <span class="counter-text">Happy Clients</span>
                            <span class="counter-number">
                             {{\App\User::where('status', 1)->count()}}
                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <div class="single-counter-box">
                        <div class="icon two">
                            <i style="color: white" class="far fa-money-bill-alt"></i>
                        </div>
                        <div class="content">
                            <span class="counter-text">Deposit Money</span>
                            <span class="counter-number">
                             {{\App\Deposit::where('status', 1)->count('id')}}
                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <div class="single-counter-box">
                        <div class="icon">
                            <i style="color: white" class="far fa-clock"></i>
                        </div>
                        <div class="content">
                            <span class="counter-text">Working Hour</span>
                            <span class="counter-number">
                             {{\Carbon\Carbon::parse($general->start_date)->diffInDays() * 24}}
                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <div class="single-counter-box">
                        <div class="icon">
                            <i style="color: white" class="fas fa-undo"></i>
                        </div>
                        <div class="content">
                            <span class="counter-text">Withdraw Money</span>
                            <span class="counter-number">
                             {{\App\Withdraw::where('status', 1)->count('id')}}
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter area end -->

    <!-- our angels area start -->
    <section class="our-angels-area" id="team">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="section-title">
                        <div class="icon">
                            <img src="{{asset('assets/images/fontend_logo/icon.png')}}" alt="icon">
                        </div>
                        <a href="#">
                            <h3>Our Team</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($team as $data)
                <div class="col-md-3 col-sm-6">
                    <div class="single-team-member">
                        <div class="image-box">
                            <a href="#"><img src="{{asset('assets/images/team/'. $data->image)}}" alt="team members"></a>
                            <div class="member-details">
                                <span class="member-name">{{$data->name}}</span>
                                <span class="post">{{$data->designation}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- our angels area end -->

    <!-- minimal video section start -->
    <section class="minimal-video-area video-area-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="minimal-video-wrapper">
                        <div class="icon">
                            <a href="{{$general->about_video_link}}" class="video-play-btn mfp-iframe">
                                <svg  width="98px" height="98px">
                                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M49.000,97.999 C21.981,97.999 0.000,76.018 0.000,48.999 C0.000,21.981 21.981,-0.001 49.000,-0.001 C50.101,-0.001 50.994,0.893 50.994,1.994 C50.994,3.095 50.101,3.988 49.000,3.988 C24.181,3.988 3.989,24.180 3.989,48.999 C3.989,73.818 24.181,94.011 49.000,94.011 C73.819,94.011 94.011,73.818 94.011,49.000 C94.011,41.738 92.336,34.807 89.032,28.400 C85.879,22.285 81.281,16.885 75.734,12.783 C74.849,12.129 74.661,10.880 75.316,9.994 C75.972,9.109 77.220,8.922 78.106,9.577 C84.141,14.040 89.146,19.917 92.577,26.572 C96.125,33.452 98.000,41.207 98.000,48.999 C98.000,76.018 76.018,97.999 49.000,97.999 ZM73.834,50.676 L49.416,66.408 C48.490,67.005 47.256,66.738 46.659,65.812 C46.063,64.886 46.330,63.652 47.256,63.056 L68.968,49.067 L39.442,31.489 L39.442,71.747 C39.442,72.849 38.549,73.741 37.447,73.741 C36.346,73.741 35.453,72.849 35.453,71.747 L35.453,27.981 C35.453,27.264 35.838,26.602 36.462,26.247 C37.085,25.893 37.850,25.900 38.467,26.267 L73.774,47.285 C74.368,47.639 74.736,48.273 74.748,48.964 C74.760,49.654 74.415,50.302 73.834,50.676 Z"
                                    />
                                </svg>
                            </a>
                        </div>
                        <div class="content">
                            <h3>Our Video Section</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- minimal video section end -->

    <!-- news feeds area start -->
    <section class="news-feeds-area" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="section-title">
                        <div class="icon">
                            <img src="{{asset('assets/images/fontend_logo/icon.png')}}">
                        </div>
                        <a href="#">
                            <h3>News Feeds</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($news as $data)
                <div class="col-md-4 col-sm-6">
                    <div class="single-news-box-item">
                        <div class="thumb">
                            <img src="{{asset('assets/blog_images/'. $data->image)}}" alt="news images">
                        </div>
                        <div class="content">
                            <span class="date-meta">{{date('d, M-Y', strtotime($data->created_at))}}</span>
                            <a href="{{route('news.show.pranto',['id' => $data->id , 'title' => Replace($data->title)])}}">
                                <h4>{{$data->title}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- news feeds area end -->

    <!-- subscribe area start -->
    <section class="subscribe-area" id="subscribe">
        <span class="bg-text">Subscribe</span>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="subscriber-wrapper">
                        <h2>Subscribe For New Updates</h2>
                        <div class="form-wrapper">
                            <form action="{{route('store.new.letter')}}" method="post">
                                {{csrf_field()}}
                                <input type="text" name="name" id="name" placeholder="Enter your Name.....">
                                <input type="email" name="email" id="email" placeholder="Enter your email.....">
                                <button type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe area end -->

    <!-- logo carousel area start -->
    <div class="logo-carousel-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo-carousel owl-carousel">
                        @foreach($gateway as $data)
                            <div class="single-logo-item">
                                <img src="{{asset('assets/images/gateway')}}/{{$data->gateimg}}" alt="payment methods">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo carousel area end -->
@endsection
