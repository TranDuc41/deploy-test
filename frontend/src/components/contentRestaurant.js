'use client'
import { useState, useEffect } from 'react';
import { Button, Col, Row, Modal } from "react-bootstrap";
import Link from "next/link";
import Image from 'react-bootstrap/Image';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import { format, addDays, isAfter, isBefore } from 'date-fns';

const currentDate = new Date();
const endOfYear = new Date(currentDate.getFullYear(), 11, 31);

const contentRestaurant = () => {
    const [restaurants, setRestaurants] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showModal, setShowModal] = useState(false);
    const [selectedRestaurant, setSelectedRestaurant] = useState(null);
    const [formData, setFormData] = useState({
        date: new Date(),
        time: '10:00',
        note: null,
        fullName: '',
        phone: '',
        email: '',
        isChecked: false,
    });

    const handleOpenModal = (restaurant) => {
        setSelectedRestaurant(restaurant);
        setShowModal(true);
    };

    const handleCloseModal = () => {
        setShowModal(false);
    };

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://localhost:8000/api/restaurants');
                const data = await response.json();
                setRestaurants(data);
                setLoading(false);
            } catch (error) {
                console.error('Error fetching data:', error);
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    const handleBookingClick = () => {
        //kiểm tra số điện thoại
        function isVietnamesePhoneNumber(number) {
            return /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/.test(number);
        }

        //kiểm tra email
        function isValidEmail(email) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailRegex.test(email);
        }

        // Thực hiện hành động khi người dùng nhấn vào nút "Đặt chỗ"
        const currentDate = new Date();
        const selectedDate = new Date(formData.date);

        // Kiểm tra xem ngày đã chọn có lớn hơn ngày hiện tại không
        const isDateAfterToday = isAfter(selectedDate, currentDate);

        // Kiểm tra xem ngày đã chọn có chênh lệch không quá 30 ngày so với ngày hiện tại không
        const isDateWithin30Days = isBefore(selectedDate, addDays(currentDate, 30));

        if (!isDateAfterToday && !isDateWithin30Days) {
            // Ngày không hợp lệ
            alert("Ngày tháng không hợp lệ!");
        }
        else if (!formData.fullName || formData.fullName.trim() === '' || formData.fullName.trim().split(/\s+/).length >= 50) {
            alert('Trường tên không hợp lệ!');
        }
        else if (formData.note && formData.note.trim().split(/\s+/).length >= 100) {
            alert('Nội dung quá dài! (Vượt quá 100 từ)')
        }
        else if (!isVietnamesePhoneNumber(formData.phone)) {
            alert('Số điện thoại không hợp lệ!');
        }
        else if (!formData.email || formData.email.trim().length === 0 || !isValidEmail(formData.email)) {
            alert('Email không hợp lệ!');
        }
        else {
            async function makeRequest() {
                const crypto = require('crypto');
                // Sử dụng:
                const secretKey = 'hdfkjshdfkhfskfhkknn34234234234kmndkfhsf34njhdf3j4j3nbjf34';

                function createSignature(data, secretKey) {
                    const hash = crypto.createHmac('sha256', secretKey)
                        .update(data)
                        .digest('hex');
                    return hash;
                }

                const formattedDate = format(new Date(formData.date), 'dd/MM/yyyy');
                const dataToSign = {
                    ...formData,
                    date: formattedDate.replace(/\//g, ''),
                    restaurant: selectedRestaurant.slug,
                };

                const signature = createSignature(JSON.stringify(dataToSign), secretKey);
                const requestData = {
                    data: dataToSign,
                    signature: signature,
                };

                try {
                    // Gửi yêu cầu tới máy chủ và xử lý response
                    const response = await fetch('http://localhost:8000/api/restaurants', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(requestData),
                    });
                    // Chờ đến khi Promise được giải quyết và sau đó đọc dữ liệu JSON
                    const responseData = await response.json();

                    if (responseData.success) {
                        handleCloseModal();
                        alert('Đặt chỗ thành công.\n Nhân viên sẽ sớm liên hệ để xác nhận với bạn. \n Xin cảm ơn.');
                        window.location.reload();
                    } else {
                        alert(responseData.message);
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            // Gọi hàm để thực hiện yêu cầu
            makeRequest();

        }
    };

    return (
        <>
            {loading ? (
                <p>Loading...</p>
            ) : (
                restaurants.map((restaurant, index) => (
                    <Row key={index} className={`restaurante-item ${index % 2 === 0 ? 'even' : 'odd'}`}>
                        <Col className="bg-white text-center d-flex justify-content-center">
                            <div>
                                <h3>{restaurant.name}</h3>
                                <span>{restaurant.description}</span>
                                <div className="restaurant-link">
                                    <Link href={`http://localhost:8000/uploads/file/${restaurant.drink_link}`} target="_blank">Drink List</Link>
                                    <Link href={`http://localhost:8000/uploads/file/${restaurant.food_link}`} target="_blank">Food Menu</Link>
                                    <span>{restaurant.time_open.slice(0, -3)} - {restaurant.time_close.slice(0, -3)}</span>
                                </div>
                                <div className="d-flex justify-content-center mt-4 btn-booking">
                                    <Button onClick={() => handleOpenModal(restaurant)}>Đặt ngay</Button>
                                </div>
                            </div>
                        </Col>
                        <Col className="restaurant-img">
                            <Image
                                width={518}
                                height={650}
                                src={restaurant.images.length > 0 ? 'http://localhost:8000' + restaurant.images[0].img_src : './dominion-defaul.png'}
                                alt="Dominion"
                            />
                        </Col>
                    </Row>
                ))
            )}

            {/* Modal */}
            <Modal show={showModal} onHide={handleCloseModal}>
                <Modal.Header closeButton>
                    <div>
                        <Modal.Title>Yêu cầu đặt chỗ</Modal.Title>
                        <span>Chúng tôi muốn dành cho bạn nhừng gì hoàn hảo nhất</span>
                    </div>

                </Modal.Header>
                <Modal.Body>
                    <div id='restaurant-modal'>
                        <h5>Chi tiết đặt chỗ</h5>
                        <div className='row'>
                            <div className='col-6'>
                                <h6>Ngày</h6>
                                <DatePicker
                                    selected={formData.date}
                                    onChange={(date) => setFormData((prevData) => ({ ...prevData, date }))}
                                    dateFormat="d/M/y"
                                    minDate={currentDate}
                                    maxDate={endOfYear}
                                />
                            </div>
                            <div className='col-6'>
                                <h6>Thời gian</h6>
                                <input
                                    className='w-100 p-1'
                                    type='time'
                                    value={formData.time}
                                    name='time'
                                    onChange={(e) => setFormData((prevData) => ({ ...prevData, time: e.target.value }))}
                                />
                            </div>
                        </div>
                        <div className='row mb-5 mt-3'>
                            <span>Bạn có yêu cầu đặc biệt nào không? Chúng tôi sẽ cố gắng hết sức để đáp ứng.</span>
                            <textarea
                                rows="4"
                                name='note'
                                value={formData.note}
                                onChange={(e) => setFormData((prevData) => ({ ...prevData, note: e.target.value }))}
                            ></textarea>
                        </div>
                        <div className='detail_user'>
                            <h5>Chi tiết liên hệ</h5>
                            <div className='row'>
                                <div className='col-6'>
                                    <h6>Họ và tên</h6>
                                    <input
                                        type='text'
                                        name='fullName'
                                        value={formData.fullName}
                                        onChange={(e) =>
                                            setFormData((prevData) => ({ ...prevData, fullName: e.target.value }))
                                        }
                                    />
                                </div>
                                <div className='col-6'>
                                    <h6>Số điện thoại</h6>
                                    <input
                                        name='phone'
                                        type='text'
                                        value={formData.phone}
                                        onChange={(e) => setFormData((prevData) => ({ ...prevData, phone: e.target.value }))}
                                    />
                                </div>
                                <div className='col-12 mt-2'>
                                    <h6>Địa chỉ email</h6>
                                    <input
                                        type='email'
                                        className='w-100'
                                        name='email'
                                        value={formData.email}
                                        onChange={(e) => setFormData((prevData) => ({ ...prevData, email: e.target.value }))}
                                    />
                                </div>
                            </div>
                        </div>
                        <div>
                            <h6 className='mt-4'>Bạn có thể thay đổi hoặc hủy đặt chỗ sau bằng cách gửi email cho chúng tôi kèm theo tên và ngày đặt chỗ của bạn</h6>
                            <div className="form-check mb-4">
                                <input
                                    className="form-check-input"
                                    type="checkbox"
                                    id="flexCheckChecked"
                                    checked={formData.isChecked}
                                    onChange={(e) => setFormData((prevData) => ({ ...prevData, isChecked: e.target.checked }))}
                                />
                                <label className="form-check-label" for="flexCheckChecked">
                                    Tôi đã đọc và chấp nhận điều khoản sử dụng, thông báo bảo vệ dữ liệu (GDPR) và chính sách bảo vệ dữ liệu.
                                </label>
                            </div>
                            {selectedRestaurant && (
                                <div>
                                    <input name='restaurant' value={selectedRestaurant.slug} hidden></input>
                                </div>
                            )}
                            <div className='button-booking'>
                                <Button onClick={handleBookingClick} disabled={!formData.isChecked}>Đặt chỗ</Button>
                            </div>
                        </div>
                    </div>
                    {/* Hiển thị thông tin chi tiết về đặt bàn */}

                </Modal.Body>
            </Modal>
        </>

    )
}

export default contentRestaurant;