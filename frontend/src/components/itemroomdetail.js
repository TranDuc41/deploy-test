'use client'
import { useState } from "react";
import { Carousel, Col, Container, Row } from "react-bootstrap";
import Image from "next/image";
import Card from 'react-bootstrap/Card';
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import SelectBooking from '@/components/selectBooking';
import '../app/custom.css'

const ItemContentRoomDetail = ({room}) => {
     //Modal edit item keep room
     const [showEdit, setShowEdit] = useState(false);

     const handleCloseEdit = () => setShowEdit(false);
     const handleShowEdit = () => setShowEdit(true);
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
                            <Card.Footer className="text-muted text-center"><Button className="btn-booking" variant="warning" onClick={handleShowEdit}>Đặt phòng</Button></Card.Footer>
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
            <Modal show={showEdit} keyboard={false} backdrop="static" size='lg'>
                <Modal.Header closeButton>
                    <Modal.Title>Thông tin đặt phòng </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Row className='seclect-booking'>
                            <SelectBooking />
                        </Row>
                </Modal.Body>
                <Modal.Footer>
                    <Button className="btn-booking text-light" variant="warning" onClick={handleCloseEdit}>Đặt phòng</Button>
                </Modal.Footer>
            </Modal>
        </section>
    )
}

export default ItemContentRoomDetail;