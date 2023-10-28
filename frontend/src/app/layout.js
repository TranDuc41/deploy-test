'use client'
// import './globals.css'
import { Arima } from 'next/font/google'
import 'bootstrap/dist/css/bootstrap.min.css';
import AppHeader from '@/components/header';
import AppFooter from '@/components/footer';

const arima = Arima({ subsets: ['latin'] })

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={arima.className}>
        <AppHeader/>
          {children}
        <AppFooter/>
      </body>
    </html>
  )
}
