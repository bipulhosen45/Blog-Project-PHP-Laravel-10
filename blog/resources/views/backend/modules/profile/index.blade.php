@extends('backend.admin-layouts.app')

@section('page_title', 'User List')
@section('header', 'User List')


@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('admin_content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="card-title">All User</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session()->has('msg'))
                            <div class="alert alert-{{ session()->get('cls') }}">
                                {{ session()->get('msg') }}
                            </div>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Iamge</th>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->user_title }}</td>
                                        <td>{{ $user->slug }}</td>
                                        <td><a
                                                href="{{ route('category.show', $user->category_id) }}">{{ $user->category->name }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('sub-category.show', $user->sub_category) }}">{{ $user->sub_category->name }}</a>
                                        </td>
                                        <td>
                                            @if ($user->role == 1)
                                                <span class="badge badge-success">Admin</span>
                                            @endif
                                            @if ($user->role == 2)
                                                <span class="badge badge-warning">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (Route::currentRouteName())
                                            <img data-src="{{$user->image}}" src="{{$user->image}}" class="img-thumbnail image_show">
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $user->updated_at != $user->updated_at ? $user->updated_at->toDayDateTimeString : 'Not Updated' }}</td>
                                        <td>{{ $user->user->name }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <form id="status-form-{{ $user->id }}" method="user" action="{{route('user.status', $user->id)}}">
                                                    @csrf
                                                </form>

                                                <button type="button" class="btn btn-primary btn-sm mx-1" onclick="if(confirm('Are you sure published this user?')){event.preventDefault();document.getElementById('status-form-{{ $user->id }}').submit();}else{event.preventDefault();}"><i class="fas fa-check">Admin</i> </button>
                                            @endif

                                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm m-1"><i class="fas fa-eye"></i> </a>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>

                                            <button type="button" class="btn btn-danger btn-sm m-1" onclick="if(confirm('Are you sure delete this?')){event.preventDefault();document.getElementById('delete-user-{{ $user->id }}').submit()};"><i class="fas fa-trash-alt"></i> </button>

                                            <form id="delete-user-{{ $user->id }}" method="user" action="{{ route('user.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Iamge</th>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!--pagination next page-->
                        <div class="mt-2">
                            {{ $users->links() }}
                        </div>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Modal for image dropdown-->
    <!-- Button trigger modal -->
        <button type="button" id="image_show_button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show">
        </button>
        <!-- Modal -->
        <div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <img src="" class="img-thumbnail" id="display_image" alt="">
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
