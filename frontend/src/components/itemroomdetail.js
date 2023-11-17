'use client'
import { useState } from "react";
import { Carousel, Col, Container, Row } from "react-bootstrap";
import Image from 'react-bootstrap/Image';
import Card from 'react-bootstrap/Card';
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import SelectBooking from '@/components/selectBooking';
import '../app/custom.css'

const ItemContentRoomDetail = ({ room }) => {
    //Modal edit item keep room
    const [showEdit, setShowEdit] = useState(false);

    const handleCloseEdit = () => setShowEdit(false);
    const handleShowEdit = () => setShowEdit(true);

    const ImagesItem = room.images.slice(0, 2);
    if (room.images.lenght > 2) {
        const ImagesItem = room.images.slice(0, 2);
    }
    return (
        <section id="block-dominion-content">
            <Container>
                <Row>
                    <Col lg={5}>
                        <Card style={{ width: '100%' }}>
                            <Card.Header>{room.room_type.name}</Card.Header>
                            <Card.Body>
                                <Card.Title>{room.title}</Card.Title>
                                <Card.Text>
                                    {room.description}
                                </Card.Text>
                                {room && room.sale ? (
                                    <Card.Subtitle className="mb-2 text-muted text-center">
                                        <del>{room.price.toLocaleString()} vnd</del><span className="room-price">{(room.price - (room.price * room.sale.discount) / 100).toLocaleString()} </span>vnd/mỗi đêm
                                    </Card.Subtitle>


                                ) : (
                                    <Card.Subtitle className="mb-2 text-muted text-center">
                                        <span className="room-price">{room.price.toLocaleString()} </span>vnd/mỗi đêm
                                    </Card.Subtitle>
                                )}
                            </Card.Body>
                            <Card.Footer className="text-muted text-center"><Button className="btn-booking" variant="warning" onClick={handleShowEdit}>Đặt phòng</Button></Card.Footer>
                        </Card>
                    </Col>
                    {ImagesItem && (
                        <Col lg={7} className={`card-media`}>
                            <div className={`p-2 card-media-item-1`}>
                                <Image
                                    src={'http://localhost:8000' + ImagesItem[0].img_src}
                                    alt={ImagesItem[0].name}
                                    width={340}
                                    height={450}
                                    style={{
                                        objectFit: 'cover',
                                    }}
                                />
                            </div>
                            <div className={`p-2 card-media-item-2`}>
                                <Image
                                    src={'http://localhost:8000' + ImagesItem[1].img_src}
                                    alt={ImagesItem[1].name}
                                    width={340}
                                    height={450}
                                    style={{
                                        objectFit: 'cover',
                                    }}
                                />
                            </div>
                        </Col>
                    )}

                </Row>
            </Container>
            <Modal show={showEdit} keyboard={false} backdrop="static" size='lg'>
                <Modal.Header>
                    <Modal.Title>Thông tin đặt phòng </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Row className='seclect-booking'>
                        <SelectBooking />
                    </Row>
                </Modal.Body>
                <Modal.Footer className="border-0">
                    <Button className="btn-booking " variant="outline-secondary" onClick={handleCloseEdit}>Đóng</Button>
                    <Button className="btn-booking text-light" variant="warning" onClick={handleCloseEdit}>Đặt phòng</Button>
                </Modal.Footer>
            </Modal>
        </section>
    )
}

export default ItemContentRoomDetail;