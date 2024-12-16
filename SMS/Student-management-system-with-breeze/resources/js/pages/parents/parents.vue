<template>
  <div>
    <div class="row">
      <div class="col-8">
        <h1>Parents List</h1>
      </div>
      <div class="col-4">
        <router-link to="/parents/create" class="btn btn-success">
          <i class="fas fa-plus"></i> Create Parent
        </router-link>
      </div>
    </div>
    <table class="styled-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Birth Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <div
      v-if="showModal"
      class="modal fade"
      id="editTeacherModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editTeacherModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveEditedTeacher">
              <div class="form-group">
                <label for="editTeacherName">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="editTeacherName"
                  v-model="editedTeacher.name"
                />
              </div>
              <div class="form-group">
                <label for="editTeacherEmail">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="editTeacherEmail"
                  v-model="editedTeacher.email"
                />
              </div>
              <div class="form-group">
                <label for="editTeacherPassword">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="editTeacherPassword"
                  v-model="editedTeacher.password"
                />
              </div>
              <div class="form-group">
                <label for="editTeacherPhone">Phone</label>
                <input
                  type="text"
                  class="form-control"
                  id="editTeacherPhone"
                  v-model="editedTeacher.phone"
                />
              </div>
              <div class="form-group">
                <label for="editTeacherGender">Gender</label>
                <select
                  class="form-control"
                  id="editTeacherGender"
                  v-model="editedTeacher.gender"
                >
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="editTeacherDateOfBirth">Date of Birth</label>
                <input
                  type="date"
                  class="form-control"
                  id="editTeacherDateOfBirth"
                  v-model="editedTeacher.date_of_birth"
                />
              </div>
              <div class="form-group">
                <label for="editTeacherCurrentAddress">Current Address</label>
                <textarea
                  class="form-control"
                  id="editTeacherCurrentAddress"
                  v-model="editedTeacher.current_address"
                ></textarea>
              </div>
              <div class="form-group">
                <label for="editTeacherPermanentAddress"
                  >Permanent Address</label
                >
                <textarea
                  class="form-control"
                  id="editTeacherPermanentAddress"
                  v-model="editedTeacher.permanent_address"
                ></textarea>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  @click="closeModal"
                >
                  Close
                </button>
                <button type="submit" class="btn btn-primary">
                  Save changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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

.edit-button {
  background-color: rgb(66, 66, 172);
  border: none;
  color: white;
  padding: 10px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.edit-button:hover {
  background-color: white;
  color: black;
  border: 2px solid rgb(66, 66, 172);
}
.img-thumbnail {
  border-radius: 50%;
}
</style>
  