<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content select-modal-content">
            <div class="modal-header select-modal-header">
                <h1 class="modal-title select-modal-title fs-5" id="exampleModalLabel">Тип заявки</h1>
                <button type="button" class="select-btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
{{--                    <span aria-hidden="true">&times;</span>--}}
                    <span aria-hidden="true"> Закрыть <img style="width: 50px; height: 40px" src="https://i.gifer.com/H0tN.gif" alt=""></span>
                </button>
            </div>
            <div class="modal-body select-modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleSelect" class="form-label">Выберите тип заявки</label>
                            <select class="form-select application-select" id="exampleSelect">
                                <option value="" disabled selected>Выберите тип заявки</option>
                                <option class="form-select__option"  style="background-color: #fff; color: #000;"
                                        value="Guests" {{old('selected_form') === 'Guests' ? 'selected' : ''}}>Приглашение
                                    посетителей
                                </option>
                                <option class="form-select__option"
                                        value="Car" {{old('selected_form') === 'Car' ? 'selected' : ''}}>Въезд автотранспорта
                                </option>
                                <option class="form-select__option"
                                        value="Property" {{old('selected_form') === 'Property' ? 'selected' : ''}}>Внос-Вынос имущества/оборудования
                                </option>
                            </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary app-choice-btn" data-bs-dismiss="modal">Применить</button>
            </div>
        </div>
    </div>
</div>




