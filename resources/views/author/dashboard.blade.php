@extends('layouts.backend.app')

@section('title', 'Dashboard')
    
@push('css')
    
@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                <div class="text">TOTAL POSTS</div>
                <div
                    class="number count-to"
                    data-from="0"
                    data-to="{{ $posts->count() }}"
                    data-speed="15"
                    data-fresh-interval="20"
                ></div>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                <div class="text">FAVORITE POSTS</div>
                <div
                    class="number count-to"
                    data-from="0"
                    data-to="{{ Auth::user()->favorite_posts->count(    ) }}"
                    data-speed="1000"
                    data-fresh-interval="20"
                ></div>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                <div class="text">PENDING POSTS</div>
                <div
                    class="number count-to"
                    data-from="0"
                    data-to="{{ $total_pending_post }}"
                    data-speed="1000"
                    data-fresh-interval="20"
                ></div>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                <div class="text">TOTAL VIEWED POSTS</div>
                <div
                    class="number count-to"
                    data-from="0"
                    data-to="{{ $all_views }}"
                    data-speed="1000"
                    data-fresh-interval="20"
                ></div>
                </div>
            </div>
            </div>
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-">
                <div class="card">
                    <div class="header">
                        <h2>POPULAR POSTS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($popular_posts as $key => $popular_post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ str_limit($popular_post->title, 40)  }}</td>
                                    <td>{{ $popular_post->view_count }}</td>
                                    <td>{{ $popular_post->favorite_to_users_count  }}</td>
                                    <td>{{ $popular_post->comments_count }}</td>
                                    @if ($popular_post == true)
                                    <td>
                                        <span class="label bg-green">Published</span>
                                    </td>
                                    @else 
                                    <td>
                                        <span class="label bg-red">Pending</span>
                                    </td>
                                    @endif  
                                
                                </tr> 
                                @endforeach 
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
        </div>
    </section>

@endsection

@push('js')
<script src="{{ asset('assets/Backend/js/pages/index.js') }}"></script>

     <!-- Jquery CountTo Plugin Js -->
 <script src="{{ asset('assets/Backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

@endpush

