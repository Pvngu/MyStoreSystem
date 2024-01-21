//// sidebar button
let btn = document.querySelector("#hamburger");
let sidebar = document.querySelector(".sidebar");

let sidebarStatus = false;

sidebarOptions = document.querySelectorAll('.openItem');
sidebarOptions.forEach(element => {
    const name = element.querySelector('.a-id');
    const submenu = element.querySelector('.submenu-items');
    const arrow = element.querySelector('.submenuArrow');
    name.addEventListener("click", () => {
        closeSubmenu(name.id);
        toggleSubmenu(submenu, arrow);
    })
});

btn.onclick = function() {
    const submenu = document.querySelectorAll('.submenu-items');
    submenu.forEach(element => {
        if(sidebar.classList.contains('active')) {
            element.classList.remove('show');
        }
    });
    sidebar.classList.toggle("active");
}

const contentClick = document.querySelector(".content");
contentClick.addEventListener("click", () => {
    const submenu = document.querySelectorAll('.submenu-items');
    submenu.forEach(element => {
        if(sidebar.classList.contains('active')) {
            element.classList.remove('show');
        }
    });
    if(sidebarStatus == true){
        sidebar.classList.remove("active");
        btn.checked = false;
    }
})
    
    function toggleSubmenu(submenu, arrow) {
        sidebarStatus = sidebar.classList.contains('active');
        if(sidebarStatus == true) {
            submenu.classList.toggle("show");
            arrow.classList.toggle("active");
        }
        else{
            btn.checked = true;
            sidebarStatus = true;
            sidebar.classList.toggle("active");
            submenu.classList.toggle("show");
            arrow.classList.toggle("active");
        }
    }

    function closeSubmenu(submenuu) {
        sidebarOptions.forEach(element => {
            const submenu = element.querySelector('.submenu-items');
            const name = element.querySelector('.a-id');
            const status = submenu.classList.contains('show');
            const arrow = element.querySelector('.submenuArrow');
            if(status == true  && submenuu !== name.id) {
                submenu.classList.toggle("show");
                arrow.classList.toggle("active");
            }
        });
    }
//// popup window
// settings window
const closeButtonS = document.querySelector(".closeBtnModalS")
const modalS = document.querySelector(".settingsModal")
const openButtonS = document.querySelectorAll(".openModalS")

openButtonS.forEach((key, index) => {
    openButtonS[index].addEventListener("click", () => {
        modalS.showModal()
    })
})
closeButtonS.addEventListener("click", () => {
    modalS.close();
})
// logout window
const closeButtonL = document.querySelectorAll(".closeBtnModalL");
const modalL = document.querySelector(".logoutModal")
const openButtonL = document.querySelector(".openModalL")
openButtonL.addEventListener("click", () => {
    modalL.showModal()
})

for(i = 0; i < closeButtonL.length; i++){
    closeButtonL[i].addEventListener("click", () => {
    modalL.close();
})
}

//About us window
const closeButtonAU = document.querySelector(".closeBtnModalAU")
const modalAU = document.querySelector(".aboutUsModal");
const openButtonAU = document.querySelector(".openModalAU");
openButtonAU.addEventListener("click", () => {
    modalAU.showModal()
})

closeButtonAU.addEventListener("click", () => {
    modalAU.close();
})
    //Account settings window
    const closeButtonAS = document.querySelector(".closeBtnModalAS")
    const modalAS = document.querySelector(".accountStgModal");
    const openButtonAS = document.querySelector(".openModalAS");
    openButtonAS.addEventListener("click", () => {
    modalAS.showModal()
})

closeButtonAS.addEventListener("click", () => {
    modalAS.close();
})

////Theme switcher slider
var html = document.getElementsByTagName('html');
var radios = document.getElementsByName('themes');
var slider = document.querySelector('.slider');

function setThemeCookie(theme) {
var expirationDate = new Date();
expirationDate.setMonth(expirationDate.getMonth() + 3);

document.cookie = "selected_theme=" + theme + "; expires=" + expirationDate.toUTCString() + "; path=/";
}

function getCookie(name) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
}

function updateSliderPosition() {
    var savedTheme = getCookie('selected_theme');
    if (savedTheme === 'dark-theme') {
        slider.style.transform = 'translateX(100%)';
    } else {
        slider.style.transform = 'translateX(0)';
    }
}

var savedTheme = getCookie('selected_theme');
if (savedTheme) {
    updateSliderPosition();
}

for (var i = 0; i < radios.length; i++) {
    radios[i].addEventListener('change', function () {
        html[0].classList.remove(html[0].classList.item(0));
        html[0].classList.add(this.id);
        setThemeCookie(this.id);
        updateSliderPosition();
    });
}