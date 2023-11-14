'use client'
import styles from '@/app/page.module.css';
import Banner from '@/components/bannerroomdetail';
import ItemContent from '@/components/itemroomdetail';
import ItemContentRoomDetail from '@/components/tabroomdetail';

// Import thư viện và hook cần thiết
import axios from 'axios';
import { useEffect, useState } from 'react';

export default function RoomDetailPage({ params }) {
    const [room, setRoom] = useState(null);
    const [loading, setLoading] = useState(true);
    const slug = params.slug;
    useEffect(() => {
      const fetchRoomData = async () => {
        try {

          const response = await axios.get(`http://127.0.0.1:8000/api/rooms/${params.slug}`);
          setRoom(response.data.room);
        } catch (error) {
          console.error('Error fetching room data:', error);
        } finally {
          setLoading(false);
        }
      };
  
      // Kiểm tra xem slug có giá trị trước khi gọi API
      if (params.slug) {
        fetchRoomData();
      }
    }, [params.slug]);
  
    if (loading) {
      return <p>Loading...</p>;
    }
  
    if (!room) {
      return <p>Room not found.</p>;
    }
    return (
        <main>
            <Banner images={room.images} />
            <ItemContent room={room} />
            <ItemContentRoomDetail spacerTitle={'Tiện ích'} listContent={room.amenities} />
            <ItemContentRoomDetail spacerTitle={'Thời gian lưu trú của bạn bao gồm'} listContent={room.packages} />
        </main>
    )
}