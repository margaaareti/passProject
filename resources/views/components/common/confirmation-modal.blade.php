<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d-flex flex-column">
                <div class="modal-header mb-1">
                    <h4 class="modal-title" id="exampleModalLabel">Проверьте правильность введенных
                        данных</h4>
                </div>
                <div>
                    <h5 class="modal-title" id="applicationType"></h5>
                </div>
            </div>
            <div class="modal-body">
                <div id="modalData"></div>
            </div>
            <div class="modal-footer">
                <x-button data-bs-dismiss="modal">Закрыть</x-button>
                <x-button id="confirmButton">Подтвердить</x-button>
            </div>
        </div>
    </div>
</div>


