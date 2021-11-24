@extends('admin.layouts.app')
@section('title', 'Destinations')
@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/photoswipe.css') }}">
@endpush
@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3>Destination</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Destination</li>
                        <li class="breadcrumb-item active">{{ $destination->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile header start-->
                <div class="col-sm-12">
                    <div class="card profile-header">
                        <img class="img-fluid bg-img-cover"
                             src="{{ asset("images/destinations/{$destination->image}") }}" alt=""/>
                        <div class="profile-img-wrrap">
                            <img class="img-fluid bg-img-cover" src="{{ asset("images/destinations/{$destination->image}") }}" alt=""/></div>
                        <div class="userpro-box">
                            <div class="img-wrraper">
                                <div class="avatar">
                                    <img class="img-fluid" alt="" src="{{ asset('images/admin/big-masonry/7.jpg') }}"/></div>
                                <a class="icon-wrapper"
                                   href="{{ route('admin.destinations.edit', ['id' => $destination->id]) }}">
                                    <i class="icofont icofont-pencil-alt-5"></i></a>
                            </div>
                            <div class="user-designation">
                                <div class="title">
                                    <h4>{{ $destination->name }}</h4>
                                    <h6>{{ $destination->category->title }}</h6>
                                </div>
                                <div class="social-media">
                                    <ul class="user-list-social">
                                        <li>
                                            <a href="#"><i class="fab fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-google-plus"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-rss"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="follow">
                                    <ul class="follow-list">
                                        <li>
                                            <div class="follow-num counter">325</div>
                                            <span>Follower</span>
                                        </li>
                                        <li>
                                            <div class="follow-num counter">450</div>
                                            <span>Following</span>
                                        </li>
                                        <li>
                                            <div class="follow-num counter">500</div>
                                            <span>Likes</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- user profile header end-->
                <div class="col-lg-12 col-md-7 xl-65">
                    <div class="row">
                        <!-- profile post start-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="profile-post">
                                    <div class="post-header">
                                        <div class="media">
                                            <img class="img-thumbnail rounded-circle me-3"
                                                 src="{{ asset("images/destinations/{$destination->image}") }}" alt="Generic placeholder image"/>
                                            <div class="media-body align-self-center">
                                                <a href="#"><h5 class="user-name">{{ $destination->name }}</h5></a>
                                                <h6>Created: {{ $destination->created_at->diffForHumans() }}</h6>
                                            </div>
                                        </div>
                                        <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                                    </div>
                                    <div class="post-body">
                                        <div class="img-container">
                                            <div class="row mt-4 pictures my-gallery" id="aniimated-thumbnials-2"
                                                 itemscope="">
                                                <figure class="col-sm-6" itemprop="associatedMedia" itemscope="">
                                                    <a href="../assets/images/user-profile/post2.jpg"
                                                       itemprop="contentUrl" data-size="1600x950">
                                                        <img class="img-fluid rounded"
                                                             src="../assets/images/user-profile/post2.jpg"
                                                             itemprop="thumbnail" alt="gallery"/>
                                                    </a>
                                                    <figcaption itemprop="caption description">Image caption 1
                                                    </figcaption>
                                                </figure>
                                                <figure class="col-sm-6" itemprop="associatedMedia" itemscope="">
                                                    <a href="../assets/images/user-profile/post3.jpg"
                                                       itemprop="contentUrl" data-size="1600x950">
                                                        <img class="img-fluid rounded"
                                                             src="../assets/images/user-profile/post3.jpg"
                                                             itemprop="thumbnail" alt="gallery"/>
                                                    </a>
                                                    <figcaption itemprop="caption description">Image caption 2
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="post-react">
                                            <ul>
                                                <li><img class="rounded-circle" src="../assets/images/user/3.jpg"
                                                         alt=""/></li>
                                                <li><img class="rounded-circle" src="../assets/images/user/5.jpg"
                                                         alt=""/></li>
                                                <li><img class="rounded-circle" src="../assets/images/user/1.jpg"
                                                         alt=""/></li>
                                            </ul>
                                            <h6>+25 people react this post</h6>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                                            occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <ul class="post-comment">
                                            <li>
                                                <label>
                                                    <a href="#"><i data-feather="heart"></i>&nbsp;&nbsp;Like<span
                                                            class="counter">520</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><i data-feather="message-square"></i>&nbsp;&nbsp;Comment<span
                                                            class="counter">85</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><i data-feather="share"></i>&nbsp;&nbsp;share<span
                                                            class="counter">30</span></a>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile post end   -->
                    </div>
                </div>
                <!-- user profile fifth-style end-->
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="pswp__bg"></div>
                    <div class="pswp__scroll-wrap">
                        <div class="pswp__container">
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                        </div>
                        <div class="pswp__ui pswp__ui--hidden">
                            <div class="pswp__top-bar">
                                <div class="pswp__counter"></div>
                                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                <button class="pswp__button pswp__button--share" title="Share"></button>
                                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                <div class="pswp__preloader">
                                    <div class="pswp__preloader__icn">
                                        <div class="pswp__preloader__cut">
                                            <div class="pswp__preloader__donut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                <div class="pswp__share-tooltip"></div>
                            </div>
                            <button class="pswp__button pswp__button--arrow--left"
                                    title="Previous (arrow left)"></button>
                            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                            <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid Ends-->

    @push('scripts')
        <script src="{{ asset('vendor/viho/js/photoswipe/photoswipe.min.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/photoswipe/photoswipe.js') }}"></script>
    @endpush
@endsection
