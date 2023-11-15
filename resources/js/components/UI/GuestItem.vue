<template>
    <div class="guests">
        <div>
            <div><strong>ФИО: {{ guest.surname }} {{ guest.name }} {{ guest.patronymic }}</strong></div>
        </div>
        <div class="post__btns">
            <my-button
                class="btn"
                @click="$emit('remove',guest)"
            >
                Удалить
            </my-button>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        guest: {
            type: Object,
            required: true,
        }
    }
}
</script>

<style scoped>

.guests {
    padding: 15px;
    border: 2px solid teal;
    margin-top: 15px;
    display:flex;
    align-items: center;
    justify-content: space-between;
}
</style>
