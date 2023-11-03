import '@/app/custom.css';
import { Container } from 'react-bootstrap'
import { FaLink, FaPhoneAlt, FaRegBuilding } from 'react-icons/fa';
import BannerBooking from '@/components/bannerBooking';
import Form from 'react-bootstrap/Form';

export const metadata = {
  title: 'Gallery Page',
  description: 'Description bla bla',
}

const address = [
  { icon: <FaRegBuilding />, text: "Võ Văn Ngân" },
  { icon: <FaPhoneAlt />, text: "0123456789" },
  { icon: <FaLink />, text: "info@gmail.com" },
]

export default function Gallery() {
  return (
    <main>
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
      <div className='seclect-booking'>
        <Container>
          <div className='row'>
            <div className='col-12 col-xl-6'>
              <BannerBooking />
            </div>
          </div>
        </Container>
      </div>
      <div className='room-select'>
        <Container>
          <div>
            <div className='select-room'>
              <div className='row'>
                <div className='col-12 col-xl-6'>
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
            </div>
          </div>
        </Container>
      </div>
    </main>
  )
}