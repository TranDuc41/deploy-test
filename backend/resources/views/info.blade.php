@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('includes.header')
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

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold "></p>
                        <h5 class="font-weight-bolder mb-0">
                            Tổng Info hiện có {{ $infos->count() }}
                        </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <form action="{{ route('info.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="Nhập nội dung tìm kiếm..." aria-label="Search" aria-describedby="search-addon" />

                </div>
            </form>
        </div>
        <!-- Info Table -->
        <div class="card">

            <div class="card-header pb-0">
                <h6>Bảng Thông Tin </h6>
                <button type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addInfoModal">
                    Thêm Thông Tin 
                </button>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tiêu đề </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link khách sạn</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hotel ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nội dung</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày cập nhật</th>
                                <th class="text-secondary opacity-7"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            @foreach($infos as $info)
                            <tr>
                                <td class="align-middle text-xs">
                                    {{ $info->title }}
                                </td>
                                <td class="align-middle text-xs">
                                    <a href="{{ $info->link }}" target="_blank">{{ $info->link }}</a>
                                </td>
                                <td class="align-middle text-xs">
                                    {{ $info->hotel->name }}
                                </td>
                                <td class="align-middle text-xs">
                                    {{ $info->content }}
                                </td>
                                <td class="align-middle text-xs">
                                    {{ $info->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="align-middle text-xs">
                                    {{ $info->updated_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editInfoModal-{{ $info->info_id }}" onclick="editInfo({{ json_encode($info) }})">
                                        Sửa
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteInfoModal-{{ $info->info_id }}" data-info-id="{{ $info->info_id }}">
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer py-4">
                        {{$infos->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Thêm Info -->
        <div class="modal fade" id="addInfoModal" tabindex="-1" aria-labelledby="addInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addInfoModalLabel">Thêm mới thông tin </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('info.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Link Hotel</label>
                                <input type="url" class="form-control" id="link" name="link">
                            </div>
                            <div class="mb-3">
                                <label for="hotel_id" class="form-label">Hotel</label>
                                <select class="form-control" id="hotel_id" name="hotel_id" required>
                                    @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->hotel_id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($infos as $info)
        <!-- Modal xóa -->
        <div class="modal fade" id="deleteInfoModal-{{ $info->info_id }}" tabindex=" F-1" role="dialog" aria-labelledby="deleteInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteInfoModalLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Bạn có chắc chắn muốn xóa thông tin này?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <!-- Form xóa -->
                        <form method="POST" action="{{ route('info.destroy', $info->info_id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="deleteInfoId" name="info_id" value="{{ $info->info_id }}">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal sửa Info -->
        <div class="modal fade" id="editInfoModal-{{ $info->info_id }}" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editInfoModalLabel">Cập nhật thông tin </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editInfoForm-{{ $info->info_id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="info_id" id="editInfoId-{{ $info->info_id }}">
                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="editTitle-{{ $info->info_id }}" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="editLink" class="form-label">Link Hotel </label>
                                <input type="url" class="form-control" id="editLink-{{ $info->info_id }}" name="link">
                            </div>
                            <div class="mb-3">
                                <label for="editHotelId" class="form-label"> Tên Hotel </label>
                                <select class="form-control" id="editHotelId-{{ $info->info_id }}" name="hotel_id" required>
                                    @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->hotel_id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editContent" class="form-label">Nội dung </label>
                                <textarea class="form-control" id="editContent-{{ $info->info_id }}" name="content" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
    </div>
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
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        // Js sửa info
        function editInfo(info) {
            document.getElementById('editInfoId-' + info.info_id).value = info.info_id;
            document.getElementById('editTitle-' + info.info_id).value = info.title;
            document.getElementById('editLink-' + info.info_id).value = info.link;
            document.getElementById('editHotelId-' + info.info_id).value = info.hotel_id;
            document.getElementById('editContent-' + info.info_id).value = info.content;

            var form = document.getElementById('editInfoForm-' + info.info_id);
            form.action = '/info/' + info.info_id;
            form.method = 'POST';
        }
    </script>
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const tableRows = document.querySelectorAll('.table tbody tr');

            searchInput.addEventListener('input', function(e) {
                const searchValue = e.target.value.toLowerCase();

                tableRows.forEach(row => {
                    const id = row.querySelector('.align-middle.text-xs').textContent.toLowerCase();
                    const title = row.querySelector('.align-middle.text-xs:nth-child(2)').textContent.toLowerCase();
                    const link = row.querySelector('.align-middle.text-xs:nth-child(3) a').textContent.toLowerCase();
                    const hotel = row.querySelector('.align-middle.text-xs:nth-child(4)').textContent.toLowerCase();
                    const content = row.querySelector('.align-middle.text-xs:nth-child(5)').textContent.toLowerCase();

                    if (id.includes(searchValue) || title.includes(searchValue) || link.includes(searchValue) || hotel.includes(searchValue) || content.includes(searchValue)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    @endsection