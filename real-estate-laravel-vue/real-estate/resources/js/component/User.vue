<template>
    <div class="app-container">
      <Sidebar />
      <div class="main-content">
        <Header />
        <div class="dashboard-card">
          <div class="button-group">
            <!-- <button class="btn btn-primary" @click="updatePermissions">Add User</button> -->
            <router-link to="/user/add" class="btn btn-primary">Add User</router-link>
          </div>
           <table class="table table-striped"> 
             <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>
             </thead>
             <tbody>
                <tr v-for="(user,index) in users" :key="user.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.roles.name}}</td>
                    <td>
                    <i class="fas fa-edit icon-action" @click="editRecord(role)"></i> 
                    <i class="fas fa-trash icon-action" @click="deleteRecord(role.id)"></i> 
                    </td>
                </tr>
             </tbody>
           </table>
        </div>
      </div>
    </div>
  </template>

<script>
import Sidebar from './sidebar.vue';
import Header from './header.vue';
import axios  from 'axios';
export default {
    components:{
    Sidebar,
    Header,
   },
   data(){
    return{
        users:[],
    }
   },
   mounted(){
    this.fetchUsers();
   },
   methods:{
    async fetchUsers(){
        const token = localStorage.getItem('auth_token');
        if(token){
            try{
                const response =await axios.get('/api/auth/user/index',{
                    headers:{
                        Authorization: `Bearer ${token}`
                    }
                });
                this.users=response.data.users;
                console.log(this.users);
            }catch(error)
            {
                console.error('There was an error fetching the users!', error);
                if (error.response && error.response.status === 401) {
                alert('Your session has expired. Please login again.');
                localStorage.removeItem('auth_token');
                this.$router.push({ name: 'Login' });
                } else {
                alert('An error occurred while fetching users.');
                } 
            }
        }
        else{
            alert('Authentication token not found. Please login again.');
            this.$router.push({ name: 'Login' });
        }
    },
   }
}
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
  .table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
  }
  .table th, .table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
  }
  .button-group {
    margin-bottom: 20px;
    text-align: right;
  }
</style>