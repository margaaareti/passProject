<template>
    <div id="111">
        <button class="card-body_button" @click="$emit('click')">
            dfsgdfgdfgdfgdfgdfgdfgfgd
            <slot></slot>
        </button>
    </div>
</template>

<script>
export default {
    name: "exampleComponent",
    methods: {
        handleClick(){
            alert('Кнопка была нажата')
        }
    }
}
</script>

<style scoped>
</style>

