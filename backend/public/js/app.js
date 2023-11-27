document.addEventListener('DOMContentLoaded', function () {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //Xử lý để yêu cầu sửa user
    // Lấy tham chiếu đến nút "Edit"
    var editButtons = document.querySelectorAll('.editButton');

    if (editButtons !== null) {
        editButtons.forEach(function (editButton) {
            // Thêm sự kiện click cho nút "Edit"
            editButton.addEventListener('click', function () {
                //Tham chiều đến các trường input/select
                const userNameInput = document.getElementById('user-name');
                const userEmailInput = document.getElementById('user-email');
                const roleSelect = document.getElementById('Select-role');
                const formEditUser = document.getElementById("user-form");

                //Lấy ra id của user
                const userId = editButton.dataset.userId;

                // Sử dụng Fetch API để gửi yêu cầu GET tới "/users/{id}"
                fetch(`/users/${userId}`, {
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
                                userNameInput.value = data.name;
                                userEmailInput.value = data.email;
                                roleSelect.value = data.user_type;
                                formEditUser.action = "/users/" + userId;
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


    //Xử lý để yêu cầu xóa user
    var deleteBtns = document.querySelectorAll('.delete-btn');
    var confirmBtn = document.getElementById('confirm-btn');

    deleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener('click', function () {
            var userId = this.getAttribute('data-user-id');
            confirmBtn.setAttribute('data-user-id', userId);
        });
    })
    if (confirmBtn != null) {
        confirmBtn.addEventListener('click', function () {
            var userId = this.getAttribute('data-user-id');

            fetch(`/users/${userId}`, {
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
                        window.location.href = '/users';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/users';
                    }
                    else {
                        window.location.href = '/users';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }


    //Xử lý để xóa hình ảnh
    var deleteImgBtns = document.querySelectorAll('.delete-img-btn');
    var confirmImgBtn = document.getElementById('confirm-img-btn');
    deleteImgBtns.forEach(function (deleteImgBtn) {
        deleteImgBtn.addEventListener('click', function () {
            var imgId = this.getAttribute('data-delete-img');
            confirmImgBtn.setAttribute('delete-img', imgId);
        });
    })
    if (confirmImgBtn != null) {
        confirmImgBtn.addEventListener('click', function () {
            var imgId = this.getAttribute('delete-img');

            fetch(`/image/${imgId}`, {
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
                        // Chuyển hướng trang /images
                        window.location.href = '/images';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/images';
                    }
                    else {
                        window.location.href = '/images';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }


    //Xử lý ẩn alert() sau 5s
    var alerts = document.querySelectorAll('.alert');

    setTimeout(function () {
        alerts.forEach(function (alert) {
            alert.style.display = 'none';
        });
    }, 5000);

    //Delete Room
    var deleteRooms = document.querySelectorAll('.delete-room');
    var comfirmDeleteRoom = document.getElementById('comfirm-delete-room');
    deleteRooms.forEach(function (deleteRoom) {
        deleteRoom.addEventListener("click", function () {
            var roomSlug = this.getAttribute('data-slug');
            comfirmDeleteRoom.setAttribute('delete-room', roomSlug);
        })
    })
    if (comfirmDeleteRoom != null) {
        comfirmDeleteRoom.addEventListener('click', function () {
            var roomSlug = this.getAttribute('delete-room');
            fetch(`/edit-room/${roomSlug}`, {
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
                        // Chuyển hướng trang /rooms
                        window.location.href = '/rooms';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/rooms';
                    }
                    else {
                        window.location.href = '/rooms';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }

    //Xử lý để yêu cầu sửa nhà hàng
    // Lấy tham chiếu đến nút "Edit"
    var editRestaurants = document.querySelectorAll('.edit-restaurant');

    if (editRestaurants !== null) {
        editRestaurants.forEach(function (editRestaurant) {
            // Thêm sự kiện click cho nút "Edit"
            editRestaurant.addEventListener('click', function () {
                //Tham chiều đến các trường input/select
                const nameRestaurant = document.getElementById('name');
                const timeOpen = document.getElementById('open_time');
                const timeClose = document.getElementById('close_time');
                const imageFile = document.getElementById("restaurant_img");
                const description = document.getElementById('description_restaurant');
                const image = document.getElementById('restaurant_img_select');
                const time_update = document.getElementById('time_update');
                const form_edit_restaurant = document.getElementById('form_edit_restaurant');

                //Lấy ra slug của nhà hàng
                const slugRestaurant = editRestaurant.dataset.slug;

                // Sử dụng Fetch API để gửi yêu cầu GET tới "/restaurant/{slug}"
                fetch(`/restaurant/${slugRestaurant}`, {
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
                                nameRestaurant.value = data.restaurant.name;
                                timeOpen.value = data.restaurant.time_open.slice(0, -3);
                                timeClose.value = data.restaurant.time_close.slice(0, -3);
                                description.value = data.restaurant.description;
                                image.src = data.images[0].img_src;
                                time_update.value = data.restaurant.updated_at;

                                form_edit_restaurant.action = "/restaurant/" + slugRestaurant;
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

    //Delete Restaurant
    var deleteRooms = document.querySelectorAll('.delete-restaurant');
    var comfirmDeleteRoom = document.getElementById('comfirm-delete-restaurant');
    deleteRooms.forEach(function (deleteRoom) {
        deleteRoom.addEventListener("click", function () {
            var roomSlug = this.getAttribute('data-slug');
            comfirmDeleteRoom.setAttribute('delete-restaurant', roomSlug);
        })
    })
    if (comfirmDeleteRoom != null) {
        comfirmDeleteRoom.addEventListener('click', function () {
            var roomSlug = this.getAttribute('delete-restaurant');
            fetch(`/restaurant/${roomSlug}`, {
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
                        // Chuyển hướng trang /rooms
                        window.location.href = '/restaurant';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/restaurant';
                    }
                    else {
                        window.location.href = '/restaurant';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }

    //Xử lý để yêu cầu sửa spa
    // Lấy tham chiếu đến nút "Edit"
    var editSpas = document.querySelectorAll('.edit-spa');

    if (editSpas !== null) {
        editSpas.forEach(function (editSpa) {
            // Thêm sự kiện click cho nút "Edit"
            editSpa.addEventListener('click', function () {
                //Tham chiều đến các trường input/select
                const nameSpa = document.getElementById('name');
                const timeOpen = document.getElementById('open_time');
                const timeClose = document.getElementById('close_time');
                const imageFile = document.getElementById("spa_img");
                const description = document.getElementById('description_spa');
                const image = document.getElementById('spa_img_select');
                const time_update = document.getElementById('time_update');
                const form_edit_spa = document.getElementById('form_edit_spa');

                //Lấy ra slug của spa
                const slugSpa = editSpa.dataset.slug;

                // Sử dụng Fetch API để gửi yêu cầu GET tới "/spa/{slug}"
                fetch(`/spa/${slugSpa}`, {
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
                                nameSpa.value = data.spa.name;
                                timeOpen.value = data.spa.time_open.slice(0, -3);
                                timeClose.value = data.spa.time_close.slice(0, -3);
                                description.value = data.spa.description;
                                image.src = data.images[0].img_src;
                                time_update.value = data.spa.updated_at;

                                form_edit_spa.action = "/spa/" + slugSpa;
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

    //Delete Spa
    var deleteSpa = document.querySelectorAll('.delete-spa');
    var comfirmDeleteSpa = document.getElementById('comfirm-delete-spa');
    deleteSpa.forEach(function (deleteRoom) {
        deleteRoom.addEventListener("click", function () {
            var spaSlug = this.getAttribute('data-slug');
            comfirmDeleteSpa.setAttribute('delete-spa', spaSlug);
        })
    })
    if (comfirmDeleteSpa != null) {
        comfirmDeleteSpa.addEventListener('click', function () {
            var spaSlug = this.getAttribute('delete-spa');
            fetch(`/spa/${spaSlug}`, {
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
                        // Chuyển hướng trang /rooms
                        window.location.href = '/spa';
                    } else if (data.message === 'Xóa thất bại') {
                        window.location.href = '/spa';
                    }
                    else {
                        window.location.href = '/spa';
                    }
                })
                .catch(error => {
                    // Xử lý lỗi
                    console.error('Error:', error);
                });
        });
    }

});



//Xử lý tìm kiếm trong table
function searchInTableFunction() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("usersTable");
    tr = table.getElementsByTagName("tr");

    var noResultsRow = document.getElementById("no-results-row");

    // Tạo dòng "Trống" nếu chưa có
    if (!noResultsRow) {
        noResultsRow = table.insertRow();
        var cell = noResultsRow.insertCell(0);
        cell.colSpan = tr[0].cells.length; // Đặt colSpan bằng số lượng ô trong mỗi hàng
        cell.innerHTML = "Không có kết quả phù hợp.";
        noResultsRow.className = "text-center";
        noResultsRow.id = "no-results-row";
        noResultsRow.style.display = "none"; // Ẩn mặc định
    }

    // Lặp qua tất cả các hàng trong bảng
    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = ""; // Hiển thị tất cả các hàng trước khi kiểm tra
        var rowContainsSearchTerm = false;

        // Loop qua từng ô trong hàng
        for (j = 0; j < tr[i].cells.length; j++) {
            td = tr[i].cells[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    // Nếu tìm thấy kết quả trong ô nào đó, không ẩn hàng và thoát khỏi vòng lặp
                    rowContainsSearchTerm = true;
                    noResultsRow.style.display = "none";
                    break;
                }
            }
        }

        // Ẩn hoặc hiển thị hàng tùy thuộc vào việc có chứa kết quả tìm kiếm không
        if (!rowContainsSearchTerm) {
            tr[i].style.display = "none";
            noResultsRow.style.display = "table-row";
        }
    }
}

