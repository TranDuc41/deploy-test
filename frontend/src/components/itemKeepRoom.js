'use client'
import 'react-bootstrap';
import { useState } from "react";
import { RiArrowDropDownLine, RiDeleteBinLine, RiEditLine } from 'react-icons/ri';
import { AiOutlineWarning } from 'react-icons/ai';
import Link from 'next/link';
import { Button, Row } from 'react-bootstrap';
import Modal from 'react-bootstrap/Modal';
import SelectBooking from '@/components/selectBooking';
import '@/app/reservations/custom-1.css';

function IteamKeepRoom() {
    const [isOpen, setIsOpen] = useState(false);
    const toggleAccordion = () => {
        setIsOpen(!isOpen);
    };
    //Modal edit item keep room
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const [showDE, setShowDE] = useState(false);
    const handleCloseDE = () => setShowDE(false);
    const handleShowDE = () => setShowDE(true);
    return (
        <section className="item-keep_room pt-3">
            <div className="item-keep_room_header mb-5">
                <div className="item-keep_room-date_checkin_checkout">
                    Ngày 15 tháng 10 năm 2023  - Ngày 17 tháng 10 năm 2023
                </div>
            </div>
            <div className="item-keep_room_content">
                <h4 className="keep_room_title">Phòng 1</h4>
                <div className="summary--keep_room_info d-flex">
                    <div className="item-keep_room--guests-night"><span>1 người lớn</span> <span>2 đêm</span></div>
                    <div className="item-keep_room--price_night">70.791.126 vnd</div>
                </div>
                <div className="accordion text-muted">
                    <div className="accordion-header" onClick={toggleAccordion}>
                        <p>Chi tiết  <RiArrowDropDownLine /></p>
                    </div>
                    {isOpen && (
                        <div className="accordion-content">
                            <div class="display-prices d-flex px-3">
                                <div class="display-prices_label"><span>15/10/2023</span>
                                </div>
                                <div class="display-prices_price"><span>35.395.563 vnd</span>
                                </div>
                            </div>
                            <div class="display-prices d-flex px-3">
                                <div class="display-prices_label"><span>16/10/2023</span>
                                </div>
                                <div class="display-prices_price"><span>35.395.563 vnd</span>
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
            <div className="item-keep_room_footer pb-3">
                <a variant="link" className='delete-keep_room pe-2' onClick={handleShowDE}><RiDeleteBinLine /> Xóa</a>
                <a variant="link" className='edit-keep_room px-2' onClick={handleShow}><RiEditLine /> Sửa</a>
            </div>
            {/* edit Modal*/}
            <Modal show={show} keyboard={false} backdrop="static" size='lg'>
                <Modal.Header>
                    <Modal.Title>Sửa</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Row className='seclect-booking'>
                        <SelectBooking />
                    </Row>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="light" onClick={handleClose}>
                        Close
                    </Button>
                    <Button variant="success" onClick={handleClose}>
                        Save Changes
                    </Button>
                </Modal.Footer>
            </Modal>
            {/* end edit Modal*/}

            {/* delete Modal*/}
            <Modal show={showDE} keyboard={false} backdrop="static" size='md'>
                <Modal.Body>
                    <h5><span className='text-danger fs-3'><AiOutlineWarning /></span> Bạn có muốn xóa mục này không?</h5>
                    <p>Chọn có để xác nhận xóa mục</p>
                    <Button variant="light" onClick={handleCloseDE}>
                        Close
                    </Button>
                    <Button variant="danger" onClick={handleCloseDE}>
                        Delete
                    </Button>
                    
                    
                </Modal.Body>
            </Modal>
            {/* end delete Modal*/}
        </section>
    )
}
export default IteamKeepRoom;