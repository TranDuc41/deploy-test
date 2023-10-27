'use client'
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Link from 'next/link';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';

function AppHeader() {
  return (
    <footer expand="lg" className="bg-body-tertiary">
      <Container>
      <Row>
        <Col>
            <p>Nulla lobortis diam orci, nec semper est convallis ac. Quisque vitae orci sem. Vivamus hendrerit est lorem.</p>
        </Col>
        <Col>
            <h5>Giới Thiệu</h5>
            <ul>
                <li>
                    <Link href={"#"}>Trang chủ</Link>
                </li>
                <li>
                    <Link href={"#"}>Phòng nghỉ</Link>
                </li>
                <li>
                    <Link href={"#"}>Ẩm thực</Link>
                </li>
                <li>
                    <Link href={"#"}>Thông tin</Link>
                </li>
                <li>
                    <Link href={"#"}>Sự kiện</Link>
                </li>
            </ul>
        </Col>
        <Col>
            <h5>Liên Hệ</h5>
        </Col>
        <Col>
            <h5>Theo dõi</h5>
            <p>Để nhận thông tin cập nhật về trải nghiệm độc quyền, sự kiện, điểm đến mới và nhiều thông tin khác, vui lòng đăng ký thông tin mà bạn quan tâm.</p>
            <Form>
                <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Control type="email" placeholder="Nhập địa chỉ mail của bạn" />
                    <Button variant="primary" type="submit" className="w-100">
                        Submit
                    </Button>
                </Form.Group>
            </Form>
        </Col>
      </Row>
      <Row>
        <p className="text-center">Copyright 2022, Dominion Resorts Ltd.</p>
      </Row>
      </Container>
    </footer>
  );
}

export default AppHeader;