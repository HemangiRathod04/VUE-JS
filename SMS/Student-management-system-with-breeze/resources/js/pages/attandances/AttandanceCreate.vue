<template>
    <div class="container">
      <div class="card">
        <div class="row">
          <div class="col-10">
            <h1>Create Attendance</h1>
          </div>
        </div>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label for="date">Date:</label>
            <input
              type="date"
              id="date"
              v-model="attendance.date"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label for="class">Class:</label>
            <select
              id="class"
              v-model="attendance.class"
              class="form-control"
              required
            >
              <option value="">Select Class</option>
              <option value="1">Class 1</option>
              <option value="2">Class 2</option>
              <option value="3">Class 3</option>
            </select>
          </div>
          <div class="form-group">
            <label for="section">Section:</label>
            <input
              type="text"
              id="section"
              v-model="attendance.section"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select
              id="status"
              v-model="attendance.status"
              class="form-control"
              required
            >
              <option value="present">Present</option>
              <option value="absent">Absent</option>
              <option value="late">Late</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Create Attendance</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        attendance: {
          date: '',
          class: '',
          section: '',
          status: 'present'
        }
      };
    },
    methods: {
      submitForm() {
        // Handle form submission, e.g., send data to the backend API
        console.log(this.attendance);
        // Reset form after submission
        this.resetForm();
      },
      resetForm() {
        this.attendance = {
          date: '',
          class: '',
          section: '',
          status: 'present'
        };
      }
    }
  };
  </script>
  
  <style scoped>
  .container {
    /* max-width: 800px; */
    margin: 0 auto;
    padding: 20px;
  }
  
  .card {
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-group label {
    display: block;
    font-weight: bold;
  }
  </style>
  