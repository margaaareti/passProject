<template>
    <div class="">

        <my-dialog v-model:show="dialogVisible">
            <post-form
                @addGuest="addGuest"
            />
            <my-button @click="closeDialog" class="btn">Закрыть</my-button>
        </my-dialog>

        <div class="guest-block">
            <div>
                <guest-list
                    :guests="searchedGuests"
                    @remove="removeGuest"
                    v-if="!isPostsLoading"
                />

                <div v-else>
                    Загрузка
                </div>

            </div>

            <div>
                <input
                    type="text"
                    v-model="searchQuery"
                    class="search-field"
                >
            </div>

        </div>

        <my-button
            class="btn"
            @click="showDialog"
            v-if="buttonVisible"
        >
            + Добавить посетителя
        </my-button>

    </div>
</template>

<script>

import PostForm from "./UI/GuestForm.vue";
import GuestList from "./UI/GuestList.vue";
import axios from "axios";
import MyInput from "@/components/UiElements/MyInput.vue";

export default {
    name: "vue-app",
    components: {
        MyInput,
        PostForm,
        GuestList
    },

    data() {
        return {
            guests: [],
            dialogVisible: false,
            buttonVisible: true,
            isPostsLoading: false,
            applicationId: null,
            applicationCreated: null,
            selectedSort: '',
            searchQuery: '',
            sortOptions: [
                {value: 'name', name: 'По имени'},
                {value: 'surname', name: 'По фамилии'}
            ]
        }
    },

    mounted() {
        this.applicationId = this.$el.dataset.applicationId;
        this.applicationCreated = this.$el.dataset.applicationCreated;

        if (this.applicationCreated) {
            const nowDate = new Date(Date.now());
            const createdDate = new Date(this.applicationCreated + ' UTC'); // Добавляем 'UTC' к строке времени

            if ((nowDate - createdDate) > 12 * 60 * 60 * 1000) {
                this.buttonVisible = false;
            }
        }

        this.fetchGuests();

    },

    methods: {
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
                this.guests = response.data.map(guest => (typeof guest === 'string' ? JSON.parse(guest) : guest));
                this.isPostsLoading = false
            } catch (e) {
                console.error("Ошибка:", e)
                alert('ошибка', e)
            } finally {

            }
        },

        async addGuest(guest) {

            // if (!guest.name || !guest.surname) {
            //     alert('Пожалуйста, заполните все поля')
            //     return
            // }

            const fullName = `${guest.surname} ${guest.name} ${guest.patronymic}`

            try {
                const response = await axios.post(`/api/test/${this.applicationId}/add-guest`, {
                    fullName: fullName,
                });
                console.log(response)
                this.guests.push(response.data); // Предполагаем, что сервер вернет нового гостя
                // this.closeDialog();

            } catch (error) {
                console.error("Ошибка:", error);
                if (error.response && error.response.status === 500) {
                    alert('Произошла ошибка на сервере. Пожалуйста, попробуйте позже.');
                } else {
                    alert('Ошибка: ' + error.message);
                }
            }
        },
    },

    computed: {
        selectedGuests() {
            return [...this.guests].sort((guest1, guest2) => guest1[this.selectedSort]?.localeCompare(guest2[this.selectedSort()]))
        },
        searchedGuests() {
            return this.selectedGuests.filter(guest => guest.name && guest.name.includes(this.searchQuery))
        }
    },

}
</script>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.guest-block {
    display: flex;

    .search-field {
        max-width: 200px;
        max-height: 200px;
        padding: 0;
        margin-left: 20px ;
    }
}

</style>
