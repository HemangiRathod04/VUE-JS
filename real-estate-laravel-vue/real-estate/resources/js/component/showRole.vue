<template>
    <div class="app-container">
      <Sidebar />
      <div class="main-content">
        <Header />
        <div class="dashboard-card">
          <div class="button-group">
            <button class="btn btn-secondary" @click="resetPermissions">Reset</button>
            <button class="btn btn-primary" @click="updatePermissions">Update</button>
          </div>
  
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Permissions For: {{ roleName }} </th>
                <th>
                  Check All
                  <label class="switch">
                    <input type="checkbox" v-model="checkAll" @change="toggleAllPermissions" />
                    <span class="slider"></span>
                  </label>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(permission, index) in permissions" :key="permission.id">
                <td>{{ permission.name }}</td>
                <td>
                  <label class="switch">
                    <input type="checkbox" v-model="permission.checked"  @change="updatePermission(permission)" />
                    <span class="slider"></span>
                  </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios, { Axios } from 'axios';
  import Sidebar from './sidebar.vue';
  import Header from './header.vue';
  
  export default {
    components: {
      Sidebar,
      Header,
    },
    data() {
      return {
        checkAll: false,
        modules: [],
        permissions:[],
        roleName: '',
        roleId: null,
      };
    },
    mounted(){
        this.fetchPermissions();
    },
    methods: {
      async fetchPermissions(){
            const token = localStorage.getItem('auth_token');
            const id = this.$route.params.id;
            this.roleId = id;
            if (token) {
                try{
                    const response = await axios.get(`/api/auth/role/show/${id}/permissions`,{
                        headers:{
                            Authorization:`Bearer ${token}`
                        }
                    });
                    this.permissions = response.data.permissions.map((permission) => ({
                      ...permission,
                      checked: permission.assigned,
                    }));
                    this.roleName = response.data.roleName;
                    console.log(this.permissions);

                }catch(error){
                    console.error('there was an error fetching the roles!',error);
                    if(error.response && error.response.status === 401 ){
                     alert('Your session has expired. Please login again.');
                     localStorage.removeItem('auth_token');
                     this.$router.push({name:'Login'});
                    }else{
                        alert('An error occurred while fetching roles.');
                    }
                }
            }
            else{
                alert('Authentication token not found.please login again');
                this.$router.push({name:'Login'});
            }
        },

        toggleAllPermissions() {
            this.permissions.forEach((permission) => {
              permission.checked = this.checkAll;
            });
          },

    resetPermissions() {
     this.permissions.forEach((permission) => {
        permission.checked = false;
        });
        this.checkAll = false;
        
        this.fetchPermissions();
    },

      updatePermission(permission) {

      },

      async updatePermissions(){
        const token = localStorage.getItem('auth_token');
        if (token) {
          try {
            console.log(12);
            const response = await axios.post('/api/auth/permissions/update', {
            role_id: this.roleId,
              permissions: this.permissions.map(({ id, checked }) => ({
                id,
                checked,
              })),
          }, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });

          if (response.status === 200) {
            alert('Permissions updated successfully.');
          }
          }
          catch (error) {
          console.error('There was an error updating the permissions!', error);
          if (error.response && error.response.status === 401) {
            alert('Your session has expired. Please login again.');
            localStorage.removeItem('auth_token');
            this.$router.push({ name: 'Login' });
          } else {
            alert('An error occurred while updating permissions.');
          }
        }
      }
      else {
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
  .btn {
    padding: 10px 20px;
    margin-right: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  .btn-secondary {
    background-color: #f0f0f0;
    color: #333;
  }
  .btn-primary {
    background-color: #007bff;
    color: #fff;
  }
  .permissions-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  .permissions-list li {
    padding: 5px 0;
  }
  .info-icon {
    color: #007bff;
    margin-left: 5px;
    cursor: pointer;
  }
  .switch {
    position: relative;
    display: inline-block;
    width: 34px;
    height: 20px;
  }
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;
  }
  .slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
  }
  input:checked + .slider {
    background-color: #007bff;
  }
  input:checked + .slider:before {
    transform: translateX(14px);
  }
  </style>
  