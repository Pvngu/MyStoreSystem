//// sidebar button
let btn = document.querySelector("#hamburger");
let sidebar = document.querySelector(".sidebar");

const inventory = document.querySelector("#inventory");
const users = document.querySelector("#users");
const customers = document.querySelector("#customers");
const orders = document.querySelector("#orders");
const submenu = document.querySelector(".submenu-items");

const inventorySubmenu = document.querySelector(".sm-inv");
const usersSubmenu = document.querySelector(".sm-users");
const customersSubmenu = document.querySelector(".sm-customers");
const ordersSubmenu = document.querySelector(".sm-orders");

const invArrow = document.querySelector(".invArrow");
const usersArrow = document.querySelector(".usersArrow");
const customersArrow = document.querySelector(".customersArrow");
const ordersArrow = document.querySelector(".ordersArrow");

let invStatus = false;
let usersStatus = false;
let customersStatus = false;
let ordersStatus = false;
let sidebarStatus = false;

btn.onclick = function() {
    sidebar.classList.toggle("active");
    closeSidebar();
}

const contentClick = document.querySelector(".content");
contentClick.addEventListener("click", () => {
    if(sidebarStatus == true){
        sidebar.classList.toggle("active");
        btn.checked = false;
    }
    closeSidebar();
})

    //submenu Items
    inventory.addEventListener("click", () => {
        closeSubmenu("inventory");
        toggleSubmenu(inventorySubmenu, invArrow);
    })

    users.addEventListener("click", () => {
        closeSubmenu("users");
        toggleSubmenu(usersSubmenu, usersArrow);
    })

    customers.addEventListener("click", () => {
        closeSubmenu("customers");
        toggleSubmenu(customersSubmenu, customersArrow);
    })
    
    orders.addEventListener("click", () => {
        closeSubmenu("orders");
        toggleSubmenu(ordersSubmenu, ordersArrow);
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

    function closeSidebar(){
        sidebarStatus = sidebar.classList.contains('active');
        invStatus = inventorySubmenu.classList.contains('show');
        usersStatus = usersSubmenu.classList.contains('show');
        customersStatus = customersSubmenu.classList.contains('show');
        ordersStatus = ordersSubmenu.classList.contains('show');

        if(invStatus){
            isSubmenuOpen(inventorySubmenu, invStatus, invArrow);
        }
        if(usersStatus){
            isSubmenuOpen(usersSubmenu, usersStatus, usersArrow);
        }
        if(customersStatus){
            isSubmenuOpen(customersSubmenu, customersStatus, customersArrow);
        }
        if(ordersStatus){
            isSubmenuOpen(ordersSubmenu, ordersStatus, ordersArrow);
        }
    }

    function isSubmenuOpen(submenu, submenuStatus, arrow) {
        if(sidebarStatus === false && submenuStatus === true) {
            submenu.classList.toggle("show");
            arrow.classList.toggle("active");
        }
    }

    function closeSubmenu(submenu) {
        usersStatus = usersSubmenu.classList.contains('show');
        invStatus = inventorySubmenu.classList.contains('show');
        customersStatus = customersSubmenu.classList.contains('show');
        ordersStatus = ordersSubmenu.classList.contains('show');

        if(usersStatus == true  && submenu !== "users") {
            usersSubmenu.classList.toggle("show");
            usersArrow.classList.toggle("active");
        }
        if(customersStatus == true && submenu !== "customers") {
            customersSubmenu.classList.toggle("show");
            customersArrow.classList.toggle("active");
        }
        if(invStatus == true  && submenu !== "inventory") {
            inventorySubmenu.classList.toggle("show");
            invArrow.classList.toggle("active");
        }      
        if(ordersStatus == true  && submenu !== "orders") {
            ordersSubmenu.classList.toggle("show");
            ordersArrow.classList.toggle("active");
        }
    }
//// popup window
// settings window
const closeButtonS = document.querySelector(".closeBtnModalS")
const modalS = document.querySelector(".settingsModal")
const openButtonS = document.querySelector(".openModalS")
openButtonS.addEventListener("click", () => {
    modalS.showModal()
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