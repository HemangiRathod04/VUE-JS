<template>
  <div v-if="student" class="student-details">
    <h1>Student Details</h1>
    <div class="student-info">
      <div class="student-photo">
        <img
          :src="student.photos_url"
          alt="Student Picture"
          v-if="student.photos_url"
        />
        <p v-else>No Image</p>
      </div>
      <div class="student-data">
        <p><strong>ID:</strong> {{ student.id }}</p>
        <p><strong>GR No:</strong> {{ student.gr_no }}</p>
        <p><strong>Email:</strong> {{ student.email }}</p>

        <p><strong>Class:</strong> {{ student.classes.year}} {{ student.classes.section }}</p>
        <p><strong>Name:</strong> {{ student.first_name }} {{ student.middle_name }} {{ student.last_name }}</p>
        <p><strong>Schedule:</strong> {{ student.schedule.title }} {{ student.formatted_title }} </p>
        <p><strong>Gender:</strong> {{ student.gender }}</p>
        <p><strong>Current Address:</strong> {{ student.current_address }}</p>
        <p><strong>permenent Address:</strong> {{ student.permanent_address }}</p>
        <p><strong>Gender:</strong> {{ student.gender }}</p>

        <p><strong>Date of Birth:</strong> {{ student.date_of_birth }}</p>
        <p><strong>Status:</strong> {{ student.status === 1 ? "Active" : "Inactive" }}</p>
        <p><strong>Phone:</strong> {{ student.phone }}</p>
        <p><strong>Joining Date:</strong> {{ student.joining_date }}</p>

        <p><strong>Blood Group:</strong> {{ student.blood_group }}</p>
        <p><strong>Emergency Contact:</strong> {{ student.emergency_contact }}</p>


      </div>
    </div>
    <h2>Parent Details</h2>
    <div class="parent-details" v-if="student.parents">
      <p><strong>First Name:</strong> {{ student.parents.first_name }}</p>
      <p><strong>Last Name:</strong> {{ student.parents.last_name }}</p>
      <p><strong>Email:</strong> {{ student.parents.email }}</p>
      <p><strong>Phone:</strong> {{ student.parents.phone }}</p>
      <p><strong>Birth Date:</strong> {{ student.parents.date_of_birth }}</p>
    </div>
    <div v-else>
      <p>No parent information available.</p>
    </div>
  </div>
  <div v-else>
    <p>Loading...</p>
  </div>
</template>


 
<script>
import axios from "axios";

export default {
  props: ["id"],
  data() {
    return {
      student: null,
    };
  },
  created() {
    this.fetchStudent();
  },
  methods: {
    async fetchStudent() {
      try {
        const response = await axios.post(`/api/students/view/${this.id}`);
        if (response.data.status === "success") {
          this.student = response.data.data;
        } else {
          console.error("Error fetching student:", response.data.message);
        }
      } catch (error) {
        console.error("Error fetching student:", error);
      }
    },
  },
};
</script>

 
<style>
.student-details {
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin: 20px;
  background-color: #f9f9f9;
}

.student-info {
  display: flex;
  align-items: center;
}

.student-photo {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 20px;
}

.student-photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.student-data {
  margin-left:15%;
  flex: 1;
}

.parent-details {
  margin-top: 20px;
}

</style>
