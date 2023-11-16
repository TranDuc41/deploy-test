import { Container } from 'react-bootstrap';
import Spinner from 'react-bootstrap/Spinner';

function BasicExample() {
    return (
        <Container className='text-center' >
            <Spinner animation="border" variant="secondary" role="status" className='m-5'>
                <span className="visually-hidden">Loading...</span>
            </Spinner>
        </Container>

    );
}
export default BasicExample;