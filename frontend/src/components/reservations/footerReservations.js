const { Container, Row, Col, Image } = require("react-bootstrap");

function Footer() {
    return (
        <footer id="footer-reservations" className="bg-light ">
            <Container>
                <Row>
                <Col>
                    <Image
                        src="/dominion--.png"
                        alt="dominion-logo"
                        width={120}
                    />
                </Col>
                <Col><p className="mb-0 text-end"> Copyright 2022, Dominion Resorts Ltd.</p></Col>
                </Row>
            </Container>
        </footer>
    )
}
export default Footer;