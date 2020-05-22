@extends('layouts.backend.app')

@section('title', 'Comments')
    
@push('css')
    <link href="{{ asset('assets/Backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="content">
    <div class="container-fluid">

        @if (session('successMsg'))
            <div class="alert alert-success" role="alert" id="alert-message">
                {{ session('successMsg') }}
            </div>
        @endif

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL COMMENTS
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped nowrap table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Comments Info</th>
                                        <th>Post Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $key=>$post)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="">
                                                         <img class="media-object" src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" 
                                                          height="64" width="64" alt="profile">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{ $post->user->name }}</h4>
                                                        <small>{{ $post->created_at->diffforHumans() }}</small>
                                                        <p> {{ $post->comment }} </p>
                                                        <a target="blank" 
                                                            href="{{ route('post.details', $post->post->slug. '#comments') }}">
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>  
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object" 
                                                        src="{{ Storage::disk('public')->url('post/'.$post->post->image) }}" 
                                                        height="100" width="120" alt="post image">
                                                    </div>
                                                    <div class="media-body">
                                                        <a target="blank" href="{{ route('post.details',$post->post->slug) }}">
                                                            <h4 class="media-heading">{{ str_limit($post->post->title, '40') }} </h4>
                                                        </a>
                                                        <p>by <strong>{{ $post->post->user->name }}</strong></p>
                                                    </div>
                                              
                                                </div>
                                            </td> 
                                            <td>
                                                <button type="submit" class="btn btn-danger waves-effect"
                                                    onclick="deleteComment({{ $post->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-comment-{{ $post->id }}" action="{{ route('author.comment.destroy', $post->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    setTimeout(function() {
        $( "#alert-message" ).fadeOut( "slow");
    },3000);

    function deleteComment(id){

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
    })

    swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-comment-'+id).submit();
            } 
        })
    }
</script>
@endpush
