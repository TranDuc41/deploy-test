import '@/app/reservations/custom-1.css';
import { Container, Row } from 'react-bootstrap';
import Image from 'react-bootstrap/Image';
import PhotoAlbum from '@/components/gallery';

export const metadata = {
  title: 'Gallery Page',
  description: 'Description bla bla',
}

export default function Gallery() {
  return (
    <main>
      <section id="banner-gellary">
        <Image src="/Amanoi_Gallery_3.jpg" height={500} />
      </section>
      <Container className='my-5 pt-3'>
        <div className='gallery-header text-center my-5'>
          <Image
            src="/dominion-logo.png"
            width={114}
            height={90}
            alt="Dominion Logo"></Image>
          <h3 className='text-40 my-3'>Thư viện ảnh</h3>
          <span className='text-18'>Khám phá qua bộ sưu tập hình ảnh  của Dominion để thấy sự đẹp và tiện nghi của khách sạn chúng tôi qua góc nhìn hình ảnh tuyệt đẹp.</span>
        </div>
        <PhotoAlbum />
        
      </Container>

    </main>
  )
}

