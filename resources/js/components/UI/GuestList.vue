<template>
    <div v-if="guests.length > 0">
        <h3>Список гостей</h3>
        <guest-item
            v-for="guest in guests"
            :guest="guest"
            :key="guest.id"
            @remove="$emit('remove',guest)"
        />
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
            required:true,
        }
    }
}

</script>

<style lang="scss" scoped>

</style>
