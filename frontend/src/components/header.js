import { useState } from 'react';
import Navbar from 'react-bootstrap/Navbar';
import Nav from 'react-bootstrap/Nav';
import Container from 'react-bootstrap/Container';
import Link from 'next/link';
import { Button } from 'react-bootstrap';
import Image from 'react-bootstrap/Image';

const links = [
  { href: '/', text: 'Trang chủ' },
  { href: '/contact', text: 'Về chúng tôi' },
  { href: '/rooms&suites', text: 'Phòng nghỉ' },
  { href: '/restaurant', text: 'Ẩm thực' },
  { href: '/spa', text: 'Chăm sóc sức khỏe' },
  { href: '/gallery', text: 'Thư viện' },
  { href: '/blogs', text: 'Sự kiện' },
];

const contacts = [
  {icon: '', text: 'Võ Văn Ngân'},
  {icon: '', text: 'info@dominion.com'},
  {icon: '', text: '0123456789'},
]

function AppHeader() {
  const [expanded, setExpanded] = useState(false);

  const handleNavItemClick = () => {
    // Khi bạn nhấp vào một liên kết, hãy đặt expanded về giá trị false để đóng collapse.
    setExpanded(false);
  };

  return (
    <Navbar fixed="top" expand="lg" className="bg-body-tertiary" expanded={expanded}>
      <Container>
        <Navbar.Brand href="/">
          <Image></Image>
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="responsive-navbar-nav" onClick={() => setExpanded(!expanded)} />
        <Navbar.Collapse id="responsive-navbar-nav" className='justify-content-end flex-wrap'>
        <Nav>
            {contacts.map((contact, index) => (
              <div key={index} className='me-5'>
                <span>{contact.text}</span>
              </div>
            ))}
          </Nav>
          <Nav>
            {links.map((link, index) => (
              <Link key={index} href={link.href}className='nav-link me-3' onClick={handleNavItemClick}>
                  {link.text}
              </Link>
            ))}
            <Button>Đặt Ngay</Button>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default AppHeader;
