@extends('admin.layouts.app')
@section('title', (isset($destination) ? 'Update' : 'Create') . ' Destination')
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Create Destination</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard.html">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">{{ isset($destination) ? 'Update' : 'Create' }} Destination</li>
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
                        <h5>{{ isset($destination) ? 'Update' : 'Create' }} Destination</h5>
                        <span>
							For custom Bootstrap form validation messages, you’ll need to add the <code
                                class="text-danger">novalidate</code> boolean attribute to your <code
                                class="text-danger">&lt;form&gt;</code>. This disables the browser
							default feedback tooltips, but still provides access to the form validation APIs in JavaScript. Try to submit the form below; our JavaScript will intercept the submit button and relay feedback to you.
						</span>
                        <span>When attempting to submit, you’ll see the <code
                                class="text-danger">:invalid </code> and <code class="text-danger">:valid </code> styles applied to your form controls.</span>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">First name</label>
                                    <input class="form-control" id="validationCustom01" type="text" value="Mark"
                                           required=""/>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom02">Last name</label>
                                    <input class="form-control" id="validationCustom02" type="text" value="Otto"
                                           required=""/>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustomUsername">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input class="form-control" id="validationCustomUsername" type="text"
                                               placeholder="Username" aria-describedby="inputGroupPrepend" required=""/>
                                        <div class="invalid-feedback">Please choose a username.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom03">City</label>
                                    <input class="form-control" id="validationCustom03" type="text" placeholder="City"
                                           required=""/>
                                    <div class="invalid-feedback">Please provide a valid city.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="validationCustom04">State</label>
                                    <select class="form-select" id="validationCustom04" required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationCustom05">Zip</label>
                                    <input class="form-control" id="validationCustom05" type="text" placeholder="Zip"
                                           required=""/>
                                    <div class="invalid-feedback">Please provide a valid zip.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" id="invalidCheck" type="checkbox" required=""/>
                                        <label class="form-check-label" for="invalidCheck">Agree to terms and
                                            conditions</label>
                                    </div>
                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">{{ isset($destination) ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection
