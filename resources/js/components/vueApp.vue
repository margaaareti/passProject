<template>
    <div class>

        <my-dialog v-model:show="dialogVisible">
            <post-form
                @createGuest="createGuest"
            />
            <my-button @click="closeDialog" class="btn">Закрыть</my-button>
        </my-dialog>

        <guest-list
            v-bind:guests="guests"
            @remove="removeGuest"
            v-if="!isPostsLoading"
        />

        <div v-else>Загрузка</div>

        <my-button
            class="btn"
            @click="showDialog"
        >
            Создать пользователя
        </my-button>
    </div>
</template>

<script>

import PostForm from "./UI/GuestForm.vue";
import GuestList from "./UI/GuestList.vue";
import axios from "axios";

export default {
    name: "vue-app",
    components: {
        PostForm, GuestList
    },

    data() {
        return {
            guests: [],
            dialogVisible: false,
            isPostsLoading: false,
            applicationId: null,
        }
    },

    methods: {
        createGuest(guest) {
            this.guests.push(guest)
        },
        removeGuest(guest) {
            this.guests = this.guests.filter(g => g.id !== guest.id)
        },
        showDialog() {
            this.dialogVisible = true;
        },
        closeDialog() {
            this.dialogVisible = false;
        },
        async fetchGuests() {
            try {
                this.isPostsLoading = true
                const response = await axios.get(`/api/test/${this.applicationId}`);
                console.log(response)
                this.guests = response.data.map(guest => (typeof guest === 'string' ? JSON.parse(guest) : guest));
                this.isPostsLoading = false
            } catch (e) {
                console.error("Ошибка:", e)
                alert('ошибка', e)
            } finally {

            }
        }
    },

    mounted() {
        this.applicationId = this.$el.dataset.applicationId;
        console.log(this.applicationId)
        this.fetchGuests();
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
