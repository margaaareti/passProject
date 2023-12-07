<template>
    <form ref="guestForm" @submit.prevent action="#">
        <my-input
            name="surname"
            v-model.trim="guest.surname"
            type="text"
            class="add-guest_input"
            placeholder="Фамилия"
            @input="handleInput('surname')"
            @blur="handleBlur('surname')"
            @focus="onInputFocus"
            :value="capitalizeFirstLetter(guest.surname)"
            :class="{ 'error': !v$.guest.surname.$pending && v$.guest.surname.$error && !v$.guest.surname.$error.minLength }"
        />

        <p
            v-for="error of v$.guest.surname.$errors"
            :key="error.$uid"
        >
            <strong>{{ error.$message }}</strong>
        </p>

        <my-input
            v-model.trim="guest.name"
            type="text"
            class="add-guest_input"
            placeholder="Имя"
            @input="handleInput('name')"
            @blur="handleBlur('name')"
            :value="capitalizeFirstLetter(guest.name)"
            :class="{ 'error': !v$.guest.name.$pending && v$.guest.name.$error && !v$.guest.name.$error.minLength }"
        />

        <span
            v-if="!v$.guest.surname.$pending && v$.guest.surname.$error && (!v$.guest.surname.$error.minLength || !v$.guest.patronymic.forbidNumber)"
            class="error-message">Фамилия должна состоять из 2 и более символов, не содержать цифр и включать в себя тольк русские символы </span>

        <my-input
            v-model.trim="guest.patronymic"
            type="text"
            class="add-guest_input"
            placeholder="Отчество"
            @input="handleInput('patronymic')"
            @blur="handleBlur('patronymic')"
            :value="capitalizeFirstLetter(guest.patronymic)"
            :class="{ 'error': !v$.guest.patronymic.$pending && v$.guest.patronymic.$error && !v$.guest.patronymic.$error.minLength }"
        />
        <span
            v-if="!v$.guest.surname.$pending && v$.guest.surname.$error && (!v$.guest.surname.$error.minLength || !v$.guest.patronymic.forbidNumber)"
            class="error-message">Фамилия должна состоять из 2 и более символов, не содержать цифр и включать в себя тольк русские символы </span>

        <my-button class="btn add_guest" @click="createGuest">
            Добавить гостя
        </my-button>
    </form>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required,minLength} from '@vuelidate/validators'
import MyInput from "../UiElements/MyInput.vue";
import MyButton from "../UiElements/MyButton.vue";

export default {
    components: {MyButton, MyInput},
    data() {
        return {
            v$: useVuelidate(),
            guest: {
                name: "",
                surname: "",
                patronymic: "",
            },
        }
    },


    validations() {
        const forbidNumber = (value) => ({
            forbidNumber: /^[^0-9]+$/.test(value),
            message: 'Поле должно содержать только буквы',
        });

        const allowOnlyRussianLetters = (value) => ({
            allowOnlyRussianLetters: /^[а-яА-Я]+$/.test(value),
            message: 'Поле должно содержать только русские буквы',
        });

        return {
            guest: {
                name: {
                    required,
                    minLength: minLength(2),
                    forbidNumber,
                    allowOnlyRussianLetters,
                },
                surname: {
                    required,
                    minLength: minLength(2),
                    forbidNumber,
                    allowOnlyRussianLetters,
                },
                patronymic: {
                    required,
                    minLength: minLength(2),
                    forbidNumber,
                    allowOnlyRussianLetters,
                },
            },
        };
    },

    methods: {
        capitalizeFirstLetter(value) {
            return value.charAt(0).toUpperCase() + value.slice(1);
        },

        createGuest() {
            this.v$.$validate();

            if (!this.v$.$pending && !this.v$.$error) {
                console.log('Успешно');

                this.guest.id = Date.now();
                this.$emit('addGuest', this.guest)
                this.guest = {
                    name: "",
                    surname: "",
                    patronymic: "",
                }

                this.v$.$reset();

                const nameInput = this.$refs.guestForm.querySelector('[name="surname"]');
                if (nameInput) {
                    nameInput.focus();
                }

            }
        },

        handleBlur(field) {
            if (this.v$[field]) {
                // Сбросить ошибку при вводе
                this.v$[field].$reset();
            }
            this.isInputFocused = false;
        },
        handleInput(field) {
            if (this.v$[field]) {
                this.v$[field].$touch();
            }
        },
        onInputFocus() {
            this.isInputFocused = true;
        },

    }
}
</script>

<style lang="scss" scoped>
form {
    display: flex;
    flex-direction: column;
}

.add_guest {
    margin-top: 10px;
    margin-bottom: 10px;
}


.error {
    border-color: red;
    border-width: 1px;
    animation: shake 0.5s; /* Добавляем анимацию тряски */
}

@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-10px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(10px);
    }
}

.error-message {
    color: red;
    display: block;
    margin-top: 5px;
    font-size: 12px;
}

label {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    transition: 0.2s ease all;
}

input {
    padding: 20px; /* или любая другая высота */
}

.active {
    transform: translateY(-20px); /* или любая другая высота */
    font-size: 14px; /* или любой другой размер шрифта */
}

</style>




