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