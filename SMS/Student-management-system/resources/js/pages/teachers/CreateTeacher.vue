<template>
  <div class="container">
    <div class="card">
      <div class="row">
        <div class="col-10">
          <h1>Create Teacher</h1>
        </div>
      </div>
      <form @submit.prevent="createTeacher" enctype="multipart/form-data">
        <div v-if="errors.length" class="alert alert-danger">
          <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
          </ul>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Name:</label>
              <input
                type="text"
                id="name"
                v-model="teacher.name"
                class="form-control"
                
              />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="email">Email:</label>
              <input
                type="email"
                id="email"
                v-model="teacher.email"
                class="form-control"
                
              />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="password">Password:</label>
              <input
                type="password"
                id="password"
                v-model="teacher.password"
                class="form-control"
                
              />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input
                type="text"
                id="phone"
                v-model="teacher.phone"
                class="form-control"
                
              />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select
                id="gender"
                v-model="teacher.gender"
                class="form-control"
                
              >
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="date_of_birth">Date of Birth:</label>
              <input
                type="date"
                id="date_of_birth"
                v-model="teacher.date_of_birth"
                class="form-control"
                
              />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="current_address">Current Address:</label>
              <textarea
                id="current_address"
                v-model="teacher.current_address"
                class="form-control"
                
              ></textarea>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="permanent_address">Permanent Address:</label>
              <textarea
                id="permanent_address"
                v-model="teacher.permanent_address"
                class="form-control"
                
              ></textarea>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="picture">Picture:</label>
          <input
            type="file"
            id="picture"
            @change="onPictureChange"
            accept="image/*"
            class="form-control-file"
          />
        </div>
        <button type="submit" class="btn btn-primary">Create Teacher</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      teacher: {
        name: "",
        email: "",
        password: "",
        phone: "",
        gender: "male",
        date_of_birth: "",
        current_address: "",
        permanent_address: "",
        picture: null,
      },
      errors: [],
    };
  },
  methods: {
    async createTeacher() {
      this.errors = [];
      try {
        const formData = new FormData();
        for (let key in this.teacher) {
          formData.append(key, this.teacher[key]);
        }
        if (this.teacher.picture) {
          formData.append("picture", this.teacher.picture);
        }
        const response = await axios.post("/api/teachers/store", formData);
        if (response.data.status === "success") {
          alert("Teacher created successfully");
          this.$router.push("/teachers");
        } else {
          this.errors.push(response.data.message || "Unknown error");
          console.error("Error creating teacher:", response.data.message);
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = Object.values(error.response.data.errors).flat();
        } else {
          this.errors.push("Error creating teacher");
          console.error("Error creating teacher:", error);
        }
      }
    },
    onPictureChange(event) {
      this.teacher.picture = event.target.files[0];
    },
  },
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

.form-group input[type="file"] {
  display: block;
  margin-top: 5px;
}

.preview-image {
  margin-top: 10px;
  max-width: 200px;
}

.preview-image img {
  max-width: 100%;
  height: auto;
  margin-top: 5px;
}
</style>
