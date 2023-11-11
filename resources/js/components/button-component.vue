<template>
    <div id="111">
        <button class="card-body_button" @click="handleClick">
            Кнопка
        </button>
    </div>
</template>

<script>
export default {
    name: "button-component",
    methods: {
        handleClick(){
            alert('Кнопка была нажата')
        }
    }
}
</script>

<style scoped>
button {
    background-color: #007bff;
    color: #fff;
    border: none;    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
}
</style>

