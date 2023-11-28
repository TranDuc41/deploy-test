"use client"
// components/FAQ.js
import React, { useState, useEffect } from 'react';

const FAQ = () => {
    const [faqData, setFaqData] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/faqs');
                const data = await response.json();
                setFaqData(data);
            } catch (error) {
                console.error('Error fetching FAQ data:', error);
            }
        };

        fetchData();
    }, []);

    return (
        <>
            <div className='top-content w-50 m-auto text-center py-3'>
                <h4>F.A.QS</h4>
                <h4>Spa Etiquette</h4>
                <span>Các câu hỏi thường gặp khi đặt dịch vụ Chăm sóc sức khỏe & Spa tại Dominion </span>
            </div>
            <div className="accordion accordion-flush" id="accordionFlushExample">
                {faqData.map((item) => (
                    <div className="accordion-item" key={item.id}>
                        <h2 className="accordion-header" id={`flush-heading${item.id}`}>
                            <button
                                className="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target={`#flush-collapse${item.id}`}
                                aria-expanded="false"
                                aria-controls={`flush-collapse${item.id}`}
                            >
                                {item.title}
                            </button>
                        </h2>
                        <div
                            id={`flush-collapse${item.id}`}
                            className="accordion-collapse collapse"
                            aria-labelledby={`flush-heading${item.id}`}
                            data-bs-parent="#accordionFlushExample"
                        >
                            <div className="accordion-body">{item.description}</div>
                        </div>
                    </div>
                ))}
            </div>
        </>
    );
};

export default FAQ;
