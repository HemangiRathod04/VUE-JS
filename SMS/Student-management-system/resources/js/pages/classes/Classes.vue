<template>
  <div>
    <div class="row">
      <div class="col-10">
        <h1>Classes List</h1>
      </div>
      <div class="col-2">
        <router-link to="/classes/create" class="btn createClassesButton">
          <i class="fas fa-plus"></i> Create Class
        </router-link>
      </div>
    </div>
    <table v-if="classes.length" class="styled-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Class</th>
          <th>Section</th>
          <th>Teacher Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="classData in classes" :key="classData.id">
          <td>{{ classData.id }}</td>
          <td>{{ classData.year }}</td>
          <td>{{ classData.section }}</td>
          <td>{{ classData.teacher.name }}</td>
          <td>{{ classData.status === 1 ? "Active" : "Inactive" }}</td>
          <td>
            <i
              class="fas fa-edit edit-icon"
              @click="editClasses(classData)"
            ></i>
            <i class="fas fa-trash-alt delete-icon"></i>
          </td>
        </tr>
      </tbody>
    </table>
    <p v-else>No classes found.</p>

    <!-- Edit Class Modal -->
    <div
      v-if="showModal"
      class="modal fade show"
      id="editClassModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editClassModalLabel"
      aria-hidden="true"
      style="display: block"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
            <button
              type="button"
              class="btn-close"
              aria-label="Close"
              @click="closeModal"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveEditedClass">
              <div class="form-group">
                <label for="editClassName">Class</label>
                <input
                  type="text"
                  class="form-control"
                  id="editClassName"
                  v-model="editClass.year"
                />
              <span class="text-red-600" v-if="errors.includes('year required')">year required</span>
              </div>
              <div class="form-group">
                <label for="editClassSection">Section</label>
                <input
                  type="text"
                  class="form-control"
                  id="editClassSection"
                  v-model="editClass.section"
                />
              <span class="text-red-600" v-if="errors.includes('section required')">Section required</span>
              </div>

              <div class="form-group">
                <label for="editClassTeacher">Teacher</label>
                <select
                  class="form-control"
                  id="editClassTeacher"
                  v-model="editClass.teacher_id"
                >
                  <option
                    v-for="teacher in teachers"
                    :key="teacher.id"
                    :value="teacher.id"
                  >
                    {{ teacher.name }}
                  </option>
                </select>
              <span class="text-red-600" v-if="errors.includes('teacher required')">Section required</span>
              </div>

              <div class="form-group">
                <label for="editClassStatus">Status</label>
                <select
                  class="form-control"
                  id="editClassStatus"
                  v-model="editClass.status"
                >
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
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
import axios from "axios";

export default {
  data() {
    return {
      classes: [],
      teachers: [],
      showModal: false,
      errors:[],
    };
  },
  created() {
    this.fetchClasses();
    this.fetchTeachers();
  },
  methods: {
    async fetchClasses() {
      const response = await axios.get("/api/classes");
      if (response.data.status === "success") {
        this.classes = response.data.data;
      } else {
        // this.errorMessage = response.data.message || "Error fetching classes";
      }
    },
    async fetchTeachers() {
      try {
        const response = await axios.get("/api/teachers");
        if (response.data.status === "success") {
          this.teachers = response.data.data;
        } else {
          // this.errorMessage =
            response.data.message || "Error fetching teachers";
        }
      } catch (error) {
        // this.errorMessage = error.message || "Error fetching teachers";
      }
    },
    editClasses(classData) {
      this.showModal = true;
      this.editClass = { ...classData };
    },
    closeModal() {
      this.showModal = false;
    },

    async saveEditedClass(){
      this.errors=[];
      if(!this.editClass.year) this.errors.push('year required')
      if(!this.editClass.section) this.errors.push('section required')
      if(!this.editClass.teacher_id) this.errors.push('teacher required')
    
    const response= await axios.post(`/api/classes/update/${this.editClass.id}`,this.editClass);
    if(response.data.status==="success"){
      this.$router.push("/classes");
      this.showModal=false;
    }
    else{
      this.errors.push(response.data.message || "Unknown error");
      console.error("Error updating student:",error);
    }
    },
  },
};
</script>
  
<style scoped>
@import url('/resources/css/classes.css');
</style>    