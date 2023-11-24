<template>
    <li class="guest-list__text">
        {{ guest.surname }} {{ guest.name }} {{ guest.patronymic }}
    </li>
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
    display: flex;
    align-items: center;
    justify-content: space-between;
}
</style>
