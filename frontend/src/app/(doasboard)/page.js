import '@/app/custom.css';
import Image from 'next/image'
import { Container } from 'react-bootstrap'
import DatePicker from '@/components/datePicker'
import Swiper from '@/components/swiper'
import RoomsSuites from '@/components/roomsSuites'
import { TbWorld } from 'react-icons/tb'
import { MdRestaurant } from 'react-icons/Md'
import { IconBase } from 'react-icons';
import GoogleMap from '@/components/map';
import RestaurantsPage from '@/components/restaurant';
import Link from 'next/link';


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
          {/* <DatePicker /> */}
        </Container>
      </div>
      <div className='intro-home'>
        <Container>
          <div className="row row-home" >
            <div className="row col-12 col-xl-6">
              <div className="col-6">
                <div className='img-home'>
                  <div className='img1-home'><Image className='w-100' src="/Amanoi_Gallery_19.jpg"
                    width={269}
                    height={239}
                    alt="">
                  </Image></div>

                  <div className='img2-home'><Image className='w-100' src="/Amanoi_Gallery_14.jpg"
                    width={269}
                    height={233}
                    alt="">
                  </Image></div>
                </div>
              </div>
              <div className="col-12 col-sm-6">
                <div className='img-home'><Image src="/Amanoi_Gallery_3.jpg"
                  priority
                  width={269}
                  height={493}
                  alt="">
                </Image></div>
              </div>

            </div>
            <div className="row col-12 col-xl-6 row-content-home">
              <div className='title-home'>
                <span className='color-span-home'>Dominion Retreats khu nghỉ dưỡng hàng đầu</span>
                <h2 >Hotel & Resort phù hợp với bạn</h2>
                <p>Đến Dominion, mời bạn cùng chúng tôi trở về quãng thời gian bình yên và những nét đẹp nguyên sơ của thiên nhiên.</p>
              </div>
              <div className='d-flex align-items-center'>
                <TbWorld className='icon-world' />
                <div className='d-block'>
                  <h3>Khu nghỉ dưỡng 5 sao</h3>
                  <p>Chúng tôi có những khoảng không gian xanh mát và tĩnh lặng, không khí trong lành.</p>
                </div>
              </div>
              <div className='d-flex align-items-center'>
                <MdRestaurant className='icon-restaurant' />
                <div className='d-block'>
                  <h3>Nhà hàng tốt nhất</h3>
                  <p>Bước vào cuộc hành trình của vị giác, khám phá ẩm thực địa phương và tận hưởng không gian ẩm thực sang trọng, ấm cúng.</p>
                </div>
              </div>
            </div>
          </div>
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






      <div className='restaurant pt-5 pb-5'>
        <Container>
          <div className='content-restaurant'>
            <div className='restaurant-top'>
              <Image src="/dominion-logo.png"
                width={90}
                height={66}
                alt="Dominion Logo">
              </Image>
              <h2 className='text-45'>Nhà Hàng</h2>
              <span className='text-18'>Các dịch vụ, món ăn chuẩn 5 sao với nhiều lựa chọn giúp bạn cảm nhận được nhiều hương vị mới lạ mỗi ngày.</span>
            </div>
            <div className='restaurant-bottom'>
              <div className='restaurant-img'>
                <RestaurantsPage />
              </div>
            </div>
            <Link className='loadmore' href="/loadmore">
              <span className="text">Xem Thêm</span>
              <span className="arrow">&rarr;</span>
            </Link>
          </div>
        </Container>
      </div>

      <div className='title-spa'>
        <Container>
          <div className='main-title-spa'>
            <div className='content-wrapper'>
              <div className='title-spa-top text-center m-auto w-50 mb-5'>
                <Image
                  src="/dominion-logo.png"
                  width={114}
                  height={90}
                  alt="Dominion Logo"></Image>
                <h2 className='text-45'>Sức khỏe & Spa</h2>
                <span className='text-18'>Chất lượng dịch vụ hàng đầu, nhân viên nhiều năm kinh nghiệm hứa hẹn mang đên trải nghiệm khó quên khi sử dụng.</span>
              </div>
            </div>

          </div>
        </Container>
        <div className='spa-introduction'>
          <div className="container">
            <div className="row">
              <div className="content-spa col-12 col-md-6 col-lg-6">
                <h3>XEM KHÁCH SẠN SANG TRỌNG CỦA CHÚNG TÔI</h3>
                <h2>Video thực tế</h2>
                <p>Những không gian, dịch vụ hiện tại của chúng tôi gói gọn trong video giúp bạn có cái nhìn tổng quan hơn.</p>
                <div><button>Tổng Quan &rarr; </button><IconBase /></div>
              </div>
              <div className="video-spa col-12 col-md-6 col-lg-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/wjjcYfccDFI?si=xyWqEa9bx4zjdi-H" title="YouTube video player" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowFullScreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className='map-container'>
        <Container>
          <GoogleMap />
        </Container>
      </div>
    </main>
  )
}
