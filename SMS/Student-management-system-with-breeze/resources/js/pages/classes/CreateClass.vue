<template>
  <div class="container">
    <div class="card">
      <div class="row">
        <div class="col-10">
          <h1>Create Class</h1>
        </div>
      </div>
      <form @submit.prevent="submitForm">
     
        <div class="form-group">
          <label for="year">Class:</label>
          <input
            type="text"
            id="year"
            v-model="classData.year"
            class="form-control"
          />
          <span class="text-red-600" v-if="errors.includes('year is required.')">year required.</span>
        </div>
        <div class="form-group">
          <label for="section">Section:</label>
          <input
            type="text"
            id="section"
            v-model="classData.section"
            class="form-control"
          />
          <span class="text-red-600" v-if="errors.includes('section required.')">Section required.</span>
        </div>
        <div class="form-group">
          <label for="teacher_name">Teacher Name:</label>
          <select
            id="teacher_name"
            v-model="classData.teacher_id"
            class="form-control"
          >
            <option value="">Select Teacher</option>
            <option
              v-for="teacher in Teachers"
              :key="teacher.id"
              :value="teacher.id"
            >
              {{ teacher.name }}
            </option>
          </select>
          <span class="text-red-600" v-if="errors.includes('Teacher is Required')">Teacher Required</span>
        </div>
        <div class="form-group">
          <label>Status:</label>
          <label class="radio-inline">
            <input type="radio" v-model="classData.status" value="1" /> Active
          </label>
          <label class="radio-inline">
            <input type="radio" v-model="classData.status" value="0" /> Inactive
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Create Class</button>
      </form>
    </div>
  </div>
</template>
  
  <script>
import axios from "axios";

export default {
  data() {
    return {
      classData: {
        year: "",
        section: "",
        teacher_id: "",
        status: "1",
      },
      Teachers: [],
      errors: [],
    };
  },
  async mounted() {
    try {
      const response = await axios.get("/api/teachers");
      this.Teachers = response.data.data;
    } catch (error) {
      console.error("Error fetching teachers:", error);
    }
  },
  methods: {
    async submitForm() {

      this.errors = [];
      if(!this.classData.year) this.errors.push("year is required.");
      if(!this.classData.section){
        this.errors.push("section required.");
      }
      if(!this.classData.teacher_id)this.errors.push("Teacher is Required");
      if (this.errors.length > 0) return;

      try {
        const response = await axios.post("/api/classes/store", this.classData);
        if (response.data.status === "success") {
          alert("Class Added SuccessFully");
          this.$router.push("/classes");
        } else {
          this.errors.push(response.data.message || "Unknown error");
          console.error("Error creating class:", response.data.message);
        }
      } catch (error) {
        console.error("Error creating class:", error);
      }
      this.resetForm();
    },
    resetForm() {
      this.classData = {
        year: "",
        section: "",
        teacher_id: "",
        status: "1",
      };
    },
  },
};
</script>

<style scoped>
/* @import "../example-app/resources/css/createclass.css"; */

@import url('/resources/css/createclass.css');
</style>