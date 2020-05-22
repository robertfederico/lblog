@extends('layouts.backend.app')

@section('title', 'Create Post  ')
    
@push('css')
  <!-- Bootstrap Select Css -->
  <link href="{{ asset('assets/Backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

  @endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <form id="form_validation" method="POST" action="{{ route('author.post.store') }}"
                enctype="multipart/form-data">
                @csrf
                
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger mt-3" role="alert" id="alert-message">
                    {{ $error }}
                </div> 
                @endforeach 

            @endif
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-uppercase"> Add New Post</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" 
                                    name="title" value="{{ old('title') }}" required>
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" class="form-control" name="image" required>
                                    <label class="form-label">Featured Image</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" class="filled-in" id="publish" name="status" value="1">
                                <label for="publish">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-uppercase"> Categories and Tags</h2>
                        </div>
                        <div class="body">
                     
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }} ">
                                <label for="category">Select Category </label>
                                <select name="categories[]" id="category" class="form-control show-tick" multiple > 
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tags">Select Tag</label>
                                    <select id='tags' name="tags[]" class="form-control show-tick" multiple>
                                            @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{ route('author.post.index') }}" class="btn btn-danger waves-effect">BACK</a>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>

         <!-- TinyMCE -->
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Post Body
                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="tinymce" name="body"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# TinyMCE -->
        </form>
        {{-- end form --}}
    </div>
</section>
@endsection

@push('js')
<!-- Jquery Validation Plugin Css -->
<script src="{{ asset('assets/Backend/plugins/jquery-validation/jquery.validate.js') }}"></script>

<script src="{{ asset('assets/Backend/js/pages/forms/form-validation.js') }}"></script>

<!-- Select Plugin Js -->
<script src="{{ asset('assets/Backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<!-- TinyMCE -->
<script src="{{ asset('assets/Backend/plugins/tinymce/tinymce.js') }}"></script>

<script>
    $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = "{{ asset('assets/Backend/plugins/tinymce') }}";
});
</script>
@endpush