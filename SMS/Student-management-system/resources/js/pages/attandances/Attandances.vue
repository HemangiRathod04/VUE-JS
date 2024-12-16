<template>
    <div>
      <div class="row">
        <div class="col-8">
          <h1>Attendances List</h1>
        </div>
        <div class="col-4">
          <router-link to="/attendance/create" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Attendances
          </router-link>
        </div>
      </div>
      <table class="styled-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Class</th>
            <th>Section</th>
            <th>Teacher Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>28/5</td>
            <td>10</td>
            <td>A</td>
            <td>Ruhi</td>
            <td>active</td>
            <td>
              <i class="fas fa-edit edit-icon"></i>
              <i class="fas fa-trash-alt delete-icon"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  </script>
  
  <style scoped>
  .styled-table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }
  
  .styled-table thead tr {
    background-color: rgb(66, 66, 172);
    color: #ffffff;
    text-align: left;
  }
  
  .styled-table th,
  .styled-table td {
    padding: 12px 15px;
  }
  
  .styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
  }
  
  .styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
  }
  
  .styled-table tbody tr:last-of-type {
    border-bottom: 2px solid rgb(66, 66, 172);
  }
  
  .styled-table tbody tr.active-row {
    font-weight: bold;
    color: rgb(66, 66, 172);
  }
  
  .edit-icon,
  .delete-icon {
    cursor: pointer;
    margin-right: 5px;
  }
  
  .edit-icon:hover,
  .delete-icon:hover {
    color: red;
  }
  </style>
  