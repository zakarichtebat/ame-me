<template>
  <section class="projects-section">
    <div class="container">
      <h2 class="section-title" :class="{ 'visible': titleVisible }" ref="sectionTitle">
        „High-Precision Milling, Turning & Gear Manufacturing for Advanced Engineering Solutions"
      </h2>
      
      <div class="services-grid">
        <div 
          v-for="(service, index) in services" 
          :key="index"
          class="service-box"
          :class="{ 'expanded': expandedService === index }"
          @click="toggleService(index)"
        >
          <div class="service-image">
            <img :src="service.image" :alt="service.title" />
          </div>
          <h3 class="service-title">{{ service.title }}</h3>
          
          <div class="service-details">
            <div class="service-info">
              <h4>{{ service.title }}</h4>
              <ul class="service-list">
                <li v-for="(item, i) in service.items" :key="i" class="service-item">
                  <span class="service-item-title">{{ item.title }}:</span> 
                  <span class="service-item-desc">{{ item.description }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <div class="more-info" v-show="showMoreInfo">
        <div class="service-section" v-for="(service, index) in services" :key="index">
          <h3>{{ service.title }}</h3>
          <ul>
            <li v-for="(item, i) in service.detailedItems" :key="i">
              <strong>{{ item.title }}:</strong> {{ item.description }}
            </li>
          </ul>
        </div>
      </div>
      
      <button @click="toggleMoreInfo" class="more-info-button">
        <span>{{ showMoreInfo ? 'Hide details' : 'Learn more...' }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="more-icon" :class="{ 'rotated': showMoreInfo }">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
    </div>
  </section>
</template>

<script>
import millingImage from '../components/image/expertise-edited.png';
import turningImage from '../components/image/proffessionalism-edited.png';
import gearsImage from '../components/image/expertiseee-edited.png';

export default {
  name: 'AnimatedProjectsComponent',
  data() {
    return {
      expandedService: null,
      titleVisible: false,
      showMoreInfo: false,
      services: [
        {
          title: 'Milling',
          image: millingImage,
          items: [
            { title: 'High-Precision Machining', description: 'Utilizing advanced CNC milling machines for precise and complex part fabrication.' },
            { title: 'Custom Solutions', description: 'Tailored milling solutions that meet specific client requirements across various industries.' },
            { title: 'Quality Control', description: 'Rigorous quality checks to ensure accurate dimensions and flawless finishes.' }
          ],
          detailedItems: [
            { title: 'High-Precision Machining', description: 'Utilizing advanced CNC milling machines for precise and complex part fabrication.' },
            { title: 'Custom Solutions', description: 'Tailored milling solutions that meet specific client requirements across various industries.' },
            { title: 'Quality Control', description: 'Rigorous quality checks to ensure accurate dimensions and flawless finishes.' }
          ]
        },
        {
          title: 'Turning',
          image: turningImage,
          items: [
            { title: 'Precision Turning', description: 'High-accuracy turning processes for parts with tight tolerances and critical specifications.' },
            { title: 'Versatile Capabilities', description: 'Manufacturing both simple and intricate cylindrical parts from a variety of materials.' },
            { title: 'Consistency & Efficiency', description: 'Streamlined production processes for consistent, efficient output at any scale.' }
          ],
          detailedItems: [
            { title: 'Precision Turning', description: 'High-accuracy turning processes for parts with tight tolerances and critical specifications.' },
            { title: 'Versatile Capabilities', description: 'Manufacturing both simple and intricate cylindrical parts from a variety of materials.' },
            { title: 'Consistency & Efficiency', description: 'Streamlined production processes for consistent, efficient output at any scale.' }
          ]
        },
        {
          title: 'Gears',
          image: gearsImage,
          items: [
            { title: 'Custom Gear Production', description: 'Crafting gears in a range of sizes and configurations to meet diverse applications.' },
            { title: 'Durability & Performance', description: 'Ensuring each gear meets high standards for strength, durability, and operational performance.' },
            { title: 'Expert Quality Assurance', description: 'Comprehensive testing and quality assurance for reliable, long-lasting gears.' }
          ],
          detailedItems: [
            { title: 'Custom Gear Production', description: 'Crafting gears in a range of sizes and configurations to meet diverse applications.' },
            { title: 'Durability & Performance', description: 'Ensuring each gear meets high standards for strength, durability, and operational performance.' },
            { title: 'Expert Quality Assurance', description: 'Comprehensive testing and quality assurance for reliable, long-lasting gears.' }
          ]
        }
      ]
    };
  },
  mounted() {
    this.setupTitleObserver();
  },
  methods: {
    toggleService(index) {
      if (this.expandedService === index) {
        this.expandedService = null;
      } else {
        this.expandedService = index;
      }
    },
    toggleMoreInfo() {
      this.showMoreInfo = !this.showMoreInfo;
    },
    setupTitleObserver() {
      const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
      };
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            this.titleVisible = true;
            observer.unobserve(entry.target);
          }
        });
      }, options);
      
      if (this.$refs.sectionTitle) {
        observer.observe(this.$refs.sectionTitle);
      }
    }
  }
};
</script>

<style scoped>
.projects-section {
  padding: 6rem 0;
  background-color: #111927;
  color: #f8fafc;
  position: relative;
  overflow: hidden;
}

.projects-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.1), transparent 70%);
  z-index: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
  position: relative;
  z-index: 1;
}

.section-title {
  text-align: center;
  font-size: 2.2rem;
  font-weight: 700;
  margin-bottom: 4rem;
  color: #f8fafc;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 1s ease, transform 1s ease;
  position: relative;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, #10b981, #3b82f6);
  transition: width 1s ease 0.5s;
}

.section-title.visible {
  opacity: 1;
  transform: translateY(0);
}

.section-title.visible::after {
  width: 120px;
}

/* Services Grid */
.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  margin-bottom: 3rem;
}

.service-box {
  border-radius: 12px;
  overflow: hidden;
  background-color: rgba(30, 41, 59, 0.3);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  transition: all 0.4s ease;
  cursor: pointer;
  position: relative;
  transform: translateY(30px);
  opacity: 0;
  animation: fadeInUp 0.5s forwards;
  animation-delay: calc(var(--index, 0) * 0.2s);
}

.service-box:nth-child(1) {
  --index: 1;
}

.service-box:nth-child(2) {
  --index: 2;
}

.service-box:nth-child(3) {
  --index: 3;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.service-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
}

.service-image {
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.service-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.service-box:hover .service-image img {
  transform: scale(1.05);
}

.service-title {
  text-align: center;
  font-size: 1.5rem;
  font-weight: 600;
  padding: 1.5rem;
  margin: 0;
  border-bottom: 2px solid rgba(16, 185, 129, 0.3);
  background-color: rgba(30, 41, 59, 0.8);
  transition: background-color 0.3s ease;
}

.service-box:hover .service-title {
  background-color: rgba(16, 185, 129, 0.2);
}

.service-details {
  height: 0;
  overflow: hidden;
  transition: height 0.4s ease;
}

.service-box.expanded .service-details {
  height: auto;
  padding: 1.5rem;
}

.service-info h4 {
  margin-top: 0;
  font-size: 1.2rem;
  margin-bottom: 1rem;
  color: #10b981;
}

.service-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.service-item {
  margin-bottom: 1rem;
  padding-left: 1.5rem;
  position: relative;
}

.service-item:before {
  content: '•';
  position: absolute;
  left: 0;
  color: #10b981;
  font-size: 1.2rem;
}

.service-item-title {
  font-weight: 600;
  color: #f8fafc;
}

.service-item-desc {
  color: #cbd5e1;
}

/* More Info Section */
.more-info {
  background-color: rgba(30, 41, 59, 0.4);
  border-radius: 12px;
  padding: 2rem;
  margin-top: 2rem;
  margin-bottom: 2rem;
  border: 1px solid rgba(16, 185, 129, 0.2);
  transform: translateY(20px);
  opacity: 0;
  animation: fadeIn 0.4s forwards;
}

@keyframes fadeIn {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.service-section {
  margin-bottom: 2rem;
}

.service-section h3 {
  color: #10b981;
  font-size: 1.4rem;
  margin-top: 0;
  margin-bottom: 1rem;
  border-bottom: 1px solid rgba(16, 185, 129, 0.3);
  padding-bottom: 0.5rem;
}

.service-section ul {
  list-style-type: none;
  padding-left: 0;
}

.service-section li {
  margin-bottom: 0.75rem;
  padding-left: 1.5rem;
  position: relative;
}

.service-section li:before {
  content: '•';
  position: absolute;
  left: 0;
  color: #10b981;
}

.service-section strong {
  color: #f8fafc;
}

.more-info-button {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  background: none;
  border: none;
  color: #cbd5e1;
  cursor: pointer;
  font-size: 1rem;
  margin: 2rem auto 0;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  transition: all 0.3s ease;
}

.more-info-button:hover {
  color: #10b981;
  background-color: rgba(16, 185, 129, 0.1);
}

.more-icon {
  transition: transform 0.3s ease;
}

.more-icon.rotated {
  transform: rotate(180deg);
}

/* Responsive styles */
@media (max-width: 1024px) {
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .section-title {
    font-size: 2rem;
  }
}

@media (max-width: 768px) {
  .services-grid {
    grid-template-columns: 1fr;
  }
  
  .service-title {
    font-size: 1.3rem;
  }
  
  .section-title {
    font-size: 1.8rem;
  }
}

@media (max-width: 640px) {
  .section-title {
    font-size: 1.6rem;
  }
}
</style> 