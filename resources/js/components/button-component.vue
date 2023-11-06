<template>
    <div id="111">
        <button class="card-body_button" @click="handleClick">
            Кнопка
        </button>
    </div>
</template>

<script>
export default {
    name: "App",
    methods: {
        handleClick(){
            alert('Кнопка была нажата')
        }
    }
}
</script>

<style scoped>
</style>

