'use client'
import { useState } from "react";
import { Carousel, Col, Container, Row } from "react-bootstrap";
import Image from "next/image";
import Card from 'react-bootstrap/Card';
import Button from 'react-bootstrap/Button';

import '../app/custom.css'

const ItemContentRoomDetail = ({room}) => {
    const [index, setIndex] = useState(0);
    const handleSelect = (selectedIndex, e) => {
        setIndex(selectedIndex);
    };
    return (
        <section id="block-dominion-content">
            <Container>
                <Row>
                    <Col lg={5}>
                        <Card style={{ width: '100%' }}>
                            <Card.Header>Villa</Card.Header>
                            <Card.Body>
                                <Card.Title>{room.title}</Card.Title>
                                <Card.Text>
                                    {room.description}
                                </Card.Text>

                                <Card.Subtitle className="mb-2 text-muted text-center">
                                    <del>{room.price.toLocaleString()} vnd</del><span className="room-price">{(room.price - (room.price * room.sale) / 100).toLocaleString()} </span>vnd/mỗi đêm </Card.Subtitle>
                            </Card.Body>
                            <Card.Footer className="text-muted text-center"><Button className="btn-booking" variant="warning">Đặt phòng</Button></Card.Footer>
                        </Card>
                    </Col>
                    <Col lg={7} className={`card-media`}>
                        <div className={`p-2 card-media-item-1` }>
                            <Image key={room.images_br[0].img_id}
                                src={room.images_br[0].imageUrl}
                                alt={room.images_br[0].alt}
                                width={340}
                                height={450}
                                style={{
                                    objectFit: 'cover',
                                }}
                            />
                        </div>
                        <div className={`p-2 card-media-item-2`}>
                            <Image key={room.images_br[1].img_id}
                                src={room.images_br[1].imageUrl}
                                alt={room.images_br[1].alt}
                                width={340}
                                height={450}
                                style={{
                                    objectFit: 'cover',
                                }}
                            />
                        </div>
                    </Col>
                </Row>
            </Container>
        </section>
    )
}

export default ItemContentRoomDetail;