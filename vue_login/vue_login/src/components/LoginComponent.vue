<template>
    <div>
    <button @click="signInWithGoogle">Sign in with Google</button>
    <div v-if="user">
      <p>Welcome, {{ user.name }}</p>
      <img :src="user.picture" alt="User Picture">
    </div>
  </div>
</template>

<script setup >
import { ref } from 'vue';
import { useGoogleAuth } from 'vue3-google-login';

const user = ref(null);
const googleAuth = useGoogleAuth();

const signInWithGoogle = async () => {
  try {
    const googleUser = await googleAuth.signIn();
    user.value = {
      id: googleUser.getId(),
      name: googleUser.getName(),
      email: googleUser.getEmail(),
      picture: googleUser.getImageUrl()
    };
  } catch (error) {
    console.error('Google sign-in error', error);
  }
};
</script>

<style>
</style>