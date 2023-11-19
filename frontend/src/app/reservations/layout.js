'use client'
import '@/app/globals.css'
import { Arima } from 'next/font/google'
import 'bootstrap/dist/css/bootstrap.min.css';
import Footer from '@/components/reservations/footerReservations';
import { Col, Container, Row } from 'react-bootstrap';

const arima = Arima({ subsets: ['latin'] })

export default function RootLayout({ children}) {
  return (
    <html lang="en">
      <link rel="icon" href="/favicon.ico" sizes="any" />
      <body className={arima.className}>
        {children}
        <Footer/>
      </body>
    </html>
  )
}
