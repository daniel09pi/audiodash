<template>
  <div class="container mt-5 justify-content-center d-flex flex-column align-items-center">
    <!-- Auswahl Login / Register -->
    <div class="d-flex w-50 flex-row">
      <input 
        type="radio" 
        class="btn-check" 
        id="optionLogin" 
        value="login"
        v-model="mode"
      >
      <label class="btn w-100" for="optionLogin">Login</label>

      <input 
        type="radio" 
        class="btn-check" 
        id="optionRegister" 
        value="register"
        v-model="mode"
      >
      <label class="btn w-100" for="optionRegister">Register</label>
    </div>

    <!-- Formular -->
    <form class="mt-5 w-50" @submit.prevent="handleSubmit">
      <!-- Nur bei Registrierung Username -->
      <div v-if="mode === 'register'">
        <label class="form-label">Username:</label>
        <input 
          type="text" 
          class="form-control mb-3" 
          placeholder="@exampleUser" 
          v-model="form.first_name"
        >
        <div v-if="form.errors.first_name" class="text-danger">{{ form.errors.first_name }}</div>
      </div>

      <!-- Mail -->
      <label class="form-label">E-Mail:</label>
      <input 
        type="email" 
        class="form-control mb-3" 
        placeholder="testuser@test.com" 
        v-model="form.email"
      >
      <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>

      <!-- Passwort -->
      <label class="form-label">Password:</label>
      <input 
        type="password" 
        class="form-control mb-3" 
        placeholder="password123" 
        v-model="form.password"
      >
      <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>

      <!-- Nur bei Registrierung Passwort Bestätigung -->
      <div v-if="mode === 'register'">
        <label class="form-label">Confirm Password:</label>
        <input 
          type="password" 
          class="form-control mb-3" 
          placeholder="password123" 
          v-model="form.confirm_password"
        >
        <div v-if="form.errors.confirm_password" class="text-danger">{{ form.errors.confirm_password }}</div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-primary mt-3 w-100" :disabled="form.processing">
        {{ mode === 'login' ? 'Login' : 'Register' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps([
	'isLogin'
])

onMounted(() => {
	// Wenn der Benutzer bereits eingeloggt ist, zeige den Login-Button
	if (props.isLogin) {
		mode.value = 'login'
	} else {
		mode.value = 'register'
	}
})

// Modus: login oder register
const mode = ref('login')

// Formular-Daten mit useForm
const form = useForm({
  first_name: '',
  email: '',
  password: '',
  confirm_password: ''
})

// Submit-Handler
const handleSubmit = () => {
  if (mode.value === 'login') {
    form.post('/login');
  } else {
    form.post('/register');
  }
}
</script>
