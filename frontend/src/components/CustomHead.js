// CustomHead.js
import Head from 'next/head';

const CustomHead = () => (
  <Head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {/* Các thẻ head khác nếu cần */}
  </Head>
);

export default CustomHead;
