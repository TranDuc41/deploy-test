
import Button from 'react-bootstrap/Button';
import Col from 'react-bootstrap/Col';
import Form from 'react-bootstrap/Form';
import InputGroup from 'react-bootstrap/InputGroup';
import Dropdown from 'react-bootstrap/Dropdown';
import DropdownButton from 'react-bootstrap/DropdownButton';
import Row from 'react-bootstrap/Row';
import '@/app/custom-1.css';
import { useState, useEffect } from 'react';
import axios from 'axios';
//Floating labels
import FloatingLabel from 'react-bootstrap/FloatingLabel';

function FormExample() {

    const host = 'https://provinces.open-api.vn/api/';
    const [cities, setCities] = useState([]);
    const [districts, setDistricts] = useState([]);
    const [wards, setWards] = useState([]);
    const [selectedCity, setSelectedCity] = useState('');
    const [selectedDistrict, setSelectedDistrict] = useState('');
    useEffect(() => {
        // Fetch cities on component mount
        axios.get(`${host}?depth=1`).then((response) => {
            setCities(response.data);
        });
    }, []);

    const callApiDistrict = (cityCode) => {
        axios.get(`${host}p/${cityCode}?depth=2`).then((response) => {
            setDistricts(response.data.districts);
        });
    };

    const callApiWard = (districtCode) => {
        axios.get(`${host}d/${districtCode}?depth=2`).then((response) => {
            setWards(response.data.wards);
        });
    };

    const handleCityChange = (e) => {
        const cityCode = e.target.value;
        setSelectedCity(cityCode);
        setSelectedDistrict('');
        setWards([]);
        callApiDistrict(cityCode);
    };

    const handleDistrictChange = (e) => {
        const districtCode = e.target.value;
        setSelectedDistrict(districtCode);
        callApiWard(districtCode);
    };

    const handleWardChange = () => {
        // Handle ward change if needed
    };
    // ---------------------------------------------------------------------------------

    const [validated, setValidated] = useState(false);

    const handleSubmit = (event) => {
        const form = event.currentTarget;
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }

        setValidated(true);
    };
    return (
        <>
            <Row className='bg-light my-5 py-5 px-2'>
                <Form noValidate validated={validated} class='form-guest_info_'>
                    <h4 className='mt-3 mb-2'><span >Thông tin khách hàng </span></h4>
                    <Row className="mb-2">
                        <Form.Group as={Col} lg="6" controlId="validationCustom01" className='d-flex'>
                            <InputGroup className="mb-3">
                                <Form.Group as={Col} lg="4" controlId="validationCustom01" className='pe-0'>
                                    <Form.Select className='height-select_info_guest'>
                                        <option>Ông</option>
                                        <option>Bà</option>
                                        <option>Khác</option>
                                    </Form.Select>
                                </Form.Group>
                                <Form.Group as={Col} lg="8" controlId="validationCustom01" className='ps-0'>
                                    <FloatingLabel controlId="floatingInputGrid" label="Họ và tên đệm">
                                        <Form.Control
                                            required
                                            type="text"
                                            placeholder="First name"
                                            maxLength={30} />
                                        <Form.Control.Feedback type="invalid">
                                            Họ và tên đệm không được bỏ trống <br />
                                            Họ và tên đệm không quá 30 kí tự.
                                        </Form.Control.Feedback>
                                    </FloatingLabel>

                                </Form.Group>
                            </InputGroup>
                        </Form.Group>
                        <Form.Group as={Col} lg="6" controlId="validationCustom02">
                            <FloatingLabel controlId="floatingInputGrid" label="Tên">
                                <Form.Control
                                    required
                                    type="text"
                                    placeholder="Last name"
                                    maxLength={20} />
                                <Form.Control.Feedback type="invalid">
                                    Tên không được bỏ trống <br />
                                    Tên không quá 20 kí tự.
                                </Form.Control.Feedback>
                            </FloatingLabel>
                        </Form.Group>
                    </Row>
                    <Row className="mb-5">
                        <Form.Group as={Col} md="6" controlId="validationCustom03">
                            <FloatingLabel controlId="floatingInputGrid" label="Số điện thoại">
                                <Form.Control type="text"  placeholder="Phone" required minLength={10} maxLength={10} />
                                <Form.Control.Feedback type="invalid">
                                    Số điện thoại không hợp lệ.
                                </Form.Control.Feedback>
                            </FloatingLabel>
                        </Form.Group>
                        <Form.Group as={Col} md="6" controlId="validationCustom03">
                            <FloatingLabel controlId="floatingInputGrid" label="Email">
                                <Form.Control type="email"  placeholder="Email" required />
                                <Form.Control.Feedback type="invalid">
                                    Email không hợp lệ.
                                </Form.Control.Feedback>
                            </FloatingLabel>
                            <p className='text-end mt-1'><span style={{ fontSize: '14px' }}>Đây là email chúng tôi sẽ gửi xác nhận của bạn.</span></p>
                        </Form.Group>
                    </Row>
                    <h4>Địa chỉ </h4>
                    <Row className="pb-5 underline_bottom">
                        <Form.Group as={Col} md="8" controlId="validationCustom03" className='my-2'>
                            <Form.Select className='height-select_info_guest' onChange={handleCityChange} value={selectedCity}>
                                <option value='0'>Tỉnh (Thành phố)</option>
                                {cities.map((city) => (
                                    <option key={city.code} value={city.code}>{city.name}</option>
                                ))}
                            </Form.Select>
                        </Form.Group>
                        <Form.Group as={Col} md="8" controlId="validationCustom03" className='my-2'>
                            <Form.Select className='height-select_info_guest' onChange={handleDistrictChange} value={selectedDistrict}>
                                <option>Huyện (phường)</option>
                                {districts.map((district) => (
                                    <option key={district.code} value={district.code}> {district.name}</option>
                                ))}
                            </Form.Select>

                        </Form.Group>
                        <Form.Group as={Col} md="8" controlId="validationCustom03" className='my-2'>
                            <Form.Select className='height-select_info_guest' onChange={handleWardChange}>
                                <option>Xã (Thị trấn)</option>
                                {wards.map((ward) => (
                                    <option key={ward.code} value={ward.code}> {ward.name}</option>
                                ))}
                            </Form.Select>
                        </Form.Group>
                        <Form.Group as={Col} md="8" controlId="validationCustom03" className='my-2'>
                            <FloatingLabel controlId="floatingInputGrid" label="Số nhà,tên đường ">
                                <Form.Control type="text"  placeholder="address" required minLength={10} />
                                <Form.Control.Feedback type="invalid">
                                    Số nhà,tên đường không được để trống.
                                </Form.Control.Feedback>
                            </FloatingLabel>
                        </Form.Group>
                    </Row>

                </Form>
                <Form class='form-guest_info_'>
                    <Row>
                        <Form.Group as={Col} controlId="validationCustom03" className='my-2'>
                            <Form.Label className='fs-4'>Ghi chú </Form.Label>
                            <Form.Control type="text" placeholder="Vui lòng ghi chú các yêu cầu hoặc nhu cầu đặc biệt của bạn" className='height-select_info_guest' />
                        </Form.Group>
                    </Row>
                </Form>
            </Row>
            <Row className='bg-light my-5 py-5  p-3'>
                <section class="guest-policies_container bg-light">
                    <h2 class="app_heading">
                        <span>Chính sách Dominion</span>
                    </h2>
                    <Row className="summary-cart_hotelDetails ">
                        <div className="summary-cart_checkIn" style={{ width: '30%' }}>
                            <b><span>Nhận phòng</span></b><br />
                            <span>Sau 2:00 chiều</span>
                        </div>

                        <div class="summary-cart_checkOut" style={{ width: '30%' }}>
                            <b><span>Trả phòng</span></b><br />
                            <span>Trước 12:00 chiều</span>
                        </div>
                    </Row>
                    <div class="guest-policies_perRoom ">
                        <div class="guest-policies_guaranteePolicy my-3">
                            <h5 class="app_subheading2"><span>CHÍNH SÁCH BẢO ĐẢM</span></h5>
                            <span>Quý khách phải thanh toán toàn bộ trước 10 ngày trước khi nhận phòng. </span>
                            &nbsp;</div>
                        <div class="guest-policies_cancelPolicy  my-3">
                            <h5 class="app_subheading2"><span>CHÍNH SÁCH HỦY PHÒNG</span></h5>
                            <span>Hủy phòng trong vòng 10 ngày trước khi đến, quý khách sẽ mất số tiền đã cọc. <br />
                                <span className='text-danger'>* </span> Khách hàng thay đổi ngày đặt phòng và liên hệ trực tiếp đến bộ phận chăm sóc khách hàng của chúng tôi.</span>&nbsp;</div>
                    </div>
                </section>
            </Row>
            <Row className='bg-light mt-5 py-5  p-3'>
                <Form noValidate validated={validated}>
                    <h4 className='mt-3 mb-2'><span >Xác nhận</span></h4>
                    <Form.Group className="mb-3">
                        <Form.Check
                            required
                            label="* Tôi đồng ý với các Điều khoản về Quyền riêng tư."
                            feedback="Bạn phải đồng ý trước khi gửi."
                            feedbackType="invalid"
                        />
                    </Form.Group>
                    <Form.Group className="mb-3">
                        <Form.Check
                            required
                            label=" * Tôi đồng ý với các Điều kiện Đặt chỗ."
                            feedback="Bạn phải đồng ý trước khi gửi."
                            feedbackType="invalid"
                        />
                    </Form.Group>
                </Form>
            </Row>
            <div className='text-end pb-5 mb-5'>
                <Button type="submit" className='px-5 py-2 text-light btn-payment' variant="warning" onClick={handleSubmit}>Submit form</Button>
            </div>

        </>
    );
}

export default FormExample;