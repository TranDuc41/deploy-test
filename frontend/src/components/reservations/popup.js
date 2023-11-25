import { useState } from 'react';
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import { CiWarning } from "react-icons/ci";

const Example = ({ show, handleClose, str_popup }) => {
  return (
    <>
      <Modal show={show} onHide={handleClose}>
        <Modal.Body><CiWarning /> {str_popup} !</Modal.Body>
      </Modal>
    </>
  );
}

export default Example;