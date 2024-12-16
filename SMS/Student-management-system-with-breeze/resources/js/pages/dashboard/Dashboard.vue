<template>
    <div class="container mt-4">
      <h1>Dashboard</h1>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Students</h5>
              <p class="card-text">Manage student information here.</p>
              <router-link to="/students" class="btn btn-primary">Go to Students</router-link>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Parents</h5>
              <p class="card-text">Manage parent information here.</p>
              <router-link to="/parents" class="btn btn-primary">Go to Parents</router-link>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Teachers</h5>
              <p class="card-text">Manage teacher information here.</p>
              <router-link to="/teachers" class="btn btn-primary">Go to Teachers</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    // Your script logic here
  };
  </script>
  
  <style scoped>
  /* Your scoped styles here */
  </style>
  