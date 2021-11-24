@extends('admin.layouts.app')
@section('title', (isset($destination) ? 'Update' : 'Create') . ' Destination')
@section('content')
    @php
        $rates = ['daily', 'hourly', 'nightly'];
    @endphp

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ isset($destination) ? 'Update' : 'Create' }} Destination</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard.html">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">{{ isset($destination) ? 'Update' : 'Create' }}Destination
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>{{ isset($destination) ? 'Update' : 'Create' }} Destination</h5>
                    </div>
                    <div class="card-body">

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible show fade py-1">
                                <strong>Oops!</strong> {{$errors->first()}}
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ isset($destination) ? route('admin.destinations.update', ['id' => $destination->id]) : route('admin.destinations.store') }}">
                            @csrf @isset($destination) @method('PUT') @endisset
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="name">Name *</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                           value="{{ old('name', $destination->name ?? '') }}" required/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="vicinity">Vicinity</label>
                                    <input class="form-control" id="vicinity" name="vicinity" type="text"
                                           value="{{ old('vicinity', $destination->vicinity ?? '') }}" required/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="price">Price *</label>
                                    <input class="form-control" id="price" name="price" type="text"
                                           value="{{ old('price', $destination->price ?? '') }}" required/>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="category_id">Category *</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" selected hidden>Select category</option>
                                        @foreach($categories as $category)
                                            <option
                                                @if(isset($destination) && $destination->category_id === $category->id) selected
                                                @endif value="{{ $category->id }}">{{ ucwords(str_replace('_', ' ', $category->title)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="rates">Rates</label>
                                    <select name="rates" id="rates" class="form-control" required>
                                        <option value="" selected hidden>Select rates</option>
                                        @foreach($rates as $rate)
                                        <option @if(isset($destination) && $destination->rates === $rate) selected
                                                @endif value="{{ $rate }}">{{ ucfirst($rate) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" {{ !isset($destination) ? 'required' : '' }}>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="website">Link to website</label>
                                    <input class="form-control" id="website" name="website" type="url"
                                           value="{{ old('website', $destination->website ?? '') }}"
                                           placeholder="Website"/>
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary"
                                        type="submit">{{ isset($destination) ? 'Update' : 'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection
