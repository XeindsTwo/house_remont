const closeModal = (modal) => {
    document.body.classList.remove('body--active');
    modal.classList.remove('modal--active');
};

const openModal = (modal) => {
    document.body.classList.add('body--active');
    modal.classList.add('modal--active');
};

const handleModalClose = (modal) => {
    document.addEventListener('keyup', (e) => {
        if (e.key === 'Escape') {
            closeModal(modal);
        }
    });
};

export {closeModal, openModal, handleModalClose};