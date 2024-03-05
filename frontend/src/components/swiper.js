'use client'
// Import Swiper React components
import { Pagination, A11y, Autoplay } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';
import Stars from '../components/stars'

// Import Swiper styles
import 'swiper/css';
import Image from 'react-bootstrap/Image';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';


const reviews = [
    { img: '/user-img/clients.png', name: 'User Name', role: 'Khách hàng', star: 4, content: 'Nội dung đánh giá của khách hàng' },
    { img: '/user-img/clients.png', name: 'User Name 1', role: 'Khách hàng', star: 5, content: 'Nội dung đánh giá của khách hàng' },
    { img: '/user-img/clients.png', name: 'User Name 2', role: 'Khách hàng', star: 3, content: 'Nội dung đánh giá của khách hàng' },
]

export default function Swiper () {
    return (
        <Swiper
            modules={[Pagination, A11y, Autoplay]}
            pagination={{ clickable: true }}
            loop={true}
            autoplay={{delay: 3000}}
            spaceBetween={10}
            slidesPerView={1}
        >
            {reviews.map((review, index) => (
                <SwiperSlide key={index}>
                    <div className='client-reviews'>
                        <div className='review-top'>
                            <div className='title mb-3'>
                                <h4>Khách hàng nói gì?</h4>
                            </div>
                            <div className='content mb-4'>
                                <span>{review.content}</span>
                            </div>
                        </div>
                        <div className='review-bottom'>
                            <div className='review-left'>
                                <div className='thumb'>
                                    <Image src={review.img}
                                        width={50}
                                        height={50}
                                        alt={review.img}
                                        roundedCircle />
                                </div>
                                <div className='name-user-review'>
                                    <h5>{review.name}</h5>
                                    <span>{review.role}</span>
                                </div>
                            </div>
                            <div className='review-right'>
                                <Stars value={review.star}/>
                            </div>
                        </div>
                    </div>
                </SwiperSlide>
            ))}
        </Swiper>
    );
};
