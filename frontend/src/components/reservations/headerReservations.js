import '@/app/custom-1.css';
import { useState } from 'react';
import Navbar from 'react-bootstrap/Navbar';
import Nav from 'react-bootstrap/Nav';
import Container from 'react-bootstrap/Container';
import Link from 'next/link';
import { Button } from 'react-bootstrap';
import Image from 'react-bootstrap/Image';
import { LuMapPin, LuMail, LuPhone } from 'react-icons/lu';
import { usePathname } from 'next/navigation';
import NavDropdown from 'react-bootstrap/NavDropdown';

import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
//Data
const links = [
    { href: '', text: 'Khả dụng' },
    { href: '/contact', text: 'Thông in' },
];
const dropdown = [
    { href: '/restaurant', text: 'Ẩm thực' },
    { href: '/spa', text: 'Chăm sóc sức khỏe' },
];
const address = [
    { icon: <FaRegBuilding />, text: "Võ Văn Ngân" },
    { icon: <FaPhoneAlt />, text: "0123456789" },
    { icon: <FaLink />, text: "info@gmail.com" },
]
//function
function Header() {
    const [expanded, setExpanded] = useState(false);
    const pathname = usePathname();
    const handleNavItemClick = () => {
        setExpanded(false);
    };

    return (
        <header>
            <Navbar id='header-reservations' fixed="top" expand="lg" className="m-0 p-0 bg-body-tertiary" expanded={expanded}>
                <Container>
                    {/* logo */}
                    <Navbar.Brand href="/" className='logo'>
                        <Image src="/dominion-logo.png"
                            width={40}
                            alt="Dominion Logo">
                        </Image>
                        <Image src="/dominion--.png"
                            width={100}
                            alt="Dominion logo">
                        </Image>
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="responsive-navbar-nav" onClick={() => setExpanded(!expanded)} />
                    <Navbar.Collapse id="responsive-navbar-nav" className='justify-content-start flex-wrap'>
                        <Nav>
                            {links.map((link, index) => (
                                <Link key={index} href={link.href} className={`nav-link ${pathname == link.href ? "active" : ""}`} onClick={handleNavItemClick}>
                                    {link.text}
                                </Link>
                            ))}

                            <NavDropdown title="Dịch vụ khác" id="nav-dropdown">
                                {dropdown.map((link, index) => (
                                    <NavDropdown.Item eventKey={index} href={link.href}>{link.text}</NavDropdown.Item>

                                ))}
                            </NavDropdown>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
            {/* BANNER */}
            <div className='banner-booking'>
                <Container>
                    <div className='address-booking'>
                        <h1>Dominion</h1>
                        <div className='address'>
                            {address.map((addres, index) => (
                                <div key={index}>
                                    {addres.icon}
                                    <span>{addres.text}</span>
                                </div>
                            ))}
                        </div>
                    </div>
                </Container>
            </div>
            {/* END BANNER */}
        </header>

    );
}

export default Header;
