// delete popup
const closeButtonD = document.querySelectorAll(".closeBtnModalD")
const modalD = document.querySelector(".deleteModal")
const openButtonD = document.querySelector(".openModalD")

for(i = 0; i < closeButtonD.length; i++){
    closeButtonD[i].addEventListener("click", () => {
    modalD.close();
})
}

$(document).ready(function () {
    $('.openModalD').click(function (e) {
        e.preventDefault();

        var item_id = $(this).data('item-id');
        $('#item_id').val(item_id);
        modalD.showModal();
    });
});

const submitForm = document.getElementById('submitForm');
const sort_order = document.getElementById('sort_order');
const sort_column = document.getElementById('sort_column');
var columnIds = [];

document.querySelectorAll('.table-head').forEach((e) => {
    columnIds.push(e.getAttribute('id'));
});

columnIds.forEach((name) => {
    const element = document.getElementById(name);
    element.addEventListener('click', () => {
        sortBy(name);
    });
});

function sortBy(name){
    if(sort_column.value !== name){
        sort_order.value = 'A';
    }
    else {
        sort_order.value = (sort_order.value === 'A') ? 'D' : 'A';
    }
    sort_column.value = name;
    submitForm.submit();
}

var checkboxes = document.querySelectorAll('.checkboxIds');

function countCheckbox() {
    var checkedCount = 0;
    var nav = document.querySelector('.deleteItemsNav');

    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkedCount++;
        }
    });

    if(checkedCount !== 0) {
        nav.classList.add('active');
    }
    else {
        nav.classList.remove('active');
    }

    document.getElementById('count').innerText = 'items selected: ' + checkedCount;
}

document.addEventListener('change', countCheckbox);

function checkAllcheckboxes() {
    var checkAll = document.getElementById('checkAll');
    var checkboxes = document.querySelectorAll('.checkboxIds');
    for(var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = checkAll.checked;
    }
}

function submitIdsForm() {
    document.getElementById('deleteIdsForm').submit();
}