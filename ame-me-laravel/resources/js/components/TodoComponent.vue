<template>
  <div class="todo-component">
    <h2 class="text-lg font-medium mb-3">Todo List</h2>
    
    <div class="mb-4">
      <div class="flex">
        <input 
          v-model="newTodo" 
          @keyup.enter="addTodo"
          type="text" 
          placeholder="Add a new task..." 
          class="flex-grow p-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
        >
        <button 
          @click="addTodo" 
          class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 transition-colors"
        >
          Add
        </button>
      </div>
    </div>
    
    <div v-if="todos.length > 0" class="space-y-2">
      <div 
        v-for="(todo, index) in todos" 
        :key="index"
        class="flex items-center justify-between p-3 border rounded-md dark:border-gray-700"
        :class="{ 'bg-gray-100 dark:bg-gray-800': todo.completed }"
      >
        <div class="flex items-center gap-2">
          <input 
            type="checkbox" 
            v-model="todo.completed" 
            class="w-4 h-4 accent-blue-500"
          >
          <span :class="{ 'line-through text-gray-500': todo.completed }">
            {{ todo.text }}
          </span>
        </div>
        <button 
          @click="removeTodo(index)"
          class="text-red-500 hover:text-red-700 transition-colors"
        >
          Delete
        </button>
      </div>
    </div>
    
    <div v-else class="text-gray-500 dark:text-gray-400 text-center p-4">
      No tasks yet. Add one above!
    </div>
    
    <div v-if="todos.length > 0" class="mt-4 text-sm text-gray-600 dark:text-gray-400">
      {{ completedCount }} of {{ todos.length }} tasks completed
    </div>
  </div>
</template>

<script>
export default {
  name: 'TodoComponent',
  data() {
    return {
      newTodo: '',
      todos: [
        { text: 'Learn Vue.js', completed: true },
        { text: 'Integrate Vue with Laravel', completed: false },
        { text: 'Build an awesome application', completed: false }
      ]
    }
  },
  computed: {
    completedCount() {
      return this.todos.filter(todo => todo.completed).length;
    }
  },
  methods: {
    addTodo() {
      if (this.newTodo.trim()) {
        this.todos.push({
          text: this.newTodo,
          completed: false
        });
        this.newTodo = '';
      }
    },
    removeTodo(index) {
      this.todos.splice(index, 1);
    }
  }
}
</script>

<style scoped>
.todo-component {
  max-width: 100%;
  width: 500px;
  margin: 0 auto;
}
</style> 