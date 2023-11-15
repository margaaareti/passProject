<template>
    <form @submit.prevent action="#">
        <my-input
            v-model="guest.surname"
            type="text"
            placeholder="Фамилия"
        />
        <my-input
            v-model="guest.name"
            type="text"
            placeholder="Имя"
        />
        <my-input v-model="guest.patronymic"
               type="text"
               placeholder="Отчество"
        />
        <my-button
            class="btn add_guest"
            @click="createGuest"
        >
            Добавить гостя
        </my-button>
    </form>
</template>

<script>

export default {

    data() {
        return {
            guest: {
                name: "",
                surname: "",
                patronymic: "",
            }
        }
    },

    methods: {
        createGuest() {
            this.guest.id = Date.now();
            this.$emit('createGuest', this.guest)
            this.guest = {
                name: "",
                surname: "",
                patronymic: "",
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

.add_guest{
    margin-top: 10px;
    margin-bottom: 10px;
}

</style>
