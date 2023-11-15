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
        />

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
import MyDialog from "@/components/UiElements/MyDialog.vue";
import MyButton from "@/components/UiElements/MyButton.vue";

export default {
    name: "vue-app",
    components: {
        MyButton,
        MyDialog,
        PostForm, GuestList
    },

    data() {
        return {
            guests: [
            ],
            dialogVisible: false,
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
        closeDialog(){
            this.dialogVisible = false;
        },
        fetchUsers(){

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
