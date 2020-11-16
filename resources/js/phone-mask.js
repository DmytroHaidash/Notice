import IMask from 'imask';

const elements = document.querySelectorAll('[type="tel"]');
const maskOptions = {
    mask: /[\d ()\-+]+$/
};
if (elements.length) {
    Array.from(elements).forEach(el => {
        el.setAttribute('placeholder', '+1 999 888-77-66');
        el.addEventListener('focus', (evt) => {
            if (!evt.target.value.length) {
                evt.target.value = '+';
            }
        });
        new IMask(el, maskOptions);
    })
}
