import Image from "next/image"


const wellness = [
    {
        img: '/spa-banner.png',
        title: 'Movement & body work',
        content: 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker.'
    }
]

const Wellness = () => {
    return (
        <>
            {wellness.map((wellnes, index) => (
                <div key={index} className="row">
                    <div className="col-5">
                        <h3 className="mb-4">{wellnes.title}</h3>
                        <span>{wellnes.content}</span>
                    </div>
                    <div className="col-7">
                        <Image
                        width={726}
                        height={462}
                        src={wellnes.img}
                        alt="Dominion"
                        />
                    </div>
                </div>
            ))}
        </>
    )
}

export default Wellness