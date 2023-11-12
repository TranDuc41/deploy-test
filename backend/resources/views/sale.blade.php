@extends('layouts.app')

@section('content')
    @include('includes.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('includes.header')
        <div class="container-fluid py-4" id="sale-container">
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
                <div class="col-md-7 mt-2">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                              <div class="col-6 d-flex align-items-center">
                                <h5 class="mb-0">Mã giảm giá</h5>
                              </div>
                              <div class="col-6 text-end">
                                <button class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#exampleModalAddSale"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Thêm</button>
                              </div>
                            </div>
                          </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                @foreach ($sales as $item)
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-3 text-primary "><span class="text-lg text-dark">Mã giảm : </span>
                                                {{ $item->discount }}%</h4>
                                            <span class="mb-2 text-xs">ID : <span
                                                    class="text-dark font-weight-bold ms-sm-2">
                                                    {{ $item->sale_id }}</span></span>
                                            <span class="mb-2 text-xs">Ngày bắt đầu : <span
                                                    class="text-dark ms-sm-2 font-weight-bold">{{ $item->start_date }}</span></span>
                                            <span class="mb-2 text-xs">Ngày kết thúc : <span
                                                    class="text-dark ms-sm-2 font-weight-bold">{{ $item->end_date }}</span></span>
                                            <span class="text-xs">Admin : <span
                                                    class="text-dark ms-sm-2 font-weight-bold">{{ $item->user->name }}</span></span>
                                        </div>
                                        <div class="ms-auto text-end">
                                            <button class="btn btn-link text-info px-3 mb-0 editSale"
                                                data-bs-toggle="modal" data-sale_id ="{{ $item->sale_id }}"
                                                data-user_id ="{{ $item->user_id }}"><i
                                                    class="fas fa-pencil-alt text-info me-2"
                                                    aria-hidden="true"></i>Sửa</button>
                                            <button class="btn btn-link text-dark text-gradient px-3 mb-0 deleteSale"
                                                data-toggle="tooltip" data-original-title="Delete user"
                                                data-bs-toggle="modal" data-sale_id ="{{ $item->sale_id }}"
                                                data-user_id ="{{ $item->user_id }}"><i
                                                    class="far fa-trash-alt me-2"></i>Xóa</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mt-4">
                    <div class="card h-100 mb-4">
                        <div class="card-header pb-0 px-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Nội dung cuối kì </h6>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <small>23 - 30 March 2020</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-down"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                                            <span class="text-xs">27 March 2020, at 12:30 PM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                        - $ 2,500
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Apple</h6>
                                            <span class="text-xs">27 March 2020, at 04:30 AM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 2,000
                                    </div>
                                </li>
                            </ul>
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                                            <span class="text-xs">26 March 2020, at 13:45 PM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 750
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                                            <span class="text-xs">26 March 2020, at 12:30 PM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 1,000
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                                            <span class="text-xs">26 March 2020, at 08:30 AM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 2,500
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="fas fa-exclamation"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                                            <span class="text-xs">26 March 2020, at 05:00 AM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                                        Pending
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal thêm --}}
            <div class="modal fade" id="exampleModalAddSale" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Mã giảm giá</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formCreateSale" class="needs-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Discount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">%</span>
                                        <input type="text" class="form-control" name="discount" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-datetime-local-input" class="form-control-label">Ngày bắt
                                        đầu</label>
                                    <input class="form-control" type="datetime-local" id="start-datetime-input"
                                        value="{{ $currentDateTime->format('Y-m-d H:i:s') }}"
                                        min="{{ $currentDateTime->format('Y-m-d H:i:s') }}" name="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-datetime-local-input" class="form-control-label">Ngày kết
                                        thúc</label>
                                    <input class="form-control" type="datetime-local" id="end-datetime-input"
                                        value="{{ $currentDateTime->format('Y-m-d H:i:s') }}"
                                        min="{{ $currentDateTime->format('Y-m-d H:i:s') }}" name="end_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-datetime-local-input" class="form-control-label">Name
                                        Admin</label>
                                    <input type="hidden" id="user_id_item" name="user_id"
                                        value="{{ Auth::user()->user_id }}">
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                        disabled>
                                </div>
                                <button class="btn bg-gradient-primary" id="btnAddSale">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Edit Chỉ admin mới có quyền được sửa --}}
            <div class="modal fade" id="exampleModalEditSale" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sửa
                                mã giảm giá</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formEditSale">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Discount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">%</span>
                                        <input type="text" class="form-control" name="discount" id="discountEdit"
                                            required>
                                        <div class="invalid-feedback">
                                            Please provide a valid.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-datetime-local-input" class="form-control-label">Ngày bắt
                                        đầu</label>
                                    <input class="form-control" type="datetime-local" id="start-datetime-edit"
                                        value="{{ $currentDateTime->format('Y-m-d H:i:s') }}" name="start_date">
                                </div>
                                <div class="form-group">
                                    <label for="example-datetime-local-input" class="form-control-label">Ngày kết
                                        thúc</label>
                                    <input class="form-control" type="datetime-local" id="end-datetime-edit"
                                        value="{{ $currentDateTime->format('Y-m-d H:i:s') }}" name="end_date">
                                </div>
                                <button type="submit" class="btn bg-gradient-primary">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->
            <div class="modal fade" id="exampleModalDeleteSale" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content ">
                        <div class="modal-body border-0 mt-4">
                            Bạn có muốn xóa mã giảm này không ?
                        </div>
                        <div class="modal-footer border-0 ">
                            <form method="POST" id="formDeleteSale">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-link text-dark"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-danger">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal Popup --}}
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="py-3 text-center">
                                <i class="ni ni-bell-55 ni-3x"></i>
                                <h4 class="text-gradient text-danger mt-4">Không thể thực hiện thao tác!</h4>
                                <p>Bạn không có quyền truy cập và thay đổi giá trị.!</p>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn  bg-gradient-primary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
