import Image from 'next/image'
import styles from './page.module.css'

export const metadata = {
  title: 'Home Page',
  description: 'Description bla bla',
}

export default function Home() {
  return (
    <main className={styles.main}>
      <h1>Home Page</h1>
    </main>
  )
}
