import styles from '@/app/page.module.css'

export const metadata = {
  title: 'Restaurant Page',
  description: 'Description bla bla',
}

export default function Restaurant() {
  return (
    <main className={styles.main}>
      <h1>Restaurant Page</h1>
    </main>
  )
}