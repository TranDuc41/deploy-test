import Link from "next/link";
import '@/app/custom.css';
import Image from 'next/image';
import { Container } from 'react-bootstrap'
export default function NotFound() {
  return (
    <html lang="en">
    <body>
    <main className='text-center'>
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
      <h2 >There was a problem</h2>
      <p>We could not find the page you were looking for.</p>
      <p>Go to back the </p><Link href={'/'}>Dashboard</Link>
    </main>
    </body>
  </html>
  )
}