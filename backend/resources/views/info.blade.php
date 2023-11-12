@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('includes.header')


    <div class="container-fluid py-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('err'))
        <div class="alert alert-success">
            {{ session('err') }}
        </div>
        @endif

        <!-- Info Table -->
        <div class="card">
            <!-- Card header -->

            <div class="card-header pb-0">
                <h6>Info Table</h6>
                <button type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addInfoModal">
                    Add New Info
                </button>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Info ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hotel ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Content</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create_at</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Update_at</th>
                                <th class="text-secondary opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- This is a static example row -->
                            <tr>
                                <td class="align-middle text-xs">
                                    1 <!-- Placeholder for info_id -->
                                </td>
                                <td class="align-middle text-xs">
                                    Sample Title <!-- Placeholder for title -->
                                </td>
                                <td class="align-middle text-xs">
                                    <a href="https://example.com" target="_blank">Link</a> <!-- Placeholder for link -->
                                </td>
                                <td class="align-middle text-xs">
                                    10 <!-- Placeholder for hotel_id -->
                                </td>
                                <td class="align-middle text-xs">
                                    This is a sample content. <!-- Placeholder for content -->
                                </td>
                                <td class="align-middle text-xs">
                                    12/11/2023 <!-- Placeholder forCreate_at -->
                                </td>
                                <td class="align-middle text-xs">
                                    12/11/2023 <!-- Placeholder for  Update_at Update_at< -->
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editInfoModal">
                                        Edit
                                    </a> |
                                    <a href="javascript:;" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteInfoModal">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <!-- End of example row -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal for Adding New Info -->
        <!-- Modal for Adding New Info -->
        <div class="modal fade" id="addInfoModal" tabindex="-1" aria-labelledby="addInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addInfoModalLabel">Add New Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input type="url" class="form-control" id="link" name="link">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Editing Info -->
        <div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editInfoModalLabel">Edit Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="info_id" id="editInfoId">
                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="editTitle" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="editLink" class="form-label">Link</label>
                                <input type="url" class="form-control" id="editLink" name="link">
                            </div>
                            <div class="mb-3">
                                <label for="editContent" class="form-label">Content</label>
                                <textarea class="form-control" id="editContent" name="content" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Deleting Info -->
        <div class="modal fade" id="deleteInfoModal" tabindex="-1" aria-labelledby="deleteInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteInfoModalLabel">Delete Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Are you sure you want to delete this info?</p>
                            <input type="hidden" name="info_id" id="deleteInfoId">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="addInfoModal" tabindex="-1" aria-labelledby="addInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addInfoModalLabel">Add New Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addInfoForm" action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Form inputs for title, link, hotel_id, content -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
        @endsection