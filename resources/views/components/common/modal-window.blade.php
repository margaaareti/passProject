<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Заголовок модального окна</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleSelect" class="form-label">Выберите что-то</label>
                        <select class="form-select" id="exampleSelect">
                            <option value="" disabled selected>Выберите тип заявки</option>
                            <option class="form-select__option"
                                    value="Guests" {{old('selected_form') === 'Guests' ? 'selected' : ''}}>Приглашение
                                посетителей
                            </option>
                            <option class="form-select__option"
                                    value="Car" {{old('selected_form') === 'Car' ? 'selected' : ''}}>Въезд автотранспорта
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>


