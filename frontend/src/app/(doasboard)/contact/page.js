import '@/app/custom.css';
import { Container } from 'react-bootstrap'
import { LuMapPin, LuMail, LuPhone } from 'react-icons/lu';
import FormContact from '@/components/formContact';

export const metadata = {
  title: 'Contact Page',
  description: 'Description bla bla',
}

const contacts = [
  { icon: <LuMapPin />, text: 'Võ Văn Ngân' },
  { icon: <LuMail />, text: 'info@dominion.com' },
  { icon: <LuPhone />, text: '0123456789' },
]

export default function Contact() {
  return (
    <main >
      <div className='contact-page' >
        <Container>
          <div className='row'>
            <div className='col-12 col-xl-6'>
              <h3>Khách sạn Dominion</h3>
              <p>Không có yêu cầu nào là quá lớn hay quá nhỏ đối với đội ngũ nhân viên tận tâm của chúng tôi. Chúng tôi luôn có mặt để hỗ trợ bạn trước kỳ nghỉ của mình.</p>
              <div className=''>
                <ul className='list-unstyled'>
                  {contacts.map((contact, index) => (
                    <li key={index}>
                      <span className='navIcon'>{contact.icon}</span>
                      <span className='ms-2'>{contact.text}</span>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
            <div className='col-12  col-xl-6'>
              <h3>Đánh giá & Góp ý</h3>
              <FormContact/>
            </div>
          </div>
        </Container>
      </div>
    </main>
  )
}