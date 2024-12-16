<template>
  <div id="app">
    <!-- <div class="app-container">
      <div class="sidebar">
        <div class="logo">Real-estate</div>
        <ul class="menu">
          <router-link to="/dashboard" class="menu-item">Dashboard</router-link>
          <li><a href="#" class="menu-item">Role Management</a></li>
        </ul>
      </div>

      <div class="main-content">
        <div class="header">
          <div class="header-left">
            <h1>Real Estate Management</h1>
          </div>
          <div class="header-right">
            <div class="profile-menu">
              <span class="profile-name">John Doe</span>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <div class="dashboard-card">
          <h2>Welcome to the Dashboard</h2>
          <p>This is your dashboard where you can manage your real estate properties and roles.</p>
        </div>
      </div>
    </div> -->
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style scoped>
body {
  margin: 0;
  font-family: 'Roboto', sans-serif;
  background-color: #f8f9fa; 
}

.app-container {
  display: flex;
}

.sidebar {
  width: 250px;
  height: 100vh;
  background-color: #0056b3; 
  color: white;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); 
}

.logo {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 40px;
  text-transform: uppercase;
  letter-spacing: 2px; 
}

.menu {
  width: 100%;
  list-style: none;
  padding: 0;
  margin: 0;
}

.menu-item {
  display: block;
  width: 100%;
  padding: 15px 20px;
  text-align: left;
  cursor: pointer;
  text-decoration: none;
  color: white;
  font-size: 18px;
  transition: background-color 0.3s ease, padding-left 0.3s ease; 
  margin-bottom: 5px; 
}

.menu-item:hover {
  background-color: #003f7f; 
  border-left: 4px solid #ffc107;
  padding-left: 24px; 
}

.menu-item:active {
  background-color: #004b9a; 
}

.main-content {
  margin-left: 250px; /* Offset by the width of the sidebar */
  /* padding: 20px; */
  width: calc(100% - 250px);
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0056b3; 
  color: white;
  padding: 15px 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
  margin-bottom: 10px;
}

.header-left h1 {
  margin: 0;
  font-size: 24px;
}

.header-right {
  display: flex;
  align-items: center;
}

.profile-menu {
  position: relative;
}

.profile-name {
  cursor: pointer;
  font-size: 18px;
  color: white;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  right: 0;
  background-color: white;
  color: black;
  width: 150px;
  border-radius: 4px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  display: none; /* Initially hide the dropdown */
  flex-direction: column;
}

.profile-menu:hover .dropdown-menu {
  display: flex;
}

.dropdown-item {
  padding: 10px;
  text-decoration: none;
  color: black;
  transition: background-color 0.3s ease;
}

.dropdown-item:hover {
  background-color: #f1f1f1;
}

.dashboard-card {
  background-color: rgb(175, 179, 182);
  padding: 20px;
  width: 20%;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.dashboard-card h2 {
  margin-top: 0;
  font-size: 24px;
  color: #0056b3;
}

.dashboard-card p {
  margin: 10px 0 0;
  font-size: 16px;
  color: #333;
}
</style>
