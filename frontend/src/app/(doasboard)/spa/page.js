import Image from 'next/image';
import { Button, Container } from 'react-bootstrap';
import Itemspa from '@/components/spa';
import Wellness from '@/components/wellness';
import Faq from '@/components/faq';

export const metadata = {
  title: 'Spa Page',
  description: 'Description bla bla',
}

export default function Spa() {
  return (
    <main>
      <div className='banner-spa'>
        <Image width={1920}
          height={458}
          src="/spa-banner.png"
          alt="Banner room"
          className='w-100' />
      </div>
      <Container>
        <div className='spa-top-content'>
          <Image
            src="/dominion-logo.png"
            width={90}
            height={66}
            alt="Dominion Logo"
            className=" mx-auto d-block" // Căn giữa ảnh
          />
          <div className='content mx-auto mt-3'>
            <h1>Chăm sóc sức khỏe & Spa tại Dominion</h1>
            <span className='mt-3'>
              Nơi bạn có thể trải nghiệm sự toàn diện về chăm sóc sức khỏe. Chúng tôi cung cấp  dịch vụ mát-xa chuyên nghiệp, liệu pháp thảo dược tối ưu và các liệu pháp làm đẹp độc đáo.
              Tất cả những điều này được thiết kế để mang đến sự thư giãn và cải thiện sức khỏe cho bạn trong một không gian thoải mái và đẳng cấp của khách sạn của chúng tôi.
            </span>
          </div>
        </div>
      </Container>
      <div className='content-spa bg-white mb-5'>
        <Container>
          <Itemspa/>
        </Container>
      </div>
      <div className='content-wellness'>
        <Container>
          <Wellness/>
        </Container>
      </div>
      <div className='content-faq mb-5'>
        <Container>
          <Faq/>
        </Container>
      </div>
    </main>
  )
}