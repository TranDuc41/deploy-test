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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Error!</strong> {{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header pb-1 border-bottom-1">
                        <div class="row">
                            <div class="col-lg-7 col-7">
                                <h5>Danh mục</h5>
                            </div>
                            <div class="col-lg-5 col-5 my-auto mb-2 d-flex text-end">
                                <input class="form-control mx-3 mt" onkeyup="searchInTableCategoryFunction()" type="search" value="" placeholder="Nhập nội dung tìm kiếm..." id="search-input-category">

                                <button class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModalAddCategory">Thêm mới</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 p-3" id="table-category">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tiêu đề</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Slug</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nội dung</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->title }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->slug }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->content }}</p>
                                        </td>
                                        <td class="align-middle ">
                                            <div class="justify-content-end d-flex px-2 py-1">
                                                <button class="btn btn-link text-info font-weight-bold text-xs mx-3 editButtonCategory" data-bs-toggle="modal" data-bs-target="#exampleModalEditCategory" data-category-id="{{ $category->categories_id }}">Sửa</button>
                                                <button class="btn btn-link text-danger font-weight-bold text-xs mx-3 delete-btn-category" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteCategory" data-category-id="{{ $category->categories_id }}">Xóa</button>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="m-3">
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal thêm --}}
        <div class="modal fade" id="exampleModalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Category</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories') }}" method="POST" class="needs-validation">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tên</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Tên danh mục " oninput="updateSlug()" required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="slug danh mục " required>
                                <div class="invalid-feedback">
                                    Please provide a valid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nội dung</label>
                                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn bg-gradient-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="exampleModalDeleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Bạn có muốn xóa loại phòng này không?
                    </div>
                    <div class="modal-footer border-0">
                        <input type="hidden" id="deleteCategoryId" name="id" value="">
                        <button type="submit" class="btn btn-danger btn-sm" id="confirm-btn-dlcategory">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="exampleModalEditCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
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
                        <form method="POST" id="editCategoryForm" action="">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" class="form-control" name="name" id="nameEdit" value="">
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




    </div>
    @include('includes.footer')
</main>
</main>
<script>
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //Xử lý để yêu cầu xóa user
    var deleteBtns = document.querySelectorAll('.delete-btn-category');
    var confirmBtnDl = document.getElementById('confirm-btn-dlcategory');
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            var categoryId = this.getAttribute('data-category-id');
            confirmBtnDl.setAttribute('data-category-id', categoryId);
        });
    })
    if (confirmBtnDl != null) {
        confirmBtnDl.addEventListener('click', function() {
            var categoryId = this.getAttribute('data-category-id');
            fetch(`/categories/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Xử lý kết quả từ server
                    // console.log(data);

                    // Kiểm tra thông báo từ server và chuyển hướng trang
                    if (data.message === 'Xóa thành công.') {
                        // Chuyển hướng trang /users
                        window.location.href = '/categories';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/categories';
                    } else {
                        window.location.href = '/categories';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }

    //Xử lý để yêu cầu sửa category
    // Lấy tham chiếu đến nút "Edit"
    var editButtonsCategory = document.querySelectorAll('.editButtonCategory');

    if (editButtonsCategory !== null) {
        editButtonsCategory.forEach(function (editButton) {
            // Thêm sự kiện click cho nút "Edit"
            editButton.addEventListener('click', function () {
                //Tham chiều đến các trường input/select
                const userNameInput = document.getElementById('nameEdit');
                const userEmailInput = document.getElementById('descriptionEdit');
                const formEditUser = document.getElementById('editCategoryForm');
                //Lấy ra id của user
                const categoryId = editButton.dataset.categoryId;

                // Sử dụng Fetch API để gửi yêu cầu GET tới "/categories/{id}"
                fetch(`/categories/${categoryId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        // Xử lý dữ liệu nhận được từ server (data) ở đây
                        if (data !== null && data !== undefined) {
                            if (Object.keys(data).length !== 0) {
                                userNameInput.value = data.title;
                                userEmailInput.value = data.content;
                                formEditUser.action = "/categories/" + data.categories_id;
                            } else {
                                console.log("Không có dữ liệu. Vui lòng thử lại!");
                            }
                        } else {
                            console.log("Không có dữ liệu. Vui lòng thử lại!");
                        }
                    })
                    .catch(error => {
                        // Xử lý lỗi ở đây
                        console.error('Error:', error);
                    });
            });
        });
    }
</script>
<script>
    function updateSlug() {
        // Lấy giá trị từ trường "Tên"
        var title = document.getElementById('title').value;

        // Chuyển đổi giá trị thành slug
        var slug = title.toLowerCase().replace(/\s+/g, '-');

        // Gán giá trị slug vào trường "Slug"
        document.getElementById('slug').value = slug;
    }
</script>
<script>
    // JavaScript function to set the category ID in the delete modal form
    function setCategoryId(categoryId) {
        // Set the category ID in the hidden input field of the delete form
        document.getElementById('deleteCategoryId').value = categoryId;
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