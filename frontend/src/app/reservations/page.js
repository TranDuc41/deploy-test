'use client'
//Css #
import '@/app/reservations/custom-1.css';
import Image from 'next/image';

//react-bootstrap-icon
import { Container, Row } from 'react-bootstrap'
import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
import Form from 'react-bootstrap/Form';
import React from 'react';

//component
import BannerBooking from '@/components/selectBooking';
import ItemRoomKeepBook from '@/components/itemRoomKeepBook';


export default function Page() {
  return (
    <div className='content'>
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
              <div className='select-items text-end'>
                <h6>Xem kết quả theo</h6>
                <div className='d-flex justify-content-end'>
                  <Form.Select aria-label="Default select example">
                    <option value="1">Đề xuất</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </Form.Select>
                </div>
              </div>
            </div>
        </Row>
      </Container>
      {/* end room seclect booking */}
      {/* Item room keep book */}
      <Container>
        <ItemRoomKeepBook />
        <ItemRoomKeepBook />
        <ItemRoomKeepBook />  
      </Container>
      {/* end Item room keep book */}
    </div>
  )
}
