/**
 * NiceHelp Theme JavaScript
 *
 * @package NiceHelp
 */

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Mobile menu toggle
    const mobileToggle = document.querySelector('.nh-header__mobile-toggle');
    const nav = document.querySelector('.nh-header__nav');
    if (mobileToggle && nav) {
        mobileToggle.addEventListener('click', () => {
            nav.classList.toggle('is-open');
            const isOpen = nav.classList.contains('is-open');
            mobileToggle.setAttribute('aria-expanded', isOpen);
        });
    }

    // FAQ accordion
    document.querySelectorAll('.nh-faq__question').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.nh-faq__item');
            const answer = item.querySelector('.nh-faq__answer');
            const isOpen = item.classList.contains('is-open');

            // Close all
            document.querySelectorAll('.nh-faq__item.is-open').forEach(openItem => {
                if (openItem !== item) {
                    openItem.classList.remove('is-open');
                    openItem.querySelector('.nh-faq__question').setAttribute('aria-expanded', 'false');
                    openItem.querySelector('.nh-faq__answer').hidden = true;
                }
            });

            // Toggle current
            item.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', !isOpen);
            answer.hidden = isOpen;
        });
    });

    // Search clear button
    const searchClear = document.querySelector('.nh-search-hero__clear');
    const searchInput = document.querySelector('.nh-search-hero__input');
    if (searchClear && searchInput) {
        searchClear.addEventListener('click', () => {
            searchInput.value = '';
            searchInput.focus();
        });
    }

    // Article feedback buttons
    document.querySelectorAll('[data-feedback]').forEach(btn => {
        btn.addEventListener('click', () => {
            const feedback = btn.dataset.feedback;
            const container = btn.closest('.nh-article__feedback');
            container.innerHTML = '<p class="nh-article__feedback-label">感谢您的反馈！</p>';
        });
    });
});
