
'use client'
import { useState } from "react";
//Css #
import '@/app/reservations/custom-1.css';
import Image from 'next/image';

//react-bootstrap-icon
import { Button, Col, Container, Row } from 'react-bootstrap'
import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
import { RiArrowDropDownLine } from 'react-icons/ri';
import Form from 'react-bootstrap/Form';
import Layoutreservations from '@/app/reservations/layout'
import React from 'react';



import ItemKeepRoom from '@/components/itemKeepRoom';

export default function Payment() {
  const [isOpen, setIsOpen] = useState(false);
  const toggleAccordion = () => {
    setIsOpen(!isOpen);
  };
  return (
    <Layoutreservations children showHeader={false}>
      <main className='content_reservations'>
        <Container>
          <Row>
            <Col lg={7}>

            </Col>
            <Col lg={5}>
              <section id="summary">
                <Container className="bg-light p-4 mt-5">
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
                          <span>VAT & Phí dịch vụ</span><span>10.250.555 vnd</span>
                        </div>
                      )}
                    </Row>
                    <div class="thumb-cards_button text-center mt-5">

                    </div>
                  </div>

                </Container>
              </section>
            </Col>
          </Row>
        </Container>
      </main>
    </Layoutreservations>
  )
}