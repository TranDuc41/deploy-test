import Image from 'next/image';
import { Button, Container } from 'react-bootstrap';
import Restaurantcontent from '@/components/contentRestaurant';

export const metadata = {
  title: 'Restaurant Page',
  description: 'Description bla bla',
}

export default function Restaurant() {
  return (
    <main>
      <div className='banner-restaurant'>
        <Image width={1920}
          height={458}
          src="/Banner-restaurant.png"
          alt="Banner room"
          className='object-fit-cover' />
      </div>
      <Container>
        <div className='restaurant-top-content'>
          <Image
            src="/dominion-logo.png"
            width={90}
            height={66}
            alt="Dominion Logo"
            className=" mx-auto d-block" // Căn giữa ảnh
          />
          <div className='content'>
            <h1>Tận hưởng những khoảnh khắc ẩm thực độc đáo</h1>
            <span>
              Khám phá tất cả các địa điểm ăn uống độc đáo và trải nghiệm ẩm thực đích thực dưới bàn tay tài năng của các đầu bếp nổi tiếng của chúng tôi.
              Phục vụ theo sở thích của khách hàng và tạo ra những khoảnh khắc khó quên bên những người thân yêu
            </span>
          </div>
        </div>
        <div className='my-5'>
          <Restaurantcontent />
        </div>
      </Container>
      <div className='banner-bootom-restaurant'>
        <div className='content'>
          <h3 className='text-white'>Trà Chiều</h3>
          <span>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn ....</span>
          <div className='btn-booking'>
            <Button>Đặt ngay</Button>
          </div>
          
        </div>
      </div>
    </main>
  )
}