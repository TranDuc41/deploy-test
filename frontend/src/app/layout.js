'use client'
// import './globals.css'
import { Inter } from 'next/font/google'
import 'bootstrap/dist/css/bootstrap.min.css';
import AppHeader from '@/components/header';
import AppFooter from '@/components/footer';

const inter = Inter({ subsets: ['latin'] })

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={inter.className}>
        <AppHeader/>
          {children}
        <AppFooter/>
      </body>
    </html>
  )
}
