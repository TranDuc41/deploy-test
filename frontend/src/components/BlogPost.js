// BlogPost.js
import React from 'react';
import { Card, Button } from 'react-bootstrap';
import Link from 'next/link';


const BlogPost = ({ blog_id, title, short_desc, img_src, read_time }) => {

  return (
    // Thêm class 'dominion-blog-post' vào Card component
    <Card className="dominion-blog-post">
      <Card.Img variant="top" src={`http://localhost:8000${img_src}`} className="dominion-blog-post__image" />
      <Card.Body className="dominion-blog-post__body">
        <Card.Text className="dominion-blog-post__read-time text-muted">{read_time} Phút</Card.Text>
        <Card.Title className="dominion-blog-post__title">{title}</Card.Title>
        <Card.Text className="dominion-blog-post__summary">{short_desc}</Card.Text>
        <Link href={`/blogdetail?page=${blog_id}`} className="dominion-blog-post__button">
          Xem Thêm
        </Link>
      </Card.Body>
    </Card>
  );
};

export default BlogPost;
