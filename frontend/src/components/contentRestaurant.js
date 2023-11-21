import { Button, Col, Row } from "react-bootstrap";
import Image from 'next/image';
import Link from "next/link";


const rooms = [
    {
        title: 'The Restaurant and Terrace',
        description: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản.',
        links: [
            { text: 'Drink List', href: '/drink-list' },
            { text: 'Food Menu', href: '/food-menu' },
        ],
        time: '05:00 sáng - 11:00 tối',
        imageSrc: '/restaurant_home.png',
    },
    // Thêm thông tin cho các phòng khác nếu cần
    {
        title: 'The Restaurant and Terrace',
        description: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản.',
        links: [
            { text: 'Drink List', href: '/drink-list' },
            { text: 'Food Menu', href: '/food-menu' },
        ],
        time: '05:00 sáng - 11:00 tối',
        imageSrc: '/restaurant_home.png',
    },
];


const contentRestaurant = () => {
    return (
        <>
            {rooms.map((room, index) => (
                <Row key={index} className={`restaurante-item ${index % 2 === 0 ? 'even' : 'odd'}`}>
                    <Col className="bg-white text-center d-flex justify-content-center">
                        <div>
                            <h3>{room.title}</h3>
                            <span>{room.description}</span>
                            <div className="restaurant-link">
                                {room.links.map((link, linkIndex) => (
                                    <Link key={linkIndex} href={link.href}>{link.text}</Link>
                                ))}
                                <span>{room.time}</span>
                            </div>
                            <div className="d-flex justify-content-center mt-4 btn-booking">
                                <Button>Đặt ngay</Button>
                            </div>
                        </div>
                    </Col>
                    <Col className="restaurant-img">
                        <Image
                            width={518}
                            height={650}
                            src={room.imageSrc}
                            alt="Dominion"
                        />
                    </Col>
                </Row>
            ))}
        </>

    )
}

export default contentRestaurant;