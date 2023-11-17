import '../app/custom.css';
import { useRouter } from 'next/navigation';
import { useState } from 'react';
import Navbar from 'react-bootstrap/Navbar';
import Nav from 'react-bootstrap/Nav';
import Container from 'react-bootstrap/Container';
import Link from 'next/link';
import { Button } from 'react-bootstrap';
import Image from 'react-bootstrap/Image';
import { LuMapPin, LuMail, LuPhone } from 'react-icons/lu';
import { usePathname } from 'next/navigation';
import { addDays, format } from 'date-fns';

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
  { icon: <LuMapPin />, text: 'Võ Văn Ngân' },
  { icon: <LuMail />, text: 'info@dominion.com' },
  { icon: <LuPhone />, text: '0123456789' },
]

function AppHeader() {
  const [expanded, setExpanded] = useState(false);

  const pathname = usePathname();

  const handleNavItemClick = () => {
    // Khi bạn nhấp vào một liên kết, hãy đặt expanded về giá trị false để đóng collapse.
    setExpanded(false);
  };

  const router = useRouter();

  const startDate = new Date();
  const endDate = addDays(startDate, 1);
  const formattedStartDate = startDate ? format(startDate, 'dd/MM/yyyy') : '';
  const formattedEndDate = endDate ? format(endDate, 'dd/MM/yyyy') : '';
  const adults = '2';
  const children = '2';
  const roomType = 'villas';
  
  const handleButtonClick = () => {
    // Chuyển dữ liệu sang trang reservations
    const dataToSend = {
      formattedStartDate,
      adults,
      children,
      formattedEndDate,
      roomType,
    };

    const queryParams = new URLSearchParams(dataToSend);
    const queryString = queryParams.toString();

    // Chuyển hướng với query parameters trong URL
    router.push(`/reservations?${queryString}`);
  }

  return (
    <Navbar fixed="top" expand="lg" className="bg-body-tertiary" expanded={expanded}>
      <Container>
        <Navbar.Brand href="/" className='logo'>
          <Image src="/dominion-logo.png"
            width={50}
            height={36}
            alt="Dominion Logo">
          </Image>
          <Image src="/dominion--.png"
            width={120}
            height={30}
            alt="Dominion logo">
          </Image>
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="responsive-navbar-nav" onClick={() => setExpanded(!expanded)} />
        <Navbar.Collapse id="responsive-navbar-nav" className='justify-content-end flex-wrap'>
          <Nav>
            {contacts.map((contact, index) => (
              <div key={index} className='me-5 text-black-50'>
                <span className='navIcon'>{contact.icon}</span>
                <span>{contact.text}</span>
              </div>
            ))}
          </Nav>
          <Nav>
            {links.map((link, index) => (
              <Link key={index} href={link.href} className={`nav-link me-3 mt-2 ${pathname == link.href ? "active" : ""}`} onClick={handleNavItemClick}>
                {link.text}
              </Link>
            ))}
            <Button className='mt-2 px-4 btn-check-now text-white' onClick={handleButtonClick}>Đặt Ngay</Button>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default AppHeader;
