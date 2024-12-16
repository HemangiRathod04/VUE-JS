<template>
    <div class="app-container">
      <Sidebar />
      <div class="main-content">
        <Header />
        <div class="dashboard-card">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col" colspan="5">Role Name</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
            <tr v-for="(role, index) in roles" :key="role.id">
              <th scope="row">{{ index + 1 }}</th>
              <td colspan="5">
                  <router-link :to="`/role/show/${role.id}/permissions`">
                  {{ role.name }}
                  </router-link>
              </td>
              <td>
                <i class="fas fa-edit icon-action" @click="editRecord(role)"></i> 
                <i class="fas fa-trash icon-action" @click="deleteRecord(role.id)"></i> 
              </td>
            </tr>
                </tbody>
            </table>
        </div>

         <!-- Modal for editing role name -->
      <div v-if="showModal" class="modal">
        <div class="modal-content">
          <span class="close" @click="closeModal">&times;</span>
          <h2>Edit Role Name</h2>
          <input type="text" v-model="selectedRole.name" />
            <button class="btn-save" @click="saveRole">Save</button>
        </div>
      </div>
      </div>
    </div>
  </template>

<script>
 import Sidebar from './sidebar.vue';
 import Header from './Header.vue'; 
 import axios from 'axios';

 export default {
    components:{
      Sidebar,
      Header 
    },
    data(){
        return{
            roles:[],
            showModal: false,
            selectedRole: null,
        }
    },
    mounted(){
        this.fetchRoles();
    },
    methods: {
        async fetchRoles() {
            const token = localStorage.getItem('auth_token');
            if (token) {
            try {
                const response = await axios.get('/api/auth/roles', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
                });
                this.roles = response.data.roles;
            } catch (error) {
                console.error('There was an error fetching the roles!', error);
                if (error.response && error.response.status === 401) {
                alert('Your session has expired. Please login again.');
                localStorage.removeItem('auth_token');
                this.$router.push({ name: 'Login' });
                } else {
                alert('An error occurred while fetching roles.');
                }
            }
            } else {
            alert('Authentication token not found. Please login again.');
            this.$router.push({ name: 'Login' });
            }
        },
        async saveRole(){
          const token = localStorage.getItem('auth_token');
          if (token && this.selectedRole) {
            try {
          await axios.post(`/api/auth/role/${this.selectedRole.id}`, this.selectedRole, {
            headers: {  
              Authorization: `Bearer ${token}`,
              'Content-Type': 'application/json'
            }
          });
          this.fetchRoles(); 
          this.closeModal(); 
          } catch (error) {
            console.error('There was an error saving the role!', error);
            alert('An error occurred while saving the role.');
          }
          }
        },
        editRecord(role) {
        this.selectedRole = { ...role }; 
        this.showModal = true;
        },
      closeModal() {
        this.showModal = false;
        this.selectedRole = null;
      },
    }
 }

</script>

<style scoped>
.icon-action{
padding: 3px;
}
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
  padding: 20px;
  border-radius: 6px;
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
.table {
  margin-top: 20px;
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7); 
  z-index: 1000; 
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 10px; 
  width: 400px; 
  max-width: 90%; 
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  position: relative;
  text-align: center;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 18px;
  color: #333; 
  transition: color 0.3s; 
}

.close:hover {
  color: #ff0000;
}

.modal h2 {
  font-size: 20px;
  margin-bottom: 20px;
  color: #0056b3;
}

.modal input[type="text"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

.modal button {
  padding: 10px 20px;
  background-color: #0056b3;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}
.modal button:hover {
  background-color: #004494;
}

</style>

