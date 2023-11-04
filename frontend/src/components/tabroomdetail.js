'use client'
import { Carousel, Col, Container, Row } from "react-bootstrap";

import '../app/custom.css'

const ItemContentRoomDetail = ({spacerTitle, listContent}) => {
    return (
        <section className="spacer">
            <Container>
                <Row>
                    <Col>
                        <header className='heading-h text-center'>
                            <h2>{spacerTitle}</h2>
                        </header>
                    </Col>
                </Row>
                <Row>
                <ul className='grid-list'> 
                    {listContent.map((item, index) => (
                        <li className='grid-column' key={index}>{item.name}</li>
                    ))}
                </ul>
                </Row>
            </Container>
        </section>
    )
}

export default ItemContentRoomDetail;