@extends('layouts.backend.app')

@section('title', 'Create Category  ')
    
@push('css')
<!-- Sweet Alert Css -->
<link href="{{ asset('assets/Backend/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
<!-- Custom Css -->
<link href="{{ asset('assets/Backend/css/style.css') }}" rel="stylesheet">
<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{ asset('assets/Backend/css/themes/all-themes.css') }}" rel="stylesheet" />
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-uppercase"> Add New Category</h2>
                    </div>
                    <div class="body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mt-3" role="alert" id="alert-message">
                                {{ $error }}
                            </div> 
                            @endforeach
                        @endif
                        <form id="form_validation" method="POST" action="{{ route('admin.category.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line @error('name') error focus @enderror">
                                    <input type="text" class="form-control" 
                                    name="name" value="{{ old('name') }}" required>
                                    <label class="form-label @error('name') error @enderror">Category Name</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" class="form-control" name="image" required>
                                    <label class="form-label">Category Image</label>
                                </div>
                            </div>

                            <a href="{{ route('admin.category.index') }}" class="btn btn-danger waves-effect">BACK</a>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<!-- Jquery Validation Plugin Css -->
<script src="{{ asset('assets/Backend/plugins/jquery-validation/jquery.validate.js') }}"></script>
<!-- JQuery Steps Plugin Js -->
<script src="{{ asset('assets/Backend/plugins/jquery-steps/jquery.steps.js') }}"></script>
   <!-- Sweet Alert Plugin Js -->
<script src="{{ asset('assets/Backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/Backend/js/pages/forms/form-validation.js') }}"></script>
@endpush