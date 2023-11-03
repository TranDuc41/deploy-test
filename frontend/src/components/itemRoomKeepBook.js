import Link from "next/link";
//react-bootstrap-icon
import { Col, Container, Image, Row } from "react-bootstrap";
import { BsFillPersonFill } from "react-icons/bs";
import { BiSolidBed } from "react-icons/bi";
import Card from 'react-bootstrap/Card';
//css
import '@/app/reservations/custom-1.css'
//Modal
import { useState } from "react";
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
//component
import showModals from '@/components/itemModalKeepRoom';
import ImageModals from '@/components/bannerroomdetail';

//Data
const room = {
    room_id: 1,
    title: 'Ocean Pool Family Villa',
    slug: 'ocean-pool-family-villa',
    price: 20000000,
    sale: 10,
    adults: 5,
    children: 2,
    rty_id: {
        rty_id: '1',
        name: 'Villa',
        slug: 'villa',
        description: 'Từ những mái nhà uốn cong nhô ra khỏi hàng cây cho đến những cửa sổ có lưới mắt cáo và những vật liệu tự nhiên kín đáo, các Nhà và Biệt thự của Dominion hòa quyện với khung cảnh tráng lệ xung quanh. Với khả năng tiếp cận đầy đủ các phương pháp trị liệu spa của Việt Nam, họ đã tận dụng được sự duyên dáng và sự đơn giản đầy tính nghệ thuật của thiết kế Việt Nam.'
    },
    description: 'Với diện tích hơn 125 mét vuông (1.346 thước vuông) với hướng nhìn ra Vịnh Vĩnh Hy tuyệt đẹp và Biển Đông, Amanoi’s Ocean Pool Family Villa là lựa chọn hoàn hảo dành cho gia đình với phòng ngủ chính được thiết kế cạnh bên hồ bơi riêng.  Sự kết hợp giữa hồ bơi và hiên tắm nắng trải dài làm nổi bật lên không gian mở liền mạch từ khuôn viên phòng ngủ kéo dài ra đến ngoài trời của căn villa. Là nơi lý tưởng cho những gia đình tìm kiếm sự bình yên và riêng biệt, Villa mang đến sự thuận tiện nhưng không mất đi sự gần gũi với một phòng ngủ chính và một phòng ngủ phụ, kết hợp ghế sofa tại khu vực phòng khách cùng với phòng tắm có thiết kế bồn tắm và phòng tắm vòi sen riêng đảm bảo không gian rộng rãi cho cả gia đình.',
    images_br: [
        { img_id: 1, imageUrl: '/ocean-pool-family-villa/Amanoi Ocean Pool Family Villa Junior BR.jpg', alt: '...' },
        { img_id: 2, imageUrl: '/ocean-pool-family-villa/Amanoi Ocean Pool Family Villa Master BR_0.jpg', alt: '...' }
    ],
    images: [
        {
            img_id: 1,
            imageUrl: '/ocean-pool-family-villa/Amanoi-Ocean-Pool-Family-Villa.jpg',
            alt: '...'
        },
        {
            img_id: 2,
            imageUrl: '/ocean-pool-family-villa/Amanoi, Vietnam - Ocean Pool Family Villa, aerial view.jpg',
            alt: '...'
        },
        {
            img_id: 3,
            imageUrl: '/ocean-pool-family-villa/Amanoi, Vietnam - Ocean Pool Family Villa, bedroom.jpg',
            alt: '...'
        },
        {
            img_id: 4,
            imageUrl: '/ocean-pool-family-villa/Amanoi, Vietnam - Ocean Pool Family Villa, swimming pool.jpg',
            alt: '...'
        },
    ],
    amenities: [
        { name: 'Quang cảnh đại dương' },
        { name: 'Một phòng ngủ chính' },
        { name: 'Phòng tắm có bồn tắm, bàn trang điểm đôi' },
        { name: 'Thanh cá nhân' },
        { name: 'Bể bơi riêng' },
        { name: 'Một phòng ngủ nhỏ' },
        { name: 'Phòng tắm/nhà vệ sinh riêng biệt' },
        { name: 'WiFi, TV, Netflix, hệ thống âm thanh Bose, két sắt' },
        { name: 'Sàn tắm nắng bằng gỗ' },
        { name: 'Khu vực sinh hoạt có ghế sofa, bàn viết' },
        { name: 'Sân phơi nắng với ghế tắm nắng' },

    ],
    packages: [
        { name: 'Bữa sáng gọi món hàng ngày tại Nhà hàng Chính' },
        { name: 'Trà chiều hàng ngày' },
        { name: 'Lớp học chăm sóc sức khỏe buổi sáng theo lịch hàng ngày' },
        { name: 'Sử dụng tất cả các thiết bị thể thao dưới nước không có động cơ' },
        { name: 'Hoạt động hàng ngày của trẻ (không bao gồm lớp học nấu ăn)' },
        { name: 'Sử dụng trung tâm thể dục, phòng tập Pilates và sân tennis' },
    ]

}

function ItemRoomKeepBook() {
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    return (
        <Row className="bg-light thumb-cards_keep_room my-4" key={''}>
            <Col lg={5} className="px-0">
                <div className="thumb-cards_images">
                    <Image className=""
                        src="/ocean-pool-family-villa/Amanoi, Vietnam - Ocean Pool Family Villa, aerial view.jpg"
                        alt=""
                        width={'100%'}
                        height={'auto'}
                    />
                </div>
            </Col>
            <Col lg={7} className="px-0">
                <div className="thumb-cards_cardHeader ">
                    <h2 class="app_heading_room">Ocean Pool Villa</h2>
                    <div className="thumb-cards_trigger_and_room_ thumb-cards_trigger_and_room_info_1">
                        <div className="trigger guests_number">
                            <BsFillPersonFill /> 2 người
                        </div>
                        <div className="trigger roomsize_bed">
                            <BiSolidBed /> 1 Giường lớn
                        </div>
                    </div>
                    <div className="thumb-cards_trigger_and_room_ thumb-cards_trigger_and_room_info_2">
                        <p><span className="room_area">95 m²</span> | <span className="room_view">View</span></p>
                    </div>
                    <div className="thumb-cards_detailsLink">
                        <Button variant="link" className="p-0" onClick={handleShow}>Xem chi tiết...</Button>

                    </div>
                </div>
                <div class="thumb-cards_footer text-end">
                    <div class="thumb-cards_priceContainer">
                        <div class="thumb-cards_price">23,000,000 vnd</div>
                        <div class="price-and-nights-text_perNight">Mỗi đêm</div>
                        <div class="thumb-cards_taxesFees">Không bao gồm thuế và phí </div>
                    </div>
                    <div class="thumb-cards_button">
                        <button className="btn-booking" variant="warning">Đặt phòng</button>


                    </div>
                </div>
            </Col>
            {/* Modal */}
            <Modal show={show} onHide={handleClose}
                size="lg"
                aria-labelledby="contained-modal-title-vcenter"
                centered
            >
                <Modal.Header closeButton>
                    <Modal.Title>Villa</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Container>
                        <Row>
                            <Col>
                                <ImageModals images={room.images} />
                            </Col>
                            <Col>
                                <h2 class="app_heading_room">Ocean Pool Villa</h2>
                                <div className="thumb-cards_trigger_and_room_ thumb-cards_trigger_and_room_info_1">
                                    <div className="trigger guests_number">
                                        <BsFillPersonFill /> 2 người
                                    </div>
                                    <div className="trigger roomsize_bed">
                                        <BiSolidBed /> 1 Giường lớn
                                    </div>
                                </div>
                                <div className="thumb-cards_trigger_and_room_ thumb-cards_trigger_and_room_info_2">
                                    <p><span className="room_area">95 m²</span> | <span className="room_view">View</span></p><br/>
                                    <p>{room.description}</p>
                                </div>
                            </Col>
                        </Row>
                    </Container>
                </Modal.Body>
                <Modal.Footer>
                    <Button href="/roomdetail" className="btn-booking" variant="warning" onClick={handleClose}>Read more</Button>
                </Modal.Footer>
            </Modal>
            {/*End Modal */}
        </Row>

    );
}

export default ItemRoomKeepBook;