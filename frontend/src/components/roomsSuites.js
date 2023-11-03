'use client'
// Import Swiper React components
import React, { useState, useEffect } from 'react';
import { Pagination, A11y, Autoplay } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';
import { IoIosBed, IoIosWifi } from 'react-icons/io';
import { GiBathtub } from 'react-icons/gi';

// Import Swiper styles
import 'swiper/css';
import Image from 'react-bootstrap/Image';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import { Button } from 'react-bootstrap';


const rooms = [
    {
        img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
            {
                "icon": <IoIosBed />,
                "text": "4 phòng ngủ",
            },
            {
                "icon": <GiBathtub />,
                "text": "Bồn tắm",
            },
            {
                "icon": <IoIosWifi />,
                "text": "Wifi miễn phí",
            }
        ]
    },
    {
        img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
            {
                "icon": <IoIosBed />,
                "text": "4 phòng ngủ",
            },
            {
                "icon": <GiBathtub />,
                "text": "Bồn tắm",
            },
            {
                "icon": <IoIosWifi />,
                "text": "Wifi miễn phí",
            }
        ]
    },
    {
        img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
            {
                "icon": <IoIosBed />,
                "text": "4 phòng ngủ",
            },
            {
                "icon": <GiBathtub />,
                "text": "Bồn tắm",
            },
            {
                "icon": <IoIosWifi />,
                "text": "Wifi miễn phí",
            }
        ]
    },
    {
        img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
            {
                "icon": <IoIosBed />,
                "text": "4 phòng ngủ",
            },
            {
                "icon": <GiBathtub />,
                "text": "Bồn tắm",
            },
            {
                "icon": <IoIosWifi />,
                "text": "Wifi miễn phí",
            }
        ]
    },
    {
        img: '/Amanoi_Accommodation_Interior 1.png', roomName: 'Room', price: 4000000, content: 'Nội dung chi tiết cần hiển thị', utilities: [
            {
                "icon": <IoIosBed />,
                "text": "4 phòng ngủ",
            },
            {
                "icon": <GiBathtub />,
                "text": "Bồn tắm",
            },
            {
                "icon": <IoIosWifi />,
                "text": "Wifi miễn phí",
            }
        ]
    },

]

export default () => {
    const [slidesPerView, setSlidesPerView] = useState(3); // Giá trị mặc định cho desktop

  useEffect(() => {
    // Lắng nghe sự kiện thay đổi kích thước màn hình
    const handleResize = () => {
      // Kiểm tra kích thước màn hình và cập nhật giá trị slidesPerView tương ứng
      if (window.innerWidth < 1200) {
        setSlidesPerView(1); // Trên mobile, hiển thị một slide mỗi lần
      } else {
        setSlidesPerView(3); // Trên desktop, hiển thị ba slide mỗi lần
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
                    <div>
                        <div className='room-img'>
                            <Image src={room.img}
                                width={409}
                                height={243}
                                alt="Dominion Logo">
                            </Image>
                        </div>
                        <div className='room-content text-center my-4'>
                            <div className='mb-4'>
                                <h3>{room.roomName}</h3>
                                <span>{room.content}</span>
                            </div>
                            <div className='room-price d-flex justify-content-center'>
                                <h3>{new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                }).format(room.price)}
                                </h3>
                                <span>/đêm</span>
                            </div>
                        </div>
                        <div className='room-bottom'>
                            <div className='row'>
                                {room.utilities.map((utilitie, index) => (
                                    <div className='col' key={index}>{utilitie.icon}<span>{utilitie.text}</span></div>
                                ))}
                            </div>
                            <div className='text-center my-4'>
                                <Button className='mt-2 px-5 btn-check-now btn btn-primary'>Đặt Ngay</Button>
                            </div>
                        </div>
                    </div>
                </SwiperSlide>
            ))}
        </Swiper>
    );
};