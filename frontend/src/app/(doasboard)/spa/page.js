import styles from '@/app/page.module.css'

export const metadata = {
  title: 'Spa Page',
  description: 'Description bla bla',
}

export default function Spa() {
  return (
    <main className={styles.main}>
      <h1>Spa Page</h1>
    </main>
  )
}