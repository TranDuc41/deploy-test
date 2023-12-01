@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100">
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
                <div class="card my-4">
                    <div class="card-header pb-1  border-bottom-1">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <h5>Blogs</h5>
                            </div>
                            <div class="col-lg-5 col-5 my-auto mb-2 d-flex text-end">
                                <input class="form-control mx-3 mt" onkeyup="searchInTableRoomTypeFunction()" type="search" value="" placeholder="Nhập nội dung tìm kiếm..." id="search-input-roomRype">
                                <a href="/add-blogs"><button class="btn bg-gradient-primary btn-sm mb-0">Thêm</button></a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 p-3" id="table-room-type">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Ảnh bìa</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tiêu đề</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Trạng thái</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Mô tả ngắn</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thời gian đọc </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thể loại</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Người viết</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ optional($blog->images->first())->img_src }}" class="avatar avatar-sm me-3">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $blog->title }}</p>
                                        </td>
                                        <td>
                                            @if($blog->action === 0)
                                            Ẩn
                                            @elseif($blog->action === 1)
                                            Hiển thị
                                            @else
                                            Lỗi
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $blog->short_desc }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $blog->read_time}} Phút</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $blog->category->title }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $blog->user->name }}</p>
                                        </td>
                                        <td class="align-middle ">
                                            <div class="justify-content-end d-flex px-2 py-1">
                                                <a href="/edit-blog/{{ $blog->slug }}"><button class="btn btn-link text-info font-weight-bold text-xs mx-3 editRoomtype">
                                                        <i class="fas fa-pencil-alt text-default me-2" aria-hidden="true"></i>Edit
                                                    </button></a>
                                                <button class="btn btn-link text-danger font-weight-bold text-xs mx-3 deleteBlog" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteBlog" data-blog-id="{{ $blog->slug }}">
                                                    <i class="far fa-trash-alt me-2"></i>Xóa
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="m-3">
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal thêm --}}
        <div class="modal fade" id="exampleModalAddRoomType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm loại phòng</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('room-types') }}" method="POST" class="needs-validation">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Pavilions & Villas" oninput="updateSlug()" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="pavilions-&-villas" required>
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
        <!-- Modal Delete -->
        <div class="modal fade" id="exampleModalDeleteBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalDeleteBlog" aria-hidden="true">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="confirm-btn-dl">Xác nhận</button>
                            <button type="button" class="btn bg-gradient-default ml-auto" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.footer')
</main>
<script>
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //Xử lý để yêu cầu xóa user
    var deleteBtns = document.querySelectorAll('.deleteBlog');
    var confirmBtn = document.getElementById('confirm-btn-dl');

    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            var userId = this.getAttribute('data-blog-id');
            confirmBtn.setAttribute('data-blog-id', userId);
        });
    })
    if (confirmBtn != null) {
        confirmBtn.addEventListener('click', function() {
            var userId = this.getAttribute('data-blog-id');

            fetch(`/delete-blog/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Xử lý kết quả từ server
                    console.log(data);

                    // Kiểm tra thông báo từ server và chuyển hướng trang
                    if (data.message === 'Xóa thành công.') {
                        // Chuyển hướng trang /users
                        window.location.href = '/blogs';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/blogs';
                    } else {
                        window.location.href = '/blogs';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }
</script>
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