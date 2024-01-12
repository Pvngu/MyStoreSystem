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