<dialog class="deleteModal modal">
    <div class="modalHeader">
        <h1>Delete</h1>
        <i class='bx bx-x closeBtnModalD modalX'></i>
    </div>
    <div class="modalContent DelModal">
        <form action="{{$action}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="logoutText">{{$slot}}</div>
            <div class="logoutButtons">
                <input type="hidden" id="item_id" name="row_delete_id">
                <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                <button id="deleteBtn" type="submit">Delete</button>
            </div>
        </form>
    </div>
</dialog>