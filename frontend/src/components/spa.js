import Image from "next/image";
import Link from "next/link";
import { Button } from "react-bootstrap";

const items = [
    {
        title: 'Dịch Vụ Spa Dominion',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker.',
        time: '10:00 - 22:00',
        link: '',
        imgs: [
            {
                image_src: "/Amanoi_Gallery_19.jpg",
            },
            {
                image_src: "/Amanoi_Gallery_19.jpg",
            }
        ]
    }
];

const itemSpa = () => {
    return (
        <>
            {items.map((item, index) => (
                <div key={index} className="item-content row">
                    <div className="col-8 row">
                        {item.imgs.map((img, index) => (
                            <div key={index} className="col">
                                <Image
                                    width={357}
                                    height={661}
                                    src={img.image_src}
                                    alt="Dominion"
                                />
                            </div>
                        ))}

                    </div>
                    <div className="col-4">
                        <h3 className="mb-4">{item.title}</h3>
                        <span className="mb-5">{item.content}</span>
                        <div className="mb-3">
                            <span>Giờ hoạt động: {item.time}
                            <Link href={item.link}>Spa Menu</Link>
                            </span>
                        </div>
                        <div className="d-flex justify-content-center">
                           <Button>Đặt ngay</Button> 
                        </div>
                        
                    </div>
                </div>
            ))}
        </>

    )
}

export default itemSpa;