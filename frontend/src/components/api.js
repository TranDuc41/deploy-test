// api.js (trong thư mục components)
import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api'; // Thay đổi URL tùy thuộc vào API của bạn

const api = axios.create({
  baseURL: API_URL,
});

export const fetchDataRoomDetail = async (slug) => {
  try {
    const response = await api.get(`/rooms/${slug}`);
    return response.data;
  } catch (error) {
    console.error(`Error fetching room data for ${slug}:`, error);
    throw error;
  }
};
