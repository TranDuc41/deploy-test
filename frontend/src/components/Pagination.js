// Pagination.js
import React from 'react';
import { Button } from 'react-bootstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowLeft, faArrowRight } from '@fortawesome/free-solid-svg-icons';


const Pagination = ({ currentPage, setPage, pageCount }) => {
    // Tạo ra mảng các nút số trang
    let pages = [];
    for (let i = 1; i <= pageCount; i++) {
        pages.push(
            <Button key={i} onClick={() => setPage(i)} disabled={currentPage === i}>
                {i}
            </Button>
        );
    }

    // Logic để hiển thị số trang với "..."
    if (pageCount > 4) {
        if (currentPage > 3) {
            pages = [
                pages[0],
                '...',
                pages[currentPage - 2],
                pages[currentPage - 1],
                currentPage < pageCount ? pages[currentPage] : null,
                '...',
                pages[pages.length - 1]
            ];
        } else {
            pages = pages.slice(0, 3).concat(['...'], pages[pages.length - 1]);
        }
    }

    return (
        <div className="pagination-container">
            {/* Nút quay lại */}
            {currentPage > 1 && (
                <Button className="pagination-btn" onClick={() => setPage(currentPage - 1)}>
                    <FontAwesomeIcon icon={faArrowLeft} />
                </Button>
            )}

            {/* Luôn hiển thị trang đầu tiên */}
            <Button className={`pagination-btn ${currentPage === 1 ? 'active' : ''}`} onClick={() => setPage(1)}>
                1
            </Button>

            {/* Hiển thị dấu chấm lửng nếu cần */}
            {currentPage > 2 && <span className="pagination-ellipsis">...</span>}

            {/* Hiển thị trang hiện tại nếu không phải là trang đầu tiên hoặc trang cuối cùng */}
            {currentPage !== 1 && currentPage !== pageCount && (
                <Button className="pagination-btn active" onClick={() => setPage(currentPage)}>
                    {currentPage}
                </Button>
            )}

            {/* Hiển thị dấu chấm lửng trước trang cuối cùng nếu cần */}
            {currentPage < pageCount - 1 && <span className="pagination-ellipsis">...</span>}

            {/* Luôn hiển thị trang cuối cùng nếu có nhiều hơn 1 trang */}
            {pageCount > 1 && (
                <Button className={`pagination-btn ${currentPage === pageCount ? 'active' : ''}`} onClick={() => setPage(pageCount)}>
                    {pageCount}
                </Button>
            )}

            {/* Nút đi tiếp */}
            {currentPage < pageCount && (
                <Button className="pagination-btn" onClick={() => setPage(currentPage + 1)}>
                    <FontAwesomeIcon icon={faArrowRight} />
                </Button>
            )}
        </div>

    );
};

export default Pagination;
