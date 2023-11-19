// Import necessary components and styles
import React from 'react';
import Link from 'next/link'; // Thêm dòng này để import Link
import '@/app/custom.css';
import { Container, Row, Col } from 'react-bootstrap';

// Define your rooms array
const rooms = [
    {
        roomType: 'Pavilions & Villas',
    },
    {
        roomType: 'Residence',
    },
    {
        roomType: 'Wellness Villa',

    }
];

// Export the functional component
export default function Roomtype({ index }) {
    // Sử dụng index từ props để xác định phòng hiển thị
    const room = rooms[index]; // Lấy phòng dựa trên index được truyền vào
    return (

        <Container className='roomtype-header'>
            <Row>
                <Col className='d-flex justify-content-between align-items-center'>
                    <span>{room.roomType}</span>;
                    <Link href="/rooms&suites-type" className='select-all text-decoration-underline text-dark'>Select All</Link>
                </Col>
            </Row>
        </Container>

    );
}