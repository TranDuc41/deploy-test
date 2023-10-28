'use client'
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Link from 'next/link';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Image from 'react-bootstrap/Image';
import ListGroup from 'react-bootstrap/ListGroup';
import { LuMapPin, LuMail, LuPhone } from 'react-icons/lu';
import { BsYoutube, BsTwitter, BsFacebook, BsInstagram } from 'react-icons/bs';

const links = [
    { href: '/', text: 'Trang chủ' },
    { href: '/rooms&suites', text: 'Phòng nghỉ' },
    { href: '/restaurant', text: 'Ẩm thực' },
    { href: '/gallery', text: 'Thư viện' },
    { href: '/blogs', text: 'Sự kiện' },
];

const contacts = [
    { icon: <LuMapPin />, text: 'Võ Văn Ngân' },
    { icon: <LuMail />, text: 'info@dominion.com' },
    { icon: <LuPhone />, text: '0123456789' },
]

const socials = [
    { icon: <BsFacebook />, text: 'Facebook', link: '' },
    { icon: <BsInstagram />, text: 'Instagram', link: '' },
    { icon: <BsTwitter />, text: 'Twitter', link: '' },
    { icon: <BsYoutube />, text: 'Youtube', link: '' },
]

function AppHeader() {
    return (
        <footer expand="lg" className="bg-body-tertiary">
            <Container>
                <Row className='mb-5'>
                    <Col className='col-12 col-sm-6 col-lg-3'>
                        <ListGroup>
                            <ListGroup.Item>
                                <Image src="/dominion-logo.png"
                                    width={50}
                                    height={36}
                                    alt="Dominion Logo">
                                </Image>
                            </ListGroup.Item>
                            <ListGroup.Item>
                                <Image src="/dominion--.png"
                                    width={120}
                                    height={30}
                                    alt="Dominion logo">
                                </Image>
                            </ListGroup.Item>
                        </ListGroup>
                        <p className='mt-2'>
                            Nulla lobortis diam orci, nec semper est convallis ac. Quisque vitae orci sem. Vivamus hendrerit est lorem.
                        </p>
                        <div className='socialsing'>
                            {socials.map((social, index) => (
                                <Link href={social.link} key={index} data-bs-toggle="tooltip" data-bs-placement="bottom" title={social.text}>{social.icon}</Link>
                            ))}
                        </div>
                    </Col>
                    <Col className='col-12 col-sm-6 col-lg-3'>
                        <h5>Giới Thiệu</h5>
                        <ul className='list-unstyled'>
                            {links.map((link, index) => (
                                <li>
                                    <Link href={link.href} key={index} className='text-decoration-none'>{link.text}</Link>
                                </li>
                            ))}
                        </ul>
                    </Col>
                    <Col className='col-12 col-sm-6 col-lg-3'>
                        <h5>Liên Hệ</h5>
                        <ul className='list-unstyled'>
                            {contacts.map((contact, index) => (
                                <li>
                                    <span className='navIcon'>{contact.icon}</span>
                                    <span className='ms-2'>{contact.text}</span>
                                </li>
                            ))}
                        </ul>
                    </Col>
                    <Col className='col-12 col-sm-6 col-lg-3'>
                        <h5>Theo dõi</h5>
                        <p>Để nhận thông tin cập nhật về trải nghiệm độc quyền, sự kiện, điểm đến mới và nhiều thông tin khác, vui lòng đăng ký thông tin mà bạn quan tâm.</p>
                        <Form>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Control type="email" placeholder="Nhập địa chỉ mail của bạn" />
                                <Button variant="primary" type="submit" className="w-100 mt-3">
                                    Submit
                                </Button>
                            </Form.Group>
                        </Form>
                    </Col>
                </Row>
                <Row>
                    <div className='coppyright'>
                        <p className="text-center text-body-tertiary py-4 mb-0">Copyright 2022, Dominion Resorts Ltd.</p>
                    </div>
                </Row>
            </Container>
        </footer>
    );
}

export default AppHeader;