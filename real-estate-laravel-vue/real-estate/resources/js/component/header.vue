<template>
    <div class="header">
          <div class="header-left">
            <h1>Real Estate Management</h1>
          </div>
          <div class="header-right">
            <div class="profile-menu">
              <span class="profile-name">John Doe</span>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item" @click="logout">Logout</a>
              </div>
            </div>
          </div>
        </div>
</template>

<script>
import axios from 'axios';

export default{
methods:{
  async logout(){
    const token = localStorage.getItem('auth_token');
    if (token) {
        try {
          await axios.post('/api/auth/logout', {}, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          localStorage.removeItem('auth_token'); 
          this.$router.push({ name: 'Login' });
        } catch (error) {
          console.error('Error during logout:', error);
          alert('An error occurred during logout.');
        }
      } else {
        alert('No authentication token found.');
        this.$router.push({ name: 'Login' });
      }
  }
},
mounted() {
            console.log('Component mounted.')
        }
}
</script>

<style>
 .header-left h1 {
    margin: 0;
    font-size: 24px;
  }
  
  .header-right{
    display: flex;
    align-items: center;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0056b3; 
    color: white;
    padding: 15px 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    margin-bottom: 10px;
  }

  .profile-menu {
    position: relative;
  }
  
  .profile-name {
    cursor: pointer;
    font-size: 18px;
    color: white;
  }

  
  
  .dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    color: black;
    width: 150px;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: none; /* Initially hide the dropdown */
    flex-direction: column;
  }
  
  .profile-menu:hover .dropdown-menu {
    display: flex;
  }
  
  .dropdown-item {
    padding: 10px;
    text-decoration: none;
    color: black;
    transition: background-color 0.3s ease;
  }
  .dropdown-item:hover {
    background-color: #f1f1f1;
  }
 
</style>