'use client'
import { useState } from "react";
import { Carousel, Col, Container, Row } from "react-bootstrap";
import Image from 'react-bootstrap/Image';

const BannerCarousel = ({ images }) => {
    const [index, setIndex] = useState(0);
    const handleSelect = (selectedIndex, e) => {
        setIndex(selectedIndex);
    };
    if (images.length == 0) {
        return
    }
    return (
        <section id="banner-room">
            {!images && images.length > 0(
                <Carousel activeIndex={index} onSelect={handleSelect} indicators={false}>
                    {images.map((item) => (
                        <Carousel.Item key={item.img_id} interval={3000} className=''>
                            <Image className="image-room"
                                src={'http://localhost:8000' + item.img_src}
                                alt={item.name}
                                fluid
                            />
                        </Carousel.Item>
                    ))}
                </Carousel>
            )}
        </section>
    )
}

export default BannerCarousel;