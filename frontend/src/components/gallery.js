'use client'
import PhotoAlbum from "react-photo-album";
import { useEffect, useState } from 'react';
import Button from 'react-bootstrap/Button';

import Lightbox from "yet-another-react-lightbox";
import "yet-another-react-lightbox/styles.css";

// import optional lightbox plugins
import Fullscreen from "yet-another-react-lightbox/plugins/fullscreen";
import Slideshow from "yet-another-react-lightbox/plugins/slideshow";
import Thumbnails from "yet-another-react-lightbox/plugins/thumbnails";
import Zoom from "yet-another-react-lightbox/plugins/zoom";
import Spinner from '@/components/spinner';
import "yet-another-react-lightbox/plugins/thumbnails.css";


const Gallery = () => {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [index, setIndex] = useState(-1);
    const [visibleImages, setVisibleImages] = useState(20);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/gallery');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }

                const responseData = await response.json();
                const data = responseData.images;
                // const slicedData = data.slice(20, 40);
                setData(data);

            } catch (error) {
                setError('Đã xảy ra lỗi khi lấy dữ liệu');
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);
    const handleLoadMore = () => {
        setVisibleImages(prevVisibleImages => prevVisibleImages + 10);
    };
    if (loading) {
        return <Spinner />;
    }

    if (error) {
        return <p>{error}</p>;
    }
    const visibleData = data.slice(0, visibleImages);
    return (
        <>
            <PhotoAlbum layout="columns" columns={3} photos={visibleData} targetRowHeight={150} onClick={({ index }) => setIndex(index)} />
            {visibleImages < data.length && (
                <div className="text-center">
                    <Button variant="link" onClick={handleLoadMore} className='text-center text-warning my-4'>Xem thêm</Button>
                </div>
                
            )}

            <Lightbox
                slides={data}
                open={index >= 0}
                index={index}
                close={() => setIndex(-1)}
                // enable optional lightbox plugins
                plugins={[Fullscreen, Slideshow, Zoom]}
            />

        </>
    )

}
export default Gallery;