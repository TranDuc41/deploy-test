'use client'
import { useState } from 'react';
import Form from 'react-bootstrap/Form';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import { FaCalendarAlt } from 'react-icons/fa';

function SelectBooking() {
    const [startDate, setStartDate] = useState(new Date());

    return (
        <div className='categories-wrap d-flex justify-content-evenly'>
            <div className='row align-items-center justify-content-between w-100'>
                <div className='col-6 col-md-3'>
                    <div className='cate-items'>
                        <h5>Ngày Nhận</h5>
                        <DatePicker
                            showIcon
                            selected={startDate}
                            onChange={(date) => setStartDate(date)}
                            icon={
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="18" viewBox="0 0 15 18" fill="none">
                                    <path d="M0.021398 0.410156V4.79817H15V0.410156H0.021398ZM0.021398 6.99218V17.7647C0.021398 17.8745 0.10699 17.9622 0.21398 17.9622H14.786C14.893 17.9622 14.9786 17.8745 14.9786 17.7647V6.99218H0H0.021398ZM2.1612 9.18618H4.301V11.3802H2.1612V9.18618ZM6.4408 9.18618H8.5806V11.3802H6.4408V9.18618ZM10.7204 9.18618H12.8602V11.3802H10.7204V9.18618ZM2.1612 13.5742H4.301V15.7682H2.1612V13.5742ZM6.4408 13.5742H8.5806V15.7682H6.4408V13.5742Z" fill="#666666" />
                                </svg>
                            }
                            dateFormat="M/d/y"
                        />
                    </div>
                </div>
                <div className='col-6 col-md-3 my-1'>
                    <div className='cate-items'>
                        <h5>Ngày Trả</h5>
                        <DatePicker
                            showIcon
                            selected={startDate}
                            onChange={(date) => setStartDate(date)}
                            icon={<svg xmlns="http://www.w3.org/2000/svg" width="15" height="18" viewBox="0 0 15 18" fill="none">
                                <path d="M0.021398 0.410156V4.79817H15V0.410156H0.021398ZM0.021398 6.99218V17.7647C0.021398 17.8745 0.10699 17.9622 0.21398 17.9622H14.786C14.893 17.9622 14.9786 17.8745 14.9786 17.7647V6.99218H0H0.021398ZM2.1612 9.18618H4.301V11.3802H2.1612V9.18618ZM6.4408 9.18618H8.5806V11.3802H6.4408V9.18618ZM10.7204 9.18618H12.8602V11.3802H10.7204V9.18618ZM2.1612 13.5742H4.301V15.7682H2.1612V13.5742ZM6.4408 13.5742H8.5806V15.7682H6.4408V13.5742Z" fill="#666666" />
                            </svg>}
                            dateFormat="M/d/y"
                        />
                    </div>
                </div>
                <div className='col-6 col-md-3'>
                    <div className='cate-items'>
                        <h5>Người Lớn</h5>
                        <div className='d-flex input'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                                <path d="M8.50024 10.1271C10.8713 10.1271 12.7934 8.17884 12.7934 5.77548C12.7934 3.37213 10.8713 1.42383 8.50024 1.42383C6.12916 1.42383 4.20703 3.37213 4.20703 5.77548C4.20703 8.17884 6.12916 10.1271 8.50024 10.1271Z" stroke="#666666" />
                                <path d="M12.7932 11.8682H13.0952C14.3942 11.8682 15.49 12.8487 15.6512 14.1553L15.9865 16.8742C16.1146 17.9131 15.3154 18.8308 14.2824 18.8308H2.71753C1.68459 18.8308 0.885396 17.9131 1.01351 16.8742L1.34881 14.1553C1.50995 12.8487 2.60575 11.8682 3.90485 11.8682H4.20679" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <Form.Select aria-label="Default select example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </Form.Select>
                        </div>
                    </div>
                </div>
                <div className='col-6 col-md-3'>
                    <div className='cate-items'>
                        <h5>Trẻ Em</h5>
                        <div className='d-flex input'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                                <path d="M8.50024 10.1271C10.8713 10.1271 12.7934 8.17884 12.7934 5.77548C12.7934 3.37213 10.8713 1.42383 8.50024 1.42383C6.12916 1.42383 4.20703 3.37213 4.20703 5.77548C4.20703 8.17884 6.12916 10.1271 8.50024 10.1271Z" stroke="#666666" />
                                <path d="M12.7932 11.8682H13.0952C14.3942 11.8682 15.49 12.8487 15.6512 14.1553L15.9865 16.8742C16.1146 17.9131 15.3154 18.8308 14.2824 18.8308H2.71753C1.68459 18.8308 0.885396 17.9131 1.01351 16.8742L1.34881 14.1553C1.50995 12.8487 2.60575 11.8682 3.90485 11.8682H4.20679" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <Form.Select aria-label="Default select example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </Form.Select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    );
}

export default SelectBooking;