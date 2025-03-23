<template>
  <div class="example-component">
    <h1>{{ title }}</h1>
    <p>This is an example Vue component.</p>
    <button @click="incrementCount">Count: {{ count }}</button>
  </div>
</template>

<script>
export default {
  name: 'ExampleComponent',
  data() {
    return {
      title: 'Hello Vue!',
      count: 0
    }
  },
  methods: {
    incrementCount() {
      this.count++;
    }
  }
}
</script>

<style scoped>
.example-component {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 20px;
  margin: 20px 0;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
  color: #42b983;
}

button {
  background-color: #42b983;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

button:hover {
  background-color: #3aa776;
}
</style> 