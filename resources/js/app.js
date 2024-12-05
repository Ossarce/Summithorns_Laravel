import './bootstrap';
import { Notyf } from 'notyf';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    toggleStickyHeader();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.hamburguer-menu');

    const sidebar = document.querySelector('.sidebar');
    const sidebarBtn = document.querySelector('.sidebar-menu');

    if(sidebarBtn) {
        sidebarBtn.addEventListener('click', function() {
            if(sidebarBtn.classList.contains('bx-menu')) {
                sidebarBtn.classList.replace('bx-menu', 'bx-x');
            } else if (sidebarBtn.classList.contains('bx-x')) {
                sidebarBtn.classList.replace('bx-x', 'bx-menu');
            }
            sidebar.classList.toggle('active');
        })
    }

    if(mobileMenu) {
        mobileMenu.addEventListener('click', responsiveNav);
    }


    const likeButtons = document.querySelectorAll('.like-icon');
    likeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            toggleSpotLikeButton(e.currentTarget);
        });
    });

    // Quill Handling
    if (document.querySelector('#entry_description')) {
        initializeQuill('#entry_description', '#entry_description_hidden', entryDescription);
    }
    if (document.querySelector('#spot_description')) {
        initializeQuill('#spot_description', '#spot_description_hidden', spotDescription);
    }
    if (document.querySelector('#zone_details')) {
        initializeQuill('#zone_details', '#zone_details_hidden',
        zoneDetails);
    }

    const logoutBtn = document.querySelector('.sign-out');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.href;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            })
            .then(res => {
                if (res.ok) {
                    window.location.href = '/';
                } else {
                    console.error('Error en el cierre de sesión webong!');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
}

function responsiveNav() {
    const hamburguer = document.querySelector('.hamburger');
    // const closeHamburger = document.querySelector('.close-hamburger');
    const navBar = document.querySelector('.nav-bar');

    // hamburguer.classList.toggle('hide-menu');
    // closeHamburger.classList.toggle('hide-menu');
    if(hamburguer.classList.contains('bx-menu')) {
        hamburguer.classList.replace('bx-menu', 'bx-x');
    } else if(hamburguer.classList.contains('bx-x')) {
        hamburguer.classList.replace('bx-x', 'bx-menu');
    }
    navBar.classList.toggle('show');


}

function toggleStickyHeader() {
    const header = document.querySelector('.header');
    const contenidoHeader = document.querySelector('.contenido-header');
    const body = document.querySelector('body');
    let navTop = header.offsetTop;


    function updateStickyHeader() {
        navTop = header.offsetTop;  // Update the navTop value

        if (window.scrollY > navTop) {
            header.classList.add('sticky');
            body.classList.add('sticky-body');
            if (contenidoHeader) {
                contenidoHeader.classList.add('sticky-header');
            }
        } else {
            header.classList.remove('sticky');
            body.classList.remove('sticky-body');
            if (contenidoHeader) {
                contenidoHeader.classList.remove('sticky-header');
            }
        }
    }

    // Call the function initially and add a scroll event listener
    if(header) {
        updateStickyHeader();
        window.addEventListener('scroll', updateStickyHeader);
    }
}

function toggleSpotLikeButton(Button) {
    if (!isLoggedIn) {
        console.log('User not logged in!');
        const notyf = new Notyf({
            duration: 2000,
            ripple: false,
            icon: {
                tagName: 'i',
            }
        });
        notyf.open({
            type: 'warning',
            message: 'Inicia sesión para acceder a esta función',
            background: '#f59e0b',
        });

        return;
    }

    const spotId = Button.dataset.spotId;
    const action = Button.classList.contains('liked') ? 'unlike' : 'like';
    Button.classList.toggle('liked');

    // AJAX request
    fetch(`/spots/${spotId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ action: action })
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'liked') {
            Button.classList.add('liked');
        } else {
            Button.classList.remove('liked');
        }
    })
    .catch(error => console.error('Error:', error));

}

function initializeQuill(editorSelector, hiddenInputSelector, initialContent = '') {
    const quill = new Quill(editorSelector, {
        theme: 'snow'
    });

    if (initialContent) {
        quill.clipboard.dangerouslyPasteHTML(initialContent);
    }

    const form = document.querySelector('form');
    form.onsubmit = function() {
        const hiddenInput = document.querySelector(hiddenInputSelector);
        hiddenInput.value = quill.root.innerHTML;  // Set Quill's content into hidden textarea
    };
}
