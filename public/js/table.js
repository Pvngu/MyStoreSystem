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
