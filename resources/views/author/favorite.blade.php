@extends('layouts.backend.app')

@section('title', 'Favorite Posts')
    
@push('css')
    <link href="{{ asset('assets/Backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            FAVORITE POSTS
                            <span class="badge bg-red">{{ $posts->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped nowrap table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th class="text-center"><i class="material-icons text-danger">favorite</i></th>
                                        <th class="text-center"><i class="material-icons text-primary">comment</i></th>
                                        <th class="text-center"><i class="material-icons text-info">visibility</i></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title, 20) }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-info">
                                                    {{ $post->favorite_to_users->count() }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info">
                                                   0
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info">
                                                    {{ $post->view_count }}
                                                </span>
                                            </td>
                                            <td>
                                                @if (Auth::user()->id == $post->user_id )
                                                <a href="{{ route('author.post.show', $post->id) }}" 
                                                    class="btn btn-warning waves-effect btn-sm">
                                                    <i class="material-icons">visibility</i>
                                                </a> 
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('assets/Backend/js/pages/tables/jquery-datatable.js') }}"></script>
@endpush
