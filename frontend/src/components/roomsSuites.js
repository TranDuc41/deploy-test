'use client'
// Import Swiper React components
import React, { useState, useEffect } from 'react';
import { Pagination, A11y, Autoplay } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';
import Link from 'next/link';
import { IoIosBed, IoIosWifi } from 'react-icons/io';
import { GiBathtub } from 'react-icons/gi';

// Import Swiper styles
import 'swiper/css';
import Image from 'react-bootstrap/Image';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import { Button } from 'react-bootstrap';


// const rooms = [
//     {
//         img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
//             {
//                 "icon": <IoIosBed />,
//                 "text": "4 phòng ngủ",
//             },
//             {
//                 "icon": <GiBathtub />,
//                 "text": "Bồn tắm",
//             },
//             {
//                 "icon": <IoIosWifi />,
//                 "text": "Wifi miễn phí",
//             }
//         ]
//     },
//     {
//         img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
//             {
//                 "icon": <IoIosBed />,
//                 "text": "4 phòng ngủ",
//             },
//             {
//                 "icon": <GiBathtub />,
//                 "text": "Bồn tắm",
//             },
//             {
//                 "icon": <IoIosWifi />,
//                 "text": "Wifi miễn phí",
//             }
//         ]
//     },
//     {
//         img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
//             {
//                 "icon": <IoIosBed />,
//                 "text": "4 phòng ngủ",
//             },
//             {
//                 "icon": <GiBathtub />,
//                 "text": "Bồn tắm",
//             },
//             {
//                 "icon": <IoIosWifi />,
//                 "text": "Wifi miễn phí",
//             }
//         ]
//     },
//     {
//         img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
//             {
//                 "icon": <IoIosBed />,
//                 "text": "4 phòng ngủ",
//             },
//             {
//                 "icon": <GiBathtub />,
//                 "text": "Bồn tắm",
//             },
//             {
//                 "icon": <IoIosWifi />,
//                 "text": "Wifi miễn phí",
//             }
//         ]
//     },
//     {
//         img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
//             {
//                 "icon": <IoIosBed />,
//                 "text": "4 phòng ngủ",
//             },
//             {
//                 "icon": <GiBathtub />,
//                 "text": "Bồn tắm",
//             },
//             {
//                 "icon": <IoIosWifi />,
//                 "text": "Wifi miễn phí",
//             }
//         ]
//     },

// ]
const RoomsSuites = () => {
    const [rooms, setRooms] = useState([]);
    const [slidesPerView, setSlidesPerView] = useState(3);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://localhost:8000/api/rooms');
                const data = await response.json();
                setRooms(data);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        if (rooms.length === 0) {
            fetchData();
        }
    }, [rooms]); // Thêm rooms vào dependencies để tránh gọi fetchData liên tục

    useEffect(() => {
        const handleResize = () => {
            if (window.innerWidth < 1200) {
                setSlidesPerView(1);
            } else {
                setSlidesPerView(3);
            }
        };

        handleResize();

        window.addEventListener('resize', handleResize);

        return () => {
            window.removeEventListener('resize', handleResize);
        };
    }, []); // Dependency rỗng để chỉ gọi một lần khi mount

    return (
        <Swiper
            modules={[Pagination, A11y, Autoplay]}
            pagination={{ clickable: true }}
            loop={true}
            spaceBetween={34}
            slidesPerView={slidesPerView}
        >
            {rooms.map((room, index) => (
                <SwiperSlide key={index}>
                    <div>
                        <div className='room-img'>
                            <Image src={'http://localhost:8000' + room.images[0].img_src} width={409} height={243} alt="Dominion Logo" />
                        </div>
                        <div className='room-content text-center my-4'>
                            <div className='mb-4'>
                                <Link href={""} className="text-decoration-none text-black">
                                <h3>{room.title}</h3>
                                </Link>
                                <span className="room-description">{room.description}</span>
                            </div>
                            <div className='room-price d-flex justify-content-center'>
                                <h3>{new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(room.price)}</h3>
                                <span>/đêm</span>
                            </div>
                        </div>
                        <div className='room-bottom'>
                            {Array.isArray(room.amenities) && (
                                <div className='row'>
                                    {room.amenities.slice(0, 3).map((amenitie, index) => (
                                        <div className='col' key={index}>
                                            {/* {utilitie.icon} */}
                                            <span>{amenitie.name}</span>
                                        </div>
                                    ))}
                                </div>
                            )}
                            <div className='text-center my-4'>
                                <Button className='mt-2 px-5 btn-check-now btn btn-primary' datatype={room.slug}>Đặt Ngay</Button>
                            </div>
                        </div>
                    </div>
                </SwiperSlide>
            ))}
        </Swiper>
    );
};

export default RoomsSuites;