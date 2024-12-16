<template>
    <div class="container">
      <h1>Create Parent</h1>
      <div class="card">
        <form @submit.prevent="submitForm">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="firstName">First Name:</label>
                <input
                  type="text"
                  v-model="parent.firstName"
                  id="firstName"
                  required
                />
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input
                  type="text"
                  v-model="parent.lastName"
                  id="lastName"
                  required
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="email">Email:</label>
                <input
                  type="email"
                  v-model="parent.email"
                  id="email"
                  required
                />
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="password">Password:</label>
                <input
                  type="password"
                  v-model="parent.password"
                  id="password"
                  required
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="phone">Phone:</label>
                <input
                  type="text"
                  v-model="parent.phone"
                  id="phone"
                  required
                />
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="birthDate">Birth Date:</label>
                <input
                  type="date"
                  v-model="parent.birthDate"
                  id="birthDate"
                  required
                />
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        parent: {
          firstName: "",
          lastName: "",
          email: "",
          password: "",
          phone: "",
          birthDate: "",
        },
      };
    },
    methods: {
      submitForm() {
        // Handle form submission, e.g., send data to the backend API
        console.log(this.parent);
        // Reset form after submission
        this.resetForm();
      },
      resetForm() {
        this.parent = {
          firstName: "",
          lastName: "",
          email: "",
          password: "",
          phone: "",
          birthDate: "",
        };
      },
    },
  };
  </script>
  
  <style scoped>
  .container {
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }
  
  .card {
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .col {
    flex: 1;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    font-weight: bold;
    color: #555;
  }
  
  input,
  select,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    color: #333;
  }
  
  select {
    appearance: none;
  }
  
  .btn {
    display: block;
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background-color: rgb(66, 66, 172);
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
  }
  
  .btn:hover {
    background-color: rgb(48, 48, 126);
  }
  </style>
  