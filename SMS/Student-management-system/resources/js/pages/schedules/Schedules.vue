<template>
  <div class="container">
    <h1>Create schedule</h1>
    <div class="card">
      <form @submit.prevent="addSchedule" enctype="multipart/form-data">
        <div v-if="errors.length" class="alert alert-danger">
          <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
          </ul>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="title">Title:</label>
                <input
                  type="text"
                  v-model="newSchedule.title"
                  id="title"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <textarea
                  v-model="newSchedule.description"
                  id="description"
                  class="form-control"
                ></textarea>
              </div>
              <div class="form-group">
                <label for="type">Type:</label>
                <select
                  v-model="newSchedule.type"
                  id="type"
                  class="form-control"
                  required
                >
                  <option value="class">Class</option>
                  <option value="exam">Exam</option>
                  <option value="meeting">Meeting</option>
                  <option value="event">Event</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group" v-if="newSchedule.type === 'class'">
                <label for="starttime">Start Time:</label>
                <input
                  type="time"
                  v-model="newSchedule.start_time"
                  id="start_time"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group" v-else>
                <label for="start_datetime">Start DateTime:</label>
                <input
                  type="datetime-local"
                  v-model="newSchedule.start_datetime"
                  id="start_datetime"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group" v-if="newSchedule.type === 'class'">
                <label for="starttime">End Time:</label>
                <input
                  type="time"
                  v-model="newSchedule.end_time"
                  id="end_time"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group" v-else>
                <label for="end_datetime">End DateTime:</label>
                <input
                  type="datetime-local"
                  v-model="newSchedule.end_datetime"
                  id="end_datetime"
                  class="form-control"
                  required
                />
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
    <br />
    <h2>Schedules</h2>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Type</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(schedule, index) in schedules" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ schedule.title }}</td>
              <td>{{ schedule.description }}</td>
              <!-- <td>{{ schedule.start_time }}</td>
              <td>{{ schedule.end_time }}</td> -->
              <td>{{ schedule.type === 'class' ? formatTime(schedule.start_time) : formatDateTime(schedule.start_time) }}</td>
              <td>{{ schedule.type === 'class' ? formatTime(schedule.end_time) : formatDateTime(schedule.end_time) }}</td>
              <td>{{ schedule.type }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      newSchedule: {
        title: "",
        description: "",
        start_time: "",
        end_time: "",
        start_datetime: "",
        end_datetime: "",
        type: "class",
      },
      schedules: [],
      errors: [],
    };
  },
  created() {
    this.fetchSchedule();
  },
  methods: {

    formatTime(time) {
    return new Date(time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    },
    formatDateTime(dateTime) {
        return new Date(dateTime).toLocaleString();
    },
    async fetchSchedule() {
        try {
        const response = await axios.get("/api/schedules");
        
        if (response.data.status == "success") {
          this.schedules = response.data.data;
        } else {
          console.error("Error fetching schedule:", response.data.message);
        }
        } catch (error) {
            if (error.response && error.response.status === 404) {
          console.error("Endpoint not found:", error.response.config.url);
        } else {
          console.error("Error fetching schedule:", error.message);
        }
    }
    },
    async addSchedule() {
      this.errors = [];
      const formData = new FormData();
      for (let key in this.newSchedule) {
        formData.append(key, this.newSchedule[key]);
      }
      try {
      const response = await axios.post("/api/schedules/store", formData);
      
      if (response.data.status == "success") {
        alert("schedules created successfully");
        this.fetchSchedule();  
      } else {
        this.errors.push(response.data.message);
        console.error("error creating schedules", response.data.message);
      }
    } catch (error) {
    if (error.response && error.response.status === 404) {
      console.error("Endpoint not found:", error.response.config.url);
    } else {
      console.error("Error creating schedule:", error.message);
    }
  }

      // Reset form fields
      this.newSchedule = {
        title: "",
        description: "",
        start_time: "",
        end_time: "",
        start_datetime: "",
        end_datetime: "",
        type: "class",
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

.schedule-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  color: #555;
}

.schedule-list {
  list-style-type: none;
  padding: 0;
}

.schedule-item {
  background-color: #f9f9f9;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
}

.schedule-item strong {
  font-size: 1.2em;
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

.schedule-item span {
  font-weight: bold;
}

.schedule-item:last-child {
  margin-bottom: 0;
}
</style>
  