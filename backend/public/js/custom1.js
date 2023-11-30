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

document.addEventListener("DOMContentLoaded", function () {
    var total_amount = document.getElementById('total_amount');
    var discount = document.getElementById('discount');
    var service_charge = document.getElementById('service_charge');
    var VAT = document.getElementById('VAT');

    // ---------------------------------------------------------------------------------------------------------------------
    //Edit room type
    var editRoomtypes = document.querySelectorAll('.editRoomtype');
    if (editRoomtypes !== null) {
        editRoomtypes.forEach(function (item) {

            // Thêm sự kiện click cho nút "Edit"
            item.addEventListener('click', function () {
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
                                formEditRoomType.action = "/room-type/" + encodeID(rty_id);
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
        deleteRoomtypes.forEach(function (item) {
            // Thêm sự kiện click cho nút "delete"
            item.addEventListener('click', function () {
                const rty_id = item.dataset.rty_id;
                const formEditRoomType = document.getElementById('formDeleteRoomType')
                formEditRoomType.action = "/room-type/" + encodeID(rty_id);
                // Sử dụng Fetch API để gửi yêu cầu GET tới "/room-type/{id}"
            });
        });
    }
    // 
    // ---------------------------------------------------------------------------------------------------------------------
    //Edit amenities 
    var editAmenities = document.querySelectorAll('.editAmenities');
    if (editAmenities !== null) {
        editAmenities.forEach(function (item) {

            // Thêm sự kiện click cho nút "Edit"
            item.addEventListener('click', function () {
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
                                formEditAmenities.action = "/amenities/" + encodeID(amenities_id);
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
        deleteAmenities.forEach(function (item) {
            // Thêm sự kiện click cho nút "delete"
            item.addEventListener('click', function () {
                const amenities_id = item.dataset.amenities_id;
                const formDeleteAmenities = document.getElementById('formDeleteRoomType')
                formDeleteAmenities.action = "/amenities/" + encodeID(amenities_id);

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
    btnCreateSale.addEventListener('click', function () {
        if (user_id_original === decodeID(user_id.value)) {
            formCreateSale.action = "/sale";
            formCreateSale.method = "POST"
        } else {
            $('#modal-notification').modal('show');
        }
    })

    // edit sale
    var editSale = document.querySelectorAll('.editSale');
    if (editSale !== null) {
        editSale.forEach(function (item) {
            item.dataset.e8701ad48ba05a91604e480dd60899a3 = encodeID(item.dataset.e8701ad48ba05a91604e480dd60899a3);
            // Thêm sự kiện click cho nút "Edit"
            item.addEventListener('click', function () {
                //so sánh id user
                // Nếu trùng thì bạn được quyền sửa nếu không trùng thì bạn ko được xóa
                if (user_id_original === decodeID(item.dataset.e8701ad48ba05a91604e480dd60899a3) || item.dataset.d7b5164029f944313b08c6b778b7b178 === 'sp-admin') {
                    $('#exampleModalEditSale').modal('show');
                    //Tham chiều đến các trường input/select
                    const discountEdit = document.getElementById('discountEdit');
                    const startDateTime = document.getElementById('start-datetime-edit');
                    const endDateTime = document.getElementById('end-datetime-edit');
                    //Lấy ra id của sale
                    const sale_id = item.dataset.e70b59714528d5798b1c8adaf0d0ed15;
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
                                    formEditSale.action = "/sale/" + encodeID(sale_id);
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
        deleteSale.forEach(function (item) {
            //hash id user
            item.dataset.e8701ad48ba05a91604e480dd60899a3 = encodeID(item.dataset.e8701ad48ba05a91604e480dd60899a3);
            // Thêm sự kiện click cho nút "delete"
            item.addEventListener('click', function () {
                //so sánh id user
                // Nếu trùng thì bạn được quyền sửa nếu không trùng thì bạn ko được xóa
                if (user_id_original === decodeID(item.dataset.e8701ad48ba05a91604e480dd60899a3) || item.dataset.d7b5164029f944313b08c6b778b7b178 === 'sp-admin') {
                    $('#exampleModalDeleteSale').modal('show');
                    const sale_id = item.dataset.e70b59714528d5798b1c8adaf0d0ed15;
                    const formDeleteSale = document.getElementById('formDeleteSale')
                    formDeleteSale.action = "/sale/" + encodeID(sale_id);
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
//key
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
//Xử lý tìm kiếm trong tienich
function searchInTableAmenitiesFunction() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search-input-amenities");
    filter = input.value.toUpperCase();
    table = document.getElementById("table-amenities");
    tr = table.getElementsByTagName("tr");

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
                    break;
                }
            }
        }

        // Ẩn hoặc hiển thị hàng tùy thuộc vào việc có chứa kết quả tìm kiếm không
        if (!rowContainsSearchTerm) {
            tr[i].style.display = "none";
        }
    }
}
//Xử lý tìm kiếm trong room type
function searchInTableRoomTypeFunction() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search-input-roomRype");
    filter = input.value.toUpperCase();
    table = document.getElementById("table-room-type");
    tr = table.getElementsByTagName("tr");

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
                    break;
                }
            }
        }

        // Ẩn hoặc hiển thị hàng tùy thuộc vào việc có chứa kết quả tìm kiếm không
        if (!rowContainsSearchTerm) {
            tr[i].style.display = "none";
        }
    }
}
//chan duuble click
var isButtonClicked = false;

function handleClick() {
    if (!isButtonClicked) {
        isButtonClicked = true;
        // Thực hiện hành động của bạn ở đây

        // Sau khi hoàn thành, đặt lại trạng thái
        setTimeout(function () {
            isButtonClicked = false;
        }, 2000); // Thời gian chờ giữa các lần click để tránh double click
    }
}


function removerItem() {
    var remove_room_booking = document.querySelectorAll('.remove-room-booking');
    if (remove_room_booking != null) {
        remove_room_booking.forEach(function (item) {
            item.addEventListener('click', function () {
                const card = item.closest('.card');
                console.log(card);
                if (card) {
                    card.remove();
                }
            });
        });
    }
}

// Hàm lưu trạng thái đã đánh dấu vào local storage
function saveCheckedState() {
    const myKey = 'difference';
    const myValue = localStorage.getItem(myKey);

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);

    localStorage.setItem('checkedCheckboxes', JSON.stringify(checkedCheckboxes));

    // var total_, service_, VAT_;
    // const rooms = JSON.parse(checkedCheckboxes);
    // console.log(rooms);
    // rooms.forEach(room => {

    //     total_ += parseFloat(room.price) * parseFloat(myValue)
    //     service_ = parseFloat(room.price) * parseFloat(myValue) * 0.02;
    //     VAT_ = parseFloat(room.price) * 0.08;
    //     total_ = parseFloat(room.price) + service_ + VAT_;

    // });

    // let total_amount = document.getElementById('total_amount');
    // let service_charge = document.getElementById('service_charge');
    // let VAT_amount = document.getElementById('VAT');

    // service_charge.textContent = service_.toString();
    // VAT_amount.textContent = VAT_.toString();
    // total_amount.textContent = total_.toString();
}

// Hàm tải trạng thái đã đánh dấu từ local storage
function loadCheckedState() {
    const checkedCheckboxes = JSON.parse(localStorage.getItem('checkedCheckboxes')) || [];

    checkedCheckboxes.forEach(value => {
        const checkbox = document.getElementById(`checkbox${value}`);
        if (checkbox) {
            checkbox.checked = true;
        }
    });
}

// Thêm bộ lắng nghe sự kiện cho các ô đánh dấu
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', saveCheckedState);
});

// Tải trạng thái đã đánh dấu khi trang được tải
window.addEventListener('load', loadCheckedState);
//chuyen doi
function calculateDateDifference() {
    // Lấy giá trị từ các trường input
    const startDateString = document.getElementById("checkIn").value;
    const endDateString = document.getElementById("checkOut").value;

    // Chuyển đổi chuỗi ngày thành đối tượng Date
    const startDate = new Date(startDateString);
    const endDate = new Date(endDateString);

    // Tính số mili giây giữa hai ngày
    const timeDifference = endDate - startDate;

    // Chuyển đổi số mili giây thành số ngày
    const dayDifference = timeDifference / (1000 * 60 * 60 * 24);
    console.log(dayDifference);
    localStorage.setItem('difference', dayDifference);
}