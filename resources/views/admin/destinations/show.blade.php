@extends('admin.layouts.app')
@section('title', 'Destination')
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
                            <img class="img-fluid bg-img-cover"
                                 src="{{ asset("images/destinations/{$destination->image}") }}" alt=""/></div>
                        <div class="userpro-box">
                            <div class="img-wrraper">
                                <div class="avatar">
                                    <img class="img-fluid" alt="" src="{{ asset('images/admin/big-masonry/7.jpg') }}"/>
                                </div>
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
                                            <div class="follow-num counter">{{ $destination->bookings_count }}</div>
                                            <span>Bookings</span>
                                        </li>
                                        <li>
                                            <div class="follow-num counter">{{ $destination->reviews_count }}</div>
                                            <span>Reviews</span>
                                        </li>
                                        <li>
                                            <div class="follow-num counter">{{ $destination->rating }}</div>
                                            <span>Rating</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- user profile header end-->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- profile post start-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="profile-post">
                                    <div class="post-header">
                                        <div class="media">
                                            <?php $imgSrc = $destination->icon ?? asset("images/destinations/{$destination->image}") ?>
                                            <img class="img-thumbnail rounded-circle me-3"
                                                 src="{{ $imgSrc }}" alt="Placeholder image"/>
                                            <div class="media-body align-self-center">
                                                <a href="#"><h5 class="user-name">{{ $destination->name }}</h5></a>
                                                <h6>Created: {{ $destination->created_at->diffForHumans() }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-body">
                                        <div class="row">
                                            <div class="col">
                                                <table>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td>~~~ {{ number_format($destination->price, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Charges</th>
                                                        <td>~~~ {{ $destination->rates }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vicinity</th>
                                                        <td>~~~ {{ $destination->vicinity }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col">
                                                <table>
                                                    <tr>
                                                        <th>Website</th>
                                                        <td>
                                                            ~~~ <a href="{{ $destination->website }}"
                                                               target="_blank">{{ $destination->name }} <i
                                                                    class="fas fa-external-link-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description</th>
                                                        <td>~~~ {{ $destination->description ?? "None" }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="img-container">
                                            <div class="row justify-content-center mt-4 pictures my-gallery"
                                                 id="aniimated-thumbnials-2" itemscope="">
                                                @foreach($destination->destinationImages as $image)
                                                    <figure class="col-sm-3" itemprop="associatedMedia" itemscope="">
                                                        <a href="{{ asset("images/destinations/{$image->image}") }}"
                                                           itemprop="contentUrl" data-size="1600x950">
                                                            <img class="img-fluid rounded"
                                                                 src="{{ asset("images/destinations/{$image->image}") }}"
                                                                 itemprop="thumbnail" alt="gallery"/>
                                                        </a>
                                                        <figcaption itemprop="caption description">Image caption 1
                                                        </figcaption>
                                                    </figure>
                                                @endforeach
                                            </div>
                                        </div>
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
