import '@/app/reservations/custom-1.css';
import { Container } from 'react-bootstrap';
import Image from 'react-bootstrap/Image';

export const metadata = {
  title: 'Gallery Page',
  description: 'Description bla bla',
}


export default function Gallery() {
  return (
    <main>
      <section id="banner-gellary">
        <Image src="/Amanoi_Gallery_3.jpg" height={458} />
      </section>
      <Container>
        <div className='gallery-header text-center my-5'>
          <Image
            src="/dominion-logo.png"
            width={114}
            height={90}
            alt="Dominion Logo"></Image>
          <h2 className='text-45'>Thư viện ảnh</h2>
          <span className='text-18'>Khám phá qua bộ sưu tập hình ảnh  của Dominion để thấy sự đẹp và tiện nghi của khách sạn chúng tôi qua góc nhìn hình ảnh tuyệt đẹp.</span>
        </div>

      </Container>
    </main>
  )
}

