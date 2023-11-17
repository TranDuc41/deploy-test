'use client'
// Import Swiper React components
import React, { useState, useEffect, useRef } from 'react';
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

const RoomsSuites = () => {
    const [rooms, setRooms] = useState([]);
    const swiper = useRef(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://localhost:8000/api/rooms');
                const data = await response.json();

                // Chỉ lấy 20 phòng từ dữ liệu
                const limitedRooms = data.slice(0, 20);

                setRooms(limitedRooms);

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        if (rooms.length === 0) {
            fetchData();
        }
    }, [rooms]);
    const breakpoints = {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        // when window width is >= 640px
        992: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
    };

    return (
        <Swiper
            ref={swiper}
            spaceBetween={50}
            slidesPerView={1}
            pagination={{
                dynamicBullets: true,
            }}
            breakpoints={breakpoints}
            modules={[Pagination, A11y, Autoplay]}
            loop={rooms.length > 1}
            autoplay={{ delay: 3000 }}
        >
            {rooms.slice(0, 20).map((room, index) => (
                <SwiperSlide key={index}>
                    <div>
                        <div className='room-img'>
                            <Image src={room.images.length > 0 ? 'http://localhost:8000' + room.images[0].img_src : './dominion-defaul.png'} width={409} height={243} alt="Dominion Logo" />
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
                            <div className='row'>
                                <div className='col-4'>
                                    <IoIosBed />
                                    <span className="room-description">Phòng ngủ</span>
                                </div>
                                <div className='col-4'>
                                    <GiBathtub />
                                    <span className="room-description">Bồn tắm</span>
                                </div>
                                <div className='col-4'>
                                    <IoIosWifi />
                                    <span className="room-description">Wifi miễn phí</span>
                                </div>
                            </div>
                            <div className='text-center my-4'>
                                {/* lan anh sửa button-> Link thêm  href={`/roomdetail/${room.slug}`}*/}
                                <Link className='mt-2 px-5 btn-check-now btn btn-primary' href={`/roomdetail/${room.slug}`}  datatype={room.slug}>Đặt Ngay</Link>
                            </div>
                        </div>
                    </div>
                </SwiperSlide>
            ))}
        </Swiper>
    );
};

export default RoomsSuites;