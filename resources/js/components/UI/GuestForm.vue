<template>
    <form @submit.prevent action="#">
        <my-input
            v-model.trim="guest.surname"
            type="text"
            class="add-guest_input"
            placeholder="Фамилия"
            @input="handleInput('surname')"
            @blur="handleBlur('surname')"
            :class="{ 'error': !v$.guest.surname.$pending && v$.guest.surname.$error }"
        />
        <span v-if="!v$.guest.surname.$pending && v$.guest.surname.$error"
              class="error-message">Фамилия обязательна</span>


        <my-input
            v-model.trim="guest.name"
            type="text"
            class="add-guest_input"
            placeholder="Имя"
            @input="handleInput('name')"
            @blur="handleBlur('name')"
            :class="{ 'error': !v$.guest.name.$pending && v$.guest.name.$error }"
        />
        <span v-if="!v$.guest.name.$pending && v$.guest.name.$error" class="error-message">Имя обязательно</span>

        <my-input
            v-model.trim="guest.patronymic"
            type="text"
            class="add-guest_input"
            placeholder="Отчество"
            @input="handleInput('patronymic')"
            @blur="handleBlur('patronymic')"
            :class="{ 'error': !v$.guest.patronymic.$pending && v$.guest.patronymic.$error }"
        />
        <span v-if="!v$.guest.patronymic.$pending && v$.guest.patronymic.$error" class="error-message">Отчество обязательно</span>

        <my-button class="btn add_guest" @click="createGuest">
            Добавить гостя
        </my-button>
    </form>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required} from '@vuelidate/validators'
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
            }
        }
    },

    validations() {
        return {
            guest: {
                name: {required},
                surname: {required},
                patronymic: {required},
            },
        };
    },

    methods: {
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
            }
        },

        handleBlur(field) {
            if (this.v$[field]) {
                // Сбросить ошибку при вводе
                this.v$[field].$reset();
            }
        },
        handleInput(field) {
            if (this.v$[field]) {
                this.v$[field].$touch();
            }
        }
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
</style>




