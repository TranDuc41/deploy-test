import { Container, Row, Col } from 'react-bootstrap';
import Image from 'next/image';
import Room from '@/components/roomSuites';

export default function RoomSuites() {
  return (
    <main>
      <Image className='banner-room-page' src="/Baner.png"
        width={1440}
        height={458}
        alt="Banner room" />
      <div className='room-page' ></div>
      <Container as="main" className="rooms-suites-container">

        <Row className="text-center mb-3">
          <Col>
            <Image
              src="/dominion-logo.png"
              width={90}
              height={66}
              alt="Dominion Logo"
              className=" mx-auto d-block" // Căn giữa ảnh
            />
          </Col>
        </Row>

        {/* Tiêu đề & Mô tả */}
        <Row className="mb-4">
          <Col>
            <h1 className="text-center">Nơi mà vẻ đẹp thiên nhiên bao quanh bạn mọi lúc mọi nơi</h1>
          </Col>
        </Row>
        <Row className="mb-4">
          <Col>
            <p className="text-center">
              Nơi bạn có cơ hội khám phá những phòng khách sạn độc đáo và thoải mái nhất. Với danh sách đa dạng và tiện nghi tối ưu, chúng tôi tự hào mang đến cho bạn trải nghiệm đặt phòng không giới hạn. Hãy tham khảo danh sách phòng của chúng tôi để tìm cho mình một không gian ấm cúng và tiện nghi để tận hưởng chuyến đi của bạn. Dominion Hotel - Đón chào bạn đến với sự thoải mái và dịch vụ tận tâm!
            </p>
          </Col>
        </Row>

        {/* Phần chính Pavilions & Villas */}
        <Row className="mb-4">
          <Col>
            <div className="pavilions-villas-header d-flex justify-content-between align-items-center">
              <h2>Pavilions & Villas</h2>
              <a href="#" className="text-decoration-underline text-dark">Select All</a>
            </div>
            <Row>
              <Col>
                <Room />
              </Col>
            </Row>
          </Col>
        </Row>
      </Container>
    </main>
  );
}
