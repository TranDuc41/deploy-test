'use client'
import 'react-bootstrap';
import { useState, useEffect } from "react";
import { RiArrowDropDownLine, RiDeleteBinLine, RiEditLine } from 'react-icons/ri';
import { AiOutlineWarning } from 'react-icons/ai';
import Link from 'next/link';
import { Button, Row } from 'react-bootstrap';
import Modal from 'react-bootstrap/Modal';
import SelectBooking from '@/components/reservations/selectBooking';
import '@/app/custom-1.css';
import { format, addDays, eachDayOfInterval, parse, differenceInDays } from 'date-fns';

const IteamKeepRoom = ({ checkin, checkout }) => {
    //lay du lieu
    const [data, setData] = useState({});
    const [dataKeyDE, setDataKeyDE] = useState({});
    const [isOpen, setIsOpen] = useState(false);
    const [reloadKey, setReloadKey] = useState(0);
    const toggleAccordion = () => {
        setIsOpen(!isOpen);
    };
    //------------------------------------------
    // thoi gian 
    const setcheckIn = parse(checkin, 'dd/MM/yyyy', new Date());
    const setcheckOut = parse(checkout, 'dd/MM/yyyy', new Date());

    // const dateArray = eachDayOfInterval({ start: setcheckIn, end: addDays(setcheckOut, -1) });

    // Tính số ngày giữa hai ngày
    const daysDifference = differenceInDays(setcheckOut, setcheckIn);
    //-------------------------------------------
    //Modal edit item keep room
    const [show, setShow] = useState(false);
    // ------------------------------------------------\
    //lấy dữ liệu trên local Storage
    useEffect(() => {
        // Xác định các khóa bạn muốn lấy
        const keysToRetrieve = ["key1", "key2", "key3"];

        const newData = {};
        keysToRetrieve.forEach((key) => {
            const storedItem = localStorage.getItem(key);
            // Kiểm tra xem storedItem có tồn tại hay không
            if (storedItem !== null) {
                const parsedItem = JSON.parse(storedItem);
                newData[key] = parsedItem;
            }
        });
        setData(newData);
    }, [reloadKey]);
    //-------------------------------------------------
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const [showDE, setShowDE] = useState(false);
    const handleCloseDE = () => setShowDE(false);
    const handleShowDE = (key) => {
        setDataKeyDE(key);
        setShowDE(true)
    };
    
    const handleRemoveKey = (key) => {
        const songay = parseFloat(daysDifference);
        var total_amount = parseFloat(localStorage.getItem('total_amount'));
        const storedItem = localStorage.getItem(key);
        const parsedItem = JSON.parse(storedItem);
        var itemPrice = parseFloat(parsedItem.price);
        console.log(parsedItem.price);
        console.log(total_amount);
        total_amount = total_amount-(itemPrice*songay);
        // Xóa một khóa từ localStorage
        localStorage.removeItem(key);
        if (total_amount <= 0) {
            localStorage.setItem('total_amount', '0');
        } else {
            localStorage.setItem('total_amount', total_amount);
        }
        // Khi xóa xong, cập nhật state để kích hoạt sự kiện render lại component
        setReloadKey(prevReloadKey => prevReloadKey + 1);
        handleCloseDE();
        window.location.reload();
    };
    //------------------------------------------------------
    return (
        <>
            {Object.keys(data).map((key) => (
                <Row>
                    <section className="item-keep_room pt-3">
                        <div className="item-keep_room_header mb-3">
                            <div className="item-keep_room-date_checkin_checkout">
                                {checkin}  - {checkout}
                            </div>
                        </div>
                        <div className="item-keep_room_content">
                            <h4 className="keep_room_title">{data[key]?.title}</h4>
                            <div className="summary--keep_room_info d-flex">
                                <div className="item-keep_room--guests-night"><span>{data[key]?.adults} Người | {daysDifference} Đêm</span></div>
                                <div className="item-keep_room--price_night">{((data[key]?.price) * (daysDifference)).toLocaleString()}  VND</div>
                            </div>
                            <div className="accordion text-muted">
                                <div className="accordion-header" onClick={toggleAccordion}>
                                    <p>Chi tiết  <RiArrowDropDownLine /></p>
                                </div>
                                {isOpen && (
                                    <div className="accordion-content">
                                        {/* {dateArray.map((date, index) => (
                                            <div class="display-prices d-flex px-3">
                                                <div key={index} class="display-prices_label"><span>{format(date, 'dd/MM/yyyy')}</span>
                                                </div>
                                                <div class="display-prices_price"><span>{data[key]?.price}</span>
                                                </div>
                                            </div>
                                        ))} */}
                                        {/* <div class="display-prices d-flex px-3">
                                            <div class="display-prices_label"><span>16/10/2023</span>
                                            </div>
                                            <div class="display-prices_price"><span>35.395.563 vnd</span>
                                            </div>
                                        </div> */}
                                    </div>
                                )}
                            </div>
                        </div>
                        <div className="item-keep_room_footer pb-3">
                            <a variant="link" className='delete-keep_room pe-2' onClick={() => handleShowDE(key)}><RiDeleteBinLine /> Xóa</a>
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
                                <Button variant="danger " onClick={() => handleRemoveKey(dataKeyDE)}>
                                    Delete
                                </Button>
                            </Modal.Body>
                        </Modal>
                        {/* end delete Modal*/}
                    </section>
                </Row>
            ))}
        </>

    )
}
export default IteamKeepRoom;