<template>
    <div v-if="userRoleId===4">
        <h1>Hello, {{  userName }}</h1>
    </div>
</template>

<script>
export default{
    props:{
        userName:{
            type: String,
            required: true,
        },
        userRoleId: {
            type: Number,
            required: true,
        },
    },
}
</script>

<style scoped>
h2{
    color: #333;
}
</style>