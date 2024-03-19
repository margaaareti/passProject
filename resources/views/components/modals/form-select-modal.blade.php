<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content select-modal-content">
            <div class="modal-header select-modal-header">
                <h1 class="modal-title select-modal-title fs-5" id="exampleModalLabel">Тип заявки</h1>
                <button type="button" class="select-btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
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


<div class="checkbox-wrapper-29">
    <label class="checkbox">
        <input type="checkbox" class="checkbox__input" />
        <span class="checkbox__label"></span>
        Checkbox
    </label>
</div>

<style>
    .checkbox-wrapper-29 {
        --size: 1rem;
        --background: #fff;
        font-size: var(--size);
    }

    .checkbox-wrapper-29 *,
    .checkbox-wrapper-29 *::after,
    .checkbox-wrapper-29 *::before {
        box-sizing: border-box;
    }

    .checkbox-wrapper-29 input[type="checkbox"] {
        visibility: hidden;
        display: none;
    }

    .checkbox-wrapper-29 .checkbox__label {
        width: var(--size);
    }

    .checkbox-wrapper-29 .checkbox__label:before {
        content: ' ';
        display: block;
        height: var(--size);
        width: var(--size);
        position: absolute;
        top: calc(var(--size) * 0.125);
        left: 0;
        background: var(--background);
    }

    .checkbox-wrapper-29 .checkbox__label:after {
        content: ' ';
        display: block;
        height: var(--size);
        width: var(--size);
        border: calc(var(--size) * .14) solid #000;
        transition: 200ms;
        position: absolute;
        top: calc(var(--size) * 0.125);
        left: 0;
        background: var(--background);
    }

    .checkbox-wrapper-29 .checkbox__label:after {
        transition: 100ms ease-in-out;
    }

    .checkbox-wrapper-29 .checkbox__input:checked ~ .checkbox__label:after {
        border-top-style: none;
        border-right-style: none;
        -ms-transform: rotate(-45deg); /* IE9 */
        transform: rotate(-45deg);
        height: calc(var(--size) * .5);
        border-color: green;
    }

    .checkbox-wrapper-29 .checkbox {
        position: relative;
        display: flex;
        cursor: pointer;
        /* Mobile Safari: */
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }

    .checkbox-wrapper-29 .checkbox__label:after:hover,
    .checkbox-wrapper-29 .checkbox__label:after:active {
        border-color: green;
    }

    .checkbox-wrapper-29 .checkbox__label {
        margin-right: calc(var(--size) * 0.45);
    }
</style>
<div class="checkbox-wrapper-29">
    <label class="checkbox">
        <input type="checkbox" class="checkbox__input" />
        <span class="checkbox__label"></span>
        Checkbox
    </label>
</div>

<style>
    .checkbox-wrapper-29 {
        --size: 1rem;
        --background: #fff;
        font-size: var(--size);
    }

    .checkbox-wrapper-29 *,
    .checkbox-wrapper-29 *::after,
    .checkbox-wrapper-29 *::before {
        box-sizing: border-box;
    }

    .checkbox-wrapper-29 input[type="checkbox"] {
        visibility: hidden;
        display: none;
    }

    .checkbox-wrapper-29 .checkbox__label {
        width: var(--size);
    }

    .checkbox-wrapper-29 .checkbox__label:before {
        content: ' ';
        display: block;
        height: var(--size);
        width: var(--size);
        position: absolute;
        top: calc(var(--size) * 0.125);
        left: 0;
        background: var(--background);
    }

    .checkbox-wrapper-29 .checkbox__label:after {
        content: ' ';
        display: block;
        height: var(--size);
        width: var(--size);
        border: calc(var(--size) * .14) solid #000;
        transition: 200ms;
        position: absolute;
        top: calc(var(--size) * 0.125);
        left: 0;
        background: var(--background);
    }

    .checkbox-wrapper-29 .checkbox__label:after {
        transition: 100ms ease-in-out;
    }

    .checkbox-wrapper-29 .checkbox__input:checked ~ .checkbox__label:after {
        border-top-style: none;
        border-right-style: none;
        -ms-transform: rotate(-45deg); /* IE9 */
        transform: rotate(-45deg);
        height: calc(var(--size) * .5);
        border-color: green;
    }

    .checkbox-wrapper-29 .checkbox {
        position: relative;
        display: flex;
        cursor: pointer;
        /* Mobile Safari: */
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }

    .checkbox-wrapper-29 .checkbox__label:after:hover,
    .checkbox-wrapper-29 .checkbox__label:after:active {
        border-color: green;
    }

    .checkbox-wrapper-29 .checkbox__label {
        margin-right: calc(var(--size) * 0.45);
    }
</style>


