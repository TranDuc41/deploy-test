'use client'
import '@/app/globals.css'
import { Arima } from 'next/font/google'
import 'bootstrap/dist/css/bootstrap.min.css';
import Header from '@/components/headerReservations';
import Footer from '@/components/footerReservations';
import { Col, Container, Row } from 'react-bootstrap';

const arima = Arima({ subsets: ['latin'] })

export default function RootLayout({ children, showHeader=true}) {
  return (
    <html lang="en">
      <link rel="icon" href="/favicon.ico" sizes="any" />
      <body className={arima.className}>
        {showHeader && (<Header/>)}
        {children}
        <Footer/>
      </body>
    </html>
  )
}
