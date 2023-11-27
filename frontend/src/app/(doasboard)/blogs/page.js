'use client';
import '@/app/custom.css';
import { Container, Row, Col, Card, Form, Button } from 'react-bootstrap';
import Image from 'next/image';
import BlogPost from '@/components/BlogPost';
import Link from 'next/link';


// Component Blogs chính
export default function Blogs() {
  const fakePosts = [
    {
      id: 'post-1',
      imageUrl: '/blogpost_default.png',
      readTime: '9 Phút đọc',
      title: 'Benefits of Swimming for your health',
      summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
      longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
    },
    {
      id: 'post-2',
      imageUrl: '/blogpost_default.png',
      readTime: '4 Phút đọc',
      title: 'Morning Yoga to Refresh',
      summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
      longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
    },
    // ... thêm các bài viết khác cùng với longDescription
  ];

  return (
    <main>
      {/* Banner */}
      <div className="dominion-blog-banner ">
        <Image
          src="/baner-blog.png"
          width={1440}
          height={458}
          alt="Banner blog"
          layout='responsive'
        />
        <div className="dominion-blog-banner-text">
          <h1 className="banner-title">Tin Tức</h1>
          <p className="banner-subtitle">Nội dung mới nhất và hữu ích mà chúng tôi muốn mang đến cho bạn.</p>
        </div>
      </div>
      {/* Blog Posts và Sidebar */}
      <Container>
        <Row>
          <Col lg={8}>
            <Row>
              {fakePosts.map((post, index) => (
                <Col md={6} key={post.id}> {/* Sử dụng post.id để làm key */}
                  <BlogPost {...post} />
                </Col>
              ))}
            </Row>
          </Col>
          <Col lg={4}>
            {/* Phần tìm kiếm */}
            <div className='search-blog'>
              <span>Tìm Kiếm</span>
              <Form className="search-form-blog mb-3">
                <Form.Control type="text" placeholder="Từ khóa..." />
                <Button className='btn-search' type="submit">Tìm</Button>
              </Form>
            </div>
            {/* Danh sách bài viết mới */}
            <div className='latest-posts-blog'>
              <h3 className="blog-sidebar__title">Bài viết mới</h3>
              {fakePosts.slice(0, 4).map((post, index) => (
                <Card key={index} className="blog-sidebar__post mb-3">
                  <Card.Body className="blog-sidebar__post-body d-flex align-items-center">
                    <Card.Img variant="left" src={post.imageUrl} className="blog-sidebar__post-image" />
                    <Card.Title className="blog-sidebar__post-title">{post.title}</Card.Title>
                  </Card.Body>
                </Card>
              ))}
            </div>
          </Col>
        </Row>
      </Container>
    </main>
  );
}
