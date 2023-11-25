//css
import '@/app/custom-1.css'
//icon
import { BsFillPersonFill } from "react-icons/bs";
import { BiSolidBed } from "react-icons/bi";
//Modal
import { useState } from "react";
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import { Col, Container, Image, Row } from "react-bootstrap";
import ImageModals from '@/components/bannerroomdetail';
const ModalItemRoomKeepBook = ({ show, handleClose, room }) => {
    return (
        <Modal show={show} onHide={handleClose}
            size="lg"
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Header closeButton>
                <Modal.Title>{room.room_type.name}</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Container>
                    <Row>
                        <Col>
                            <ImageModals images={room.images} />
                        </Col>
                        <Col>
                            <h2 class="app_heading_room">Ocean Pool Villa</h2>
                            <div className="thumb-cards_trigger_and_room_ thumb-cards_trigger_and_room_info_1">
                                <div className="trigger guests_number">
                                    <BsFillPersonFill /> {room.adults} người
                                </div>
                                <div className="trigger roomsize_bed">
                                    <BiSolidBed />  { (Number(room.adults)/2)} Giường lớn
                                </div>
                            </div>
                            <div className="thumb-cards_trigger_and_room_ thumb-cards_trigger_and_room_info_2">
                                <p><span className="room_area">{room.area} m²</span> | <span className="room_view">Bữa sáng miễn phí</span></p><br />

                            </div>
                        </Col>
                    </Row>
                    <Row>
                        <Col> <p>{room.description}</p></Col>
                    </Row>
                </Container>
            </Modal.Body>
            <Modal.Footer>
                <Button  href={`/roomdetail/${room.slug}`} className="btn-booking" variant="warning" onClick={handleClose}>Read more</Button>
            </Modal.Footer>
        </Modal>
    )
}
export default ModalItemRoomKeepBook;