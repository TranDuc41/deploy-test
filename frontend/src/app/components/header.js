'use client'
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Button from 'react-bootstrap/Button';
import Link from 'next/link';

function AppHeader() {
  return (
    <Navbar collapseOnSelect expand="lg" className="bg-body-tertiary">
      <Container>
      <Nav className="me-auto">
        <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
        </Nav>
        <Navbar.Toggle aria-controls="responsive-navbar-nav" />
        <Navbar.Collapse id="responsive-navbar-nav" className='justify-content-end'>
          <Nav>
            <Link href="/" className='nav-link'>Trang chủ</Link>
            <Link href="/contact" className='nav-link'>
              Về chúng tôi
            </Link>
            <Link href="#" className='nav-link'>Phòng nghỉ</Link>
            <Link href="#" className='nav-link'>Ẩm thực</Link>
            <Link href="#" className='nav-link'>Chăm sóc sức khỏe</Link>
            <Link href="#" className='nav-link'>Thư viện</Link>
            <Link href="/blogs" className='nav-link'>Sự kiện</Link>
            <Button>Đặt Ngay</Button>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default AppHeader;