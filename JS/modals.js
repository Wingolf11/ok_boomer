
    const buttons = document.querySelectorAll('[data-modal]');
    const modalOverlay = document.getElementById('modalOverlay');
    const modals = document.querySelectorAll('.modal');
    const closeBtns = document.querySelectorAll('.close-btn');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const modalId = btn.getAttribute('data-modal');

        modals.forEach(m => m.style.display = 'none'); // hide all modals
        document.getElementById(modalId).style.display = 'block'; // show selected modal
        modalOverlay.style.display = 'flex';
      });
    });

    closeBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        modalOverlay.style.display = 'none';
      });
    });

    modalOverlay.addEventListener('click', (e) => {
      if (e.target === modalOverlay) {
        modalOverlay.style.display = 'none';
      }
    });
 