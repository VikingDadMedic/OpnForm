<template>
  <div>
    <select v-model="selectedTheme">
      <option value="vs-forms">VS Forms</option>
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      themes: [
        {
          name: 'VS Forms',
          value: 'vs-forms',
          description: 'Travel advisor theme by Voyager Social AI'
        }
      ],
    }
  },
}
</script>
