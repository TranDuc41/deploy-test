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
            const activeSelect = document.getElementById('Select-active');
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
                            roleSelect.value = data.uesr_type;
                            activeSelect.value = data.active;
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