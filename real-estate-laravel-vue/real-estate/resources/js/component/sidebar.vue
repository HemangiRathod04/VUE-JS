<!-- Sidebar.vue -->
<template>
    <div class="sidebar">
      <div class="logo">Real-estate</div>
      <ul class="menu">
        <router-link to="/dashboard" class="menu-item">Dashboard</router-link>
        <router-link to="/roles" v-if="canAccessRoleManagement" class="menu-item">Role Management</router-link>
        <router-link to="/users" class="menu-item">User Management</router-link>
        <router-link to="/submitproperty" class="menu-item">Submit Property</router-link>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data(){
      return{
        userRole: 1,
      };
    },
    computed:{
      canAccessRoleManagement(){
        return this.userRole == 1 || this.userRole == 2;
      },
    },
    created(){

    },
  };
  </script>

<style scoped>

.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #0056b3; 
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); 
  }
  
  .logo {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 40px;
    text-transform: uppercase;
    letter-spacing: 2px; 
  }
  
  .menu {
    width: 100%;
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .menu-item {
    display: block;
    width: 100%;
    padding: 15px 20px;
    text-align: left;
    cursor: pointer;
    text-decoration: none;
    color: white;
    font-size: 18px;
    transition: background-color 0.3s ease, padding-left 0.3s ease; 
    margin-bottom: 5px; 
  }
    
  .menu-item:hover {
    background-color: #003f7f; 
    border-left: 4px solid #ffc107;
    padding-left: 24px; 
  }
  
  .menu-item:active {
    background-color: #004b9a; 
  }
</style>