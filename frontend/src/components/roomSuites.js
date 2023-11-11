'use client'
// Import Swiper React components
import React, { useState, useEffect } from 'react';
import { Pagination, A11y, Autoplay } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import '@/app/custom.css';
import 'swiper/css';
import Image from 'react-bootstrap/Image';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import { Button } from 'react-bootstrap';
const rooms = [
    {
        img: '/room-suite-image.png',
        roomtType: 'Villa',
        roomName: 'Phòng 1 ',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một v...',
       
    } ,
    {
        img: '/room-suite-image.png',
        roomtType: 'Villa',
        roomName: 'Phòng 1 ',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một v...',
       
    },
    {
        img: '/room-suite-image.png',
        roomtType: 'Villa',
        roomName: 'Phòng 1 ',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một v...',
       
    },
    {
        img: '/room-suite-image.png',
        roomtType: 'Villa',
        roomName: 'Phòng 1 ',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một v...',
       
    },

    {
        img: '/room-suite-image.png',
        roomtType: 'Villa',
        roomName: 'Phòng 1 ',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một v...',
       
    },
    {
        img: '/room-suite-image.png',
        roomtType: 'Villa',
        roomName: 'Phòng 1 ',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một v...',
       
    }
    
]

export default () => {
    const [slidesPerView, setSlidesPerView] = useState(5); // Giá trị mặc định cho desktop

    useEffect(() => {
        // Lắng nghe sự kiện thay đổi kích thước màn hình
        const handleResize = () => {
            // Kiểm tra kích thước màn hình và cập nhật giá trị slidesPerView tương ứng
            if (window.innerWidth < 1200) {
                setSlidesPerView(1); // Trên mobile, hiển thị một slide mỗi lần
            } else {
                setSlidesPerView(2); // Trên desktop, hiển thị hai slide mỗi lần
            }
        };

        // Gọi hàm handleResize ngay khi component được mount
        handleResize();

        // Lắng nghe sự kiện resize và gọi hàm handleResize khi kích thước màn hình thay đổi
        window.addEventListener('resize', handleResize);

        // Cleanup: loại bỏ sự kiện lắng nghe khi component bị unmount
        return () => {
            window.removeEventListener('resize', handleResize);
        };
    }, []);
    return (
        <Swiper
            modules={[Pagination, A11y, Autoplay]}
            pagination={{ clickable: true }}
            loop={true}
            // autoplay={{delay: 3000}}
            spaceBetween={34}
            slidesPerView={slidesPerView}
        >
            {rooms.map((room, index) => (
                <SwiperSlide key={index}>
                    <div className='roomsuite-main-section'>
                        <div className='roomsuite-section'>
                            <Image src={room.img}
                                width={409}
                                height={243}
                                alt="Dominion Logo">
                            </Image>
                        </div>
                        <div className='roomsuite-description'>
                            <div className='room-short-description'>
                                <span>{room.roomtType}</span>
                                <h3>{room.roomName}</h3>
                                <span>{room.content}</span>
                            </div>
                        </div>
                        <div className='over-view-button'>
                            <div className='btn'>
                                <Button className='overview-btn'>Tổng quan </Button>
                            </div>
                        </div>
                    </div>
                    <div className="gold-line"></div>
                </SwiperSlide>
            ))}
        </Swiper>
    );
};