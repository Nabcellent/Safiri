@extends('admin.layouts.app')
@section('title', 'Banners')
@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/photoswipe.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3>Banner Grid</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Banner Grid With Desc</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>BANNER GALLERY</h5>
                    </div>
                    <div class="my-gallery card-body row gallery-with-description" itemscope="">
                        @foreach($banners as $item)
                            <?php
                            $image = (isset($item->image) && file_exists("images/banners/{$item->image}"))
                                ? "images/banners/{$item->image}"
                                : "images/admin/big-masonry/7.jpg"
                            ?>
                            <figure class="col-xl-4 col-sm-6 xl-33" itemprop="associatedMedia" itemscope="">
                                <a href="{{ asset($image) }}" itemprop="contentUrl"
                                   data-size="1600x950">
                                    <img src="{{ asset($image) }}" itemprop="thumbnail"
                                         alt="Image description"/>
                                    <div class="caption">
                                        <h4>{{ $item->title }}</h4>
                                        <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                            has been the industry's standard dummy.</p>
                                    </div>
                                </a>
                                <figcaption itemprop="caption description">
                                    <h4>{{ $item->title }}</h4>
                                    <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                        been the industry's standard dummy.</p>
                                    <div class="d-flex justify-content-evenly text-center">
                                        <a href="{{ route('admin.banners.edit', ['id' => $item->id]) }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.banners.destroy', ['id' => $item->id]) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                        <!--
                        Background of PhotoSwipe.
                        It's a separate element, as animating opacity is faster than rgba().
                        -->
                        <div class="pswp__bg"></div>
                        <!-- Slides wrapper with overflow:hidden.-->
                        <div class="pswp__scroll-wrap">
                            <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                            <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                            <div class="pswp__container">
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                            </div>
                            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                            <div class="pswp__ui pswp__ui--hidden">
                                <div class="pswp__top-bar">
                                    <!-- Controls are self-explanatory. Order can be changed.-->
                                    <div class="pswp__counter"></div>
                                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                    <button class="pswp__button pswp__button--share" title="Share"></button>
                                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                                    <!-- element will get class pswp__preloader--active when preloader is running-->
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
                                <button class="pswp__button pswp__button--arrow--right"
                                        title="Next (arrow right)"></button>
                                <div class="pswp__caption">
                                    <div class="pswp__caption__center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <h5 class="card-header">{{ isset($banner) ? 'Update' : 'Create' }} Banner</h5>
                        <div class="card-body">
                            <form class="row" method="POST" enctype="multipart/form-data"
                                  action="{{ isset($banner) ? route('admin.banners.update', ['id' => $banner->id]) : route('admin.banners.store') }}">
                                @csrf @isset($banner) @method('PUT') @endisset
                                <div class="col-md-6 mb-3">
                                    <label for="title">Title *</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           value="{{ old('title', $banner->title ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="url">Link</label>
                                    <input type="url" name="url" id="url" class="form-control"
                                           value="{{ old('url', $banner->url ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="content">Content *</label>
                                    <input type="text" name="content" id="content" class="form-control"
                                           value="{{ old('content', $banner->content ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary">{{ isset($banner) ? 'Update' : 'Create' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('vendor/viho/js/photoswipe/photoswipe.min.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/photoswipe/photoswipe.js') }}"></script>
    @endpush
@endsection
