<template>
  <div class="container" style="height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;">
    <img alt="Vue logo" class="logo d-flex justify-content-center w-100 mb-5" src="@/assets/logo.svg"  height="50" />
    <form class="row g-3" @submit="onSubmit">
      <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" v-model="form.email">
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" v-model="form.password">
      </div>
      <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="w-100 mt-2 submit" :disabled="loading || !form.email || !form.password">Sign in</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

const form = ref({
  email: '',
  password: ''
})

const loading = ref(false)

const router = useRouter();
const store = useStore();

const onSubmit = async (event) => {
  event.preventDefault()
  loading.value = true;
  store.dispatch("login", form.value).then(res => {
    if(res.status === 200) {
      loading.value = false;
      router.push('/')
    }
  })
};
</script>
