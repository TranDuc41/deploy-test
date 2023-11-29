'use client'
import React, { useState } from 'react';
import Container from 'react-bootstrap/Container';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import axios from 'axios';

function FormContact() {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        title: '',
        content: ''
    });

    const [errors, setErrors] = useState({});
    const [submitSuccess, setSubmitSuccess] = useState(false);

    const validateForm = () => {
        let errors = {};
        // Validate Full Name
        if (formData.name.length > 55) {
            errors.name = 'Nội dung tối đa 55 ký tự';
        } else if (!formData.name.trim()) {
            errors.name = 'Vui lòng nhập ít nhất một ký tự';
        } else if (!/^[\p{L}\s]+$/u.test(formData.name)) {
            errors.name = 'Nội dung không hợp lệ';
        }

        // Validate Email Address
        if (formData.email.length > 254) {
            errors.email = 'Nội dung tối đa 254 ký tự';
        } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
            errors.email = 'Định dạng email không hợp lệ';
        }
        // Validate Your Number
        const validMobilePrefixes = [
            '086', '096', '097', '098', '032', '033', '034', '035', '036', '037', '038', '039',
            '091', '094', '083', '084', '085', '081', '082',
            '089', '090', '093', '070', '079', '077', '076', '078',
            '092', '056', '058',
            '099', '059'
        ];

        const validLandlinePrefixes = ['24', '28', '236', '292', '225', '203', '238', '237', '258', '274', '251', '254', '296'];

        const isValidMobileNumber = validMobilePrefixes.some(prefix => formData.phone.startsWith(prefix));
        const isValidLandlineNumber = validLandlinePrefixes.some(prefix => formData.phone.startsWith(prefix));

        if (formData.phone.length !== 10 || !/^\d{10}$/.test(formData.phone) || (!isValidMobileNumber && !isValidLandlineNumber)) {
            errors.phone = 'Số điện thoại không hợp lệ';
        }

        // Validate Subject
        if (formData.title.length < 20 || formData.title.length > 100) {
            errors.title = 'Nội dung phải từ 20 - 100 ký tự';
        } else if (!/^[\p{L}\d\s\p{P}]+$/u.test(formData.title)) {
            errors.title = 'Nội dung chứa ký tự không hợp lệ';
        }

        // Validate Content
        if (formData.content.length < 20 || formData.content.length > 512) {
            errors.content = 'Nội dung phải từ 20 - 512 ký tự';
        }
        return errors;
    };
    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value.trim() });
        // Reset the error for the changed field
        setErrors((prevErrors) => ({ ...prevErrors, [name]: '' }));
    }
    const [isSubmitting, setIsSubmitting] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        if (isSubmitting) return;
    
        const formErrors = validateForm();
        if (Object.keys(formErrors).length === 0) {
            setIsSubmitting(true);
    
            try {
                const response = await axios.post('http://localhost:8000/api/save-data', formData);
                console.log(response.data);
                setSubmitSuccess(true);
    
                // Xóa nội dung form sau khi gửi thành công
                setFormData({
                    name: '',
                    email: '',
                    phone: '',
                    title: '',
                    content: ''
                });
                 // Xóa các lỗi sau khi gửi thành công
            setErrors({});
            } catch (error) {
                console.error('Có lỗi xảy ra khi gửi dữ liệu:', error);
            } finally {
                setIsSubmitting(false);
            }
        } else {
            setErrors(formErrors);
        }
    };
    







    return (
        <Container>
            <Form onSubmit={handleSubmit}>
                <Row className='contact-form mb-5'>
                    {/* Trường "Họ tên" */}
                    <Col className='col-12 col-sm-6 col-lg-6'>
                        <Form.Control
                            type="text"
                            placeholder="Họ tên..."
                            name="name"
                            value={formData.name}
                            onChange={handleInputChange}
                            isInvalid={!!errors.name}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.name}
                        </Form.Control.Feedback>
                    </Col>
                    {/* Trường "Email" */}
                    <Col className='col-12 col-sm-6 col-lg-6'>
                        <Form.Control
                            type="email"
                            placeholder="Email..."
                            name="email"
                            value={formData.email}
                            onChange={handleInputChange}
                            isInvalid={!!errors.email}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.email}
                        </Form.Control.Feedback>
                    </Col>
                    {/* Trường "Số điện thoại" */}
                    <Col className='col-12 col-sm-6 col-lg-6'>
                        <Form.Control
                            type="text"
                            placeholder="Số điện thoại..."
                            name="phone"
                            value={formData.phone}
                            onChange={handleInputChange}
                            isInvalid={!!errors.phone}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.phone}
                        </Form.Control.Feedback>
                    </Col>
                    {/* Trường "Tiêu đề" */}
                    <Col className='col-12 col-sm-6 col-lg-6'>
                        <Form.Control
                            type="text"
                            placeholder="Tiêu đề..."
                            name="title"
                            value={formData.title}
                            onChange={handleInputChange}
                            isInvalid={!!errors.title}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.title}
                        </Form.Control.Feedback>
                    </Col>
                    <Col className='col-12 col-sm-12 col-lg-12'>
                        <Form.Control
                            as="textarea"
                            rows={6}
                            placeholder="Nội dung..."
                            name="content"
                            value={formData.content}
                            onChange={handleInputChange}
                            isInvalid={!!errors.content}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.content}
                        </Form.Control.Feedback>
                    </Col>
                    {/* Hiển thị thông báo lỗi trên nút "Send Message" */}
                    {/* {Object.keys(errors).length > 0 && (
                    <div>
                        <p style={{ color: 'red', fontWeight: 'bold' }}>Đã có lỗi xảy ra:</p>
                        <ul>
                            {Object.values(errors).map((error, index) => (
                                <li key={index} style={{ color: 'red' }}>{error}</li>
                            ))}
                        </ul>
                    </div>
                )} */}
                    <Col className='submit-contact'>
                        

                        <Button type="submit" disabled={isSubmitting}>Gửi</Button>
                        {/* Hiển thị thông báo thành công */}
                        {submitSuccess && (
                            <div style={{ color: 'green', textAlign: 'center', margin: '20px 0' }}>
                                Nội dung đã được gửi thành công. Cảm ơn bạn!
                            </div>
                        )}

                    </Col>

                </Row>


            </Form>
        </Container>
    );
}

export default FormContact;