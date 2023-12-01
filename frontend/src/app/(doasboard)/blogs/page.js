'use client'
import '@/app/custom.css';
import { Container, Row, Col, Card, Form, Button } from 'react-bootstrap';
import Image from 'next/image';
import BlogPost from '@/components/BlogPost';
import Link from 'next/link';
import React, { useState, useEffect } from 'react';
import Pagination from '@/components/Pagination';


// Component Blogs chính
export default function Blogs() {
  // const fakePosts = [
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '1 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '2 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '3 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '4 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '5 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '6 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '7 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '8 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '9 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '10 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '11 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '12 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '13 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '14 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '15 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '16 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '17 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '18 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   {
  //     id: 'post-1',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '19 Phút đọc',
  //     title: 'Benefits of Swimming for your health',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về lợi ích của việc bơi lội cho sức khỏe của bạn...'
  //   },
  //   {
  //     id: 'post-2',
  //     imageUrl: '/blogpost_default.png',
  //     readTime: '20 Phút đọc',
  //     title: 'Morning Yoga to Refresh',
  //     summary: 'Aliquam nec turpis in nunc venenatis aliquam at ut enimAliquam nec turpis in nunc venenatis aliquam at ut enim...',
  //     longDescription: 'Mô tả dài về yoga buổi sáng để làm mới bản thân...'
  //   },
  //   // ... thêm các bài viết khác cùng với longDescription
  // ];
  // State cho phân trang
  const [currentPage, setCurrentPage] = useState(1);
  const [fakePosts, setPosts] = useState([]);
  const postsPerPage = 6;
  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const response = await fetch('http://localhost:8000/api/list-blog');
        const data = await response.json();
        setPosts(data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchPosts();
  }, []);
  const pageCount = Math.ceil(fakePosts.length / postsPerPage);


  // Lấy các bài viết hiện tại
  const indexOfLastPost = currentPage * postsPerPage;
  const indexOfFirstPost = indexOfLastPost - postsPerPage;
  const currentPosts = fakePosts.slice(indexOfFirstPost, indexOfLastPost);

  // Thêm component Pagination vào UI
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
              {currentPosts.map((post, index) => (
                <Col md={6} key={post.id}> {/* Sử dụng post.id để làm key */}
                  <BlogPost {...post} />
                </Col>
              ))}
            </Row>
            {/* Phân trang */}
            <Pagination
              currentPage={currentPage}
              setPage={setCurrentPage}
              pageCount={pageCount}
            />
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
              <div className='blog-sidebar-content'>
                {fakePosts.slice(0, 4).map((post, index) => (
                  <Card key={index} className="blog-sidebar__post mb-3">
                    <Card.Body className="blog-sidebar__post-body d-flex align-items-center">
                      <Card.Img variant="left" src={post.imageUrl} className="blog-sidebar__post-image" />
                      <Card.Title className="blog-sidebar__post-title">{post.title}</Card.Title>
                    </Card.Body>
                  </Card>
                ))}
              </div>
            </div>
          </Col>
        </Row>
      </Container>
    </main>
  );
}
