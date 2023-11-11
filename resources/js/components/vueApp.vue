<template>
    <div class="modalWindow">
        <form action="#">
            <input v-bind:value="surname"
                   @input="surname = $event.target.value"
                   class="input"
                   type="text"
                   placeholder="Фамилия"
            >
            <input
                v-bind:value="name"
                @input="name = $event.target.value"
                class="input"
                type="text"
                placeholder="Имя"
            >
            <input v-bind:value="patronymic"
                   @input="patronymic= $event.target.value"
                   class="input"
                   type="text"
                   placeholder="Отчество"
            >
            <div class="guests" v-for="guest in guests">
                <div><strong>ФИО: {{guest.surname}} {{guest.name}} {{guest.patronymic}}</strong></div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            guests: [{surname: 'Ан', name: 'Владислав', patronymic: 'Вадимович'}],
            name: '',
            surname: '',
            patronymic: '',
        }
    },

    methods: {
        inputName(event) {
        },
        inputSurname(event) {

        },
        inputPatronymic(event) {

        }
    }
}
</script>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

</style>
