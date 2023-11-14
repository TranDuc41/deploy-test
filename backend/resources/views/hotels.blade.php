@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('includes.header')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold "></p>
                        <h5 class="font-weight-bolder mb-0">
                            Tổng Hotel hiện có {{ $hotels->count() }}
                        </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <form action="{{ route('hotels.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Nhập nội dung tìm kiếm..." aria-label="Search" aria-describedby="search-addon" />
                </div>
            </form>
        </div>
        <!-- TABLE -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <h6>Hotels table</h6>
                <button type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New Hotel
                </button>
            </div>
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
                                    <span class="text-secondary text-xs font-weight-bold">{{ $hotel->created_at->format('d/m/Y H:i:s') }}</span>
                                </td></span>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $hotel->updated_at->format('d/m/Y H:i:s') }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-start gap-2">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editHotelModal" onclick="editHotel({{ json_encode($hotel)}})">
                                            Sửa
                                        </button>
                                        <form action="{{ route('hotel.destroy', ['hotel_id' => $hotel->hotel_id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa hotel này?');">
                                                Xóa
                                            </button> -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteHotelModal-{{ $hotel->hotel_id }}">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
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
                    <div class="card-footer py-4">
                        {{ $hotels->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->

        <!-- ...Modal Thêm... -->

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

                            <!-- Address Input - Replaced with Dropdowns -->

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn Thành Phố</label>
                                <select class="form-control" id="city" name="city">
                                    <option value="city" selected>Chọn tỉnh thành</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn Thành Phố</label>
                                <select class="form-control" id="district" name="district">
                                    <option value="district" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn Thành Phố</label>
                                <select class="form-control" id="ward" name="ward">
                                    <option value="ward" selected>Chọn phường xã</option>
                                </select>
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

        <!-- ... phần dưới của file view ... -->

        @foreach($hotels as $hotel)
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteHotelModal-{{ $hotel->hotel_id }}" tabindex="-1" aria-labelledby="deleteHotelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteHotelModalLabel">Cảnh Báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="bi bi-exclamation-triangle-fill" style="color: #FFA726; font-size: 2rem;"></i>
                        <p class="text-bold mt-2">Bạn có chắc muốn Xóa!</p>
                        <p>Sau khi xóa, dữ liệu sẽ không thể khôi phục.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <form action="{{ route('hotel.destroy', ['hotel_id' => $hotel->hotel_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xác Nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</main>
<!--   Core JS Files   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

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

<script>
    // JavaScript for live search
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
            const address = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
            const found = name.includes(searchText) || address.includes(searchText);
            row.style.display = found ? 'table-row' : 'none';
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

<script>
    const host = "https://cors-anywhere.herokuapp.com/https://provinces.open-api.vn/api/";

    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "city");
            });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }

    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }

    $("#city").change(() => {
        callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#ward").change(() => {
        printResult();
    })
</script>
@endsection