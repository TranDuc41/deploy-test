import '@/app/reservations/custom-1.css';
import Image from 'next/image';

import { Container, Row } from 'react-bootstrap'
import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
import Form from 'react-bootstrap/Form';
import BannerBooking from '@/components/selectBooking';
import React from 'react';
import ItemRoomKeepBook from '@/components/itemRoomKeepBook';

export const metadata = {
  title: 'Home Page',
  description: 'Description bla bla',
}
//data
export default function Home() {

  return (
    <div className='content'>
      {/* seclect booking */}
      <Container>
        <Row>
          <div className='seclect-booking'>
            <BannerBooking />
          </div>
        </Row>
      </Container>
      {/* end seclect booking */}
      {/* room seclect booking */}
      <Container>
        <Row>
          <div className='room-select'>
            <div className='select-room'>
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
          </div>
        </Row>
      </Container>
       {/* end room seclect booking */}
      {/* Item room keep book */}
      <Container>
         <ItemRoomKeepBook/>
      </Container>
      {/* end Item room keep book */}
    </div>
  )
}
