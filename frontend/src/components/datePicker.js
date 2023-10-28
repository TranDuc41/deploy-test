'use client'
import { useState } from 'react';
import { Button } from 'react-bootstrap';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import Form from 'react-bootstrap/Form';

const titles = [
    { text: "Nhận Phòng" },
    { text: "Trả Phòng" },
]

export default function MyDatePicker() {
    const [startDate, setStartDate] = useState(new Date());

    return (
        <div className='categories-wrap d-flex'>
            <div className='row align-items-center justify-content-between w-100'>
                {titles.map((title, index) => (
                    <div key={index} className='col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4'>
                        <div className='cate-items'>
                            <h5>{title.text}</h5>
                            <DatePicker
                                selected={startDate}
                                onChange={(date) => setStartDate(date)}
                                dateFormat="d/M/y"
                            />
                        </div>
                    </div>
                ))}
                <div className='col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Người Lớn</h5>
                        <Form.Select aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Trẻ Em</h5>
                        <Form.Select aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Phòng</h5>
                        <Form.Select aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-4 h-100 d-flex align-items-flex-end'>
                    <Button className='mt-2 px-4 btn-check-now w-100'>Đặt Ngay</Button>
                </div>
            </div>
        </div>
    );
}