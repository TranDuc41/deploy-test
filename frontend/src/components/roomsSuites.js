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
                setRooms(data);

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
            pagination={{ clickable: true }}
            breakpoints={breakpoints}
            modules={[Pagination, A11y, Autoplay]}
            loop={rooms.length > 1}
            autoplay={{ delay: 3000 }}
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
                                        <div className='col-4' key={index}>
                                            {/* {utilitie.icon} */}
                                            <span className="room-description">{amenitie.name}</span>
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