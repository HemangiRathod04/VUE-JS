<template>
    <div class="app-container">
      <Sidebar />
      <div class="main-content">
        <Header />
        <div class="dashboard-card">
          <h2>Welcome to the Dashboard</h2>
          <p>This is your dashboard where you can manage your real estate properties and roles.</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import Sidebar from './sidebar.vue';
  import Header from './Header.vue'; 
  import axios from 'axios';

  export default {
    name: 'Dashboard',
    components:{
      Sidebar,
      Header 
    },
    methods:{
    // async logout(){
    //   try{
    //     const response =await axios.post('api/auth/logout');
    //     if (response.status === 200) {
    //       alert('You have successfully logged out.'); 
    //       this.$router.push({ name: 'Login' });
    //     } else {
    //       alert('Unexpected response, please try again.');
    //     }
    //   }catch(error){
    //     console.log('Lougout failed ',error);
    //     alert('there was issue in log out , please try again latter');
    //   }
    // }
  }
  };
  </script>

  <style scoped>
  body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa; 
  }
  .app-container {
    display: flex;
  }
  .main-content {
    margin-left: 250px; 
    width: calc(100% - 250px);
  }
  .dashboard-card {
    background-color: rgb(175, 179, 182);
    padding: 20px;
    width: 20%;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  .dashboard-card h2 {
    margin-top: 0;
    font-size: 24px;
    color: #0056b3;
  }
  .dashboard-card p {
    margin: 10px 0 0;
    font-size: 16px;
    color: #333;
  }
  </style>
  
  