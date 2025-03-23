import './bootstrap';
import { createApp } from 'vue';

// Import Vue components
import ExampleComponent from './components/ExampleComponent.vue';
import TodoComponent from './components/TodoComponent.vue';
import AnimatedHeroComponent from './components/AnimatedHeroComponent.vue';
import AnimatedAchievementsComponent from './components/AnimatedAchievementsComponent.vue';
import AnimatedServicesComponent from './components/AnimatedServicesComponent.vue';
import AnimatedContactComponent from './components/AnimatedContactComponent.vue';
import AnimatedHeaderComponent from './components/AnimatedHeaderComponent.vue';
import AnimatedSliderComponent from './components/AnimatedSliderComponent.vue';
import AnimatedIndustrialServicesComponent from './components/AnimatedIndustrialServicesComponent.vue';
import AnimatedMaintenanceServicesComponent from './components/AnimatedMaintenanceServicesComponent.vue';
import AnimatedProjectsComponent from './components/AnimatedProjectsComponent.vue';
import AnimatedMaintenanceComponent from './components/AnimatedMaintenanceComponent.vue';
import AnimatedFooterComponent from './components/AnimatedFooterComponent.vue';
import AnimatedAboutComponent from './components/AnimatedAboutComponent.vue';
import AnimatedCGVSComponent from './components/AnimatedCGVSComponent.vue';

// Initialize Vue app
const app = createApp({});

// Register components globally
app.component('example-component', ExampleComponent);
app.component('todo-component', TodoComponent);
app.component('animated-hero', AnimatedHeroComponent);
app.component('animated-achievements', AnimatedAchievementsComponent);
app.component('animated-services', AnimatedServicesComponent);
app.component('animated-contact', AnimatedContactComponent);
app.component('animated-header', AnimatedHeaderComponent);
app.component('animated-slider', AnimatedSliderComponent);
app.component('animated-industrial', AnimatedIndustrialServicesComponent);
app.component('animated-maintenance', AnimatedMaintenanceServicesComponent);
app.component('animated-projects', AnimatedProjectsComponent);
app.component('animated-maintenance-info', AnimatedMaintenanceComponent);
app.component('animated-footer', AnimatedFooterComponent);
app.component('animated-about', AnimatedAboutComponent);
app.component('animated-cgvs', AnimatedCGVSComponent);

// Mount the app
app.mount('#app');
