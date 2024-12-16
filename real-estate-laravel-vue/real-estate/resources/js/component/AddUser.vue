<template>
    <div class="app-container">
      <Sidebar />
      <div class="main-content">
        <Header />
        <div class="dashboard-card">
          <h2>Add New User</h2>
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" v-model="user.name"/>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" v-model="user.email"/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" v-model="user.password" />
            </div>

            <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input
              type="password"
              id="confirmPassword"
              v-model="user.confirmPassword"
              placeholder="Confirm your password"
              @blur="validatePasswordConfirm"
            />
            <span v-if="passwordMismatch" class="error-message">
              Passwords do not match!
            </span>
          </div>

            <div class="form-group">
              <label for="role">Role</label>
              <select id="role" v-model="user.role">
                <option value="" disabled>Select a role</option>
                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
              </select>
            </div>

            <div class="button-group">
              <button type="submit" class="btn btn-primary">Add User</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import Header from './header.vue';
  import Sidebar from './sidebar.vue';
  import axios from 'axios';
  
  export default {
    components: {
      Sidebar,
      Header,
    },
    data() {
      return {
        user: {
          name: '',
          email: '',
          password: '',
          confirmPassword: '',
          role: '',
        },
        confirmPassword: '',
        roles: [],
        passwordMismatch: false,
      };
    },
    mounted() {
      this.fetchRoles();
    },
    methods: {
      async fetchRoles() {
        const token = localStorage.getItem('auth_token');
        if(token){
        try {
          const response = await axios.get('/api/auth/roles',{
            headers:{
                Authorization:`Bearer ${token}`
            }
          });
          this.roles = response.data.roles;
        } catch (error) {
          console.error('There was an error fetching the roles!', error);
          alert('An error occurred while fetching roles.');
        }
       }
       else{
            alert('Authentication token not found. Please login again.');
            this.$router.push({ name: 'Login' });
        }
      },
    
      async submitForm() {
        if (this.user.password !== this.user.confirmPassword) {
        this.passwordMismatch = true; 
        return;
        }
        this.passwordMismatch = false; 

        const token = localStorage.getItem('auth_token');
        if (token) {
          try {
            await axios.post('/api/register', this.user, {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            });
            alert('User added successfully!');
            this.$router.push({ name: 'Users' });
          } catch (error) {
            console.error('There was an error adding the user!', error);
            if (error.response && error.response.status === 401) {
              alert('Your session has expired. Please login again.');
              localStorage.removeItem('auth_token');
              this.$router.push({ name: 'Login' });
            } else {
              alert('An error occurred while adding the user.');
            }
          }
        } else {
          alert('Authentication token not found. Please login again.');
          this.$router.push({ name: 'Login' });
        }
      },
    },
  };
  </script>
  
  <style>
  .app-container {
    display: flex;
  }
  
  .main-content {
    margin-left: 250px;
    width: calc(100% - 250px);
  }
  
  .dashboard-card {
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  .button-group {
    margin-top: 20px;
    text-align: right;
  }
  </style>
  