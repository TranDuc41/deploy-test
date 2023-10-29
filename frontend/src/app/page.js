import '../app/custom.css';
import Image from 'next/image'
import { Container } from 'react-bootstrap'
import DatePicker from '../components/datePicker'
import Swiper from '../components/swiper'
import RoomsSuites from '../components/roomsSuites'

export const metadata = {
  title: 'Home Page',
  description: 'Description bla bla',
}

export default function Home() {

  return (
    <main>
      <div className='banner'>
        <Container>
          <div className='row justify-content-center'>
            <div className='col-xxl-12 col-lg-12 wow fadeInUp'>
              <div className='banner-content w-100'>
                <div className='logo mb-3'>
                  <Image src="/dominion-logo.png"
                    width={90}
                    height={66}
                    alt="Dominion Logo">
                  </Image>
                </div>
                <div className='banner-title'>
                  <h4 className='text-white mb-4'>Chào Mừng Đến Với DOMINION</h4>
                  <h3 className='mb-4'>THIÊN NHIÊN, KHÔNG GIAN, SỰ CỞI MỞ, RIÊNG TƯ, KIẾN TRÚC PHONG CÁCH VIỆT NAM.</h3>
                </div>
                <div className='banner-description d-flex justify-content-center'>
                  <span className='text-white d-flex'>Tại Dominion Retreats, chúng tôi kết hợp vẻ đẹp của thiên nhiên nguyên sơ với sự tinh tế của tay nghề thủ công chu đáo để thiết kế những nơi nghỉ dưỡng khó quên.</span>
                </div>
              </div>
            </div>
          </div>
        </Container>
      </div>
      <div className='categoris-section'>
        <Container>
          <DatePicker />
        </Container>
      </div>
      <div className='rooms-suites pt-5 pb-5'>
        <Container>
          <div className='content-rooms-suites'>
            <div className='rooms-suites-top text-center m-auto w-50 mb-5'>
              <Image
              src="/dominion-logo.png"
              width={114}
              height={90}
              alt="Dominion Logo"></Image>
              <h2 className='text-45'>Rooms & Suites</h2>
              <span className='text-18'>Những phòng dành cho gia đình, cá nhân với views cực đẹp giúp bạn có những kỳ nghỉ đáng nhớ bên gia đình và người thân.</span>
            </div>
            <div className='rooms-suites-bottom'>
              <RoomsSuites />
            </div>
          </div>
        </Container>
      </div>
      <div className='reviews-section'>
        <Container>
          <div className='review-title-head'>
            <div className='text-center m-auto'>
              <h5 className='text-white text-24 mb-5'>Đánh Giá</h5>
              <h2 className='text-white text-45'>Lời đánh giá của khách hàng về chúng tôi</h2>
            </div>
          </div>
          <Swiper />
        </Container>
      </div>
    </main>
  )
}
