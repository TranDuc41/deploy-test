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
        <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif -->
        @if(session('err'))
        <div class="alert alert-success">
            {{ session('err') }}
        </div>
        @endif
        <!-- TABLE -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <h6>Hotels table</h6>
                <button type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New Hotel
                </button>
            </div>
            <!-- Card body -->
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hotel ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
                                <th class="text-secondary opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Repeat this block for each hotel entry in your database -->
                            @foreach($hotels as $hotel)
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $hotel->hotel_id }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $hotel->name }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $hotel->address }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $hotel->phone }}</p>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $hotel->created_at->format('d/m/Y') }}</span>
                                </td></span>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $hotel->updated_at->format('d/m/Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editHotelModal" onclick="editHotel({{ json_encode($hotel)}})">
                                        Edit
                                    </button>
                                    <form action="{{ route('hotel.destroy', ['hotel_id' => $hotel->hotel_id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa hotel này?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal chỉnh sửa thông tin khách sạn -->
                            <div class="modal fade" id="editHotelModal" tabindex="-1" aria-labelledby="editHotelModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editHotelModalLabel">Chỉnh Sửa Thông Tin Khách Sạn</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="editHotelForm" action="{{ route('hotels.update', ['hotel_id' => $hotel->hotel_id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="modal-body">
                                                <input type="hidden" id="editHotelId" name="hotel_id">
                                                <div class="mb-3">
                                                    <label for="editHotelName" class="form-label">Tên Khách Sạn</label>
                                                    <input type="text" class="form-control" id="editHotelName" name="name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editHotelAddress" class="form-label">Địa Chỉ</label>
                                                    <input type="text" class="form-control" id="editHotelAddress" name="address" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editHotelPhone" class="form-label">Số Điện Thoại</label>
                                                    <input type="tel" class="form-control" id="editHotelPhone" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Lưu Lại</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- End of block -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->

        <!-- Modal - add hotel-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Khách Sạn Mới</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="hotelForm" action="{{ route('hotelData') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Hotel Name Input -->
                            <div class="mb-3">
                                <label for="hotelName" class="form-label">Tên Khách Sạn</label>
                                <input type="text" class="form-control" id="hotelName" name="name" required>
                            </div>

                            <!-- Address Input -->
                            <div class="mb-3">
                                <label for="hotelAddress" class="form-label">Địa Chỉ</label>
                                <input type="text" class="form-control" id="hotelAddress" name="address" required>
                            </div>

                            <!-- Phone Input -->
                            <div class="mb-3">
                                <label for="hotelPhone" class="form-label">Số Điện Thoại</label>
                                <input type="tel" class="form-control" id="hotelPhone" name="phone" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn bg-gradient-primary">Lưu Lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>














    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
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
<script>
    // JavaScript để điền dữ liệu vào form khi nút Edit được nhấn
    function editHotel(hotel) {
        document.getElementById('editHotelId').value = hotel.hotel_id;
        document.getElementById('editHotelName').value = hotel.name;
        document.getElementById('editHotelAddress').value = hotel.address;
        document.getElementById('editHotelPhone').value = hotel.phone;

        // Cập nhật action của form để gửi đến route cập nhật thông tin
        var form = document.getElementById('editHotelForm');
        form.action = '/hotels/' + hotel.hotel_id;
        form.method = 'post'; // Hoặc 'GET' nếu bạn muốn gửi thông tin qua URL

        // Thêm phần tử input ẩn để gửi phương thức PUT nếu bạn đang sử dụng phương thức POST
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = '_method';
        hiddenInput.value = 'PUT';
        form.appendChild(hiddenInput);
    }

    function editHotel(hotel) {
        document.getElementById('editHotelId').value = hotel.hotel_id;
        document.getElementById('editHotelName').value = hotel.name;
        document.getElementById('editHotelAddress').value = hotel.address;
        document.getElementById('editHotelPhone').value = hotel.phone;

        var form = document.getElementById('editHotelForm');
        form.action = '/hotels/' + hotel.hotel_id; // Chắc chắn rằng đây là đường dẫn chính xác đến route chỉnh sửa
        form.method = 'POST'; // Sử dụng phương thức POST để gửi thông tin
    }

    //----------------------------------------------------------------

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