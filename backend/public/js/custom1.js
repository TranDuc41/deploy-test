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

    // ---------------------------------------------------------------------------------------------------------------------
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
    // ---------------------------------------------------------------------------------------------------------------------
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

    // ---------------------------------------------------------------------------------------------------------------------
    // Lấy phần tử input bằng id
    var user_id = document.getElementById('user_id_item');
    const user_id_original = user_id.value;
    // Đặt giá trị cho phần tử input
    user_id.value = encodeID(user_id.value);;

    //create sale
    var btnCreateSale = document.getElementById('btnAddSale');
    const formCreateSale = document.getElementById('formCreateSale');
    btnCreateSale.addEventListener('click', function() {
        if (user_id_original === decodeID(user_id.value)) {
            formCreateSale.action = "/sale";
            formCreateSale.method = "POST"
        } else {

        }
    })

    // edit sale
    var editSale = document.querySelectorAll('.editSale');
    if (editSale !== null) {
        editSale.forEach(function(item) {
            item.dataset.user_id = encodeID(item.dataset.user_id);
            // Thêm sự kiện click cho nút "Edit"
            item.addEventListener('click', function() {
                //so sánh id user
                // Nếu trùng thì bạn được quyền sửa nếu không trùng thì bạn ko được xóa
                if (user_id_original === decodeID(item.dataset.user_id)) {
                    $('#exampleModalEditSale').modal('show');
                    //Tham chiều đến các trường input/select
                    const discountEdit = document.getElementById('discountEdit');
                    const startDateTime = document.getElementById('start-datetime-edit');
                    const endDateTime = document.getElementById('end-datetime-edit');
                    //Lấy ra id của sale
                    const sale_id = item.dataset.sale_id;
                    const formEditSale = document.getElementById('formEditSale');
                    // Sử dụng Fetch API để gửi yêu cầu GET tới "/sale/{id}"
                    fetch(`/sale/${sale_id}`, {
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
                                    discountEdit.value = data.discount;
                                    startDateTime.value = data.start_date;
                                    endDateTime.value = data.end_date;
                                    formEditSale.action = "/sale/" + sale_id;
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
                } else {
                    $('#modal-notification').modal('show');
                }
            });
        });
    }

    //Delete sale 
    var deleteSale = document.querySelectorAll('.deleteSale');
    if (deleteSale !== null) {
        deleteSale.forEach(function(item) {
            //hash id user
            item.dataset.user_id = encodeID(item.dataset.user_id);
            // Thêm sự kiện click cho nút "delete"
            item.addEventListener('click', function() {
                //so sánh id user
                // Nếu trùng thì bạn được quyền sửa nếu không trùng thì bạn ko được xóa
                if (user_id_original === decodeID(item.dataset.user_id)) {
                    $('#exampleModalDeleteSale').modal('show');
                    const sale_id = item.dataset.sale_id;
                    const formDeleteSale = document.getElementById('formDeleteSale')
                    formDeleteSale.action = "/sale/" + sale_id;
                } else {
                    $('#modal-notification').modal('show');
                }
            });
        });
    }
    // ---------------------------------------------------------------------------------------------------------------------

});
//tạo slug
function createSlug(name) {
    return name
        .toLowerCase() // Chuyển đổi thành chữ thường
        .normalize('NFD') // Chuyển đổi các ký tự có dấu thành ký tự không dấu
        .replace(/[\u0300-\u036f]/g, '') // Loại bỏ các ký tự dấu
        .replace(/\s+/g, '-') // Thay thế khoảng trắng bằng dấu gạch ngang
        .replace(/[^a-z0-9-]/g, '') // Loại bỏ các ký tự không phải chữ cái, số, hoặc dấu gạch ngang
        .replace(/-+/g, '-') // Loại bỏ các dấu gạch ngang liên tiếp
        .replace(/^-+|-+$/g, ''); // Loại bỏ dấu gạch ngang ở đầu và cuối chuỗi

}
//update slug
function updateSlug() {
    var nameInput = document.getElementById('name');
    var slugInput = document.getElementById('slug');

    var nameValue = nameInput.value;
    var slugValue = createSlug(nameValue);

    slugInput.value = slugValue;
}
//Random chuỗi 5 kí tự
function generateRandomString(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        result += characters.charAt(randomIndex);
    }
    return result;
}
//ghep key va encodeID
function insertStringAtIndex(str1, str2, position) {
    const result = str1.slice(0, position) + str2 + str1.slice(position);
    return result;
}

function encodeID(id) {
    const encodedID = btoa(id);
    const key = generateRandomString(5);
    var result = insertStringAtIndex(encodedID, key, 1);
    return result;
}

function decodeID(encodedID) {
    //caắt chuỗi key và id hash
    encodedID = encodedID.slice(0, 1) + encodedID.slice(6);
    //giải mã
    var decodedID = atob(encodedID);
    return decodedID;
}