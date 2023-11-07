import Spinner from 'react-bootstrap/Spinner';

function BasicExample() {
  return (
    <Spinner animation="border" variant="light" size="xl" role="status">
      <span className="visually-hidden">Loading...</span>
    </Spinner>
  );
}

export default BasicExample;