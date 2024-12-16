<template>
    <div class="register-container">
      <div class="register-card">
        <h1 class="register-title">Register</h1>
        <form @submit.prevent="register" class="register-form" method="post">
          <div class="form-group">
            <label for="name">Name:</label>
            <input
              type="text"
              v-model="name"
              @blur="validateName"
              placeholder="Enter your name"
              class="form-input"
            />
            <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input
              type="email"
              v-model="email"
              @blur="validateEmail"
              placeholder="Enter your email"
              class="form-input"
            />
            <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input
              type="password"
              v-model="password"
              @blur="validatePassword"
              placeholder="Enter your password"
              class="form-input"
            />
            <span v-if="errors.password" class="error-message">{{ errors.password }}</span>
          </div>
          <div class="form-group">
            <label for="passwordConfirm">Confirm Password:</label>
            <input
              type="password"
              v-model="passwordConfirm"
              @blur="validatePasswordConfirm"
              placeholder="Confirm your password"
              class="form-input"
            />
            <span v-if="errors.passwordConfirm" class="error-message">{{ errors.passwordConfirm }}</span>
          </div>
          <button type="submit" class="submit-button">Register</button>
        </form>
        <div class="login-link">
          <p>Already have an account? <router-link to="/login">Login Here</router-link></p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        passwordConfirm: '',
        errors: {}
      };
    },
    methods: {
      validateName() {
        if (!this.name) {
          this.errors.name = 'Name is required';
        } else {
          delete this.errors.name;
        }
      },
      validateEmail() {
        if (!this.email) {
          this.errors.email = 'Email is required';
        } else if (!this.validEmail(this.email)) {
          this.errors.email = 'Email is invalid';
        } else {
          delete this.errors.email;
        }
      },
      validatePassword() {
        if (!this.password) {
          this.errors.password = 'Password is required';
        } else if (this.password.length < 6) {
          this.errors.password = 'Password must be at least 6 characters long';
        } else {
          delete this.errors.password;
        }
      },
      validatePasswordConfirm() {
        if (!this.passwordConfirm) {
          this.errors.passwordConfirm = 'Password confirmation is required';
        } else if (this.passwordConfirm !== this.password) {
          this.errors.passwordConfirm = 'Passwords do not match';
        } else {
          delete this.errors.passwordConfirm;
        }
      },
      validEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
      },
      async register() {
        this.validateName();
        this.validateEmail();
        this.validatePassword();
        this.validatePasswordConfirm();
  
        if (Object.keys(this.errors).length === 0) {
          try {
            const response = await axios.post('api/register', {
              name: this.name,
              email: this.email,
              password: this.password,
              passwordConfirm: this.passwordConfirm,
            });
            this.$router.push({ name: 'Login' });
          } catch (error) {
            if (error.response && error.response.status === 422) {
                this.errors = {};
                const backendErrors = error.response.data.errors;
                for (const field in backendErrors) {
              this.errors[field] = backendErrors[field][0]; 
            }
            } else {
              alert('An error occurred. Please try again later.');
            }
          }
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f2f5;
  }
  
  .register-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 400px;
    width: 100%;
  }
  
  .register-title {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .register-form .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  .form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  
  .error-message {
    color: #ff4d4d;
    font-size: 12px;
  }
  
  .submit-button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
  }
  
  .submit-button:hover {
    background-color: #0056b3;
  }
  
  .login-link {
    margin-top: 15px;
    text-align: center;
  }
  
  .login-link a {
    color: #007bff;
    text-decoration: none;
  }
  
  .login-link a:hover {
    text-decoration: underline;
  }
  </style>
  