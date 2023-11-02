'use client'
import { useState } from 'react';
import Form from 'react-bootstrap/Form';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";

function BannerBooking() {
    const [startDate, setStartDate] = useState(new Date());

    return (
        <div className='categories-wrap d-flex justify-content-evenly'>
            <div className='row align-items-center justify-content-between w-100'>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Ngày Nhận</h5>
                        <DatePicker
                            selected={startDate}
                            onChange={(date) => setStartDate(date)}
                            dateFormat="M/d/y"
                        />
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Ngày Trả</h5>
                        <DatePicker
                            selected={startDate}
                            onChange={(date) => setStartDate(date)}
                            dateFormat="M/d/y"
                        />
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Người Lớn</h5>
                        <Form.Select aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Trẻ Em</h5>
                        <Form.Select aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </Form.Select>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default BannerBooking;