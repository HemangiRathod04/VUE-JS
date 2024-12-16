<template>
  <div class="container">
    <h1>Create Student</h1>
    <div class="card">
      <form @submit.prevent="createStudent" enctype="multipart/form-data">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="grNumber">GR Number:</label>
              <input
                type="text"
                v-model="student.grNumber"
                id="grNumber"
              />
              <span class="text-red-600" v-if="errors.includes('grNumber Required')">grNumber Required</span>
            </div>
            <div class="form-group">
              <label for="firstName">First Name:</label>
              <input
                type="text"
                v-model="student.firstName"
                id="firstName"
              />
              <span class="text-red-600" v-if="errors.includes('firstname required')">firstname Required</span>
            </div>
            <div class="form-group">
              <label for="middleName">Middle Name:</label>
              <input type="text" v-model="student.middleName" id="middleName" />
              <span class="text-red-600" v-if="errors.includes('middleName required')">middleName Required</span>
            </div>
            <div class="form-group">
              <label for="lastName">Last Name:</label>
              <input
                type="text"
                v-model="student.lastName"
                id="lastName"
              />
              <span class="text-red-600" v-if="errors.includes('lastName Required')">lastName Required</span>
            </div>
            <div class="form-group">
              <label for="class">Class:</label>
              <select v-model="student.class" id="class">
                <option value="">Select Class</option>
                <option
                  v-for="classItem in classes"
                  :key="classItem.id"
                  :value="classItem.id"
                >
                  {{ classItem.year }}-{{ classItem.section }}
                </option>
              </select>
              <span class="text-red-600" v-if="errors.includes('class required')">Class Required</span>
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" v-model="student.email" id="email" />
              <span class="text-red-600" v-if="errors.includes('email Required')">Email Required</span>
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" v-model="student.phone" id="phone" />
              <span class="text-red-600" v-if="errors.includes('phone required')">Phone Required</span>
            </div>

            <div class="form-group">
              <label for="scheduled">Scheduled:</label>
              <select v-model="student.scheduled" id="scheduled">
                <option value="">Select Scheduled</option>
                <option
                  v-for="schedule in filteredSchedules"
                  :key="schedule.id"
                  :value="schedule.id"
                >
                  {{ schedule.title }} ({{ formatTime(schedule.start_time) }} to
                  {{ formatTime(schedule.end_time) }})
                </option>
              </select>
              <span class="text-red-600" v-if="errors.includes('schedule required')">Schedule Required</span>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="currentAddress">Current Address:</label>
              <textarea
                v-model="student.currentAddress"
                id="currentAddress"
              ></textarea>
              <span class="text-red-600" v-if="errors.includes('currentAddress required')">CurrentAddress Required</span>
            </div>
            <div class="form-group">
              <label for="permanentAddress">Permanent Address:</label>
              <textarea
                v-model="student.permanentAddress"
                id="permanentAddress"
              ></textarea>
              <span class="text-red-600" v-if="errors.includes('permanentAddress required')">PermanentAddress Required</span>
            </div>
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select v-model="student.gender" id="gender">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
              <span class="text-red-600" v-if="errors.includes('gender required')">Gender Required</span>
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth:</label>
              <input type="date" v-model="student.dob" id="dob" />
              <span class="text-red-600" v-if="errors.includes('birthdate required')">Birthdate Required</span>
            </div>
            <div class="form-group">
              <label for="bloodGroup">Blood Group:</label>
              <select v-model="student.bloodGroup" id="bloodGroup">
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
              <span class="text-red-600" v-if="errors.includes('bloodgroup required')">BloodGroup Required</span>
            </div>

            <div class="form-group">
              <label for="status">Status:</label>
              <select
                v-model="student.status"
                id="status"
                class="form-control"
              >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="emergency_contact">Emergency Contact:</label>
              <input
                type="text"
                v-model="student.emergency_contact"
                id="emergency_contact"
              />
              <span class="text-red-600" v-if="errors.includes('emergencyContact required')">emergencyContact Required</span>
            </div>

            <div class="form-group">
              <label for="photo">Photo:</label>
              <input type="file" id="photo" accept="image/*" />
              <span class="text-red-600" v-if="errors.includes('Photo required')">Photo Required</span>
            </div>
          </div>
        </div>

        <!-- Parent Details -->
        <h2>Parent Information:</h2>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="parentFirstName">First Name:</label>
              <input
                type="text"
                v-model="parent.parentFirstName"
                id="parentFirstName"
                name="parentFirstName"
              />
              <span class="text-red-600" v-if="errors.includes('firstname required')">Firstname Required</span>
            </div>
            <div class="form-group">
              <label for="parentLastName">Last Name:</label>
              <input
                type="text"
                v-model="parent.parentLastName"
                id="parentLastName"
                name="parentLastName"
              />
              <span class="text-red-600" v-if="errors.includes('lastname required')">Lastname Required</span>
            </div>
            <div class="form-group">
              <label for="parentEmail">Email:</label>
              <input
                type="email"
                v-model="parent.parentEmail"
                id="parentEmail"
                name="parentEmail"
              />
              <span class="text-red-600" v-if="errors.includes('email required')">Email Required</span>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="parentPassword">Password:</label>
              <input
                type="password"
                v-model="parent.parentPassword"
                id="parentPassword"
                name="parentPassword"
              />
              <span class="text-red-600" v-if="errors.includes('password required')">Password Required</span>
            </div>
            <div class="form-group">
              <label for="parentPhone">Phone:</label>
              <input
                type="text"
                v-model="parent.parentPhone"
                id="parentPhone"
                name="parentPhone"
              />
              <span class="text-red-600" v-if="errors.includes('phone required')">Phone Required</span>
            </div>
            <div class="form-group">
              <label for="parentDob">Date of Birth:</label>
              <input
                type="date"
                v-model="parent.parentDob"
                id="parentDob"
                name="parentDob"
              />
              <span class="text-red-600" v-if="errors.includes('birthdate required')">Birthdate Required</span>
            </div>
          </div>
        </div>
        <!-- End of Parent Details -->
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
</template>
  
<script>
import axios from "axios";
export default {
  data() {
    return {
      student: {
        grNumber: "",
        firstName: "",
        middleName: "",
        lastName: "",
        class: "",
        email: "",
        phone: "",
        currentAddress: "",
        permanentAddress: "",
        scheduled: "",
        gender: "",
        dob: "",
        bloodGroup: "",
        status: "1",
        emergency_contact: "",
        photo: "",
      },
      parent: {
        parentFirstName: "",
        parentLastName: "",
        parentEmail: "",
        parentPhone: "",
        parentDob: "",
        parentPassword: "",
      },
      classes: [],
      schedules: [],
      errors: [],
    };
  },
  computed: {
    filteredSchedules() {
      console.log(this.schedules); // Check if schedules array is populated
      return this.schedules.filter((schedule) => schedule.type === "class");
    },
  },
  async mounted() {
    try {
      const response = await axios.get("/api/students/class");
      this.classes = response.data.data;

      const scheduleResponse = await axios.get("/api/schedules");
      console.log(scheduleResponse); // Log response to check for errors
      this.schedules = scheduleResponse.data.data;
    } catch (error) {
      console.error("Error fetching classes or schedules:", error);
    }
  },

  methods: {
    formatTime(time) {
      const [hour, minute] = time.split(":");
      const period = hour < 12 ? "am" : "pm";
      const formattedHour = hour % 12 || 12;
      return `${formattedHour}:${minute} ${period}`;
    },
    async createStudent() {
      this.errors = [];
    if(!this.student.grNumber) this.errors.push("grNumber Required");
    if(!this.student.firstName) this.errors.push("firstname required");
    if(!this.student.middleName) this.errors.push("middleName required");
    if(!this.student.lastName) this.errors.push("lastName Required");
    if(!this.student.class) this.errors.push("class required");
    if(!this.student.email) this.errors.push("email Required");
    if(!this.student.phone) this.errors.push("phone required");
    if(!this.student.scheduled) this.errors.push("schedule required");
    if(!this.student.currentAddress) this.errors.push("currentAddress required");
    if(!this.student.permanentAddress) this.errors.push("permanentAddress required");
    if(!this.student.gender)this.errors.push("gender required");
    if(!this.student.dob)this.errors.push("birthdate required");
    if(!this.student.bloodGroup)this.errors.push("bloodgroup required");
    if(!this.student.emergency_contact)this.errors.push("emergencyContact required");
    if(!this.student.photo)this.errors.push("photo required");
    if(!this.parent.parentFirstName)this.errors.push("firstname required");
    if(!this.parent.parentLastName)this.errors.push("lastname required");
    if(!this.parent.parentEmail)this.errors.push("email required");
    if(!this.parent.parentPassword)this.errors.push("password required");
    if(!this.parent.parentPhone)this.errors.push("phone required");
    if(!this.parent.parentDob)this.errors.push("birthdate required");


    if(this.errors.length >= 0) return;
      try {
        const formData = new FormData();
        for (let key in this.student) {
          formData.append(key, this.student[key]);
        }
        for (let key in this.parent) {
          formData.append(key, this.parent[key]);
        }
        if (this.student.photo) {
          formData.append("photo", this.student.photo);
        }
        const response = await axios.post("/api/students/store", formData);
        if (response.data.status === "success") {
          alert("Student created successfully");
          this.$router.push("/students");
        } else {
          this.errors.push(response.data.message || "Unknown error");
          console.error("Error creating student:", response.data.message);
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = Object.values(error.response.data.errors).flat();
        } else {
          this.errors.push("Error creating student");
          console.error("Error creating student:", error);
        }
      }
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

.status-container {
  display: flex;
  align-items: center;
}

.status-option {
  margin-right: 10px;
}
.text-red-600{
  color:red;
}
</style>
  