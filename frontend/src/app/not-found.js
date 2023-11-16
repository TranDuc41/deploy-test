import Link from "next/link";
import '@/app/custom.css';
import Image from 'next/image';
import { Container } from 'react-bootstrap'
export default function NotFound() {
  return (
    <main className='text-center' id="notFound">
      <div className='background'>
        <Container>
          <div className='banner-content w-100'>
            <div className='banner-title'>
              <Image src="/dominion-logo.png"
                width={90}
                height={66}
                alt="Dominion Logo">
              </Image>
              <h1 className='text-white'>Đã có vấn đề sảy ra!</h1>
              <h4 className=''>Chúng tôi không thể tìm thấy trang bạn đang tìm kiếm.</h4>
              <h4>Trở về <Link href={'/'}>Trang chủ</Link></h4>
            </div>
            <div className='banner-description d-flex justify-content-center'>
              <span className='text-white d-flex'></span>
            </div>
          </div>
        </Container>
      </div>
    </main>
  )
}