import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    // deleteAlertMsg();
    toggleStickyHeader(); // Call the sticky header function on page load
});

function eventListeners() { // Add them as parameters
    const mobileMenu = document.querySelector('.mobile-menu');

    // const sidebar = document.querySelector('.sidebar');
    // const sidebarBtn = document.querySelector('.sidebar-menu');

    // if(sidebarBtn) {
    //     sidebarBtn.addEventListener('click', function() {
    //         if(sidebarBtn.classList.contains('bx-menu')) {
    //             sidebarBtn.classList.replace('bx-menu', 'bx-x');
    //         } else if (sidebarBtn.classList.contains('bx-x')) {
    //             sidebarBtn.classList.replace('bx-x', 'bx-menu');
    //         }
    //         sidebar.classList.toggle('active');
    //     })
    // }

    if(mobileMenu) {
        mobileMenu.addEventListener('click', responsiveNav);
    }

    // const likeButtons = document.querySelectorAll('.like-icon');
    // likeButtons.forEach(button => {
    //     button.addEventListener('click', function(e) {
    //         toggleSpotLikeButton(e.currentTarget);
    //     });
    // });

    // Quill Handling
    // if (document.querySelector('#entry_description')) {
    //     initializeQuill('#entry_description', '#entry_description_hidden', entryDescription);
    // }
    // if (document.querySelector('#spot_description')) {
    //     initializeQuill('#spot_description', '#spot_description_hidden', spotDescription);
    // }

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

// function deleteAlertMsg() {
//     const alertMsg = document.querySelector('.success');
//     if (alertMsg !== null) {
//         setTimeout(function () {
//             alertMsg.classList.add('hideAlert')
//         }, 2500)

//         setTimeout(function () {
//             alertMsg.remove();
//         }, 2700);

//         console.log('Alert message removed with smoother animation!');
//     } else {
//         console.log('No alert message found.');
//     }
// }

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

// function toggleSpotLikeButton(Button) {
//     if (!isLoggedIn) {
//         console.log('User not logged in!');
//         return;
//     }

//     const spotId = Button.dataset.spotId;
//     const action = Button.classList.contains('liked') ? 'unlike' : 'like';

//     // AJAX request
//     const xhr = new XMLHttpRequest();
//     xhr.open('POST', action === 'like' ? '/spot/like' : '/spot/unlike', true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     xhr.onload = function() {
//         if (xhr.status === 200) {
//             console.log('Raw response:', xhr.responseText);  // Log the raw response
//             try {
//                 const response = JSON.parse(xhr.responseText);
//                 if (response.status === 'success') {
//                     Button.classList.toggle('liked');
//                     console.log(response.message);
//                 } else {
//                     console.log(response.message);
//                 }
//             } catch (e) {
//                 console.error('Failed to parse JSON:', e);
//             }
//         }
//     };
//     xhr.send(`spot_id=${spotId}`);
// }

// function initializeQuill(editorSelector, hiddenInputSelector, initialContent = '') {
//     const quill = new Quill(editorSelector, {
//         theme: 'snow'
//     });

//     if (initialContent) {
//         quill.clipboard.dangerouslyPasteHTML(initialContent);
//     }

//     const form = document.querySelector('form');
//     form.onsubmit = function() {
//         const hiddenInput = document.querySelector(hiddenInputSelector);
//         hiddenInput.value = quill.root.innerHTML;  // Set Quill's content into hidden textarea
//     };
// }
