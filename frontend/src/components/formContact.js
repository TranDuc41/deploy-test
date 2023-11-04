'use client'
import Container from 'react-bootstrap/Container';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';

function FormContact() {
    return (
        <Container>
            <Form>
                <Row className='contact-form mb-5'>
                    <Col className='col-12 col-sm-6 col-lg-6'>
                        <Form.Control type="text" placeholder="Họ tên..." />
                    </Col> 
                    <Col className='col-12 col-sm-6 col-lg-6'>

                        <Form.Control type="email" placeholder="Email..." />
                    </Col>
                    <Col className='col-12 col-sm-6 col-lg-6'>

                        <Form.Control type="text" placeholder="Số điện thoại..." />
                    </Col>
                    <Col className='col-12 col-sm-6 col-lg-6'>

                        <Form.Control type="text" placeholder="Tiêu đề..." />
                    </Col>
                    <Col className='col-12 col-sm-12 col-lg-12'>

                        <Form.Control type='textarea' placeholder="Nội dung..." as="textarea" rows={6} />
                    </Col>
                    <Col className='submit-contact'>
                        <Button type="submit">Gửi</Button>
                    </Col>
                </Row>
            </Form>

        </Container>
    );
}

export default FormContact;