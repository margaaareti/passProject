<template>

    <div class="card-body__guest-block" v-if="guests.length > 0">
        <p><strong> Количество лиц, указанных в заявке: {{ guests.length }} </strong></p>
        <ul class="card-body__list guest-list">
            <transition-group name="guest_list">
                <guest-item
                    v-for="guest in guests"
                    :guest="guest"
                    :key="guest.id"
                    @remove="$emit('remove',guest)"
                />
            </transition-group>
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

.guest_list {
    display: inline-block;
    margin-right: 10px;
}

.guest_list-enter-active,
.guest_list-leave-active {
    transition: all 1s ease;
}

.guest_list-enter-from,
.guest_list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}


</style>
