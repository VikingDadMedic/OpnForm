<template>
  <div class="flex items-center">
    <div class="flex-shrink-0">
      <img
        v-if="logoUrl"
        :src="logoUrl"
        alt="VS Forms Logo"
        class="h-8 w-auto"
      />
      <div v-else class="text-primary-600 font-bold text-xl">
        VS Forms
      </div>
    </div>
    <div v-if="showText" class="ml-2 text-xl font-sem
