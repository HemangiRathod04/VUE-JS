<template>
  <div class="container">
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
      <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg px-8 py-6">
          <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
          <form @submit.prevent="handleLogin">
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" v-model="email" id="email"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div class="mb-6">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" v-model="password" id="password"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div class="flex items-center justify-between mb-6">
              <div class="flex items-center">

              </div>
              <div class="text-sm">
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
              </div>
            </div>
            <div>
              <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
            </div>
          </form>

          <div style="text-align: end;">
            <router-link to="/register" class="font-medium text-indigo-600 hover:text-indigo-500">Register
              Here</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      email: '',
      password: '',
      remember: false
    };
  },
  methods: {
    handleLogin() {
      console.log("Email:", this.email);
      console.log("Password:", this.password);
      console.log("Remember me:", this.remember);
    }
  }
};
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}

.bg-gray-100 {
  background-color: #f7fafc;
}

.bg-white {
  margin-left: 400px;
  margin-right: 200px;
  width: 40%;
  background-color: #ffffff;
}

.shadow-md {
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.rounded-lg {
  border-radius: 0.5rem;
}

.px-8 {
  padding-left: 2rem;
  padding-right: 2rem;
}

.py-6 {
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;
}

.text-2xl {
  font-size: 1.5rem;
  line-height: 2rem;
}

.font-bold {
  font-weight: 700;
}

.mb-6 {
  margin-bottom: 1.5rem;
}

.text-center {
  text-align: center;
}

.block {
  display: block;
}

.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.font-medium {
  font-weight: 500;
}

.text-gray-700 {
  color: #4a5568;
}

.mt-1 {
  margin-top: 0.25rem;
}

.w-full {
  width: 100%;
}

.px-3 {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.border {
  border-width: 1px;
}

.border-gray-300 {
  border-color: #d2d6dc;
}

.rounded-md {
  border-radius: 0.375rem;
}

.shadow-sm {
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.focus\:outline-none {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.focus\:ring-indigo-500 {
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}

.focus\:border-indigo-500 {
  border-color: #6366f1;
}

.sm\:text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

.flex {
  display: flex;
}

.items-center {
  align-items: center;
}

.justify-between {
  justify-content: space-between;
}

.mb-6 {
  margin-bottom: 1.5rem;
}

.h-4 {
  height: 1rem;
}

.w-4 {
  width: 1rem;
}

.text-indigo-600 {
  color: #4f46e5;
}

.border-gray-300 {
  border-color: #d2d6dc;
}

.rounded {
  border-radius: 0.25rem;
}

.ml-2 {
  margin-left: 0.5rem;
}

.text-gray-900 {
  color: #1a202c;
}

.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.font-medium {
  font-weight: 500;
}

.text-indigo-600 {
  color: #4f46e5;
}

.hover\:text-indigo-500:hover {
  color: #4338ca;
}

.w-full {
  width: 100%;
}

.bg-indigo-600 {
  background-color: #4f46e5;
}

.text-white {
  color: #ffffff;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.border {
  border-width: 1px;
}

.border-transparent {
  border-color: transparent;
}

.rounded-md {
  border-radius: 0.375rem;
}

.shadow-sm {
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.font-medium {
  font-weight: 500;
}

.hover\:bg-indigo-700:hover {
  background-color: #4338ca;
}

.focus\:outline-none {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.focus\:ring-2 {
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}

.focus\:ring-offset-2 {
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}

.focus\:ring-indigo-500 {
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}
</style>