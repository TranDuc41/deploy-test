@extends('layouts.app')

@section('content')
    @include('includes.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('includes.header')
        <div class="container-fluid py-4">
            <div class="row">
                @if (session('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Lỗi !</strong> {{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="d-flex justify-content-between card-header pb-0">
                            <h6>Loại phòng</h6>
                            <button class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#exampleModalAddRoomType">Thêm</button>
                            {{-- Modal thêm --}}
                            <div class="modal fade" id="exampleModalAddRoomType" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm loại phòng</h5>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('room-types') }}" method="POST"
                                                class="needs-validation">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Tên</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Pavilions & Villas" oninput="updateSlug()" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid.
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Slug</label>
                                                    <input type="text" class="form-control" name="slug" id="slug"
                                                        placeholder="pavilions-&-villas" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid.
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Nội dung</label>
                                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn bg-gradient-primary">Thêm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 " id="table-room-type">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tên</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                slug</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nội dung </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($room_types as $room_type)
                                            <tr>

                                                <td class="align-middle text-left text-sm">
                                                    <p class="text-xs font-weight-bold mb-0 ps-3 ">{{ $room_type->rty_id }}
                                                    </p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $room_type->name }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $room_type->slug }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0" >{{ $room_type->description }}
                                                    </p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex px-2 py-1">
                                                        <a class="text-info font-weight-bold text-xs mx-3 editRoomtype"
                                                            data-original-title="Edit user" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalEditRoomType"
                                                            data-rty_id="{{ $room_type->rty_id }}">
                                                            <i class="fas fa-pencil-alt text-default me-2" aria-hidden="true"></i>Edit
                                                        </a>
                                                        <a class="text-danger font-weight-bold text-xs mx-3 deleteRoomType"
                                                            data-toggle="tooltip" data-original-title="Delete user"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalDeleteRoomType"
                                                            data-rty_id="{{ $room_type->rty_id }}">
                                                            <i class="far fa-trash-alt me-2"></i>Xóa
                                                        </a>
                                                    </div>
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
            {{-- Modal Edit --}}
            <div class="modal fade" id="exampleModalEditRoomType" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sửa
                                Loại phòng</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formEditRoomType">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" name="name" id="nameEdit">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slugEdit">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Nội dung</label>
                                    <textarea class="form-control" name="description" rows="3" id="descriptionEdit"></textarea>
                                </div>
                                <button type="submit" class="btn bg-gradient-primary">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->
            <div class="modal fade" id="exampleModalDeleteRoomType" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Delete </h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có muốn xóa loại phòng này không ?
                        </div>
                        <div class="modal-footer border-0">
                            <form method="POST" id="formDeleteRoomType">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-danger">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
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
