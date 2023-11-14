'use client'
import { useState, useEffect } from 'react';
import { Button } from 'react-bootstrap';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import Form from 'react-bootstrap/Form';
import { format, differenceInDays, isValid } from 'date-fns';
import { useRouter } from 'next/navigation';

const currentDate = new Date();
const endOfYear = new Date(currentDate.getFullYear(), 11, 31);

export default function MyDatePicker() {
    const [roomTypes, setRoomTypes] = useState([]);
    const [startDate, setStartDate] = useState(new Date());
    const [endDate, setEndDate] = useState(new Date());
    const [roomType, setRoomType] = useState('');
    const [adults, setAdults] = useState('1');
    const [children, setChildren] = useState('0');
    const [error, setError] = useState('');

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://localhost:8000/api/room-types');
                const data = await response.json();
                setRoomTypes(data);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        if (roomTypes.length === 0) {
            fetchData();
        }
    }, [roomTypes]);

    const isValidAdults = !isNaN(adults) && adults >= 1 && adults <= 20;
    const isValidChildren = !isNaN(children) && children >= 0 && children <= 5;

    const router = useRouter();

    const handleButtonClick = () => {
        const formattedStartDate = startDate ? format(startDate, 'dd/MM/yyyy') : '';
        const formattedEndDate = endDate ? format(endDate, 'dd/MM/yyyy') : '';

        // Hàm kiểm tra định dạng 'dd/MM/yyyy'
        const isFormattedDateValid = (dateString) => isValid(new Date(dateString));

        const isStartDateValid = isFormattedDateValid(startDate);
        const isEndDateValid = isFormattedDateValid(endDate);
        const isDateRangeValid = endDate > startDate && differenceInDays(endDate, startDate) <= 50;

        if (!isDateRangeValid || !isStartDateValid || !isEndDateValid) {
            setError('Ngày tháng năm không hợp lệ!');
        }
        // Kiểm tra điều kiện trước khi gửi dữ liệu
        else if (!isValidAdults || !isValidChildren) {
            setError('Số lượng không hợp lệ!');
        } else if (!roomTypes.some((Type) => roomType === Type.slug)) {
            setError('Vui lòng chọn loại phòng!');
        } else if (!adults || !children) {
            setError('Nội dung không hợp lệ!');
        } else {
            // console.log('Đã gửi');
            setError('');
            // Chuyển dữ liệu sang trang Booking
            router.push('/booking', undefined, { shallow: true });
            router.query = {
                formattedStartDate,
                adults,
                children,
                formattedEndDate,
                isDateRangeValid,
                isStartDateValid,
                roomType,
            };
        }
    };

    // Hàm để ẩn thông báo sau 5 giây
    const hideErrorAfterDelay = () => {
        setTimeout(() => {
            setError('');
        }, 5000);
    };

    if (error) {
        hideErrorAfterDelay();
    }

    return (
        <div className='categories-wrap d-flex justify-content-evenly'>
            <div className='row align-items-center justify-content-between w-100'>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Nhận Phòng</h5>
                        <DatePicker
                            selected={startDate}
                            onChange={(date) => setStartDate(date)}
                            dateFormat="d/M/y"
                            minDate={currentDate}
                            maxDate={endOfYear}
                        />
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Trả Phòng</h5>
                        <DatePicker
                            selected={endDate}
                            onChange={(date) => setEndDate(date)}
                            dateFormat="d/M/y"
                            minDate={currentDate}
                            maxDate={endOfYear}
                        />
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Người Lớn</h5>
                        <Form.Select
                            aria-label="Default select example"
                            name='adults'
                            value={adults}
                            onChange={(e) => setAdults(e.target.value)}>
                            {Array.from({ length: 20 }, (_, index) => index + 1).map((number) => (
                                <option key={number} value={number}>{number}</option>
                            ))}
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Trẻ Em</h5>
                        <Form.Select
                            aria-label='Default select example'
                            name='children'
                            value={children}
                            onChange={(e) => setChildren(e.target.value)}>
                            {Array.from({ length: 6 }, (_, index) => index).map((number) => (
                                <option key={number}>{number}</option>
                            ))}
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <div className='cate-items'>
                        <h5>Phòng</h5>
                        <Form.Select
                            aria-label="Default select example"
                            name='roomType'
                            value={roomType}
                            onChange={(e) => setRoomType(e.target.value)}>
                            <option>---Chọn---</option>
                            {roomTypes.map((roomType, index) => (
                                <option key={index} value={roomType.slug}>{roomType.name}</option>
                            ))};
                        </Form.Select>
                    </div>
                </div>
                <div className='col-xxl-2 col-xl-4 col-lg-4 col-md-4 col-sm-4'>
                    <Button className='px-4 btn-check-now w-100' onClick={handleButtonClick}>Đặt Ngay</Button>
                </div>
                <div className='col-12 text-center'>
                    {error && <p style={{ color: 'red' }} className='mt-5'>{error}</p>}
                </div>
            </div>
        </div>
    );
}