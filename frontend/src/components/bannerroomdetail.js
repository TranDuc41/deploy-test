'use client'
import { useState } from "react";
import { Carousel, Col, Container, Row } from "react-bootstrap";
import Image from 'react-bootstrap/Image';

const BannerCarousel = ({ images }) => {
    const [index, setIndex] = useState(0);
    const handleSelect = (selectedIndex, e) => {
        setIndex(selectedIndex);
    };
    return (
        <section id="banner-room">
            <Carousel activeIndex={index} onSelect={handleSelect} indicators={false}>
                {images.map((item) => (
                    <Carousel.Item key={item.img_id} interval={1000} className=''>
                        <Image className="image-room"
                            src={item.imageUrl}
                            alt={item.alt}
                            fluid
                        />
                    </Carousel.Item>
                ))}
            </Carousel>
        </section>
    )
}

export default BannerCarousel;