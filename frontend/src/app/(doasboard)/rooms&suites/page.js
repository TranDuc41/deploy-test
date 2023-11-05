import { Container } from 'react-bootstrap'
import Room from '@/components/roomSuites'

export const metadata = {
  title: 'Room & Suites Page',
  description: 'Description bla bla',
}

export default function RoomSuites() {
  return (
    <main>
      <Container>
        <Room/>
      </Container>
    </main>
  )
}