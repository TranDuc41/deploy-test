@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100">
    @include('includes.header')
    <div class="container-fluid py-4">
        <div class="row">
        </div>
        <div class="row mt-4">
            <div class="row">
                <div class="col-6">
                    <button class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModalAddSpa">Thêm Mới</button>
                </div>
                <div class="col-6">
                    <input class="form-control" onkeyup="searchInTableFunction()" type="search" value="" placeholder="Nhập nội dung tìm kiếm..." id="search-input">
                </div>
                <div class="col-12">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white"><strong>Success!</strong> {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white"><strong>Danger!</strong> {{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            <div></div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="usersTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên Spa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thời gian mở cửa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thời gian đóng cửa</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spas as $spa)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $spa->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $spa->time_open }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $spa->time_close }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="col-md-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bg-gradient-warning btn-block mb-3 edit-spa" data-bs-toggle="modal" data-bs-target="#modalEditSpa" data-slug="{{ $spa->slug }}">
                                            Edit
                                        </button>
                                        <button type="button" class="delete-spa btn btn-block bg-gradient-danger mb-3" data-bs-toggle="modal" data-bs-target="#modal-notification" data-slug="{{ $spa->slug }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $spas->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Modal Sửa -->
        <div class="modal fade" id="modalEditSpa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Thông Tin Spa</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/spa/" method="POST" class="needs-validation" enctype="multipart/form-data" id="form_edit_spa">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên spa..." required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Thời gian mở cửa</label>
                                <input class="form-control" type="time" id="open_time" name="open_time" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Thời gian đóng cửa</label>
                                <input class="form-control" type="time" id="close_time" name="close_time" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">File Menu Spa (chỉ nhập file PDF)</label>
                                <input type="file" name="spa_menu" id="spa_menu" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Hình Ảnh</label>
                                <input type="file" name="spa_img[]" id="spa_img" class="form-control" multiple>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                                <img id="spa_img_select" src="" alt="Dominion" class="avatar avatar-xxl mt-3">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nội dung mô tả</label>
                                <textarea class="form-control" id="description_spa" name="description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" id="time_update" name="time_update" hidden />
                            </div>
                            <button type="submit" class="btn bg-gradient-primary">Sửa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal thêm mới -->
        <div class="modal fade" id="exampleModalAddSpa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Spa</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('spa') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên spa..." required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Thời gian mở cửa</label>
                                <input class="form-control" type="time" value="07:00" id="open_time" name="open_time" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Thời gian đóng cửa</label>
                                <input class="form-control" type="time" value="22:30" id="close_time" name="close_time" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">File Menu (chỉ nhập file PDF)</label>
                                <input type="file" name="spa_menu" id="spa_menu" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Hình Ảnh</label>
                                <input type="file" name="spa_img[]" id="spa_img" class="form-control" multiple required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nội dung mô tả</label>
                                <textarea class="form-control" name="description" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn bg-gradient-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete-->
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Cảnh Báo</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="py-3 text-center">
                            <i class="ni ni-bell-55 ni-3x"></i>
                            <h4 class="text-gradient text-danger mt-4">Bạn có chắc muốn Xóa!</h4>
                            <p>Sau khi xóa, dữ liệu sẽ không thể khôi phục.</p>
                            <span class="d-none" id="slug-value"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="comfirm-delete-bookings-spa" class="btn btn-danger">Xác nhận</button>
                        <button type="button" class="btn bg-gradient-default ml-auto" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    </div>
</main>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3">
                <h6 class="mb-0">Navbar Fixed</h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
            </div>
            <hr class="horizontal dark my-sm-4">
            <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
            <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
            <div class="w-100 text-center">
                <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                <h6 class="mt-3">Thank you for sharing!</h6>
                <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                </a>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
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