@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100">
    @include('includes.header')
    <div class="container-fluid py-4">
        <h4 class="font-weight-bolder mb-5">{{ isset($room) ? 'Chỉnh Sửa' : 'Tạo Mới' }} Thông Tin Phòng</h4>
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
        <div class="row">
            <form action="{{ isset($room) ? route('edit-room.edit', $room) : route('edit-room.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="room-name" class="form-control-label">Tên Phòng</label>
                    <input class="form-control" type="text" id="room-name" name="room-name" required value="{{ isset($room) ? $room->title : '' }}">
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="room-price" class="form-control-label">Giá Phòng</label>
                        <div class="input-group">
                            <input class="form-control" type="number" value="{{ isset($room) ? $room->price : '' }}" id="room-price" name="room-price" required readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="Sale-Select">Giảm Giá</label>
                        <select class="form-control" id="Sale-Select" name="sale-select">
                            <option value="0">0%</option>
                            @foreach($sales as $sale)
                            <option value="{{ $sale->sale_id }}" {{ isset($room) && $room->sale_id == $sale->sale_id ? 'selected' : '' }}>{{ $sale->discount }}%</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label for="room-adults" class="form-control-label">Số người lớn</label>
                        <input class="form-control" type="number" value="{{ isset($room) ? $room->adults : '' }}" id="room-adults" name="room-adults" required>
                    </div>
                    <div class="form-group col-3">
                        <label for="room-children" class="form-control-label">Số trẻ em</label>
                        <input class="form-control" type="number" value="{{ isset($room) ? $room->children : '' }}" id="room-children" name="room-children" required>
                    </div>
                    <div class="form-group col-3">
                        <label for="room-area" class="form-control-label">Kích thước phòng (m&sup2;)</label>
                        <input class="form-control" type="number" value="{{ isset($room) ? $room->area : '' }}" id="room-area" id="room-area" name="room-area" required>
                    </div>
                    <div class="form-group col-3">
                        <label for="kind-room">Loại phòng</label>
                        <select class="form-control" id="kind-room" name="kind-room">
                            @foreach($roomTypes as $roomType)
                            <option value="{{ $roomType->rty_id }}" {{ isset($room) && $room->rty_id == $roomType->rty_id ? 'selected' : '' }}>
                                {{ $roomType->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="package-room">Gói lưu trú</label>
                        <select class="form-control" id="package-room" name="package-room[]" multiple size="6">
                            @foreach($packages as $package)
                            <option value="{{ $package->packages_id }}" {{ isset($room) && $room->packages->contains('packages_id', $package->packages_id) ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                            @endforeach
                        </select>


                    </div>
                    <div class="form-group col-6">
                        <label for="room-amenities">Tiện nghi</label>
                        <select class="form-control" id="room-amenities" name="room-amenities[]" multiple size="6">
                            @foreach($amenities as $amenitie)
                            <option value="{{ $amenitie->amenities_id }}" {{ isset($room) && $room->amenities->contains('amenities_id', $amenitie->amenities_id) ? 'selected' : '' }}>
                                {{ $amenitie->name }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="room-status">Trạng thái phòng</label>
                        <select class="form-control" id="room-status" name="room-status">
                            <option value="work" {{ isset($room) && $room->status == 'work' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="maintenance" {{ isset($room) && $room->status == 'maintenance' ? 'selected' : '' }}>Bảo trì</option>
                            <option value="used" {{ isset($room) && $room->status == 'used' ? 'selected' : '' }}>Đang được sử dụng</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="exampleFormControlSelect1">Hình ảnh</label>
                        <input type="file" name="images[]" id="image" class="form-control" multiple {{ isset($room) ? '' : 'required' }}>
                    </div>
                    @if(isset($images))
                    <div class="col-6">
                        <label for="exampleFormControlSelect1">Ảnh đã tải lên</label>
                        <div>
                            @if($images->count() > 0)
                            @foreach($images as $image)
                            <img src="{{ $image->img_src }}" alt="" class="avatar avatar-xxl me-3">
                            @endforeach
                            {{ $images->links('pagination::bootstrap-5') }} <!-- Hiển thị link phân trang -->
                            @else
                            <p>Không có hình ảnh.</p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description-input" class="form-control-label">Mô tả</label>
                    <textarea class="form-control" rows="10" value="@example.com" id="description-input" name="description-input" required>{{ isset($room) ? $room->description : '' }}</textarea>
                </div>
                <input class="form-control d-none" type="text" value="{{ isset($room) ? $room->slug : '' }}" name="room-slug">
                <!-- <a href="{{ isset($room) ? '/edit-room/' . $room->slug : '/create-room' }}"> -->
                <button type="submit" class="btn bg-gradient-primary">{{ isset($room) ? 'Sửa' : 'Tạo Mới' }}</button>
                <!-- </a> -->
            </form>
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