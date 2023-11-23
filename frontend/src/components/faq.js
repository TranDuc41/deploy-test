"use client"
// components/FAQ.js
import React, { useEffect } from 'react';

const faqData = [
    {
        id: 1,
        question: 'Xin chào?',
        answer: 'You can use this service by...'
    },
    {
        id: 2,
        question: 'Is there a free trial?',
        answer: 'Yes, we offer a free trial for...'
    },
    // Add more FAQ items as needed
];

const FAQ = () => {
    useEffect(() => {
        // Đặt logic JavaScript cho FAQ component ở đây (nếu cần)
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
                                {item.question}
                            </button>
                        </h2>
                        <div
                            id={`flush-collapse${item.id}`}
                            className="accordion-collapse collapse"
                            aria-labelledby={`flush-heading${item.id}`}
                            data-bs-parent="#accordionFlushExample"
                        >
                            <div className="accordion-body">{item.answer}</div>
                        </div>
                    </div>
                ))}
            </div>
        </>
    );
};

export default FAQ;
