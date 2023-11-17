'use client'
import { useState, useEffect } from "react";
import { useRouter } from 'next/navigation';
//Css #
import '@/app/reservations/custom-1.css';
import Image from 'react-bootstrap/Image';

//react-bootstrap-icon
import { Button, Col, Container, Row } from 'react-bootstrap'
import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
import { RiArrowDropDownLine } from 'react-icons/ri';
import Form from 'react-bootstrap/Form';
import React from 'react';
import Offcanvas from 'react-bootstrap/Offcanvas';

//component
import BannerBooking from '@/components/selectBooking';
import ItemRoomKeepBook from '@/components/itemRoomKeepBook';
import ItemKeepRoom from '@/components/itemKeepRoom';
import Spinner from '@/components/spinner';

//check validation
import validator from 'validator';

const ReservationsPage = () => {
  const router = useRouter();
  //Lay dữ liệu và get api
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
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
  useEffect(() => {
    // Lấy dữ liệu từ URL khi được render
    const fetchDataFromURL = async () => {
      // window.location.href sẽ trả về URL đầy đủ
      const currentURL = window.location.href;

      // Thực hiện các thao tác cần thiết để lấy dữ liệu từ URL
      const urlParams = new URLSearchParams(window.location.search);
      const parameterValue = urlParams.get('queryString');
      const formattedStartDate = urlParams.get('formattedStartDate');
      const adults = urlParams.get('adults');
      const children = urlParams.get('children');
      const formattedEndDate = urlParams.get('formattedEndDate');
      const isDateRangeValid = urlParams.get('isDateRangeValid');
      const isStartDateVali = urlParams.get('isStartDateVali');
      const roomType = urlParams.get('roomType');
      if (!adults || !children || !roomType) {
        router.push('/not-found');
      }
      // Kiểm tra xem giá trị từ URL
      if (!validator.isNumeric(adults) || !validator.isNumeric(children)) {
        status = "Không thể xác định thông tin tìm kiếm.";
      }
      try {

        // Sử dụng giá trị từ URL để gọi API hoặc thực hiện các thao tác khác
        const response = await fetch(`http://127.0.0.1:8000/api/reservations/${adults}/${children}/${roomType}`);
        const result = await response.json();
        // Cập nhật state với dữ liệu lấy được từ URL
        setData(result);
      } catch (error) {
        router.push('/not-found');
        console.error('Error fetching room data:', error);
        // router.push('/404');
      } finally {
        setLoading(false);
      }
    };

    fetchDataFromURL();
  }, []);
  console.log("danh sach phonh", data);
  // -------------------------------------------------------
  const toggleAccordion = () => {
    setIsOpen(!isOpen);
  };
  ///// -------------------------------------------------------
  const handleSummaryClose = () => setShowSummary(false);
  const handleSummaryShow = () => setShowSummary(true);
  // -------------------------------------------------------
  // State để theo dõi số lượng slides cần hiển thị

  return (
    <main className='content_reservations'>
      <Container>
        <Row>
          <Col lg={7} sm={12}>
            {/* seclect booking */}
            <Container>
              <Row className='seclect-booking mt-5'>
                <BannerBooking />
              </Row>
            </Container>
            {/* end seclect booking */}
            {/* room seclect booking */}
            <Container>
              <Row className='room-select my-3'>
                <div className='select-room p-0'>
                  <h4>Chọn Phòng</h4>
                  <div className='select-items'>
                    {/* <h6>Xem kết quả theo</h6> */}
                    <div className='justify-content-end'>
                      <Form.Label className="fw-normal fs-6">Xem kết quả theo</Form.Label>
                      <Form.Select className="p-0 fw-bold" aria-label="Default select example">
                        <option value="1">Đề xuất</option>
                        <option value="2">Giá Thấp - Cao</option>
                        <option value="3">Giá Cao - Thấp</option>
                      </Form.Select>
                    </div>
                  </div>
                </div>
              </Row>
            </Container>
            <Container>
              {loading ? (
                <Spinner />
              ) : data.countbyslug ? (
                <p><span>{data.countbyslug}</span></p>
              ) : data.countbyadults ? (
                <p><span>{data.countbyadults}</span></p>
              ) : (
                <div>
                  {/* Vòng lặp để hiển thị danh sách các phòng */}
                  {data.rooms.map((room) => (
                    <div key={room.id}>
                      <ItemRoomKeepBook item={room} />
                    </div>
                  ))}
                </div>
              )}
            </Container>
            {/* end Item room keep book */}
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
                    <div class="thumb-cards_button text-center mt-5">
                      <Button href="/reservations/payment" className="btn-continue" variant="warning" >Tiếp tục thanh toán</Button>
                    </div>
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
                      <div class="thumb-cards_button text-center mt-5">
                        <Button href="/reservations/payment" className="btn-continue" variant="warning" >Tiếp tục thanh toán</Button>
                      </div>
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

export default ReservationsPage;