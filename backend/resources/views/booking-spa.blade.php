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
            <h4 class="mt-5">Lịch đặt spa</h4>
            <div id="btn-delete-all">
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="usersTable">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                                        <label class="form-check-label" for="selectAllCheckbox"></label>
                                    </div>
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên Khách Hàng</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số Điện Thoại</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày Giờ Đặt</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên Spa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ghi Chú</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spas as $spa)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input booking-checkbox" type="checkbox" id="bookingCheckbox{{ $loop->index }}" data-slug="{{ $spa->id }}">
                                        <label class="form-check-label" for="bookingCheckbox{{ $loop->index }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $spa->full_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $spa->phone_number }}</p>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $spa->email }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $spa->date_time }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $spa->spa_name }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $spa->note }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="col-md-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bg-gradient-warning btn-block mb-3 edit-booking-spa" data-bs-toggle="modal" data-bs-target="#modalEditBookingSpa" data-slug="{{ $spa->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="delete-booking-spa btn btn-block bg-gradient-danger mb-3" data-bs-toggle="modal" data-bs-target="#modal-notification" data-slug="{{ $spa->id }}">Delete</button>
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

        <!-- Modal Sửa Booking Spa -->
        <div class="modal fade" id="modalEditBookingSpa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Thông Tin Đặt Spa</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/bookings-spa/" method="POST" class="needs-validation" enctype="multipart/form-data" id="form_edit_booking_spa">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên Khách Hàng</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Số Điện Thoại</label>
                                <input class="form-control" type="text" id="phone_number" name="phone_number" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email</label>
                                <input class="form-control" type="email" id="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Ngày Đặt</label>
                                <input class="form-control" type="date" id="date" name="date" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Giờ Đặt</label>
                                <input class="form-control" type="time" id="time" name="time" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Ghi Chú</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
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
                        <button type="button" id="comfirm-delete-booking-spa" class="btn btn-danger">Xác nhận</button>
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
<script>
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //Hàm thực hiện xóa nhiều
    function initializeTable(tableId, selectAllCheckboxId, deleteButtonContainerId, deleteAllEndpoint) {
        // Lấy ra tất cả các checkbox hàng và checkbox "Chọn Tất Cả"
        var allCheckboxes = document.querySelectorAll(`#${tableId} .booking-checkbox`);
        var selectAllCheckbox = document.getElementById(selectAllCheckboxId);

        // Xử lý sự kiện khi checkbox "Chọn Tất Cả" thay đổi
        selectAllCheckbox.addEventListener('change', function () {
            var isChecked = this.checked;

            // Thiết lập trạng thái của tất cả các checkbox hàng
            allCheckboxes.forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });

            // Lấy ra mảng giá trị "data-slug" của các hàng được chọn
            var selectedSlugs = getSelectedSlugs();

            // Thêm hoặc xóa button dựa trên việc có hàng được chọn hay không
            if (selectedSlugs.length > 0) {
                addDeleteButton();
            } else {
                removeDeleteButton();
            }

            console.log(selectedSlugs);
        });

        // Xử lý sự kiện khi một trong các checkbox hàng thay đổi
        allCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                // Nếu tất cả các checkbox hàng đều được chọn, chọn checkbox "Chọn Tất Cả"
                if (document.querySelectorAll(`#${tableId} .booking-checkbox:checked`).length === allCheckboxes.length) {
                    selectAllCheckbox.checked = true;
                } else {
                    selectAllCheckbox.checked = false;
                }

                // Lấy ra mảng giá trị "data-slug" của các hàng được chọn
                var selectedSlugs = getSelectedSlugs();

                // Thêm hoặc xóa button dựa trên việc có hàng được chọn hay không
                if (selectedSlugs.length > 0) {
                    addDeleteButton();
                } else {
                    removeDeleteButton();
                }

                console.log(selectedSlugs);
            });
        });

        // Hàm thêm button vào DOM
        function addDeleteButton() {
            // Kiểm tra xem button đã tồn tại trong DOM chưa
            var deleteButton = document.getElementById('delete-all');
            if (!deleteButton) {
                // Nếu chưa tồn tại, tạo button và thêm vào DOM
                deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.id = 'delete-all';
                deleteButton.className = 'btn btn-danger';
                deleteButton.innerHTML = 'Xóa tất cả';
                deleteButton.addEventListener('click', function () {
                    // Xử lý logic khi button được click
                    var userConfirmed = confirm("Bạn chắc muốn xóa chứ. \n Nội dung sẽ không thể khôi phục!");

                    if (userConfirmed) {
                        // Người dùng đã xác nhận, thực hiện xóa hoặc các thao tác khác
                        console.log('Đã xác nhận xóa tất cả.');

                        // Gọi hàm thực hiện xóa tất cả hoặc các thao tác khác
                        deleteAll(deleteAllEndpoint);
                    } else {
                        // Người dùng đã hủy bỏ
                        console.log('Đã hủy xóa tất cả.');
                    }
                });

                // Thêm button vào DOM
                var divElement = document.getElementById(deleteButtonContainerId);
                divElement.appendChild(deleteButton);
            }
        }

        // Hàm xóa button khỏi DOM
        function removeDeleteButton() {
            // Kiểm tra xem button đã tồn tại trong DOM không
            var deleteButton = document.getElementById('delete-all');
            if (deleteButton) {
                // Nếu tồn tại, xóa button khỏi DOM
                deleteButton.remove();
            }
        }

        // Hàm lấy ra mảng giá trị "data-slug" của các hàng được chọn
        function getSelectedSlugs() {
            var selectedSlugs = [];
            allCheckboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    selectedSlugs.push(checkbox.getAttribute('data-slug'));
                }
            });
            return selectedSlugs;
        }

        //Hàm xóa tất cả
        function deleteAll(endpoint) {
            // Lấy ra mảng giá trị "data-slug" của các hàng được chọn
            var selectedSlugs = getSelectedSlugs();

            if (selectedSlugs.length > 0) {
                // Gửi yêu cầu DELETE đến endpoint với danh sách ID cần xóa
                fetch(endpoint, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken, // Đảm bảo thêm CSRF token nếu cần
                    },
                    body: JSON.stringify({ ids: selectedSlugs }),
                })
                    .then(response => response.json())
                    .then(data => {
                        // Xử lý kết quả từ server
                        console.log(data);

                        // Hiển thị thông báo hoặc thực hiện các thao tác khác
                        alert(data.message);
                        window.location.reload();
                    })
                    .catch(error => {
                        // Xử lý lỗi
                        console.error('Error:', error);
                    });
            } else {
                // Nếu không có hàng nào được chọn
                alert('Vui lòng chọn ít nhất một hàng để xóa.');
            }
        }
    }

    // Sử dụng hàm initializeTable cho mỗi bảng cụ thể
    initializeTable('usersTable', 'selectAllCheckbox', 'btn-delete-all', '/delete-all-booking-spa');
</script>
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