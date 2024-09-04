<template>
  <div>
    <div class="flex mt-6 mb-10">
      <div
        class="flex flex-wrap w-full px-4 mx-auto md:max-w-6xl md:flex-row-reverse"
      >
        <div class="w-full md:w-1/2 md:p-6">
          <div class="sticky p-6 border rounded-md shadow-md top-4">
            <h2 class="text-2xl font-semibold">
              Login to vsForms
            </h2>
            <p class="text-sm text-gray-500">
              Welcome back! Please enter your details.
            </p>

            <login-form />
          </div>
        </div>
        <div class="w-full mt-8 md:w-1/2 md:p-6 md:mt-0">
          <h1 class="font-bold">
            Create beautiful forms and share them anywhere
          </h1>
          <p class="my-4 text-lg text-gray-900">
            It takes seconds, you don't need to know how to code and it's free.
          </p>
          <div class="flex flex-wrap justify-center">
            <p class="px-3 pb-3 text-sm text-gray-500">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="inline w-4 h-4"
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
                class="inline w-4 h-4"
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
                class="inline w-4 h-4"
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
