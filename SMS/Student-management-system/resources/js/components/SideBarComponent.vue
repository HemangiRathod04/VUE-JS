<template>
  <div class="sidebar">
    <ul class="menu">
      <li class="menu-item">
        <router-link to="/dashboard">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/students">
          <i class="fas fa-graduation-cap"></i> Students
        </router-link>
      </li>
      <!-- <li class="menu-item">
        <a href="#/subjects"> <i class="fas fa-book"></i> Subjects </a>
      </li> -->
      <li class="menu-item">
        <router-link to="/teachers">
          <i class="fas fa-chalkboard-teacher"></i> Teachers
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/parents">
          <i class="fas fa-users"></i> Parents
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/classes">
          <i class="fas fa-school"></i> Class 
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/attandances">
          <i class="fas fa-school"></i> Attendance
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/classes">
          <i class="fas fa-school"></i> Exam
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/classes">
          <i class="fas fa-school"></i> Fees Table
        </router-link>
      </li>
      <li class="menu-item">
        <router-link to="/schedules">
          <i class="fas fa-school"></i>  Schedules
        </router-link>
      </li>
    </ul>
  </div>
</template>
  
  
<script>
export default {};
</script>
  
<style src="/resources/css/sidebar.css"></style>

  