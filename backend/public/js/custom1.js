// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()
document.addEventListener("DOMContentLoaded", function() {
    //Edit room type
    var editRoomtypes = document.querySelectorAll('.editRoomtype');
    if (editRoomtypes !== null) {
        editRoomtypes.forEach(function(item) {

            // Thêm sự kiện click cho nút "Edit"
            item.addEventListener('click', function() {
                //Tham chiều đến các trường input/select
                const nameInput = document.getElementById('nameEdit');
                const slugInput = document.getElementById('slugEdit');
                const descriptionText = document.getElementById('descriptionEdit')
                    //Lấy ra id của user
                const rty_id = item.dataset.rty_id;
                console.log(rty_id);
                const formEditRoomType = document.getElementById('formEditRoomType')
                    // Sử dụng Fetch API để gửi yêu cầu GET tới "/room-type/{id}"
                fetch(`/room-type/${rty_id}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Xử lý dữ liệu nhận được từ server (data) ở đây
                        if (data !== null && data !== undefined) {
                            if (Object.keys(data).length !== 0) {
                                nameInput.value = data.name;
                                slugInput.value = data.slug;
                                descriptionText.value = data.description;
                                formEditRoomType.action = "/room-type/" + rty_id;
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
    //Delete room type

    var deleteRoomtypes = document.querySelectorAll('.deleteRoomType');
    if (deleteRoomtypes !== null) {
        deleteRoomtypes.forEach(function(item) {
            // Thêm sự kiện click cho nút "delete"
            item.addEventListener('click', function() {
                const rty_id = item.dataset.rty_id;
                const formEditRoomType = document.getElementById('formDeleteRoomType')
                formEditRoomType.action = "/room-type/" + rty_id;
                // Sử dụng Fetch API để gửi yêu cầu GET tới "/room-type/{id}"

            });
        });
    }
    // 

    //Edit amenities 
    var editAmenities = document.querySelectorAll('.editAmenities');
    if (editAmenities !== null) {
        editAmenities.forEach(function(item) {

            // Thêm sự kiện click cho nút "Edit"
            item.addEventListener('click', function() {
                //Tham chiều đến các trường input/select
                const nameInput = document.getElementById('nameEdit');
                const slugInput = document.getElementById('slugEdit');
                //Lấy ra id của user
                const amenities_id = item.dataset.amenities_id;
                const formEditAmenities = document.getElementById('formEditAmenities')
                    // Sử dụng Fetch API để gửi yêu cầu GET tới "/room-type/{id}"
                fetch(`/amenities/${amenities_id}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Xử lý dữ liệu nhận được từ server (data) ở đây
                        if (data !== null && data !== undefined) {
                            if (Object.keys(data).length !== 0) {
                                nameInput.value = data.name;
                                slugInput.value = data.slug;
                                formEditAmenities.action = "/amenities/" + amenities_id;
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
    //Delete amenities 

    var deleteAmenities = document.querySelectorAll('.deleteAmenities');
    if (deleteAmenities !== null) {
        deleteAmenities.forEach(function(item) {
            // Thêm sự kiện click cho nút "delete"
            item.addEventListener('click', function() {
                const amenities_id = item.dataset.amenities_id;
                const formDeleteAmenities = document.getElementById('formDeleteRoomType')
                formDeleteAmenities.action = "/amenities/" + amenities_id;

            });
        });
    }
});
//tạo slug
function createSlug(name) {
    return name
        .toLowerCase()
        .replace(/[^a-z0-9\s]/g, '')
        .replace(/\s+/g, '-')
        .trim();
}

function updateSlug() {
    var nameInput = document.getElementById('name');
    var slugInput = document.getElementById('slug');

    var nameValue = nameInput.value;
    var slugValue = createSlug(nameValue);

    slugInput.value = slugValue;
}