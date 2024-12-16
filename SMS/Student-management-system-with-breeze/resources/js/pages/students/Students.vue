<template>
  <div>
    <div class="row">
      <div class="col-10">
        <h1>Students List</h1>
      </div>
      <div class="col-2">
        <router-link to="/students/create" class="btn createStudentColor">
          <i class="fas fa-plus"></i> Create Students
        </router-link>
      </div>
    </div>
    <table class="styled-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Photo</th>
          <th>GR No</th>
          <th>Class</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Schedule</th>
          <th>Date of Birth</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="student in students" :key="student.id">
          <td>{{ student.id }}</td>
          <td v-if="student.photo">
            <img
              :src="student.photos_url"
              class="img-thumbnail rounded-circle"
              alt="Student Picture"
              height="50"
              width="50"
            />
          </td>
          <td v-else>No Image</td>
          <td>{{ student.gr_no }}</td>
          <td>{{ student.classes.year }} {{ student.classes.section }}</td>
          <td>
            {{
              student.first_name +
              " " +
              student.middle_name +
              " " +
              student.last_name
            }}
          </td>
          <td>{{ student.gender }}</td>
          <td>{{ student.schedule.title }} {{ student.formatted_title }}</td>
          <td>{{ student.date_of_birth }}</td>
          <td>{{ student.phone }}</td>
          <td>
            <router-link
              :to="{ name: 'StudentView', params: { id: student.id } }"
              class="action-icon view-icon"
            >
              <i class="fas fa-eye"></i>
            </router-link>
            <i
              class="fas fa-edit"
              @click="editStudent(student)"
              data-bs-toggle="modal"
              data-bs-target="#editStudentModal"
            ></i>
            <span
              class="action-icon delete-icon"
              @click="deleteStudent(student.id)"
            >
              <i class="fas fa-trash-alt"></i>
            </span>
          </td>
        </tr>
      </tbody>
    </table>

    <div
      class="modal fade"
      id="editStudentModal"
      tabindex="-1"
      aria-labelledby="editStudentModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="editStudentModalLabel" class="modal-title">Edit Student</h2>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="closeModal"
            ></button>
          </div>
          <div class="model-body">
            <form
              @submit.prevent="saveEditedStudent"
              enctype="multipart/form-data"
            >
              <!-- <div v-if="errors.length" class="alert alert-danger"> -->
                <!-- <ul>
                  <li v-for="(error, index) in errors" :key="index">
                    {{ error }}
                  </li>
                </ul> -->
              <!-- </div> -->
              <div class="row">
                <div class="col">
                  <div class="form-group ml-2">
                    <label for="grNumber" class="form-label">GR Number:</label>
                    <input
                      type="text"
                      v-model="editedStudent.gr_no"
                      id="grNumber"
                      class="form-control"
                    />
                    <span class="text-red-600" v-if="errors.includes('year required')">year required</span>
                  </div>
                  <div class="form-group">
                    <label for="firstName" class="form-label"
                      >First Name:</label
                    >
                    <input
                      type="text"
                      v-model="editedStudent.first_name"
                      id="firstName"
                      class="form-control"
                    />
                    <span class="text-red-600" v-if="errors.includes('year required')">year required</span>
                  </div>
                  <div class="form-group">
                    <label for="middleName" class="form-label"
                      >Middle Name:</label
                    >
                    <input
                      type="text"
                      v-model="editedStudent.middle_name"
                      id="middleName"
                      class="form-control"
                    />
                    <span class="text-red-600" v-if="errors.includes('year required')">year required</span>
                  </div>
                  <div class="form-group">
                    <label for="lastName" class="form-label">Last Name:</label>
                    <input
                      type="text"
                      v-model="editedStudent.last_name"
                      id="lastName"
                      class="form-control"
                    />
                    <span class="text-red-600" v-if="errors.includes('year required')">year required</span>
                  </div>
                  <div class="form-group">
                    <label for="class" class="form-label">Class:</label>
                    <select
                      id="class"
                      v-model="editedStudent.class_id"
                      class="form-control"
                    >
                      <option
                        v-for="classYear in classYears"
                        :key="classYear.id"
                        :value="classYear.id"
                      >
                        {{ classYear.year }}-{{ classYear.section }}
                      </option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input
                      type="email"
                      v-model="editedStudent.email"
                      id="email"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="phone" class="form-label">Phone:</label>
                    <input
                      type="text"
                      v-model="editedStudent.phone"
                      id="phone"
                      class="form-control"
                    />
                  </div>

                  <div class="form-group">
                    <label for="scheduled" class="form-label">Scheduled:</label>
                    <select
                      v-model="editedStudent.schedule_id"
                      id="scheduled"
                      class="form-control"
                    >
                      <option
                        v-for="schedule in schedules"
                        :key="schedule.id"
                        :value="schedule.id"
                      >
                        {{ schedule.title }} ({{ formatTime(schedule.start_time) }} to
                        {{ formatTime(schedule.end_time) }})
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="currentAddress" class="form-label"
                      >Current Address:</label
                    >
                    <textarea
                      v-model="editedStudent.current_address"
                      id="currentAddress"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="permanentAddress" class="form-label"
                      >Permanent Address:</label
                    >
                    <textarea
                      v-model="editedStudent.permanent_address"
                      id="permanentAddress"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="gender" class="form-label">Gender:</label>
                    <select
                      v-model="editedStudent.gender"
                      id="gender"
                      class="form-control"
                    >
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input
                      type="date"
                      v-model="editedStudent.date_of_birth"
                      id="dob"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="bloodGroup" class="form-label"
                      >Blood Group:</label
                    >
                    <select
                      v-model="editedStudent.blood_group"
                      id="bloodGroup"
                      class="form-control"
                    >
                      <option value="">Select Blood Group</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="status" class="form-label">Status:</label>
                    <select
                      v-model="editedStudent.status"
                      id="status"
                      class="form-control"
                    >
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="emergency_contact" class="form-label"
                      >Emergency Contact:</label
                    >
                    <input
                      type="text"
                      v-model="editedStudent.emergency_contact"
                      id="emergency_contact"
                      class="form-control"
                    />
                  </div>

                  <div class="form-group">
                    <label for="photo" class="form-label">Photo:</label>
                    <div v-if="editedStudent.photos_url">
                      <img
                        :src="editedStudent.photos_url"
                        alt="Existing Photo"
                        class="img-thumbnail"
                        height="150"
                        width="150"
                      />
                      <button 
                        @click="editedStudent.photos_url = ''"
                        class="btn btn-danger mt-2"
                        type="button"
                      >
                        Remove
                      </button>
                    </div>

                    <input
                      v-else
                      type="file"
                      id="photo"
                      accept="image/*"
                      @change="handleFileUpload"
                      class="form-control mt-2"
                    />
                  </div>
                  
                </div>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                @click="closeModal"
              >
                Close
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from "axios";

export default {
  data() {
    return {
      students: [],
      editedStudent: {
        existingPhotoUrl: '',
      },

      showModal: false,
      classYears: [],
      schedules: [],
      errors: [],
    };
  },
  created() {
    this.fetchStudents();
    this.fetchClassYears();
    this.fetchSchedule();
  },

  methods: {
    formatTime(time) {
      const [hour, minute] = time.split(":");
      const period = hour < 12 ? "am" : "pm";
      const formattedHour = hour % 12 || 12;
      return `${formattedHour}:${minute} ${period}`;
    },
    async fetchStudents() {
      try {
        const response = await axios.get("/api/students");
        if (response.data.status == "success") {
          this.students = response.data.data;
        } else {
          console.error("Error fetching students:", response.data.message);
        }
      } catch (error) {
        console.error("Error fetching students:", error);
      }
    },

    async fetchClassYears() {
      try {
        const response = await axios.get("/api/classes");
        if (response.data.status == "success") {
          this.classYears = response.data.data;
        } else {
          console.error("Error fetching class years:", response.data.message);
        }
      } catch (error) {
        console.error("Error fetching class years:", error);
      }
    },
    async fetchSchedule() {
      try {
        const response = await axios.get("/api/schedules");
        if (response.data.status == "success") {
          this.schedules = response.data.data;
        }
      } catch (error) {
        console.error("Error fetching schedule", error);
      }
    },

    editStudent(student) {
      this.showModal = true;
      this.editedStudent = { ...student };
      console.log(this.editedStudent);
    },
    closeModal() {
      this.showModal = false;
    },
    async saveEditedStudent() {
      this.errors = [];
      if(!this.editedStudent.gr_no)
      if(!this.editedStudent.first_name)
      if(!this.editedStudent.middle_name)
      if(!this.editedStudent.last_name)
      if(!this.editedStudent.email)
      if(!this.editedStudent.phone)
      if(!this.editedStudent.current_address)
      if(!this.editedStudent.permanent_address)
      if(!this.editedStudent.date_of_birth)
      if(!this.editedStudent.blood_group)
      if(!this.editedStudent.emergency_contact)
      if(!this.editedStudent.photos_url)

      try {
        const response = await axios.post(
          `/api/students/update/${this.editedStudent.id}`,
          this.editedStudent
        );
        if (response.data.status === "success") {
          alert("Student Updated successfully");
          this.$router.push("/students");
        } else {
          this.errors.push(response.data.message || "Unknown error");
          console.error("Error updating Student:", response.data.message);
        }
        this.showModal = false;
        this.fetchStudents();
      } catch (error) {
        console.log("error updating student:", error);
      }
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      this.editedStudent.photo = file;
    },
  },
};
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
.createStudentColor {
  background-color: rgb(66, 66, 172);
  color: white;
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

.action-icon {
  display: inline-block;
  margin-right: 5px;
  padding: 3px 6px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.action-icon:hover {
  background-color: #f0f0f0;
  border-radius: 3px;
}

.view-icon {
  color: black;
}

.edit-icon {
  color: black;
}

.delete-icon {
  color: black;
}
</style>
  