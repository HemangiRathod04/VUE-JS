<template>
  <nav class="navbar">
    <div class="nav-content">
      <div class="nav-right">
        <div class="dropdown" @click="toggleDropdown">
          <span class="profile-name">Profile</span>
          <span class="dropdown-arrow">▼</span>
          <div class="dropdown-menu" v-if="dropdownOpen">
            <a href="/profile" class="dropdown-item">Profile</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
};
</script>

<style src="/resources/css/NavBar.css"></style>