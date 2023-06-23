const headerForm = document.getElementById('header-input-search');

headerForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let text = document.querySelector('#header-input-search > input').value;

    let encodedText = encodeURIComponent(text);

    let url = '/catalog/search?q=' + encodedText;

    window.location.href = url;
});