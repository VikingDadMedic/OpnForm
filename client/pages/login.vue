<template>
  <div>
    <div class="min-h-screen md:py-6 md:flex">
      <div class="flex flex-col z-30 justify-center py-6 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
          <div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
              Login to VS Forms
            </h2>
            <p class="text-sm text-gray-500">
              Welcome back! Please enter your details.
            </p>

            <login-form />
          </div>
        </div>
      </div>
      <div class="hidden md:block md:w-1/2">
        <h1 class="font-bold">
          Create beautiful forms and share them anywhere
        </h1>
        <p class="text-gray-900 my-4 text-lg">
          It takes seconds, you don't need to know how to code and it's free.
        </p>
        <div class="flex flex-wrap justify-center">
          <p class="px-3 pb-3 text-sm text-gray-500">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 inline"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M5 13l4 4L19 7"
              />
            </svg>
            Unlimited forms
          </p>
          <p class="px-3 pb-3 text-sm text-gray-500">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 inline"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M5 13l4 4L19 7"
              />
            </svg>
            Unlimited fields
          </p>
          <p class="px-3 pb-3 text-sm text-gray-500">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 inline"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M5 13l4 4L19 7"
              />
            </svg>
            Unlimited submissions
          </p>
        </div>
      </div>
    </div>
    <open-form-footer />
  </div>
</template>

<script setup>
import LoginForm from "~/components/pages/auth/components/LoginForm.vue"

definePageMeta({
  middleware: "guest",
})
useOpnSeoMeta({
  title: "Login",
})
</script>
