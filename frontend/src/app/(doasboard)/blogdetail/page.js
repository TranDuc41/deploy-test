'use client';
import '@/app/custom.css';
import React from 'react';
import { Container, Row, Col, Card, Form, Button } from 'react-bootstrap';
import Image from 'next/image';
import BlogPost from '@/components/BlogPost';
import Link from 'next/link';


// Component Blogs chính
export default function BlogDetail() {
    const fakePosts = new Array(6).fill({
        imageUrl: '/blogpost_default.png',
        readTime: '7 Phút đọc',
        title: 'Benefits of Swimming for your health',
        summary: 'Quisque sed felis bibendum, pulvinar leo vitae, ornare libero...',
    });

    const detailContent = {
        id: 'unique-post-id',
        title: 'Benefits of Swimming for your health',
        imageUrl: '/blogpost_default.png',
        longDescription: 'Quisque sed felis bibendum, pulvinar leo vitae, ornare libero. In at metus nec dolor sollicitudin consectetur vel in nibh. Praesent a lacus sit amet nunc ultricies porttitor vel in nunc. Etiam et facilisis elit. Nunc sed aliquam arcu, a lacinia augue. Nullam sodales mi id Quisque sed felis bibendum, pulvinar leo vitae, ornare libero. In at metus nec dolor sollicitudin consectetur vel in nibh. Praesent a lacus sit amet nunc ultricies porttitor vel in nunc. Etiam et facilisis elit. Nunc sed aliquam arcu, a lacinia augue. Nullam sodales mi id tincidunt congue.Quisque sed felis bibendum, pulvinar leo vitae, ornare libero. In at metus nec  tincidunt congue.',
    };
    const fakeCategories = new Array(3).fill({
        name: 'Hotel Design',
        // Nếu bạn có các url hình ảnh cho mỗi category, thêm vào đây
        // imageUrl: '/path-to-category-image.png',
    });

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
                        <Card>
                            {/* Display the current blog post */}
                            <Card.Img variant="top" src={detailContent.imageUrl} />
                            <Card.Body>
                                <Card.Title>{detailContent.title}</Card.Title>
                                <Card.Text>
                                    {detailContent.longDescription}
                                </Card.Text>
                            </Card.Body>
                        </Card>
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
                            <h3 className="blog-sidebar__title">Bài viết gần đây</h3>
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
                        <div className='category-blog'>
                            <h3 className="blog-sidebar__title">Thể Loại</h3>
                            <ul className="list-unstyled">
                                {fakeCategories.map((category, index) => (
                                    <li key={index} className='category-item'>
                                        <Link href="/path-to-category" passHref>
                                            <span className='category-link'>{"\u00BB " + category.name}</span>
                                        </Link>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </Col>
                </Row>
            </Container>
        </main>
    );
}
