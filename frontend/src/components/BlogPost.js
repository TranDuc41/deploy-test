// BlogPost.js
import React from 'react';
import { Card, Button } from 'react-bootstrap';
import Link from 'next/link';


const BlogPost = ({ id, title, summary, imageUrl, readTime }) => {

  return (
    // Thêm class 'dominion-blog-post' vào Card component
    <Card className="dominion-blog-post">
      <Card.Img variant="top" src={imageUrl} className="dominion-blog-post__image" />
      <Card.Body className="dominion-blog-post__body">
        <Card.Text className="dominion-blog-post__read-time text-muted">{readTime}</Card.Text>
        <Card.Title className="dominion-blog-post__title">{title}</Card.Title>
        <Card.Text className="dominion-blog-post__summary">{summary}</Card.Text>
        <Link href={`/blogdetail?page=${id}`} className="dominion-blog-post__button">
          Xem Thêm
        </Link>
      </Card.Body>
    </Card>
  );
};

export default BlogPost;
