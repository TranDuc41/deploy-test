@extends('layouts.app')

@section('content')
    @include('includes.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100">
        @include('includes.header')
        <div class="container-fluid py-4">
            <form method="POST" class="needs-validation">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 mb-lg-0 mb-4">
                                <div class="card mt-4 mb-3">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <h6 class="mb-0">Thông tin phòng</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3 " id="booking-body">
                                        <div class="row">
                                            <div class="row" style="width: 100%">
                                                <div class="col-lg-6 ">
                                                    <div class="form-group ">
                                                        <label for="example-datetime-local-input"
                                                            class="form-control-label">Ngày
                                                            nhận phòng </label>
                                                        <input class="form-control" type="datetime-local"
                                                            id="start-datetime-input"
                                                            value="{{ now()->format('Y-m-d\TH:i') }}"
                                                            min="{{ now()->format('Y-m-d\TH:i') }}" name="checkIn"
                                                            id="checkIn" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="example-datetime-local-input"
                                                            class="form-control-label">Ngày
                                                            trả phòng</label>
                                                        <input class="form-control" type="datetime-local"
                                                            id="end-datetime-input"
                                                            value="{{ now()->addDay()->format('Y-m-d\TH:i') }}"
                                                            min="{{ now()->addDay()->format('Y-m-d\TH:i') }}"
                                                            name="checkOut" id="checkOut" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="width: 100%">
                                                <div class="col-lg-6 ">
                                                    <div class="form-group ">
                                                        <label for="example-datetime-local-input"
                                                            class="form-control-label">Người lớn </label>
                                                        <input class="form-control" type="number" id="start-datetime-input"
                                                            value="0" maxlength="20" name="adults" id="adults"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="example-datetime-local-input"
                                                            class="form-control-label">Trẻ em</label>
                                                        <input class="form-control" type="number" id="end-datetime-input"
                                                            value="0" maxlength="20" name="children" id="children"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <button type="button" class="btn bg-gradient-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modal-default"
                                                        id="show-room-booking">Chọn
                                                        phòng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header pb-0 px-3">
                                        <h6 class="mb-0">Thanh toán</h6>
                                    </div>
                                    <div class="card-body pt-4 p-3 d-flex">
                                        <ul class="list-group" style="width: 50%">
                                            <li
                                                class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-sm">Tổng tiền</h6>
                                                    <span class="mb-2 text-xs">Mã giảm trá: </span>
                                                    <span class="mb-2 text-xs">Phí dịch vụ (2%/phòng): </span>
                                                    <span class="text-xs">VAT (8%/phòng): </span>
                                                </div>
                                            </li>

                                        </ul>
                                        <ul class="list-group " style="width: 50%">
                                            <li
                                                class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg text-end justify-content-end">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-sm" id="total_amount"> </h6>
                                                    <span class="mb-2 text-xs" id="discount">0</span>
                                                    <span class="mb-2 text-xs" id="service_charge">0</span>
                                                    <span class="text-xs" id="VAT">0</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn bg-gradient-primary">Thanh toan</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 mt-4">
                        <div class="card mb-3">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Note</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3 pb-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <textarea class="form-control" aria-label="With textarea" rows="5" name="note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  mb-3">
                            <div class="card-header pb-0 px-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-0">Khách hàng</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tên Khách hàng</label>
                                    <input class="form-control" type="text" name="full_name">
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="example-tel-input" class="form-control-label">Số điện thoại</label>
                                    <input class="form-control" type="text" name="phone_number">
                                </div>
                                <div class="form-group">
                                    <label for="example-number-input" class="form-control-label">Địa chỉ</label>
                                    <input class="form-control" type="text" name="address">
                                    <input class="form-control" type="hidden" name="update">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal fade modal-lg " id="modal-default" tabindex="-1" role="dialog"
                aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal- modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Thêm phòng</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modal-room-body_item">
                            @foreach ($rooms as $item)
                                <div class="card card-blog card-plain">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="position-relative">
                                                <a class="d-block blur-shadow-image">
                                                    <img src="{{ $item->images[0]->img_src }}" alt="img-blur-shadow"
                                                        class="img-fluid shadow border-radius-lg" width="100%"
                                                        height="500px" style="object-fit: cover">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">

                                            <div class="card-body px-0 pt-4">
                                                <p
                                                    class="text-gradient text-primary text-gradient font-weight-bold text-sm text-uppercase">
                                                    {{ $item->price }} VND</p>
                                                <a href="javascript:;">
                                                    <h3>
                                                        {{ $item->title }}
                                                    </h3>
                                                </a>
                                                <p>
                                                    {{ $item->description }}
                                                </p>
                                                <blockquote class="blockquote text-white mb-0">
                                                    <p class="text-dark ms-3">Người lớn : {{ $item->adults }} người</p>
                                                    <p class="text-dark ms-3">Trẻ em : {{ $item->children }} người </p>
                                                </blockquote>
                                                <button type="button" data-slug="{{ $item->slug }}"
                                                    class="btn bg-gradient-primary mt-3 room-booking-item"
                                                    data-bs-dismiss="modal">Chọn
                                                    phòng</button>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
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
