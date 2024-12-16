<template>
  <div class="login-container">
    <div class="login-card">
      <h1 class="login-title">Login</h1>
      <form @submit.prevent="login" class="login-form">
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
        <button type="submit" class="submit-button">Login</button>
      </form>
      <div class="registration-link">
        <p>Don't have an account? <router-link to="/register">Register here</router-link> </p>


      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
    return {
      email: '',
      password: '',
      errors: {}
        };
    },
    methods: {
        validateEmail(){
            if(!this.email){
                this.errors.email = 'Email is required';
            }
            else if (!this.validEmail(this.email)) {
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
        validEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
        },
        async login(){
            this.validateEmail();
            this.validatePassword();

            if(Object.keys(this.errors).length===0){
              console.log(12);
                try {
                    const response = await axios.post('api/login',{
                        email:this.email,
                        password:this.password,
                    });
                    localStorage.setItem('auth_token', response.data.token);
                    this.$router.push({ name: 'Dashboard' });
                    localStorage.setItem('token', response.data.token);
                }catch(error){
                  console.log('inn');
                    if(error.response && error.response.status === 401)
                {
                    alert('Invalid credentials. Please try again.');
                }else
                {
                    alert('An error occurred. Please try again later.');
                }
                }
            }
            // else{
                // alert('please correct the errors before submitting');
            // }
        }
    },
}
</script>

<style scoped>
/* .error{
    color:red;
}
.login {
  max-width: 300px;
  margin: auto;
  padding: 1em;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.login h1 {
  text-align: center;
}

.login div {
  margin-bottom: 1em;
}

.login label {
  margin-bottom: .5em;
  color: #333333;
  display: block;
}

.login input {
  border: 1px solid #ccc;
  padding: .5em;
  font-size: 1em;
  border-radius: 4px;
  width: 100%;
}

.login button {
  padding: 0.7em;
  color: #fff;
  background-color: #007BFF;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
}

.login button:hover {
  background-color: #0056b3;
} */

.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f2f5;
}

.login-card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  max-width: 400px;
  width: 100%;
}

.login-title {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}

.login-form .form-group {
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

.registration-link {
  margin-top: 15px;
  text-align: center;
}

.registration-link a {
  color: #007bff;
  text-decoration: none;
}

.registration-link a:hover {
  text-decoration: underline;
}

</style>