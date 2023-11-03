import Link from "next/link";
import { Col, Image, Row } from "react-bootstrap";
import { BsFillPersonFill } from "react-icons/bs";
import { BiSolidBed } from "react-icons/bi";
import '@/app/reservations/custom-1.css'

function ItemRoomKeepBook() {
    return (
        <Row className="bg-light thumb-cards_keep_room" key={''}>
            <Col lg={5} className="px-0 ">
                <div className="thumb-cards_images">
                    <Image className=""
                        src="/ocean-pool-family-villa/Amanoi, Vietnam - Ocean Pool Family Villa, aerial view.jpg"
                        alt=""
                        width={'100%'}
                        height={'auto'}
                    />
                </div>
            </Col>
            <Col lg={7}>
                <div className="thumb-cards_cardHeader">
                    <h2 class="app_heading_room">Ocean Pool Villa</h2>
                    <div className="thumb-cards_trigger_and_room_info">
                        <div className="trigger guests_number">
                            <BsFillPersonFill /> 2 người
                        </div>
                        <div className="trigger roomsize_bed">
                            <BiSolidBed />1 Giường lớn
                        </div>
                    </div>
                    <div className="thumb-cards_trigger_and_room_info_2">
                        <p></p>
                    </div>
                    <div className="thumb-cards_detailsLink">
                        <Link href={''} aria-aria-label="">Xem chi tiết...</Link>
                    </div>
                </div>
            </Col>
        </Row>
    );
}

export default ItemRoomKeepBook;