import Link from "next/link";
import '@/app/custom.css';
import Image from 'next/image';
import { Container } from 'react-bootstrap'
export default function NotFound() {
  return (
    <main className='text-center' id="notFound">
      <div className='background'>
        <Container className="justify-content-center">
          <section class="page_404 ">
            <div class="container">
              <div class="row">
                <div class="col-sm-12 ">
                  <div class="col-sm-10 col-sm-offset-1 custom-center">
                    <div class="four_zero_four_bg">
                      <h1 class="text-center">404</h1>
                    </div>
                    <div class="contant_box_404">
                      <h3 class="h2">
                        Có vẻ như bạn đang đi lạc
                      </h3>
                      <p>Trang bạn đang tìm kiếm không có sắn!</p>
                      <a href="/" class="link_404">Trở về trang chủ</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </Container>
      </div>
    </main>
  )
}