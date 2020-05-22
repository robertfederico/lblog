@extends('layouts.backend.app')

@section('title', 'Create Tag  ')
    
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
                        <h2 class="text-uppercase"> Add New Tag</h2>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-success mt-3" role="alert" id="alert-message">
                                {{ $error }}
                            </div> 
                            @endforeach
                        @endif
                        
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST" action="{{ route('admin.tag.store') }}">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" required>
                                    <label class="form-label">Name</label>
                                </div>
                                @error('name')
                                    
                                @enderror
                            </div>
                            <a href="{{ route('admin.tag.index') }}" class="btn btn-danger waves-effect">BACK</a>
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