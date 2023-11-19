<template>

    <div class="card-body__guest-block" v-if="guests.length > 0">
        <p> <strong> Количество лиц, указанных в заявке: {{guests.length}} </strong></p>
        <ul class="card-body__list guest-list">
                <guest-item
                    v-for="guest in guests"
                    :guest="guest"
                    :key="guest.id"
                    @remove="$emit('remove',guest)"
                />
        </ul>
    </div>

    <h2 v-else>
        Список пользователей пуст
    </h2>

</template>

<script>
import GuestItem from "./GuestItem.vue";

export default {
    components: {GuestItem},
    props: {
        guests: {
            type: Array,
            required: true,
        }
    }
}

</script>

<style lang="scss" scoped>

</style>
