'use client'
import { useState, useEffect } from "react";
import { useRouter } from 'next/navigation';
//Css #
import '@/app/custom-1.css';
import Image from 'react-bootstrap/Image';

//layout
import LayoutR from '@/app/reservations/layout';
//react-bootstrap-icon
import { Button, Col, Container, Row } from 'react-bootstrap'
import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
import { IoMdArrowRoundBack } from "react-icons/io";
import { RiArrowDropDownLine } from 'react-icons/ri';
import Form from 'react-bootstrap/Form';
import React from 'react';
import Offcanvas from 'react-bootstrap/Offcanvas';
import Navbar from 'react-bootstrap/Navbar';
//component
import ItemKeepRoom from '@/components/reservations/itemKeepRoom';
import Spinner from '@/components/spinner';
import GuestContactInfo from '@/components/reservations/guestContactInfo';
//Floating labels
import FloatingLabel from 'react-bootstrap/FloatingLabel';

export default function Payment() {

  const router = useRouter();
  //Lay dữ liệu và get api
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  //Accordion
  const [isOpen, setIsOpen] = useState(false);
  //Offcanvas
  const [show, setShowSummary] = useState(false);
  //summary
  const [summary, setSummary] = useState(2); // Giá trị mặc định cho desktop
  // tạo chuỗi trạng thái
  let status;
  useEffect(() => {
    // Hàm xử lý thay đổi kích thước màn hình
    const handleResize = () => {
      // Kiểm tra kích thước màn hình và cập nhật giá trị  tương ứng
      if (window.innerWidth < 1200) {
        setSummary(1); // Trên mobile, hiển thị một  mỗi lần
      } else {
        setSummary(2); // Trên desktop, hiển thị hai  mỗi lần
      }
    };

    // Gọi hàm handleResize ngay khi component được mount để đặt giá trị ban đầu
    handleResize();

    // Lắng nghe sự kiện resize và gọi hàm handleResize khi kích thước màn hình thay đổi
    window.addEventListener('resize', handleResize);

    // Cleanup: loại bỏ sự kiện lắng nghe khi component bị unmount
    return () => {
      window.removeEventListener('resize', handleResize);
    };
  }, []); // Dependency array rỗng để useEffect chỉ chạy một lần khi component mount
  // -------------------------------------------------------
  const toggleAccordion = () => {
    setIsOpen(!isOpen);
  };
  ///// -------------------------------------------------------
  const handleSummaryClose = () => setShowSummary(false);
  const handleSummaryShow = () => setShowSummary(true);
  // -------------------------------------------------------
  //trở về trang trước đó
  const goBack = () =>{
    router.back();
  }
  return (
    <main className="pt-0">
      <Container fluid className="p-0">
        <Navbar className="bg-body-tertiary">
          <Container>
            <Navbar.Brand href="#home" onClick={goBack}>
              <IoMdArrowRoundBack />
              Chi tiết đặt phòng
            </Navbar.Brand>
          </Container>
        </Navbar>
      </Container>
      <Container>
        <Row>
          <Col lg={7} sm={12} className="guest-info_contact_Info px-4">
          <GuestContactInfo />
          </Col>
          {summary === 2 ? (
            <Col lg={5}>
              <section id="summary">
                <Container className="bg-light p-4 my-5">
                  <div className="summary-header pb-3">
                    <Row className="summary-total-heading mb-3">
                      <Col className="grand-total-heading--title">Tổng
                      </Col>
                      <Col className="grand-total-heading--amount text-end">70.791.126 vnd
                      </Col>
                    </Row>
                    <Row className="summary-cart_hotelDetails ">
                      <div className="summary-cart_checkIn" style={{ width: '50%' }}>
                        <b><span>Nhận phòng</span></b><br />
                        <span>Sau 2:00 chiều</span>
                      </div>

                      <div class="summary-cart_checkOut" style={{ width: '50%' }}>
                        <b><span>Trả phòng</span></b><br />
                        <span>Trước 12:00 chiều</span>
                      </div>
                    </Row>
                  </div>
                  <div className="summary-content">
                    <Row>
                      <ItemKeepRoom />
                    </Row>
                  </div>
                  <div className="summary-footer mt-3">
                    <Row className="summary-total-footer">
                      <Col className="grand-total-footer--title">Tổng
                      </Col>
                      <Col className="grand-total-footer--amount text-end">70.791.126 vnd
                      </Col>
                    </Row>
                    <Row className="summary-total-prices_displayed_include_fees">
                      <div className="accordion-header" onClick={toggleAccordion}>
                        <h6>Đã bao gồm thuế + phí  <RiArrowDropDownLine /></h6>
                      </div>
                      {isOpen && (
                        <div className="accordion-content d-flex px-4" style={{ justifyContent: "space-between" }}>
                          {/* vat va phí */}
                          <p>VAT & Phí dịch vụ</p> <p>10.250.555 vnd</p>
                        </div>
                      )}
                    </Row>

                  </div>

                </Container>
              </section>
            </Col>
          ) : (
            <div>
              <Button variant="light" onClick={handleSummaryShow}
                style={{
                  position: 'fixed',
                  bottom: '20px',
                  right: '20px',
                  padding: '10px',
                  color: '#fff',
                  border: 'none',
                  borderRadius: '50%',
                  cursor: 'pointer',
                }}>
                <Image
                  src="/dominion-logo.png"
                  alt="dominion-logo"
                  width={40} />
              </Button>

              <Offcanvas show={show} onHide={handleSummaryClose} backdrop="static">
                <Offcanvas.Header closeButton>
                </Offcanvas.Header>
                <section id="summary">
                  <Container className="p-4 my-5">
                    <div className="summary-header pb-3">
                      <Row className="summary-total-heading mb-3">
                        <Col className="grand-total-heading--title">Tổng
                        </Col>
                        <Col className="grand-total-heading--amount text-end">70.791.126 vnd
                        </Col>
                      </Row>
                      <Row className="summary-cart_hotelDetails ">
                        <div className="summary-cart_checkIn" style={{ width: '50%' }}>
                          <b><span>Nhận phòng</span></b><br />
                          <span>Sau 2:00 chiều</span>
                        </div>

                        <div class="summary-cart_checkOut" style={{ width: '50%' }}>
                          <b><span>Trả phòng</span></b><br />
                          <span>Trước 12:00 chiều</span>
                        </div>
                      </Row>
                    </div>
                    <div className="summary-content">
                      <Row>
                        <ItemKeepRoom />
                      </Row>
                    </div>
                    <div className="summary-footer mt-3">
                      <Row className="summary-total-footer">
                        <Col className="grand-total-footer--title">Tổng
                        </Col>
                        <Col className="grand-total-footer--amount text-end">70.791.126 vnd
                        </Col>
                      </Row>
                      <Row className="summary-total-prices_displayed_include_fees">
                        <div className="accordion-header" onClick={toggleAccordion}>
                          <h6>Đã bao gồm thuế + phí  <RiArrowDropDownLine /></h6>
                        </div>
                        {isOpen && (
                          <div className="accordion-content d-flex px-4" style={{ justifyContent: "space-between" }}>
                            {/* vat va phí */}
                            <p>VAT & Phí dịch vụ</p> <p>10.250.555 vnd</p>
                          </div>
                        )}
                      </Row>
                    </div>
                  </Container>
                </section>
              </Offcanvas>
            </div>
          )}
        </Row>
      </Container>
    </main>
  )
}