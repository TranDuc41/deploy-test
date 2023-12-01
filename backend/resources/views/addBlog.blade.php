@extends('layouts.app')

@section('content')
@include('includes.sidebar')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                                <h5>Add Blogs</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="/add-blog-new" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Tiêu đề</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Thời gian đọc</label>
                                            <input type="number" class="form-control" id="read-time" name="read-time" placeholder="Thời gian đọc dự kiến..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlSelect1">Hình ảnh</label>
                                        <input type="file" name="image-blog" id="image-blog" class="form-control" required>
                                        <div class="col-6">
                                       
                                        <label for="exampleFormControlSelect1">Trạng Thái </label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="action">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiện</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleFormControlSelect1">Thể loại</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="category">
                                            @foreach($categories as $category)
                                            <option value="{{ $category->categories_id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlSelect1">Mô tả ngắn</label>
                                        <textarea name="short-desc" id="short-desc" class="form-control" rows="6" required ></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="description" id="quillContent">
                                <div class="col">
                                    <label for="exampleFormControlSelect1">Nội dung bài viết</label>
                                    <div id="editor">
                                    </div>
                                </div>
                                <div class="button-add mt-5">
                                    <a href="/blogs">
                                        <button class="btn btn-primary" type="submit" onclick="submitForm()">Thêm</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="m-3">
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
</main>
<!--   Core JS Files   -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    function submitForm() {
        // Lấy nội dung từ Quill editor
        var quillContent = quill.root.innerHTML;

        // Gán giá trị cho trường ẩn
        document.getElementById('quillContent').value = quillContent;

        // Submit form
        document.getElementById('yourFormId').submit();
         // Chuyển hướng sau khi form được submit
         window.location.href = '/blogs';
    }
</script>
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