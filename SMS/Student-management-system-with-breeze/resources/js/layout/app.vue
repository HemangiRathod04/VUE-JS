<template>
    <div class="app-container">
        <navbar-component></navbar-component>
        <div class="content-container">
            <sidebar-component></sidebar-component>
            <div class="main-content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>


<script>

import SideBarComponent from '../components/SideBarComponent.vue';
import NavBarComponent from '../components/NavBarComponent.vue';

export default{
components:{
    SideBarComponent,
    NavBarComponent
}
}
</script>


<style scoped>
.app-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.content-container {
    display: flex;
    flex: 1;
}

.sidebar-component {
    width: 250px; /* Adjust the width as needed */
    background-color: #f8f9fa; /* Optional: change background color */
}

.main-content {
    flex: 1;
    padding: 20px; /* Adjust padding as needed */
    overflow-y: auto;
}
</style>
