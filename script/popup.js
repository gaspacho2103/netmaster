var popupBg = document.querySelector('.popup');

var form;

function openConnectForm() {

    form = document.querySelector('.connect-form');

    popupBg.classList.add('active');
    form.classList.add('active');

    console.log(form);
}

function openUnconnectForm() {

    form = document.querySelector('.unconnect-form');

    popupBg.classList.add('active');
    form.classList.add('active');
}

function openRemoveForm() {

    form = document.querySelector('.remove-form');

    popupBg.classList.add('active');
    form.classList.add('active');
}

function openCreateUserForm() {

    form = document.querySelector('.create-user');

    popupBg.classList.add('active');
    form.classList.add('active');
}

function openCreateSwitchForm() {

    form = document.querySelector('.create-switch');

    popupBg.classList.add('active');
    form.classList.add('active');
}

function openCreateRouterForm() {

    form = document.querySelector('.create-router');

    popupBg.classList.add('active');
    form.classList.add('active');
}

document.addEventListener('click', (e) => {
    if(e.target === popupBg) {
        popupBg.classList.remove('active');
        form.classList.remove('active');
    }
});